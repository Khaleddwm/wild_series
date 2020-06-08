<?php
/**
 * Auteur: Khaled Benharrat
 * Date: 06/06/2020
 */

// src/DataFixtures/ActorFixtures.php
namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

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

    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::ACTORS as $key => $actorName) {
            $actor = new Actor();
            $actor->setName($actorName);
            $manager->persist($actor);
            $actor->addProgram($this->getReference('program_0'));
            $this->addReference('actor_' . $i, $actor);
            $i++;
        }

        $manager->flush();
    }

    public function getDependencies()  
    {
        return [ProgramFixtures::class];  
    }
}
