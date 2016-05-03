<?php

class Appointments_Model_Appointments
{


    private $table_appointments;



    public function __construct()
    {
        $this->table_appointments = new Appointments_Model_DbTable_Appointments();
    }




    public function insertNewRecord (array $values)
    {
        $this->table_appointments->insert($values);
    }




    public function getLastAppByID($id)
    {
        $sql = $this->table_appointments->select()->where("clientid = ?", $id)->limit(1)->order('date_app DESC');

        return $this->table_appointments->fetchAll($sql)->toArray();
    }


    public function getAppointmentByID($id){

        $sql = $this->table_appointments->select()->where("id = ?", (int) $id);
        return $this->table_appointments->fetchRow($sql)->toArray();
    }


    public function updateRecord(array $values, $id){


        $where = $this->table_appointments->getAdapter()->quoteInto('id = ?', (int) $id);

        $this->table_appointments->update($values, $where);


    }

}
