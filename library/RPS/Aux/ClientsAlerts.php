<?php

/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 29/04/16
 * Time: 17:22
 */
class RPS_Aux_ClientsAlerts
{

private $clients;
protected $id;

    
    
    public function __construct(Clients_Model_Clients $clients)
    {
        $this->clients = $clients;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    public function alerts()
    {

        $info = $this->clients->findByID($this->getId());

        $origin = array("Portuguese", "Spanish", "Italian", "Maghrebian", "South American");


        switch (TRUE){

            case  $info[0]["age"] >= 45:
                return TRUE;

            case in_array($info[0]["origin"], $origin):
                return TRUE;
        }



    }




    






}