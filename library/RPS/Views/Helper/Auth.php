<?php

/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 19/01/16
 * Time: 12:27
 */
class RPS_Views_Helper_Auth extends Zend_View_Helper_Abstract
{

    public function Auth(){

        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            $this->direct("/");
        }


    }

}