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
        $input = mb_strtolower(str_replace(
            ' ',
            '-', trim(strip_tags($this->input)))
        );
        
        return $this->input;
    }
}