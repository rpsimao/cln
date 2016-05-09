<?php

class Admin_Model_Treatments extends RPS_Abstract_CRUD
{


    public function __construct()
    {
        $table = new Admin_Model_DbTable_Treatments();

        parent::__construct($table);
    }


    public function filterZonesByLangAndInsertTreatment(array $params)
    {

        $zones = explode(";", $params["type"]);

        $vals = array(

            'type_en' => $zones[0],
            'type_fr' => $zones[1],
            'type_de' => $zones[2],
            'description_en' => $params["desc_en"],
            'description_fr' => $params["desc_fr"],
            'description_de' => $params["desc_de"]
        );

        return $this->insertNewRecord($vals);


    }


    public function getTreatmentsSelect(array $params, $locale)
    {
        $sql = $this->table->select()->where('type_'.$locale.' IN (?)', $params);

        $rows = $this->table->fetchAll($sql)->toArray();

        return $rows;
    }
    
}

