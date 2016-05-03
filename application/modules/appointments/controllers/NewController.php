<?php

class Appointments_NewController extends Zend_Controller_Action
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


        $client = new RPS_UserService_SessionClient();
        $this->view->id = $client->getSessionID();

    }

    public function preDispatch()
    {
        if ($this->_helper->FlashMessenger->hasMessages()) {
            $this->view->messages = $this->_helper->FlashMessenger->getMessages();
        }
    }

    public function indexAction()
    {


        $client = new RPS_UserService_SessionClient();
        $this->view->client = $client->getClient();
        

        $clientData = new Clients_Model_Clients();
        $dbAlerts = new Appointments_Model_Alerts();
        $alerts = new RPS_Aux_ClientsAlerts($clientData, $dbAlerts);
        $alerts->setId($client->getSessionID());
        

        $this->view->display = $alerts->alerts();





    }

    public function createAction()
    {
        if($this->getRequest()->isPost()) {

           $values = $this->getRequest()->getPost();

            if ($values) {

                $db = new Appointments_Model_Appointments();

                $dat = array(
                    "clientid" => $values["clientid"],
                    "client_name"=> $values["client_name"],
                    "date_app" => $values["date_app"],
                    "type_treatment" => $this->loopThrowArray($values["type_treatment"]),
                    "desc_treatment" => $this->loopThrowArray($values["desc_treatment"]),
                    "type_treatment_future" => $this->loopThrowArray($values["type_treatment_future"]),
                    "desc_treatment_future" => $this->loopThrowArray($values["desc_treatment_future"]),
                    "type_of_skin" => $this->loopThrowArray($values["type_of_skin"]),
                    "hair_type_1" => $values["hair_type_1"],
                    "hair_type_2" => $values["hair_type_2"],
                    "allergies" => $values["allergies"],
                    "out_in_the_sun" => $values["out_in_the_sun"],
                    "laser_light" => $values["laser_light"],
                    "vitamines" => $values["vitamines"],
                    "hormone" => $values["hormone"],
                    "diabetes" => $values["diabetes"],
                    "pregnant" => $values["pregnant"],
                    "cancer" => $values["cancer"],
                    "sensitive_skin" => $values["sensitive_skin"],
                    "burns" => $values["burns"],
                    "spots" => $values["spots"],
                    "scars" => $values["scars"],
                    "vascular" => $values["vascular"],
                    "tatoos" => $values["tatoos"],
                    "circulatory" => $values["circulatory"],
                    "info" => $values["info"],
                );

                try {
                    $db->insertNewRecord($dat);

                } catch (Zend_Exception $e) {

                    $db->updateRecord($dat, $values["id"]);
                }

                $client = new RPS_UserService_SessionClient();


                $this->redirect("/clients/dashboard/". $client->getSessionID());


            }
        }
    }




    private function loopThrowArray($values)
    {

        $final ="";

        foreach ($values as $value)
        {

            $final.= $value . ";";


        }

        return rtrim($final, ";");


    }


}



