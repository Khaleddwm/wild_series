<?php
/**
 * Auteur: Khaled Benharrat
 * Date: 30/05/2020
 */

// src/Controller/CategoryController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CategoryType;
use App\Controller\WildController;
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
    public function add() :Response
    {
 
    }
}

  