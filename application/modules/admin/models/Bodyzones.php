<?php

class Admin_Model_Bodyzones extends RPS_Abstract_CRUD
{


    public function __construct()
    {
        $table = new Admin_Model_DbTable_Bodyzones();

        parent::__construct($table);
    }


    public function getZonesByLang()
    {

        $lang = RPS_Aux_GetLocale::get();

        try {

            /*$sql = $this->table->select()->from("bodyzones")->columns(array("zone_".$lang));
            $rows = $this->table->fetchAll($sql)->toArray();*/

            $clm = "zone_".$lang;
            $sql = $this->table->getAdapter()->fetchAll("SELECT `$clm` FROM `bodyzones`");

            return $sql;


        } catch (Zend_Db_Table_Exception $e) {
            return $e->getMessage() ;
        }


        
    }
    



    
    
    
}

