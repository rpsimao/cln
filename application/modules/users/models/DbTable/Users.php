<?php

class Users_Model_DbTable_Users extends Zend_Db_Table_Abstract
{

    protected $_name = 'users';
    protected $_primary = 'id';


    /**
     * @var username
     */
    protected $username;



    public function getClinicName($username)
    {

        $sql = $this->select("clinic");
        $sql->where("username = ?", $username);

        $row = $this->fetchRow($sql);

        return $row;

    }
}

