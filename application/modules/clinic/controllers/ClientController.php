<?php

class Clinic_ClientController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $session = new Zend_Session_Namespace("clinic_current_client");

        $id = $this->getParam("id");

        $db = new Clients_Model_Clients();
        $client = $db->findByID($id);

        $session->client = $client[0]["first_name"] . " " . $client[0]["last_name"];

        $this->redirect("/clinic");



    }


}

