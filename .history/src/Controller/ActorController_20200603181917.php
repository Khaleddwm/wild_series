<?php
/**
 * Auteur: Khaled Benharrat
 * Date: 03/06/2020
 */

// src/Controller/ActorController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ActorRepository;
use App\Entity\Actor;
use App\Entity\Program;

/**
* @Route("/actor", name="actor_")
*/
class ActorController extends AbstractController
{
    /**
     * Show all rows from Actors's entity
     * @Route("/{actorId}", name="show")
     * @return Response A response instance
     */
    public function show(ActorRepository $actorRepository): Response
    {
        return $this->render('actor/show.html.twig', [
            'actor' => $actorRepository->findAll(),
        ]);
    }
}

  