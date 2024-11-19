<?php
namespace App\Controller;

use App\Entity\Game;
use App\Entity\Lineup;
use App\Entity\Players;
use App\Repository\LineupRepository;
use App\Repository\PlayersRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use http\Client;
use Doctrine\ORM;
use Doctrine\ORM\QueryBuilder;
use App\Entity\Ligue1Teams;
use App\Repository\TeamsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\GameRepository;
use Symfony\Component\Console\Logger;


class MatchController extends AbstractController
{
    private $entityManager;
    private $client;

    private GameRepository $gameRepository;

    public function __construct(EntityManagerInterface $entityManager, HttpClientInterface $client)
    {
        $this->entityManager = $entityManager;
        $this->client = $client;
    }


    #[Route('/import-games', name: "import_games")]
    public function importAllGames(HttpClientInterface $client, EntityManagerInterface $entityManager): Response
    {
        // Get the current year for the season
        $season = (int)date("Y");

        // Fetch all the games for the season using the API
        try {
            $this->importGamesForSeason($season, $client, $entityManager);
            return new Response('Games imported successfully.');
        } catch (\Exception $e) {
            // Log the error and return an error message
            file_put_contents('D:/Dev/RateMyTeam/debug.log', "Error importing games: " . $e->getMessage() . "\n", FILE_APPEND);
            return new Response('Error importing games: ' . $e->getMessage(), 500);
        }
    }

    private function importGamesForSeason(int $season, HttpClientInterface $client, EntityManagerInterface $entityManager)
    {
        $url = "https://v3.football.api-sports.io/fixtures?season={$season}&league=61";

        // Set the API key and make the request
        $apiKey = '817f5048f12a77621a46a76d0ca25df6';
        $response = $client->request('GET', $url, [
            'headers' => [
                'x-rapidapi-host' => 'v3.football.api-sports.io',
                'x-rapidapi-key' => $apiKey,
            ]
        ]);

        // Check the response status code
        if ($response->getStatusCode() !== 200) {
            throw new \Exception('API request failed with status ' . $response->getStatusCode());
        }

        // Get the response content as an array
        $responseData = $response->toArray();

        // Log the full response structure to see what's returned
        file_put_contents('D:/Dev/RateMyTeam/debug.log', "Response Data: " . print_r($responseData, true) . "\n", FILE_APPEND);

        // Check if 'response' exists in the response data
        if (!isset($responseData['response']) || empty($responseData['response'])) {
            // Log and handle the error if the 'response' key is missing or empty
            file_put_contents('D:/Dev/RateMyTeam/debug.log', "No fixtures found or invalid response format.\n", FILE_APPEND);
            throw new \Exception('No fixtures found in the response or invalid response format.');
        }

        // Process the fixtures if they exist
        foreach ($responseData['response'] as $game) {
            $this->saveGame($game, $entityManager);
        }
    }

    private function saveGame(array $gameData, EntityManagerInterface $entityManager)
    {
        // Fetch home and away teams by their API IDs
        $teamHome = $this->entityManager->getRepository(Ligue1Teams::class)->findOneBy(['ApiId' => $gameData['teams']['home']['id']]);
        $teamAway = $this->entityManager->getRepository(Ligue1Teams::class)->findOneBy(['ApiId' => $gameData['teams']['away']['id']]);

        if (!$teamHome || !$teamAway) {
            throw new \Exception('Invalid team data: home or away team not found.');
        }

        $game = new Game();
        $game->setDate(new \DateTime($gameData['fixture']['date']));
        $game->setTeamHome($teamHome);
        $game->setTeamAway($teamAway);
        $game->setScoreHome($gameData['score']['fulltime']['home']);
        $game->setScoreAway($gameData['score']['fulltime']['away']);
        $game->setStage($gameData['league']['round']);
        $game->setApiMatchId($gameData['fixture']['id']);

        // Persist the game to the database
        $entityManager->persist($game);
        $entityManager->flush();
    }
    #[Route('/stages', name: 'stages')]
    public function stages(EntityManagerInterface $entityManager): Response
    {
        // Fetch all unique stages from the database (assuming games are already imported)
        $stages = $entityManager->getRepository(Game::class)->createQueryBuilder('g')
            ->select('DISTINCT g.stage')
            ->getQuery()
            ->getResult();

        // Flatten the array if necessary (extracting just the stage values)
        $stages = array_map(function ($stage) {
            return $stage['stage'];
        }, $stages);

        // Pass the stages to the view
        return $this->render('admin/stages/stages.html.twig', [
            'stages' => $stages,
        ]);
    }

    #[Route('/games/stage/{stage}', name: 'games_by_stage')]
    public function gamesByStage(string $stage, EntityManagerInterface $entityManager): Response
    {
        // Fetch all games for the given stage
        $games = $entityManager->getRepository(Game::class)->findBy(['stage' => $stage]);

        return $this->render('admin/stages/gamesByStages.html.twig', [
            'stage' => $stage,
            'games' => $games,
        ]);
    }
    #[Route('/import-lineup/{id}', name: 'importLineup', methods: ['POST'])]
    public function importLineupForGame(
        int $id,
        EntityManagerInterface $entityManager,  // Use the EntityManager directly
        GameRepository $gameRepository,
        HttpClientInterface $httpClient,
        TeamsRepository $teamsRepository,
    ): Response {
        // Find the game by ID (this is the internal game ID in your database)
        $game = $gameRepository->find($id);

        if (!$game) {
            return $this->json(['error' => 'Game not found'], Response::HTTP_NOT_FOUND);
        }

        try {
            // Fetch the lineups from the API based on the apiMatchId (external ID from your database)
            $externalApiId = $game->getApiMatchId();  // Get the external API match ID from your database

            if (!$externalApiId) {
                return $this->json(['error' => 'External API ID not found for the game'], Response::HTTP_BAD_REQUEST);
            }

            // Construct the API URL using the external API match ID
            $url = "https://v3.football.api-sports.io/fixtures/lineups?fixture=$externalApiId";

            // Send the request to the API
            $response = $httpClient->request('GET', $url, [
                'headers' => [
                    'x-rapidapi-host' => 'v3.football.api-sports.io',
                    'x-rapidapi-key' => '817f5048f12a77621a46a76d0ca25df6',
                ],
            ]);

            // Get the response data as an array
            $data = $response->toArray();

            // If lineups are available, proceed with processing
            if (isset($data['response']) && count($data['response']) > 0) {
                foreach ($data['response'] as $teamLineup) {
                    // Find the team by its API ID (from the lineup data)
                    $team = $teamsRepository->findOneBy(['ApiId' => $teamLineup['team']['id']]);
                    if (!$team) {
                        continue; // Skip if team not found
                    }

                    // Create and persist the lineup for the game and team
                    $lineup = new Lineup();
                    $lineup->setGame($game);
                    $lineup->setTeam($team);

                    // Add the starter lineup (just a simplified example, you can add more details later)
                    $lineup->setStarter(true);
                    $entityManager->persist($lineup);

                    // Add the substitute lineup (again simplified)
                    $lineup->setStarter(false);
                    $entityManager->persist($lineup);
                }

                // Persist the lineups to the database
                $entityManager->flush();
            }
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->json(['message' => 'Lineup imported successfully']);
    }

}


