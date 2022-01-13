<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TournoiController extends AbstractController
{
    #[Route('/tournoi', name: 'tournoi')]
    public function index(): Response
    {
        return $this->render('blog_fifa/tournoi.html.twig', [
            'controller_name' => 'TournoiController',
        ]);
    }
}
