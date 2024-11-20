<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // If the user is already authenticated
        if ($this->getUser()) {
            // Check if the user has the ROLE_ADMIN role
            if (in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
                // Redirect to admin dashboard if the user is an admin
                return $this->redirectToRoute('admin_dashboard');
            }

            // Otherwise, redirect to the game page if the user is not an admin
            return $this->redirectToRoute('app_game');
        }

        // Get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // Get the last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        // Render the login form with the error and last username
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
