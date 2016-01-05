<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 05.01.2016
 * Time: 11:08
 */

namespace AppBundle\Utils;


class Slugger
{
    public function slugify($string)
    {
        return preg_replace(
            '/^a-z0-9/',
            '-',
            strtolower(trim(strip_tags($string)))
        );
    }
}