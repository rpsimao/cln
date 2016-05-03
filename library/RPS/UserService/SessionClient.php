<?php

/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 22/01/16
 * Time: 10:37
 */
class RPS_UserService_SessionClient
{


    protected $client;

    protected $session;

    protected $id;


    private $namespace = "clinik_current_client";



    public function __construct()
    {
        $this->session = new Zend_Session_Namespace($this->namespace);
    }


    public function setClient($client){

        $this->session->client = $client;

    }


    public function getClient()
    {

        return $this->session->client;
    }


    public function setID($id){

        $this->session->id = $id;

    }


    public function getSessionID()
    {
        return $this->session->id;
    }


    public function destroy(){


        $this->session->unsetAll();
    }


}