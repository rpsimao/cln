<?php

class Default_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->_layout->setLayout('login');
    }

    public function preDispatch ()
    {
        if ($this->_helper->FlashMessenger->hasMessages()) {
            $this->view->messages = $this->_helper->FlashMessenger->getMessages();
        }
    }

    public function indexAction()
    {
        $this->view->form = new Default_Form_Login();
    }
}

