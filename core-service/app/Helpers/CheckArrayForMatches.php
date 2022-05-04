<?php

namespace App\Helpers;

use Exception;

class CheckArrayForMatches
{
    public static function checkArray(array $checkValues, $values): void
    {
        $matches = array_intersect(array_keys($checkValues), $values);

        if ($matches) {
            $message = implode(",", $matches) . " are extra fields.";

            throw new Exception($message, 400);
        }
    }
}
