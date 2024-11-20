<?php

namespace App\Controller;

use App\Form\ChangePasswordFormType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\TeamsRepository;
use App\Repository\GameRepository;
use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;

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
        $selectedTeam = $user->getSelectedTeam();
        // Fetch last game
        $lastGame = $gamesRepository->findLastGameByTeam($selectedTeam->getId());

        // Fetch next 5 games
        $nextGames = $gamesRepository->findNextGamesByTeam($selectedTeam->getId(), 5);

        return $this->render('User/index.html.twig', [
            'selectedTeam' => $selectedTeam,
            'lastGame' => $lastGame,
            'nextGames' => $nextGames,
            'user' => $user,
            'email' => $user->getEmail(),
        ]);
    }

    #[Route('/profile', name: 'app_user_profile')]
    public function profile(): Response
    {
        // Get the current user
        $user = $this->getUser();

        // Render the profile page with user's email
        return $this->render('user/profile.html.twig', [
            'email' => $user->getEmail(),
        ]);
    }

    #[Route('/profile/update-password', name: 'app_profile_update_password', methods: ['POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function updatePassword(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $newPassword = $request->get('newPassword');
        $confirmPassword = $request->get('confirmPassword');

        if ($newPassword === $confirmPassword) {
            $user->setPassword($passwordHasher->hashPassword($user, $newPassword));
            $entityManager->flush();

            $this->addFlash('success', 'Your password has been updated.');
            return $this->redirectToRoute('app_profile');
        } else {
            $this->addFlash('error', 'Passwords do not match.');
            return $this->redirectToRoute('app_profile');
        }
    }







}