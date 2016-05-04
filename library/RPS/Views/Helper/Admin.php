<?php

/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 04/05/16
 * Time: 12:27
 */
class RPS_Views_Helper_Admin extends Zend_View_Helper_Abstract

{

    private $auth;

    private $identity;

    public function Admin()
    {

        $this->auth = Zend_Auth::getInstance();
        if ($this->auth->hasIdentity()) {
            $this->identity = $this->auth->getIdentity();

            if ($this->identity->roles == "admin") {
                return TRUE;

            }


        }

    }
}