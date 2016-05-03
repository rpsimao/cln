<?php

class Clients_ClientsController extends Zend_Controller_Action
{

    private $auth = null;

    private $identity = null;

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

        $form = new Clients_Form_Patients();
        $form->populate(["clinic" => $this->identity->clinic]);
        $this->view->form = $form;

    }

    public function newAction()
    {

        $form = new Clients_Form_Patients();

        if($this->getRequest()->isPost()) {

            if ($form->isValid($this->getRequest()->getPost())) {

                $values = $form->getValues();
                $db = new Clients_Model_Clients();
                $id = $db->newClient($values);
                $this->_helper->flashMessenger->addMessage($this->view->translate(gettext("Client created successfully.")));

                $client = $db->findByID($id);

                $session = new RPS_UserService_SessionClient();
                $session->setClient($client[0]["first_name"] . " " . $client[0]["last_name"]);
                $session->setID($client[0]["id"]);

                $this->redirect("/appointments/new");

            } else {
                $this->view->form   = $form;
                $this->view->errors = $form->getMessages();

            }

        }
    }

    public function searchAction()
    {
        $client = new RPS_UserService_SessionClient();
        $id = $client->getSessionID();



        if (isset($id))
        {
            $this->redirect("/clients/dashboard/".$id);

        }
    }

    public function searchforAction()
    {
        if($this->getRequest()->isPost()) {

            $values = $this->getRequest()->getPost();

            $db = new Clients_Model_Clients();
            $results = $db->searchClient($values["rps_text_search_client"], $values["optionsRadios"], $this->identity->clinic);

            if (!$results)
            {
                $this->_helper->flashMessenger->addMessage($this->view->translate(gettext("No Client found!")));
                $this->redirect("/clients/clients/search");

            } else {
                $this->view->results = $results;
            }
        }
    }

    public function switchAction()
    {

        $cli = new RPS_UserService_SessionClient();
        $cli->destroy();

        $this->redirect("/clients/clients/search");

    }


}