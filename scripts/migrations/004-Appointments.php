<?php


class Appointments extends Akrabat_Db_Schema_AbstractChange
{

    private $tableName = 'appointments';


    function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS $this->tableName (
              id int(11) NOT NULL AUTO_INCREMENT,
              clientid VARCHAR(50) NOT NULL,
              client_name VARCHAR (50) NOT NULL,
              date_app DATE NOT NULL,
              type_treatment LONGTEXT,
              desc_treatment LONGTEXT,
              type_treatment_future LONGTEXT,
              desc_treatment_future LONGTEXT,
              type_of_skin LONGTEXT,
              hair_type_1 VARCHAR (100),
              hair_type_2 VARCHAR (100),
              allergies LONGTEXT,
              out_in_the_sun TINYINT,
              laser_light TINYINT,
              vitamines TINYINT,
              hormone TINYINT,
              diabetes TINYINT,
              pregnant TINYINT,
              cancer TINYINT,
              sensitive_skin TINYINT,
              burns TINYINT,
              spots TINYINT,
              scars TINYINT,
              vascular TINYINT,
              tatoos TINYINT,
              circulatory TINYINT,
              info LONGTEXT,

              PRIMARY KEY (id),
              UNIQUE (clientid)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->_db->query($sql);
    }


    function down()
    {
        $sql= "DROP TABLE IF EXISTS $this->tableName";
        $this->_db->query($sql);
    }
}