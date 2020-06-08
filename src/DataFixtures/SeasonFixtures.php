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
use Faker;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    

    public function load(ObjectManager $manager)
    {
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');
        // reference saison
        $ref = 0;
        // on créé 50 saisons
        for ($s = 0; $s < 6; $s++) {
            for ($i = 0; $i < 10; $i++) {
                $season = new Season();
                $season->setNumber($i + 1);
                $season->setYear($faker->year());
                $season->setDescription($faker->realText($maxNbChars = 800));
                $manager->persist($season);
                $season->setProgram($this->getReference('program_' . $s));
                $this->addReference('season_' . $ref, $season);
                $ref++;
            }
        }
        $manager->flush();
    }
    
    public function getDependencies()  
    {
        return [ProgramFixtures::class];  
    }
}
