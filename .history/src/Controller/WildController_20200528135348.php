<?php
/**
 * Auteur: Khaled Benharrat
 * Date: 19/05/2020
 */

// src/Controller/WildController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use App\Entity\Category;

/**
* @Route("/wild", name="wild_")
*/
class WildController extends AbstractController
{
    /**
     * Show all rows from Program's entity
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index() :Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();
        if (!$programs) {
            throw $this->createNotFoundException(
                'No program found in program\'s table.'
            );
        }

        return $this->render(
            'wild/index.html.twig',
            ['programs' => $programs]
        );
    }

    /**
    * Getting a program with a formatted slug for title
    *
    * @param string $slug The slugger
    * @Route("/show/{slug<^[a-z0-9-]+$>}", defaults={"slug" = null}, name="show")
    * @return Response
    */
    public function show(?string $slug) :Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find a program in program\'s table.'
            );
        }
        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneByTitle(mb_strtolower($slug));
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with '.$slug.' title, found in program\'s table.'
            );
        }

        return $this->render('wild/show.html.twig', [
            'program' => $program,
            'slug'  => $slug,
        ]);
    }

    /**
     * Show last 3 rows from Program's entity by Category's entity
     * 
     * @param string $categoryName program's category
     * @Route("/category/{categoryName<^[a-zA-Z]+$>}", defaults={"categoryName" = null}, name="show_category")
     * @return Response
     */
    public function showByCategory(string $categoryName) :Response
    {
        if (!$categoryName) {
            throw $this->createNotFoundException(
                'No category has been sent to find a program in program\'s table.'
            );
        }
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneByName(mb_strtolower($categoryName));
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findByCategory($category, ['id' => 'DESC'], 3);
        if (!$programs) {
            throw $this->createNotFoundException(
                'No programs with '.$category.' category, found in program\'s table'
            );
        }

        return $this->render('wild/category.html.twig',[
            'category' => $category,
            'programs' => $programs,
        ]);
    }
    
    /**
     * Show rows from Program's entity by program's title
     * 
     * @param string $programTitle program
     * @Route("/program/{programTitle<^[ a-zA-Z-]+$>}", defaults={"programTitle" = null}, name="show_program")
     * @return Response
     */
    public function showByProgram(string $programTitle) :Response
    {
        if (!$programTitle) {
            throw $this->createNotFoundException(
                'No program title has been sent to find a program in program\'s table.'
            );
        }
        $programTitle = preg_replace(
            '/-/',
            ' ', trim(strip_tags($programTitle), "-")
        );
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneByTitle(mb_strtolower($programTitle));
        if (!$program) {
            throw $this->createNotFoundException(
                'No programs with '.$programTitle.' program, found in program\'s table'
            );
        }
        $seasons = $program->getSeasons();
        if (!$seasons) {
            throw $this->createNotFoundException(
                'No seasons with '.$programTitle.' program, found in program\'s table'
            );
        }
        
        return $this->render('wild/program.html.twig', [
            'program' => $program,
            'seasons' => $seasons,
        ]);
        
    }

    /**
     * Show rows from Program's, Season's, Episode's, by Season's id
     * 
     * @param int $seasonId season id
     * @return Response
     * @Route("/season/{seasonId<^[0-9]+$>}", defaults={"seasonId" = null}, name="show_season")
     */
    public function showBySeason(int $seasonId) :Response
    {
        if (!$seasonId) {
            throw $this->createNotFoundException(
                'No season has been find in season\'s table.');
        }
        $seasons = $this->getDoctrine()
            ->getRepository(Season::class)
            ->find($seasonId);
        if (!$seasons) {
            throw $this->createNotFoundException(
                'No season with season id '.$seasonId.', found in season\'s table.'
            );
        }
        $program = $seasons->getProgram();
        if (!$program) {
            throw $this->createNotFoundException(
                'No programs with season id '.$seasonId.', found in program\'s table'
            );
        }
        $episodes = $seasons->getEpisodes();
        if (!$episodes) {
            throw $this->createNotFoundException(
                'No episodes with season id '.$seasonId.', found in episode\'s table'
            );
        }

        return $this->render('wild/season.html.twig', [
            'program'  => $program,
            'seasons'   => $seasons,
            'episodes' => $episodes,
        ]);
    }

    /**
    * @Route("/episode/{id}", name="wild_episode")
    */

    public function showEpisode(Episode $episode): Response
    {
        if (!$episode) {
            throw $this
                ->createNotFoundException(
                    'No episode has been find in episode\'s table.');
        }
        $season = $episode->getSeason();
        $program = $season->getProgram();

        return $this->render('wild/episode.html.twig', ['program' => $program,
                                                        'season' => $season,
                                                        'episode' => $episode,
        ]);
    }
}

  