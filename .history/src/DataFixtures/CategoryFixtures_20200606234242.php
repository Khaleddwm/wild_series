<?php
/**
 * Auteur: Khaled Benharrat
 * Date: 06/06/2020
 */

// src/DataFixtures/CategoryFixtures.php
namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName('Nom de catégorie');
        $manager->persist($category);

        $manager->flush();
    }
}