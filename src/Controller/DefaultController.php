<?php
/**
 * Auteur: Khaled Benharrat
 * Date: 19/05/2020
 */

// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
    */
    public function index() :Response
    {
        return $this->render('index.html.twig', [
            'bienvenue' => 'Bienvenue sur Wild Series',
        ]);
    }
}