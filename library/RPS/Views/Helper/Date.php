<?php

/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 22/01/16
 * Time: 12:03
 */
class RPS_Views_Helper_Date extends Zend_View_Helper_Abstract
{
    function Date  ()
    {
        $dateTime = new DateTime;
        return $dateTime->format('Y-m-d');
    }
}