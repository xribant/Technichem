<?php

namespace App\Services;

class PasswordGenerator 
{
    /**
     * Original credit to Laravel's Str::random() method.
     *
     * String length is 12 characters
     */
    public function getRandomAlphaNumStr(): string
    {
        $string = '';

        while (($len = \strlen($string)) < 16) {
            /** @var int<1, max> $size */
            $size = 16 - $len;

            $bytes = random_bytes($size);

            $string .= substr(
                str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }

        return $string;
    }
}
