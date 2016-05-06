<?php

/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 05/05/16
 * Time: 15:38
 */
class RPS_Aux_GetLocale
{

    public static function get()
    {

        $locale = new Zend_Locale();
        $lang = $locale->findLocale();

        preg_match("/[a-z]*/", $lang, $output_array);

        return $output_array[0];

    }


}