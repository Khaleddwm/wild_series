<?php
/**
 * Auteur: Khaled Benharrat
 * Date: 03/06/2020
 */

// src/Service/Slugify.php
namespace App\Service;

class Slugify
{
    /**
    * Generates a slug with a string
    *
    * @param string
    */
    public function generate(string $input)
    {
        $input = preg_replace(
            '/-/',
            ' ', trim(strip_tags($input), "-")
        );
        
        return $this->$input;
    }
}