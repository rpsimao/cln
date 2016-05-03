<?php
/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 03/05/16
 * Time: 11:46
 */

class Alerts extends Akrabat_Db_Schema_AbstractChange
{

    private $tableName = 'alerts';


    function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS $this->tableName (
              id int(11) NOT NULL AUTO_INCREMENT,
              origin VARCHAR(500) NOT NULL,
              age int(3) NOT NULL,
              PRIMARY KEY (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->_db->query($sql);
        
        $data = array();
        $data['origin'] = "Portuguese;Spanish;Italian;Maghrebian;South American";
        $data['age'] = 45;



        $this->_db->insert('alerts', $data);
    }


    function down()
    {
        $sql= "DROP TABLE IF EXISTS $this->tableName";
        $this->_db->query($sql);
    }
}