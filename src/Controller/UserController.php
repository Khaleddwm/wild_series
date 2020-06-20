<?php
/**
 * Auteur: Khaled Benharrat
 * Date: 19/06/2020
 */

// src/Controller/UserController.php
namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * show profile user
     * 
     * @Route("/my-profile", name="app_profile", methods={"GET","POST"})
     */
    public function profile(UserInterface $user): Response
    {
        return $this->render('security/profile.html.twig', [
            'profile' => $user,
        ]);
    }
}