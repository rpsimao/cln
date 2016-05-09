<?php
/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 13/01/16
 * Time: 09:56
 */
class Users extends Akrabat_Db_Schema_AbstractChange
{

    private $tableName = "users";


    function up()
    {

        $sql = "
            CREATE TABLE IF NOT EXISTS $this->tableName (
              id int(11) NOT NULL AUTO_INCREMENT,
              username varchar(50) NOT NULL,
              password varchar(75) NOT NULL,
              roles varchar(200) NOT NULL DEFAULT 'user',
              clinic varchar(200) NOT NULL,
              PRIMARY KEY (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->_db->query($sql);

        $data = array();
        $data['username'] = 'rpsimao';
        $data['password'] = '1234';
        $data['roles'] = 'admin';
        $data['clinic'] = 'friburg';

        $this->_db->insert('users', $data);

    }


    function down()
    {
        $sql= "DROP TABLE IF EXISTS $this->tableName";
        $this->_db->query($sql);
    }
}