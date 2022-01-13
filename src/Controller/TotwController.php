<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TotwController extends AbstractController
{
    #[Route('/totw', name: 'totw')]
    public function index(): Response
    {
        return $this->render('blog_fifa/totw.html.twig', [
            'controller_name' => 'TotwController',
        ]);
    }
}
