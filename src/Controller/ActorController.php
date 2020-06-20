<?php
/**
 * Auteur: Khaled Benharrat
 * Date: 03/06/2020
 */

// src/Controller/ActorController.php
namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
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
     * 
     * @Route("/", name="index", methods={"GET"})
     * @return Response A response instance
     */
    public function index(ActorRepository $actorRepository, UserRepository $userRepository) :Response
    {
        if (empty($userRepository->findAll())) {
            return $this->redirectToRoute('admin_register');
        } else {
            $actors = $actorRepository->findAll();
            if (!$actors) {
                throw $this->createNotFoundException(
                    'No actors found in actor\'s table.'
                );
            }
            return $this->render('actor/index.html.twig', [
            'actors' => $actors,
            ]);
        } 
    }

    /**
     * Show rows from slug Actors's entity
     * 
     * @param string $slug actor
     * @Route("/{slug}", name="show", methods={"GET"})
     * @return Response A response instance
     */
    public function show(Actor $actor): Response
    {
        return $this->render('actor/show.html.twig', [
            'actor' => $actor,
        ]);
    }
}

  