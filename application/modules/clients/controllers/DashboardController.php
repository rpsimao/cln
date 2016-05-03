<?php

class Clients_DashboardController extends Zend_Controller_Action
{

    private $auth;

    private $identity;

    public function init()
    {
        $this->auth = Zend_Auth::getInstance();
        if ($this->auth->hasIdentity()) {
            // Identity exists; get it
            $this->identity = $this->auth->getIdentity();
        } else {

            $this->_helper->flashMessenger->addMessage($this->view->translate(gettext("You are not allowed to see this resource. Please login.")));
            $this->redirect("/");
        }
    }

    public function indexAction()
    {
        $id = $this->_getParam("id");

        $db = new Clients_Model_Clients();
        $client = $db->findByID($id);

        $this->view->client = $client;

        $session = new RPS_UserService_SessionClient();
        $session->setClient($client[0]["first_name"] . " " . $client[0]["last_name"]);
        $session->setID($client[0]["id"]);

        $consultas = new Appointments_Model_Appointments();
        $this->view->last = $consultas->getLastAppByID($id);

    }



}
