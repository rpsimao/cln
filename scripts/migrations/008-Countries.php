<?php

/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 11/05/16
 * Time: 15:07
 */
class Countries extends Akrabat_Db_Schema_AbstractChange
{

    private $tableName = 'countries';


    function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS $this->tableName (
            id int(11) NOT NULL AUTO_INCREMENT,
            country_code varchar(2) NOT NULL default '',
            country_name varchar(100) NOT NULL default '',
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