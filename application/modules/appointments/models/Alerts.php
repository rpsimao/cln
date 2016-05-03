<?php

/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 03/05/16
 * Time: 11:54
 */
class Appointments_Model_Alerts
{

    private $table_alerts;



    public function __construct()
    {
        $this->table_alerts = new Appointments_Model_DbTable_Alerts();
    }


    public function getOrigin()
    {

        $sql = $this->table_alerts->find(1);

        return $sql["origin"];

    }


    public function getAge()
    {

        $sql = $this->table_alerts->find(1);

        return $sql["age"];

    }




}