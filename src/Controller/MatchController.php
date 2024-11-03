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
use http\Env\Response;

class MatchController extends AbstractController
{
    private HttpClientInterface $httpClient;
    private EntityManagerInterface $entityManager;
    private TeamsRepository $ligue1TeamsRepository;

    public function __construct(
        HttpClientInterface $client,
        EntityManagerInterface $entityManager,
        TeamsRepository $ligue1TeamsRepository
    ) {
        $this->httpClient = $client;
        $this->entityManager = $entityManager;
        $this->ligue1TeamsRepository = $ligue1TeamsRepository;
    }

    #[Route('/import-matches', name: 'import_matches')]
    public function importMatches(): JsonResponse
    {
        $url = 'https://api.football-data.org/v4/competitions/FL1/matches';
        $token = '78a7c9b17f784d6993ad0a9fcb3bed11';

        // Fetch data from the API
        $response = $this->httpClient->request('GET', $url, [
            'headers' => [
                'X-Auth-Token' => $token,
            ],
        ]);
        $statusCode = $response->getStatusCode();

        if ($statusCode !== 200) {
            return new JsonResponse(['error' => 'Unable to fetch data from API'], $statusCode);
        }

        $content = $response->toArray();
        $matches = $content['matches'] ?? [];
        $count = 0;

        foreach ($matches as $match) {
            $game = new Game();
            $game->setDate(new \DateTime($match['utcDate']));
            $game->setMatchday($match['matchday']);
            $game->setStage($match['stage']);
            $game->setApiMatchId($match['id']);

            // Find teams by their API ID
            $homeTeam = $this->ligue1TeamsRepository->findOneBy(['ApiId' => $match['homeTeam']['id']]);
            $awayTeam = $this->ligue1TeamsRepository->findOneBy(['ApiId' => $match['awayTeam']['id']]);

            // Skip match if either team is missing
            if (!$homeTeam || !$awayTeam) {
                continue;
            }

            $game->setTeamHome($homeTeam);
            $game->setTeamAway($awayTeam);

            // Set score
            $score = $match['score']['fullTime'] ?? null;
            if ($score !== null) {
                $game->setScoreHome($score['home']);
                $game->setScoreAway($score['away']);
            }

            $this->entityManager->persist($game);
            $count++;
        }

        // Flush all persisted games
        $this->entityManager->flush();

        return new JsonResponse(['status' => 'success', 'matches_imported' => $count]);
    }


    #[Route('/import-teams', name: 'import_teams')]
    public function importTeams(): JsonResponse
    {

        $url = 'https://api.football-data.org/v4/competitions/FL1/teams';
        $token = '78a7c9b17f784d6993ad0a9fcb3bed11';

        // Fetch data from the API
        $response = $this->httpClient->request('GET', $url, [
            'headers' => [
                'X-Auth-Token' => $token,
            ],
        ]);
        $statusCode = $response->getStatusCode();

        if ($statusCode !== 200) {
            return new JsonResponse(['error' => 'Unable to fetch data from API'], $statusCode);
        }

        $content = $response->toArray();
        $teams = $content['teams'] ?? [];
        foreach ($teams as $teamData) {
            if (empty($teamData['id'])) {
                continue; // Skip if no `id` is present for the team
            }

            $apiId = $teamData['id'];


            $team = $this->entityManager->getRepository(Ligue1Teams::class)->findOneBy(['ApiId' => $apiId]);

            if ($team) {
                // Update only properties that have changed
                if ($team->getName() !== ($teamData['name'] ?? null)) {
                    $team->setName($teamData['name']);
                }
                if ($team->getShortName() !== ($teamData['shortName'] ?? null)) {
                    $team->setShortName($teamData['shortName']);
                }
                if ($team->getTla() !== ($teamData['tla'] ?? null)) {
                    $team->setTla($teamData['tla']);
                }
                if (isset($teamData['coach']['name']) && $team->getCoach() !== $teamData['coach']['name']) {
                    $team->setCoach($teamData['coach']['name']);
                } elseif (!isset($teamData['coach']['name'])) {
                    $team->setCoach(null); // Set to null if no coach data is available
                }
                if ($team->getFounded() !== ($teamData['founded'] ?? null)) {
                    $team->setFounded($teamData['founded']);
                }
                if ($team->getAddress() !== ($teamData['address'] ?? null)) {
                    $team->setAddress($teamData['address']);
                }
                if ($team->getVenue() !== ($teamData['venue'] ?? null)) {
                    $team->setVenue($teamData['venue']);
                }
            } else {
                // Create a new team if it does not exist
                $team = new Ligue1Teams();
                $team->setApiId($apiId);
                $team->setName($teamData['name'] ?? null);
                $team->setShortName($teamData['shortName'] ?? null);
                $team->setTla($teamData['tla'] ?? null);

                if (isset($teamData['coach']['name'])) {
                    $team->setCoach($teamData['coach']['name']);
                } else {
                    $team->setCoach(null);
                }

                $team->setFounded($teamData['founded'] ?? null);
                $team->setAddress($teamData['address'] ?? null);
                $team->setVenue($teamData['venue'] ?? null);

                $this->entityManager->persist($team);
            }
        }

// Save all changes to the database
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Teams imported and updated successfully'], JsonResponse::HTTP_OK);
    }





}
