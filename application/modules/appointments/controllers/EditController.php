<?php

class Appointments_EditController extends Zend_Controller_Action
{

    private $auth;

    private $identity;

    public function init()
    {
        $this->auth = Zend_Auth::getInstance();
        if ($this->auth->hasIdentity())
        {
            $this->identity = $this->auth->getIdentity();

        } else {
            $this->_helper->flashMessenger->addMessage($this->view->translate(gettext("You are not allowed to see this resource. Please login.")));
            $this->redirect("/");
        }
    }

    public function preDispatch()
    {
        if ($this->_helper->FlashMessenger->hasMessages()) {
            $this->view->messages = $this->_helper->FlashMessenger->getMessages();
        }
    }

    public function indexAction()
    {
        $id = $this->getParam("id");

        $db = new Appointments_Model_Appointments();
        $this->view->record = $db->findByID($id);
        
    }


}

