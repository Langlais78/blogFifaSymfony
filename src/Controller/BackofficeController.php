<?php

namespace App\Controller;


use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class BackofficeController extends AbstractController
{
    ///////////////////////////// Accueil backoffice ///////////////////////////////////////////////
    #[Route('/backoffice', name: 'backoffice')]
    public function home(): Response
    {
        return $this->render('backoffice/home.html.twig', [
            'controller_name' => 'BackofficeController',
        ]);
    }

    //////////////////////////////////// article ajout /////////////////////////////////////////////////

    #[Route('/ajoutArticle', name: 'ajoutArticle')]
    public function ajoutArticle(Articles $article = null, Request $request, EntityManagerInterface $manager): Response
    {
        if($article)
        {
            $photoActuelle = $article->getPhoto();
        }

        if(!$article)
        {
            $article = new Articles;
        }

        $formArticle = $this->createForm(ArticlesType::class, $article);

        $formArticle->handleRequest($request);

        if($formArticle->isSubmitted() && $formArticle->isValid())
        {

            if(!$article->getId())
                $article->setDate(new \DateTime());

            $photo = $formArticle->get('photo')->getData();

            if($photo)
            {
                $nomOriginPhoto = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);

                $nouveauNomFichier = $nomOriginPhoto . "-" . uniqid() . "." . $photo->guessExtension();

                // try
                // {
                    
                //     $photo->move(
                //         $this->getParameter('photo_directory'),
                //         $nouveauNomFichier
                //     );
                // }
                // catch(FileException $e)
                // {

                // }

                $article->setPhoto($nouveauNomFichier);
            }
            else
            {
                if(isset($photoActuelle))
                    $article->setPhoto($photoActuelle);
                else
                
                    $article->setPhoto(null);
            }

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('listeArticle', [
                'id' => $article->getId()
            ]);
        }

        return $this->render('backoffice/ajout.article.html.twig', [
            'formArticle' => $formArticle->createView(),
            'editMode' => $article->getId(),
            'photoActuelle' => $article->getPhoto()
        ]);
    }

    ///////////////////////////// affichage des articles ////////////////////////////////////////////////////////////

    #[Route('/listeArticle', name: 'listeArticle')]
    public function viewArticle(EntityManagerInterface $manager, ArticlesRepository $repoArticle): Response
    {

        $colonnes = $manager->getClassMetadata(Articles::class)->getFieldNames();

        $cellules = $repoArticle->findAll();


        return $this->render('backoffice/liste.article.html.twig', [
            'colonnes' => $colonnes,
            'cellules' => $cellules,
            'controller_name' => 'BackofficeController',
        ]);
    }

    /////////////////////////////////////////// affichage modification categories //////////////////////////////////////////////

    #[Route('/categorie', name: 'categorie')]
    public function viewCategorie(): Response
    {
        return $this->render('backoffice/categorie.html.twig', [
            'controller_name' => 'BackofficeController',
        ]);
    }

    /////////////////////////////////////////////// affichage modification utilisateur //////////////////////////////////////////

    #[Route('/user', name: 'user')]
    public function viewUser(): Response
    {
        return $this->render('backoffice/user.html.twig', [
            'controller_name' => 'BackofficeController',
        ]);
    }
}

