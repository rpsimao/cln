<?php

/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 19/01/16
 * Time: 11:03
 */
class RPS_Views_Helper_Clinikname extends Zend_View_Helper_Abstract
{
    public function Clinikname()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            // Identity exists; get it
            $identity = $auth->getIdentity();

            return $identity->clinic;
        }
    }
}