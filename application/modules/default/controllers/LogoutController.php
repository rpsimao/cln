<?php

class Default_LogoutController extends Zend_Controller_Action
{

    public function init()
    {
        Zend_Auth::getInstance()->clearIdentity();

        $this->_helper->flashMessenger->clearMessages();

        $session = new RPS_UserService_SessionClient();
        $session->destroy();
    }

    public function indexAction()
    {
        $this->redirect("/");
    }

}