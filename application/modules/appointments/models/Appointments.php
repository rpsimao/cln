<?php

class Appointments_Model_Appointments extends RPS_Abstract_CRUD
{


    public function __construct()
    {

        $table = new Appointments_Model_DbTable_Appointments();

        parent::__construct($table);
    }




    public function getLastAppByID($id)
    {
        $sql = $this->table->select()->where("clientid = ?", $id)->limit(1)->order('date_app DESC');

        return $this->table->fetchAll($sql)->toArray();
    }




}
