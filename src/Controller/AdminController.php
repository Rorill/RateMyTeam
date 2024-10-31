<?php
namespace App\Controller;

use App\Entity\Ligue1Teams;
use App\Entity\Players;
use App\Entity\User;
use App\Form\AddPlayerType;
use App\Form\PlayerType;
use App\Repository\PlayersRepository;
use App\Repository\TeamsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
#[Route('/admin', name: 'admin_dashboard')]
public function index(TeamsRepository $teamsRepository, EntityManagerInterface $entityManager): Response
{
    $userCount = $entityManager->getRepository(User::class)->count([]);
    $playerCount = $entityManager->getRepository(Players::class)->count([]);

    $teamCount = $entityManager->getRepository(Ligue1Teams::class)->count([]);

// Récupère le nombre total d'utilisateurs
$userCount = $entityManager->getRepository(User::class)->count([]);

return $this->render('admin/AdminDashboard.html.twig', [
'teamCount' => $teamCount,
'userCount' => $userCount,
    'playerCount' => $playerCount,
]);

// User Management
}
    #[Route('/admin/users', name: 'admin_users')]
    public function manageUsers(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll(); // Récupérer tous les utilisateurs

        return $this->render('admin/Users/manageUsers.html.twig', [
            'users' => $users,
        ]);
    }


    // add user

    #[Route('/admin/users/add', name: 'admin_add_user')]
    public function addUser(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, TeamsRepository $teamsRepository): Response
    {
        $teams = $teamsRepository->findAll();

        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $password = $request->request->get('password');

            $user = new User();
            $user->setEmail($email);
            $user->setPassword($passwordHasher->hashPassword($user, $password)); // Utiliser hashPassword à la place d'encodePassword
            $user->setRoles(['ROLE_USER']); // Attribuer le rôle par défaut

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin_users');
        }

        return $this->render('admin/Users/addUser.html.twig', [
            'teams' => $teams, // Passer les équipes au template
        ]);


    }


    // edit User
    #[Route('/admin/users/edit/{id}', name: 'admin_edit_user')]
    public function editUser(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, TeamsRepository $teamsRepository, int $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        $teams = $teamsRepository->findAll();

        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $password = $request->request->get('password');
            $teamId = $request->request->get('team'); // Récupérer l'ID de l'équipe sélectionnée

            $user->setEmail($email);

            if ($password) {
                $user->setPassword($passwordHasher->hashPassword($user, $password)); // Utiliser hashPassword à la place d'encodePassword
            }

            $team = $teamsRepository->find($teamId);
            $user->setSelectedTeam($team);

            $entityManager->flush();

            return $this->redirectToRoute('admin_users');
        }

        return $this->render('admin/Users/editUser.html.twig', [
            'user' => $user,
            'teams' => $teams,
        ]);
    }

    #[Route('/admin/users/delete/{id}', name: 'admin_delete_user')]
    public function deleteUser(Request $request, User $user, EntityManagerInterface $entityManager, TeamsRepository $teamsRepository): Response
    {
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('admin_users');
    }

    #[Route('/admin/team/{id}/players', name: 'admin_team_players')]
    public function teamPlayers(int $id, TeamsRepository $teamsRepository, Request $request, EntityManagerInterface $entityManager): Response
    {

        $team = $teamsRepository->find($id);

        if (!$team) {
            throw $this->createNotFoundException('Team not found');
        }

        $players = $team->getPlayers();

        // Create a new player
        $player = new Players();
        $form = $this->createForm(PlayerType::class, $player);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Assigner l'équipe au joueur
            $player->setTeam($team);
            $entityManager->persist($player);
            $entityManager->flush();

            return $this->redirectToRoute('admin_team_players', ['id' => $team->getId()]);
        }

        return $this->render('admin/Teams/teamManagement.html.twig', [
            'team' => $team,
            'players' => $players,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/teams', name: 'admin_team_list')]
    public function teamListing(TeamsRepository $teamsRepository): Response
    {
        // Récupère toutes les équipes
        $teams = $teamsRepository->findAll();

        return $this->render('admin/Teams/teamList.html.twig', [
            'teams' => $teams,
        ]);
    }


    public function teamList(TeamsRepository $teamsRepository): Response
    {
        $teams = $teamsRepository->findAll();

        return $this->render('admin/teamList.html.twig', [
            'teams' => $teams,
        ]);
    }

    #[Route('/admin/team/{id}/add-player', name: 'admin_add_player')]
    #[Route('/admin/team/{id}/add-player', name: 'admin_add_player')]
    public function addPlayer(Request $request, EntityManagerInterface $entityManager, Ligue1Teams $team = null): Response
    {
        $player = new Players();

        if ($team) {
            $player->setTeam($team);
            $form = $this->createForm(AddPlayerType::class, $player, [
                'team_assigned' => true,
            ]);
        } else {
            $form = $this->createForm(AddPlayerType::class, $player);
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$team) {
                $player->setTeam($form->get('team')->getData());
            }

            $entityManager->persist($player);
            $entityManager->flush();

            return $this->redirectToRoute('admin_team_players', ['id' => $player->getTeam()->getId()]);
        }

        return $this->render('admin/Players/addPlayer.html.twig', [
            'form' => $form->createView(),
            'team' => $team,
        ]);
    }


    // edit players
    #[Route('/admin/player/edit/{id}', name: 'admin_edit_player')]
    public function editPlayer(Request $request,Players $player, PlayersRepository $playersRepository, EntityManagerInterface $entityManager, int $id): Response
    {
        $form = $this->createForm(PlayerType::class, $player);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_team_players', ['id' => $player->getTeam()->getId()]);
        }

        return $this->render('admin/Players/editPlayer.html.twig', [
            'form' => $form->createView(),
            'player' => $player,
        ]);
    }




}




