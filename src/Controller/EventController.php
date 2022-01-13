<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/event', name: 'event')]
    public function index(): Response
    {
        return $this->render('blog_fifa/event.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }
}
