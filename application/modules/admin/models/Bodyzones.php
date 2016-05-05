<?php

class Admin_Model_Bodyzones extends RPS_Abstract_CRUD
{


    public function __construct()
    {
        $table = new Admin_Model_DbTable_Bodyzones();

        parent::__construct($table);
    }
    
    
}

