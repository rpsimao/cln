<?php

/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 13/01/16
 * Time: 14:31
 */
class Clients extends Akrabat_Db_Schema_AbstractChange
{

    private $tableName = 'clients';


    function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS $this->tableName (
              id int(11) NOT NULL AUTO_INCREMENT,
              first_name varchar(50) NOT NULL,
              last_name varchar(50) NOT NULL,
              age int(3),
              email varchar(50),
              origin VARCHAR(80),
              notes LONGTEXT,
              clinic VARCHAR(50),
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
