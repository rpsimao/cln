<?php

/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 05/05/16
 * Time: 11:35
 */
interface RPS_Interfaces_CRUD
{

    public function findByID($id);

    public function getAll();

    public function insertNewRecord(array $values);

    public function removeRecord($id);

    public function updateRecord(array $values, $id);


}