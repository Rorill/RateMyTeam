<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\PlayerRatingType;
use App\Entity\PlayerRating;
use App\Repository\PlayersRepository;
use App\Repository\GameRepository;

class PlayerRatingController extends AbstractController
{
    #[Route('/rate-game/{gameId}', name: 'app_rate_game')]
    public function rateGame(int $gameId, GameRepository $gameRepository, PlayerRatingRepository $playerRatingRepository, Request $request): Response
    {
        // Fetch the game by ID
        $game = $gameRepository->find($gameId);

        // Fetch the players that played in this game
        $players = $game->getTeamHome()->getPlayers()->toArray();  // You could adjust based on your database relations

        // Create a form for each player to rate them
        $playerRatings = [];
        foreach ($players as $player) {
            $playerRating = new PlayerRating();
            $playerRating->setGame($game);
            $playerRating->setPlayer($player);
            $playerRating->setUser($this->getUser());  // Automatically set the user

            $form = $this->createForm(PlayerRatingType::class, $playerRating);
            $playerRatings[] = $form;  // Add each form to the list
        }

        // Handle the form submission for each player
        if ($request->isMethod('POST')) {
            foreach ($playerRatings as $form) {
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    // Persist the rating for each player
                    $this->getDoctrine()->getManager()->persist($form->getData());
                }
            }

            // Save all ratings
            $this->getDoctrine()->getManager()->flush();

            // Redirect after saving
            return $this->redirectToRoute('app_game');  // Redirect to the main page or wherever you'd like
        }

        // Render the rating page
        return $this->render('User/RatePlayer.html.twig', [
            'game' => $game,
            'playerRatings' => $playerRatings,  // Pass the forms for each player
        ]);
    }
}