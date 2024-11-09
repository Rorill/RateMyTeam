<?php
namespace App\Controller;

use App\Entity\Game;
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
        $game->setMatchday((int) $gameData['league']['round']);
        $game->setStage($gameData['league']['round']);
        $game->setApiMatchId($gameData['fixture']['id']);

        // Persist the game to the database
        $entityManager->persist($game);
        $entityManager->flush();
    }

}