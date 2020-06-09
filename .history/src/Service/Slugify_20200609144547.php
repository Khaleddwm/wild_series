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
        // conversion of special characters to unicode characters
        $input = iconv('UTF-8', 'ASCII//TRANSLIT', $input);
        // return a slug without punctuation, without spaces at the beginning and end of the chain, without successive "-" and in lowercase
        $input = trim($input);
        $input = preg_replace("/[[:punct:]]/", "", $input);
        $input = preg_replace("/ +/", "-", $input);
        $input = preg_replace("/-+/", "-", $input);
        $input = strtolower($input);
        return $input;
    }
}