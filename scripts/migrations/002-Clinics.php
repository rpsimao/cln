<?php

/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 13/01/16
 * Time: 12:42
 */
class Clinics extends Akrabat_Db_Schema_AbstractChange

{
    private $tableName = "clinics";


    function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS $this->tableName (
              id int(11) NOT NULL AUTO_INCREMENT,
              clinic_name varchar(50) NOT NULL,
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