<?php
/**
 * Auteur: Khaled Benharrat
 * Date: 06/06/2020
 */

// src/DataFixtures/ActorFixtures.php
namespace App\DataFixtures;

use App\Entity\Actor;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    const ACTORS = [
        'Norman Reedus',
        'Andrew Lincoln',
        'Lennie James',
        'Jeffrey Dean Morgan',
        'Danai Gurira',
        'Lauren Cohan',
        'Steven Yeun',
        'Melissa McBride',
        'Tom Payne',
        'Jon Bernthal',
    ];

    public $slugify;

    public function __construct (Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        $i = 0;
        $name = '';
        foreach (self::ACTORS as $key => $actorName) {
            $actor = new Actor();
            $actor->setName($actorName);
            $actor->setSlug($this->slugify->generate($actorName));
            $manager->persist($actor);
            $actor->addProgram($this->getReference('program_0'));
            $this->addReference('actor_' . $i, $actor);
            $i++;
        }

        

        // On configure dans quelles langues nous voulons nos données (US)
        $faker = Faker\Factory::create();
        // On créé 50 acteurs
        for ($i = 10; $i < 60; $i++) {
            $actor = new Actor();
            $actor->setName($faker->name());
            $actor->setSlug($this->slugify->generate($actor->getName()));
            $manager->persist($actor);
            $actor->addProgram($this->getReference('program_' . $faker->numberBetween($min = 0, $max = 5)));
            $this->addReference('actor_' . $i, $actor);
        }

        $manager->flush();
    }

    public function getDependencies()  
    {
        return [ProgramFixtures::class];  
    }
}
