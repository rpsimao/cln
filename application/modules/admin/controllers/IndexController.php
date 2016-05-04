<?php

class Admin_IndexController extends Zend_Controller_Action
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

        $db = new Users_Model_Users();

        $this->view->all = $db->getAll();

       
      

    }


    public function insertAction()
    {
        
       $this->_helper->viewRenderer->setNoRender(true);
       $this->_helper->layout->disableLayout();


        $params = $this->getAllParams();


        
        
        
    }


}

