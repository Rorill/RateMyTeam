<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\TeamsRepository;
use App\Repository\GameRepository;
use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\IsGranted;
class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/index', name: 'app_game')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function mainPage(TeamsRepository $teamsRepository, GameRepository $gamesRepository, UserRepository $userRepository): Response
    {
        $user = $this->getUser(); // Get the authenticated user
        $selectedTeam = $user->getSelectedTeam(); // Assume this gets the user's selected team

        // Fetch last game
        $lastGame = $gamesRepository->findLastGameByTeam($selectedTeam->getId());

        // Fetch next 5 games
        $nextGames = $gamesRepository->findNextGamesByTeam($selectedTeam->getId(), 5);

        return $this->render('User/index.html.twig', [
            'selectedTeam' => $selectedTeam,
            'lastGame' => $lastGame,
            'nextGames' => $nextGames,
        ]);
    }



}