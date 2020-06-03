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
use App\Form\CategoryType;
use App\Entity\Category;

/**
* @Route("/category", name="category_")
*/
class CategoryController extends AbstractController
{
    /**
     * Show all rows from Category's entity
     * Add category name in Category's entity
     * @Route("/add", name="add")
     * @return Response A response instance
     */
    public function add(Request $request) :Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        if (!$categories) {
            throw $this->createNotFoundException(
                'No category found in category\'s table.'
            );
        }

        // Create form
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('category_add');
        }

        return $this->render(
            'category/_add.html.twig',
            ['categories' => $categories,
             'form' => $form->createView(),
        ]);
    }
}

  