<?php

/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 14/01/16
 * Time: 10:31
 */

class RPS_Plugins_Controllers_Auth extends Zend_Controller_Plugin_Abstract
{

    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {

        $controller = $request->getControllerName();



        if(!Zend_Auth::getInstance()->hasIdentity() && $controller != "users")
        {
            $request->setModuleName("default");
            $request->setControllerName('index');
            $request->setActionName('index');

            $flashmessenger = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');
            $flashmessenger->addMessage(gettext('Session Expired! Please login again!'));
        }
    }
}