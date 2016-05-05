<?php

class Clients_Model_Clients extends RPS_Abstract_CRUD
{


    public function __construct()
    {
        $table = new Clients_Model_DbTable_Clients();

        parent::__construct($table);
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

        $db = $this->table->select();

        if ($type == "name"){
            try {
                $names = explode(" ", $value);
                $sql = $db->where("first_name = ?", $names[0])->where("last_name = ?",  $names[1])->where("clinic = ?", $clinic);

                $rows = $this->table->fetchAll($sql);
                return $rows->toArray();
            } catch (Zend_Exception $e){

                return false;
            }
        } else {

            $sql = $db->where("$type = ?", $value);
            $rows = $this->table->fetchAll($sql);
            return $rows->toArray();
        }
    }
}

