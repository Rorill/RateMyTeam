<?php
namespace App\Controller;

use App\Entity\Game;
use App\Entity\Lineup;
use App\Entity\Players;
use App\Repository\LineupRepository;
use App\Repository\PlayersRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\IsGranted;
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

    private TeamsRepository $teamsRepository;

    private GameRepository $gameRepository;

    public function __construct(EntityManagerInterface $entityManager, HttpClientInterface $client)
    {
        $this->entityManager = $entityManager;
        $this->client = $client;
    }


    #[Route('/import-games', name: "import_games")]
    #[isGranted('ROLE_ADMIN')]

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
    #[isGranted('ROLE_ADMIN')]

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

    #[Route('/import-lineups/{gameId}', name: 'lineupPerGame')]
    #[isGranted('ROLE_ADMIN')]

    public function fetchDataAndInsertLineups(int $gameId, GameRepository $gameRepository, TeamsRepository $teamRepository, PlayersRepository $playersRepository, HttpClientInterface $client,): Response
    {
        $apiKey = '817f5048f12a77621a46a76d0ca25df6'; // Replace with your actual API key
        $apiUrl = "https://v3.football.api-sports.io/fixtures/lineups?fixture={$gameId}";

        try {
            // 1. Fetch lineup data from the API
            $response = $client->request('GET', $apiUrl, [
                'headers' => [
                    'x-apisports-key' => $apiKey,
                    'x-rapidapi-host' => 'v3.football.api-sports.io',
                ],
            ]);

            $statusCode = $response->getStatusCode();
            if ($statusCode !== 200) {
                throw new \Exception("API request failed with status code: {$statusCode}");
            }

            $data = $response->toArray();
            $lineupsData = $data['response'];

            // 2. Process and insert data for each team in the lineup
            foreach ($lineupsData as $lineup) {
                $teamId = $lineup['team']['id'];
                $team = $teamRepository->find($teamId);
                if (!$team) {
                    throw new \Exception("Team with ID {$teamId} not found.");
                }

                $game = $gameRepository->find($gameId);
                if (!$game) {
                    throw new \Exception("Game with ID {$gameId} not found.");
                }

                $starterLineup = new Lineup();
                $starterLineup->setGame($game);
                $starterLineup->setTeam($team);
                $starterLineup->setStarter(true);
                $this->entityManager->persist($starterLineup);

                foreach ($lineup['startXI'] as $playerData) {
                    $playerId = $playerData['player']['id'];
                    $player = $playersRepository->findOneBy(['ApiId' => $playerId]);

                    if (!$player) {
                        throw new \Exception("Player with API ID {$playerId} not found in the database.");
                    }

                    $starterLineup->addPlayer($player);
                }

                $substituteLineup = new Lineup();
                $substituteLineup->setGame($game);
                $substituteLineup->setTeam($team);
                $substituteLineup->setStarter(false);
                $this->entityManager->persist($substituteLineup);

                foreach ($lineup['substitutes'] as $playerData) {
                    $playerId = $playerData['player']['id'];
                    $player = $playersRepository->findOneBy(['ApiId' => $playerId]);

                    if (!$player) {
                        throw new \Exception("Player with API ID {$playerId} not found in the database.");
                    }

                    $substituteLineup->addPlayer($player);
                }
            }

            $this->entityManager->flush();

            // Redirect to the match page after the lineup import
            return($this->redirectToRoute('stages'));

        } catch (\Exception $e) {
            $this->addFlash('error', 'An error occurred while importing lineups: ' . $e->getMessage());
            return $this->redirectToRoute('game_show', ['id' => $gameId]); // Redirect to the game page on error
        }
    }

}