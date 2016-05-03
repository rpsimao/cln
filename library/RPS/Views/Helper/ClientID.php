<?php

/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 20/01/16
 * Time: 11:54
 */
class RPS_Views_Helper_ClientID extends Zend_View_Helper_Abstract
{
    public function ClientID()
    {
        $s = new RPS_UserService_SessionClient();

        return $s->getSessionID();


    }
}