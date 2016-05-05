<?php

class Users_Model_Users extends RPS_Abstract_CRUD
{


    public function __construct()
    {
        $table = new Users_Model_DbTable_Users();

        parent::__construct($table);
    }





}

