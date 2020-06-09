<?php
/**
 * Auteur: Khaled Benharrat
 * Date: 06/06/2020
 */

// src/DataFixtures/EpisodeFixtures.php
namespace App\DataFixtures;

use App\Entity\Episode;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    private $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');
        // reference episode
        $ref = 0;
        // on créé 720 episodes
        for ($e = 0; $e < 60; $e++) {
            for ($i = 0; $i < 12; $i++) {
                $episode = new Episode();
                $episode->setNumber($i + 1);
                $episode->setTitle($faker->realText($maxNbChars = 30));
                $episode->setSlug($this->slugify->generate($episode->getTitle()));
                $episode->setSynopsis($faker->realText($maxNbChars = 1200));
                $manager->persist($episode);
                $episode->setSeason($this->getReference('season_' . $e));
                $this->addReference('episode_' . $ref, $episode);
                $ref++;
            }
        }
        $manager->flush();
    }
    
    public function getDependencies()  
    {
        return [SeasonFixtures::class];  
    }
}