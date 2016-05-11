<?php

/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 11/05/16
 * Time: 10:58
 */
class Questions extends Akrabat_Db_Schema_AbstractChange
{

    private $tableName = 'questions';


    function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS $this->tableName (
            id int(11) NOT NULL AUTO_INCREMENT,
            bloco_id varchar(255) NOT NULL,
            questions_order int(2) NOT NULL UNIQUE,
            title_en VARCHAR(500),
            title_fr VARCHAR(500),
            title_de VARCHAR(500),
            question_en LONGTEXT,
            question_fr LONGTEXT,
            question_de LONGTEXT,
            popup_en LONGTEXT,
            popup_fr LONGTEXT,
            popup_de LONGTEXT,
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