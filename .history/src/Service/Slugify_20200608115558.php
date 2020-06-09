<?php
/**
 * Auteur: Khaled Benharrat
 * Date: 03/06/2020
 */

// src/Service/Slugify.php
namespace App\Service;

class Slugify
{
    private $input;
    
    /**
    * Generates a slug with a string
    *
    * @param string
    */
    public function generate(string $input)
    {
        if (!$input) {
            throw $this
                ->createNotFoundException('
                    No slug has been sent to find a string.'
            );
        }
        $input = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );
        
        return $this->$input;
    }
}