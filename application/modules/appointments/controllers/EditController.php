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
        $this->_helper->viewRenderer('edit');

        $id = $this->getParam("id");

        $dbBodyZones = new Admin_Model_Bodyzones();
        $this->view->bodyZones = $dbBodyZones->getZonesByLang();

        $this->view->lang = RPS_Aux_GetLocale::get();

        $db = new Appointments_Model_Appointments();
        $this->view->record = $db->findByID($id);

        $db1 = new Admin_Model_Treatments();
        $this->view->allTreatments = $db1->getAllTreatmentsByLang(RPS_Aux_GetLocale::get());
        
    }


}

