<?php
namespace App\Controller;

use App\Entity\Ligue1Teams;
use App\Entity\Players;
use App\Entity\User;
use App\Form\AddPlayerType;
use App\Form\PlayerType;
use App\Repository\GameRepository;
use App\Repository\PlayersRepository;
use App\Repository\TeamsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\QueryBuilder;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
class AdminController extends AbstractController
{
#[Route('/admin', name: 'admin_dashboard')]
#[isGranted('ROLE_ADMIN')]

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
    #[isGranted('ROLE_ADMIN')]

    public function manageUsers(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll(); // Récupérer tous les utilisateurs

        return $this->render('admin/Users/manageUsers.html.twig', [
            'users' => $users,
        ]);
    }


    // add user

    #[Route('/admin/users/add', name: 'admin_add_user')]
    #[isGranted('ROLE_ADMIN')]

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
    #[isGranted('ROLE_ADMIN')]

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
    #[isGranted('ROLE_ADMIN')]

    public function deleteUser(Request $request, User $user, EntityManagerInterface $entityManager, TeamsRepository $teamsRepository): Response
    {
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('admin_users');
    }

    #[Route('/admin/team/{id}/players', name: 'admin_team_players')]
    #[isGranted('ROLE_ADMIN')]

    public function teamPlayers(int $id, TeamsRepository $teamsRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Find the team by the database id (not ApiId)
        $team = $teamsRepository->find($id);  // Use find() instead of findOneBy()

        if (!$team) {
            throw $this->createNotFoundException('Team not found');
        }

        // You can now access ApiId from the $team object
        $apiId = $team->getApiId();  // Access the actual ApiId if needed

        $players = $team->getPlayers();

        // Create a new player form
        $player = new Players();
        $form = $this->createForm(AddPlayerType::class, $player);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Assign the team to the new player
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
    #[isGranted('ROLE_ADMIN')]

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
    #[isGranted('ROLE_ADMIN')]

    public function addPlayer(Request $request, EntityManagerInterface $entityManager, Ligue1Teams $team = null): Response
    {
        $player = new Players();

        if ($team) {
            $player->setTeam($team);
            $form = $this->createForm(AddPlayerType::class, $player);
        } else {
            throw $this->createNotFoundException('Team not found');
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
    #[isGranted('ROLE_ADMIN')]

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


    // game management page
    #[Route('/gestion-matches', name: 'match_management')]
    #[isGranted('ROLE_ADMIN')]

    public function manageMatches(GameRepository $matchRepository, Request $request): Response
    {
        $matchday = $request->query->get('matchday');

        $criteria = [];
        if ($matchday) {
            $criteria['matchday'] = $matchday;
        }
        $matches = $matchRepository->findBy($criteria, ['matchday' => 'ASC']);


        return $this->render('admin/Teams/GameManagement.html.twig', [
            'matches' => $matches,
            'selectedMatchday' => $matchday,
        ]);
    }


    #[Route('/import-teams', name: 'match_management')]
    #[isGranted('ROLE_ADMIN')]


    public function fetchTeams(HttpClientInterface $client, EntityManagerInterface $entityManager): Response
    {
        $url = 'https://v3.football.api-sports.io/teams?league=61&season=2024';

        // Remplacer par vos clés d'API
        $apiKey = '817f5048f12a77621a46a76d0ca25df6';

        try {
            $response = $client->request('GET', $url, [
                'headers' => [
                    'x-rapidapi-host' => 'v3.football.api-sports.io',
                    'x-rapidapi-key' => $apiKey,
                ],
            ]);

            $statusCode = $response->getStatusCode();
            if ($statusCode !== 200) {
                throw new \Exception('Erreur de la requête API : ' . $statusCode);
            }

            $content = $response->getContent();
            $data = json_decode($content, true);

            // Check if 'response' exists and is an array
            if (!isset($data['response']) || !is_array($data['response'])) {
                throw new \Exception('Structure inattendue de la réponse API');
            }
            $nomsComplets = [
                'Lyon' => 'Olympique Lyonnais',
                'Marseille' => 'Olympique de Marseille',
                'Angers' => 'SCO Angers',
                'Montpellier' => 'Montpellier HSC',
                'Paris Saint Germain' => 'Paris Saint-Germain',
                'Monaco' => 'AS Monaco',
                'Reims' => 'Stade de Reims',
                'Rennes' => 'Stade Rennais',
                'Strasbourg' => 'RC Strasbourg',
                'Toulouse' => 'Toulouse FC',
                'Stade Brestois 29' => 'Brest',
                'Auxerre' => 'AJ Auxerre',
                'LE Havre' => 'Le Havre AC',
                'Lens' => 'Racing Club de Lens',
                'Saint Etienne' => 'AS Saint-Étienne',
                'Lille' => 'Lille OSC',
                'Nantes' => 'FC Nantes',
                'Nice' => 'OGC Nice',

                // ... ajouter d'autres équipes
            ];

            $coachs = [
                'Lyon' => 'Pierre Sage',
                'Marseille' => 'Roberto De Zerbi',
                'Angers' => 'Alexandre Dujeux',
                'Montpellier' => 'Jean-Louis Gasset',
                'Paris Saint Germain' => 'Luis Enrique',
                'Monaco' => 'Adi Hütter',
                'Reims' => 'Luka Elsner',
                'Rennes' => 'Julien Stéphan',
                'Strasbourg' => 'Liam Rosenior',
                'Toulouse' => 'Carles Martínez',
                'Stade Brestois 29' => 'Eric Roy',
                'Auxerre' => 'Christophe Pélissier',
                'LE Havre' => 'Didier Digard',
                'Lens' => 'Will Still',
                'Saint Etienne' => 'Olivier Dall\'\Oglio',
                'Lille' => 'Bruno Génésio',
                'Nantes' => 'Antoine Kombouare',
                'Nice' => 'Franck Haise',
            ];

            $short = [
                'Lyon' => 'OL',
                'Marseille' => 'OM',
                'Angers' => 'SCO',
                'Montpellier' => 'MHSC',
                'Paris Saint Germain' => 'PSG',
                'Monaco' => 'ASM',
                'Reims' => 'SR',
                'Rennes' => 'SRFC',
                'Strasbourg' => 'RCS',
                'Toulouse' => 'TFC',
                'Stade Brestois 29' => 'SB29',
                'Auxerre' => 'AJA',
                'LE Havre' => 'HAC',
                'Lens' => 'RCL',
                'Saint Etienne' => 'ASSE',
                'Lille' => 'LOSC',
                'Nantes' => 'FCN',
                'Nice' => 'OGCN',
            ];


            // Process each team data
            foreach ($data['response'] as $teamData) {
                $ApiId = $teamData['team']['id']; // Récupération de l'API ID
                $team = $teamData['team'];
                $venue = $teamData['venue'];
                $teamName = $teamData['team']['name'];
                $coachName = $coachs[$teamName] ?? null;
                $fullName = $nomsComplets[$teamName] ?? null;
                $shortname = $short[$teamName] ?? null;



                $existingTeam = $entityManager->getRepository(Ligue1Teams::class)->findOneBy(['ApiId' => $ApiId]);
                if ($existingTeam) {
                    // Team exists, check and update fields if necessary
                    if ($existingTeam->getVenue() !== ($venue['name'] ?? 'Unknown venue')) {
                        $existingTeam->setVenue($venue['name'] ?? 'Unknown venue');
                    }
                    if ($existingTeam->getName() !== ($nomsComplets[$teamName] ?? $team['name'])) {
                        $existingTeam->setName($nomsComplets[$teamName] ?? $team['name']);
                    }
                    if ($coachName && $existingTeam->getCoach() !== $coachName) {
                        $existingTeam->setCoach($coachName);
                    }
                    if ($fullName && $existingTeam->getShortName() !== $fullName) {
                        $existingTeam->setShortName($fullName);
                    }
                    if ($existingTeam->getShortName() !==  $team['name']) {
                        $existingTeam->setShortName($team['name']);
                    }
                    if ($shortname && $existingTeam->getTLA() !== $shortname) {
                        $existingTeam->setTLA($shortname);
                    }


                    $entityManager->persist($existingTeam);

                    // ... mettre à jour les autres champs
                } else {
                    $ligue1Team = new Ligue1Teams();
                    $ligue1Team->setApiId($team['id']);
                    $ligue1Team->setShortName($team['name']);
                    if (isset($short[$teamName])) {
                        $short = $coachs[$teamName];
                        $ligue1Team->setCoach($short);
                    } else {

                        $ligue1Team->setTLA($team['code']);
                    }
                    $ligue1Team->setVenue($venue['name'] ?? 'Unknown venue');
                    if (isset($coachs[$teamName])) {
                        $coach = $coachs[$teamName];
                        $ligue1Team->setCoach($coach);
                    } else {

                        $ligue1Team->setCoach('Coach inconnu');
                    }
                    if (isset($short[$teamName])) {
                        $ligue1Team->setShortName($short[$teamName]);
                    }
                    else {
                        $ligue1Team->setShortName($team['code']);
                    }

                    if (isset($nomsComplets[$teamName])) {
                        $ligue1Team->setName($nomsComplets[$teamName]);
                    }
                    else {
                        $ligue1Team->setName($team['code']);
                    }

                    $entityManager->persist($ligue1Team);
                }
            }





            $entityManager->flush();

            return new Response('Les équipes ont été récupérées et insérées en base de données');
        } catch (\Exception $e) {
            return new Response('Erreur lors de la récupération ou de l\'insertion des équipes : ' . $e->getMessage());
        }
    }



    // Import players from api
    #[Route('/import-players', name: 'import_players')]
    #[isGranted('ROLE_ADMIN')]

    public function importPlayers(HttpClientInterface $client, EntityManagerInterface $entityManager): Response
    {
        $this->importPlayersData($client, $entityManager);

        return new Response('Players imported successfully');
    }

    private function importPlayersData(HttpClientInterface $client, EntityManagerInterface $entityManager)
    {
        $apiKey = '817f5048f12a77621a46a76d0ca25df6';
        $teamRepository = $entityManager->getRepository(Ligue1Teams::class);
        $allTeams = $teamRepository->findAll();

        foreach ($allTeams as $index => $team) {
            $teamApiId = $team->getApiId();
            if ($teamApiId) {
                $url = "https://v3.football.api-sports.io/players/squads?team={$teamApiId}";
                try {
                    // Log URL and Team Info
                    file_put_contents('D:\Dev\RateMyTeam\bipbip.log', "Requesting data for team: {$teamApiId}, URL: {$url}\n", FILE_APPEND);

                    $response = $client->request('GET', $url, [
                        'headers' => [
                            'x-rapidapi-host' => 'v3.football.api-sports.io',
                            'x-rapidapi-key' => $apiKey,
                        ],
                    ]);

                    if ($response->getStatusCode() !== 200) {
                        throw new \Exception('API request failed with status ' . $response->getStatusCode());
                    }

                    $content = $response->getContent();
                    $data = json_decode($content, true);
                    if (!isset($data['response'][0]['players'])) {
                        throw new \Exception('No players data returned');
                    }

                    foreach ($data['response'][0]['players'] as $playerData) {
                        // Check if the player already exists in the database based on ApiId
                        $player = $entityManager->getRepository(Players::class)->findOneBy(['ApiId' => $playerData['id']]);

                        if (!$player) {
                            // If player doesn't exist, create a new player
                            $player = new Players();
                            $player->setApiId($playerData['id']);
                            $player->setTeam($team);
                            $player->setPosition($playerData['position']); // Ensure position is set correctly
                            $player->setDateOfBirth(new \DateTime('1970-01-01'));

                            // Set FirstName and LastName from API response
                            $entityManager->persist($player);
                        } else {
                            // If player exists, update the data
                            $player->setPosition($playerData['position'] ?? $player->getPosition());

                            // Only update FirstName and LastName if they are different
                            if (isset($playerData['firstname']) && $player->getFirstName() !== $playerData['firstname']) {
                                $player->setFirstName($playerData['firstname']);
                            }
                            if (isset($playerData['lastname']) && $player->getLastName() !== $playerData['lastname']) {
                                $player->setLastName($playerData['lastname']);
                            }

                            // Update other fields if necessary
                            if (isset($playerData['dateOfBirth']) && $player->getDateOfBirth() !== new \DateTime($playerData['dateOfBirth'])) {
                                $player->setDateOfBirth(new \DateTime($playerData['dateOfBirth']));
                            }
                        }

                        $entityManager->flush(); // Persist changes to the database

                        // Fetch detailed player info for additional updates
                        $detailUrl = "https://v3.football.api-sports.io/players/profiles?player={$playerData['id']}";
                        $detailResponse = $client->request('GET', $detailUrl, [
                            'headers' => [
                                'x-rapidapi-host' => 'v3.football.api-sports.io',
                                'x-rapidapi-key' => $apiKey,
                            ],
                        ]);

                        if ($detailResponse->getStatusCode() === 200) {
                            $detailContent = $detailResponse->getContent();
                            $detailData = json_decode($detailContent, true);

                            if (isset($detailData['response'][0]['player'])) {
                                $playerInfo = $detailData['response'][0]['player'];

                                // Update player info with detailed data from the response
                                if (isset($playerInfo['firstname']) && $player->getFirstName() !== $playerInfo['firstname']) {
                                    $player->setFirstName($playerInfo['firstname']);
                                }
                                if (isset($playerInfo['lastname']) && $player->getLastName() !== $playerInfo['lastname']) {
                                    $player->setLastName($playerInfo['lastname']);
                                }

                                if (isset($playerInfo['birth']['date'])) {
                                    $birthDate = new \DateTime($playerInfo['birth']['date'] ?? '1970-01-01');
                                    $player->setDateOfBirth($birthDate);
                                }

                                $player->setNationality($playerInfo['nationality'] ?? 'Unknown');
                                $player->setPosition($playerInfo['position'] ?? 'Unknown');
                                $entityManager->persist($player);
                            }
                        } else {
                            throw new \Exception('Failed to fetch player details, status code: ' . $detailResponse->getStatusCode());
                        }
                    }

                    // Delay after processing each team (e.g., 1 second)
                    sleep(1);

                } catch (\Exception $e) {
                    file_put_contents('D:\Dev\RateMyTeam\bipbip.log', "Error importing player data for team: {$teamApiId}\n" . $e->getMessage() . "\n", FILE_APPEND);
                }
            }
        }

        // Final flush to save updated player data
        $entityManager->flush();
    }

    #[Route('/update-player-names', name: 'appPlayeUpdate')]
    #[isGranted('ROLE_ADMIN')]

    public function updatePlayerNames(HttpClientInterface $client, EntityManagerInterface $entityManager): Response
    {
        // Logic to update player names for players with missing FirstName/LastName
        $this->updatePlayersData($client, $entityManager);

        return new Response('Players updated successfully');
    }

    private function updatePlayersData(HttpClientInterface $client, EntityManagerInterface $entityManager)
    {
        $apiKey = 'your_api_key'; // Your API key
        $playersRepository = $entityManager->getRepository(Players::class);

        // Fetch players that have ApiId but FirstName/LastName is null
        $playersToUpdate = $playersRepository->findBy([
            'ApiId' => ['!=', null],
            'FirstName' => null,
            'LastName' => null
        ]);

        foreach ($playersToUpdate as $player) {
            // Fetch player details from API
            $detailUrl = "https://v3.football.api-sports.io/players/profiles?player={$player->getApiId()}";
            $detailResponse = $client->request('GET', $detailUrl, [
                'headers' => [
                    'x-rapidapi-host' => 'v3.football.api-sports.io',
                    'x-rapidapi-key' => $apiKey,
                ],
            ]);

            if ($detailResponse->getStatusCode() === 200) {
                $detailContent = $detailResponse->getContent();
                $detailData = json_decode($detailContent, true);

                if (isset($detailData['response'][0]['player'])) {
                    $playerInfo = $detailData['response'][0]['player'];
                    $player->setFirstName($playerInfo['firstname'] ?? null);
                    $player->setLastName($playerInfo['lastname'] ?? null);

                    $entityManager->persist($player);
                    $entityManager->flush(); // Save the changes
                }
            }
        }
    }










}




