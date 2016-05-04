<?php

class Users_Model_Users
{

    private $table;

    public function __construct()
    {
        $this->table = new Users_Model_DbTable_Users();
    }


    public function getAll()
    {

        $sql = $this->table->select();

        $rows = $this->table->fetchAll($sql)->toArray();

        return $rows;

    }



    public function insertNewUser(array $values)
    {
        

        $this->table->insert($values);
        return $this->table->getAdapter()->lastInsertId();


    }


}

