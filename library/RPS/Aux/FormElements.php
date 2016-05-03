<?php

/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 26/01/16
 * Time: 13:04
 */
class RPS_Aux_FormElements
{



    public static function multiSelect($needle, $string){

        $array = explode(";", $string);

     $isSelected = (in_array( $needle, $array)) ? ' selected="selected"' : '';

     return $isSelected;



    }



    public static function select($value)
    {





    }



}