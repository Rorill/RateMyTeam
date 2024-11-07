<?php
namespace App\Controller;

use App\Entity\Game;
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

class MatchController extends AbstractController
{
    private $entityManager;
    private $client;

    public function __construct(EntityManagerInterface $entityManager, HttpClientInterface $client)
    {
        $this->entityManager = $entityManager;
        $this->client = $client;
    }


    #[Route('/import-games', name:"import_games")]
    public function importAllGames()
    {
        // Get the current year for the season
        $season = (int) date("Y");

        // Fetch all the games for the season using the API
        $this->importGamesForSeason($season);

        return new Response('Games imported successfully.');
    }

    private function importGamesForSeason(int $season)
    {
        $url = "https://v3.football.api-sports.io/fixtures?league=61&season={$season}";
        $response = $this->client->request('GET', $url, [
            'headers' => [
                'X-Auth-Token' => 'YOUR_API_TOKEN'
            ]
        ]);

        // Check the structure of the response before accessing it
        $responseData = $response->toArray();

        // Log or debug the full response structure to see what's returned
        dump($responseData); // Symfony's debug function

        // Check if 'response' exists in the response data
        if (!isset($responseData['response'])) {
            // Handle the error - you can log the error or return a message
            return new Response('No fixtures found in the response or invalid response format.', 500);
        }

        // Process the fixtures if they exist
        foreach ($responseData['response'] as $game) {
            $this->saveGame($game);
        }
    }

    private function saveGame(array $gameData)
    {
        // Fetch home and away teams by their API IDs
        $teamHome = $this->entityManager->getRepository(Ligue1Teams::class)->find($gameData['teams']['home']['id']);
        $teamAway = $this->entityManager->getRepository(Ligue1Teams::class)->find($gameData['teams']['away']['id']);

        $game = new Game();
        $game->setDate(new \DateTime($gameData['fixture']['date']));
        $game->setTeamHome($teamHome);
        $game->setTeamAway($teamAway);
        $game->setScoreHome($gameData['score']['fulltime']['home']);
        $game->setScoreAway($gameData['score']['fulltime']['away']);
        $game->setMatchday($gameData['league']['round']);
        $game->setStage($gameData['league']['round']);
        $game->setApiMatchId($gameData['fixture']['id']);

        // Persist the game to the database
        $this->entityManager->persist($game);
        $this->entityManager->flush();
    }

}

