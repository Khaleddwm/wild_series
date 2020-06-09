<?php
/**
 * Auteur: Khaled Benharrat
 * Date: 03/06/2020
 */

// src/Controller/ActorController.php
namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Program;
use App\Repository\ActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/actor", name="actor_")
*/
class ActorController extends AbstractController
{
    /**
     * Show all rows from Actors's entity
     * @Route("/{id}", name="show", methods={"GET"})
     * @return Response A response instance
     */
    public function show(Actor $actor): Response
    {
        return $this->render('program/show.html.twig', [
            'actor' => $actor,
        ]);
    }
}

  