<?php

class Admin_IndexController extends Zend_Controller_Action
{

    private $auth;

    private $identity;

    public function init()
    {
        $this->auth = Zend_Auth::getInstance();
        $this->identity = $this->auth->getIdentity();


        if ($this->identity->roles == "admin")
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

        $dbBodyZones = new Admin_Model_Bodyzones();
        $this->view->bodyZones = $dbBodyZones->getZonesByLang();

        $this->view->lang = RPS_Aux_GetLocale::get();
        
        $dbTraetment = new Admin_Model_Treatments();
        $this->view->treatments = $dbTraetment->getAll();


    }


    public function insertAction()
    {
        
       $this->_helper->viewRenderer->setNoRender(true);
       $this->_helper->layout->disableLayout();


       $params = $this->getAllParams();

        $dbArray = array(

            'username' => $params["username"],
            'password' => $params["passwd"],
            'roles' => $params["roles"],
            'clinic' => $params["clinic"]

        );


        $db = new Users_Model_Users();
        $resp = $db->insertNewRecord($dbArray);

        $this->getResponse()->appendBody($resp);
        
    }

    public function removeAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

        $param = $this->_getParam("id");

        $db = new Users_Model_Users();
        $db->removeRecord($param);

    }


    public function bodyzonesAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

        if ($this->getRequest()->isPost()) {

            $params = $this->getAllParams();
            $db = new Admin_Model_Bodyzones();

            $values = array(

                "zone_en" => strtoupper($params["en"]),
                "zone_fr" => strtoupper($params["fr"]),
                "zone_de" => strtoupper($params["de"]),
            );



            $this->getResponse()->appendBody($db->insertNewRecord($values));

        }

        }


    public function bodyzonedeleteAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

        if ($this->getRequest()->isPost()) {

            $params = $this->getAllParams();
            $db = new Admin_Model_Bodyzones();


            $db->removeRecord($params["id"]);


        }


    }


    public function bodyzoneeditAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();


        if ($this->getRequest()->isPost()) {

            $params = $this->getAllParams();
            $db = new Admin_Model_Bodyzones();


            $values = array(

                "zone_en" => strtoupper($params["en"]),
                "zone_fr" => strtoupper($params["fr"]),
                "zone_de" => strtoupper($params["de"]),


            );

            $db->updateRecord($values, $params["id"]);

        }

    }

    public function treatmentAction()
    {

        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

        if ($this->getRequest()->isPost())
        {
            $params = $this->getAllParams();

            $db = new Admin_Model_Treatments();
            $msg = $db->filterZonesByLangAndInsertTreatment($params);

            $this->getResponse()->appendBody($msg);
        }
    }

    public function treatmentdeleteAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();


        if ($this->getRequest()->isPost()){

            $id = $this->_getParam("id");

            $db = new Admin_Model_Treatments();
            $db->removeRecord($id);


        }
    }

    public function treatmenteditAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();


        if ($this->getRequest()->isPost()){

            $params = $this->getAllParams();

            $values = array(
                "description_en" => $params["en"],
                "description_fr" => $params["fr"],
                "description_de" => $params["de"],

            );

            $db = new Admin_Model_Treatments();
            $db->updateRecord($values, $params["id"]);

            $this->getResponse()->appendBody($params["id"]);


        }

    }

}

