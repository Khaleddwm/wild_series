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
use App\Entity\Actor;
use App\Entity\Program;

/**
* @Route("/actor", name="actor_")
*/
class ActorController extends AbstractController
{
    /**
     * Show all rows from Actors's entity
     * @Route("/{id}", name="show")
     * @return Response A response instance
     */
    public function show(int $actorId) :Response
    {
        if (!$actors) {
            throw $this->createNotFoundException(
                'No category found in category\'s table.'
            );
        }
        $actors = $this->getDoctrine()
            ->getRepository(Actors::class)
            ->findAll();

        return $this->render(
            'actor/show.html.twig',
            ['actors' => $actors,
        ]);
    }
}

  