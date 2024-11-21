<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TermesServicesController extends AbstractController
{
    #[Route('/termes/services', name: 'app_termes_services')]
    public function index(): Response
    {
        return $this->render('termes_services/index.html.twig', [
            'controller_name' => 'TermesServicesController',
        ]);
    }
}
