<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SbcController extends AbstractController
{
    #[Route('/sbc', name: 'sbc')]
    public function index(): Response
    {
        return $this->render('blog_fifa/sbc.html.twig', [
            'controller_name' => 'SbcController',
        ]);
    }
}
