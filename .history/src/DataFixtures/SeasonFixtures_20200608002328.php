<?php
/**
 * Auteur: Khaled Benharrat
 * Date: 06/06/2020
 */

// src/DataFixtures/SeasonFixtures.php
namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SeasonFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::PROGRAMS as $title => $data) {
            $program = new Program();
            $program->setTitle($title);
            $program->setSynopsis($data['synopsis']);
            $manager->persist($program);
            $program->setCategory($this->getReference('categorie_9'));
            $this->addReference('program_' . $i, $program);
            $i++;
        }

        $manager->flush();
    }

    public function getDependencies()  
    {
        return [CategoryFixtures::class];  
    }
}