<?php

class Treatments extends Akrabat_Db_Schema_AbstractChange
{

    private $tableName = 'treatments';


    function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS $this->tableName (
              id int(11) NOT NULL AUTO_INCREMENT,
              type_en VARCHAR(500),
              type_fr VARCHAR(500),
              type_de VARCHAR(500),
              description_en VARCHAR(500),
              description_fr VARCHAR(500),
              description_de VARCHAR(500) NOT NULL,
              PRIMARY KEY (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->_db->query($sql);
    }


    function down()
    {
        $sql= "DROP TABLE IF EXISTS $this->tableName";
        $this->_db->query($sql);
    }
}