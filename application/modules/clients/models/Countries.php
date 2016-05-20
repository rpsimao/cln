<?php

class Clients_Model_Countries extends RPS_Abstract_CRUD
{



    public function __construct()
    {
        $table = new Clients_Model_DbTable_Countries();
        parent::__construct($table);
    }


    public function checkAlert($country)
    {

        $sql = $this->table->select();
        $sql->where("country_name = ?", $country );

        $row = $this->table->fetchRow($sql);

        return $row["alert"];
    }

}

