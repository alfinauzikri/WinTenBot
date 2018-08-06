<?php
/**
 * Created by PhpStorm.
 * User: Azhe
 * Date: 06/08/2018
 * Time: 21.14
 */

namespace App;

class Kata
{
    public static function substrteks($text, $limit, $end = '...')
    {
        if (mb_strwidth($text, 'UTF-8') <= $limit) {
            return $text;
        }

        return rtrim(mb_strimwidth($text, 0, $limit, '', 'UTF-8')) . $end;
    }

    public static function substrkata($text, $maxchar, $end = '...')
    {
        if (strlen($text) > $maxchar || $text == '') {
            $words = preg_split('/\s/', $text);
            $output = '';
            $i = 0;
            while (1) {
                $length = strlen($output) + strlen($words[$i]);
                if ($length > $maxchar) {
                    break;
                } else {
                    $output .= ' ' . $words[$i];
                    ++$i;
                }
            }
            $output .= $end;
        } else {
            $output = $text;
        }
        return $output;
    }
}
