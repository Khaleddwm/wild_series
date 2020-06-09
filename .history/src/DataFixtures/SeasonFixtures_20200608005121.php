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
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SeasonFixtures extends Fixture
{
    // On configure dans quelles langues nous voulons nos données
    $faker = Faker\Factory::create('fr_FR');

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

    // on créé 50 saisons
    for ($i = 0; $i < 50; $i++) {
        $season = new Season();
        $season->setNumber($i + 1);
        $season->setYear($faker->year($min = '2010'));
        $season->setDescription($faker->realText($maxNbChars = 500));
        $manager->persist($season);
        $season->setProgram($this->getReference('program_' . $faker->shuffle(array(0, 1, 2, 3, 4, 5)));
        $this->addReference('season_' . $i, $season);
    }

    $manager->flush();
}

    public function getDependencies()  
    {
        return [CategoryFixtures::class];  
    }
}