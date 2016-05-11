<?php

class Admin_Model_Questions extends RPS_Abstract_CRUD
{

    public function __construct()
    {

        $table = new Admin_Model_DbTable_Questions();

        parent::__construct($table);
    }


}

