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
    private $dbalerts;
    protected $id;

    
    
    public function __construct(Clients_Model_Clients $clients, Appointments_Model_Alerts $dbalerts)
    {
        $this->clients = $clients;
        $this->dbalerts = $dbalerts;
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
        


        switch (TRUE){

            case  $info[0]["age"] >= $this->dbalerts->getAge():
                return TRUE;


        }



    }




    






}