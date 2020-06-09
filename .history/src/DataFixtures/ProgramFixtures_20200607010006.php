<?php
/**
 * Auteur: Khaled Benharrat
 * Date: 06/06/2020
 */

// src/DataFixtures/ProgramFixtures.php
namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProgramFixtures extends Fixture
{
    const PROGRAMS = [
        'Walking Dead' => [
        'synopsis' => 'Le policier Rick Grimes se réveille après un long coma. Il découvre avec effarement que le monde, ravagé par une épidémie, est envahi par les morts-vivants.',
        'category' => 'Horreur',
        ],
        'The Haunting Of Hill House' => [
        'synopsis' => 'Plusieurs frères et sœurs qui, enfants, ont grandi dans la demeure qui allait devenir la maison hantée la plus célèbre des États-Unis, sont contraints de se réunir pour finalement affronter les fantômes de leur passé.',
        'category' => 'Horreur',
        ],
        'American Horror Story' => [
        'synopsis' => 'A chaque saison, son histoire. American Horror Story nous embarque dans des récits à la fois poignants et cauchemardesques, mêlant la peur, le gore et le politiquement correct.',
        'category' => 'Horreur',
        ],
        'Love Death And Robots' => [
        'synopsis' => 'Un yaourt susceptible, des soldats lycanthropes, des robots déchaînés, des monstres-poubelles, des chasseurs de primes cyborgs, des araignées extraterrestres et des démons assoiffés de sang : tout ce beau monde est réuni dans 18 courts métrages animés déconseillés aux âmes sensibles.',
        'category' => 'Horreur',
        ],
        'Penny Dreadful' => [
        'synopsis' => 'Dans le Londres ancien, Vanessa Ives, une jeune femme puissante aux pouvoirs hypnotiques, allie ses forces à celles de Ethan, un garçon rebelle et violent aux allures de cowboy, et de Sir Malcolm, un vieil homme riche aux ressources inépuisables. Ensemble, ils combattent un ennemi inconnu, presque invisible, qui ne semble pas humain et qui massacre la population.',
        'category' => 'Horreur',
        ],
        'Fear The Walking Dead' => [
        'synopsis' => 'La série se déroule au tout début de l épidémie relatée dans la série mère The Walking Dead et se passe dans la ville de Los Angeles, et non à Atlanta. Madison est conseillère dans un lycée de Los Angeles. Depuis la mort de son mari, elle élève seule ses deux enfants : Alicia, excellente élève qui découvre les premiers émois amoureux, et son grand frère Nick qui a quitté la fac et a sombré dans la drogue.',
        'category' => 'Horreur',
        ],
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