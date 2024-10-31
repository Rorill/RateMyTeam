<?php
namespace App\Controller;

use App\Repository\TeamsRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use http\Client;

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

        $matches = $data['matches'] ?? [];

        foreach ($matches as $match) {
            $game = new Game();
            $game->setDate(new \DateTime($match['utcDate']));
            $game->setMatchday($match['matchday']);
            $game->setStage($match['stage']);
            $game->setApiMatchId($match['id']);

            $homeTeam = $this->ligue1TeamsRepository->find($match['homeTeam']);
            $awayTeam = $this->ligue1TeamsRepository->find($match['awayTeam']);

            $game->setTeamHome($homeTeam);
            $game->setTeamAway($awayTeam);

            $score = $match['score']['fullTime'] ?? null;
            if ($score !== null) {
                $game->setScoreHome($score['home']);
                $game->setScoreAway($score['away']);

            }
            $this->entityManager->persist($game);

        }
        $this->entityManager->flush();

        return new JsonResponse();


    }
}
