<?php

class Clients_Model_Clients
{

    private $table_clients;

    public function __construct()
    {
        $this->table_clients = new Clients_Model_DbTable_Clients();
    }

    /**
     * Create New Client
     * @param array $values
     * @return string
     */
    public function newClient(array $values){

    $this->table_clients->insert($values);
    return $this->table_clients->getAdapter()->lastInsertId();

    }

    /**
     * Find Client by ID
     * @param $id
     * @return array
     * @throws Zend_Db_Table_Exception
     */

    public function findByID($id)
    {
        $sql = $this->table_clients->find($id);
        return $sql->toArray();
    }


    /**
     * Search for Clients
     * @param $value
     * @param $type
     * @param $clinic
     * @return array
     */

    public function searchClient($value, $type, $clinic)
    {
        switch ($type){
            case "option1":
                $type = "email";
                break;
            case "option2":
                $type = "birthdate";
                break;
            case "option3":
                $type = "mobile";
                break;
            case "option4":
                $type = "phone";
                break;
            case "option5":
                $type = "name";
                break;
        }

        $db = $this->table_clients->select();

        if ($type == "name"){
            try {
                $names = explode(" ", $value);
                $sql = $db->where("first_name = ?", $names[0])->where("last_name = ?",  $names[1])->where("clinic = ?", $clinic);

                $rows = $this->table_clients->fetchAll($sql);
                return $rows->toArray();
            } catch (Zend_Exception $e){

                return false;
            }
        } else {

            $sql = $db->where("$type = ?", $value);
            $rows = $this->table_clients->fetchAll($sql);
            return $rows->toArray();
        }
    }
}

