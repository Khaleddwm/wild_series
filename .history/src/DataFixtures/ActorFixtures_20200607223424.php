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

class ActorFixtures extends Fixture
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
        foreach (self::PROGRAMS as $title => $data) {
            $program = new Program();
            $program->setTitle($title);
            $program->setSynopsis($data['synopsis']);
            $manager->persist($program);
            $program->setCategory($this->getReference('categorie_0'));
            $this->addReference('program_' . $i, $program);
            $i++;
        }

        $manager->flush();
    }
}
