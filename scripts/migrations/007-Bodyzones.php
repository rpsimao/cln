<?php

class Bodyzones extends Akrabat_Db_Schema_AbstractChange
{

    private $tableName = 'bodyzones';


    function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS $this->tableName (
            id int(11) NOT NULL AUTO_INCREMENT,
            zone_en VARCHAR (500),
            zone_fr VARCHAR (500),
            zone_de VARCHAR (500),
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