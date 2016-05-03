<?php

class Users_IndexController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function preDispatch ()
    {
        if ($this->_helper->FlashMessenger->hasMessages()) {
            $this->view->messages = $this->_helper->FlashMessenger->getMessages();
        }
    }

    public function indexAction()
    {
        $form = new Default_Form_Login();
        $this->view->form = $form;

        if($this->getRequest()->isPost()){

            if($form->isValid($this->getRequest()->getPost())){

                $values = $form->getValues();

                $login = new RPS_UserService_Clients();
                $login->setURL("/clinic");
                $login->setTable("users");
                $login->setCredentialColumn("password");
                $login->setIdentityColumn("username");
                $login->setIdentity($values["Users_Form_Login_Username"]);
                $login->setCredential($values["Users_Form_Login_Password"]);
                $login->setDefaultSessionTime(1800);
                $login->authenticate();





            } else {
                $this->_helper->_layout->setLayout('login');
                $this->view->form   = $form;
                $this->view->errors = $form->getMessages();
                }
            } else {


            $this->redirect("/");
        }

        }

}