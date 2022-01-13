<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjoutArticleController extends AbstractController
{
    #[Route('/ajout/article', name: 'ajout_article')]
    public function index(): Response
    {
        return $this->render('ajout_article/index.html.twig', [
            'controller_name' => 'AjoutArticleController',
        ]);
    }
}
