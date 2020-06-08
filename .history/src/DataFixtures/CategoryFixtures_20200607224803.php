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

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
    const CATEGORY = [
        'Action',
        'Animation',
        'Aventure',
        'Catastrophe',
        'Documentaire',
        'Dramatique',
        'Erotique',
        'Fantastique',
        'Science-fiction',
        'Horreur',
        'Humoristique'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORY as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference('categorie_' . $key, $category);
        }

        $manager->flush();
    }
}
