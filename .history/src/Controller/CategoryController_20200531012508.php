<?php
/**
 * Auteur: Khaled Benharrat
 * Date: 19/05/2020
 */

// src/Controller/CategoryController.php
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
class WildController extends AbstractController
{
    /**
     * Show all rows from Category's entity
     * Add category name in Category's entity
     * @Route("/add", name="add")
     * @return Response A response instance
     */
    public function index() :Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        if (!$programs) {
            throw $this->createNotFoundException(
                'No category found in category\'s table.'
            );
        }

        // Create form
        $category = new Category();
        $form = $this->createForm(
            CategoryType::class,
            $category,
        );

        return $this->render(
            'category/_add.html.twig',
            ['categories' => $categories,
             'form' => $form->createView(),
        ]);
    }
}

  