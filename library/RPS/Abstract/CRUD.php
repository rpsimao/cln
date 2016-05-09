<?php

/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 05/05/16
 * Time: 11:38
 */
abstract class RPS_Abstract_CRUD implements RPS_Interfaces_CRUD
{

    /**
     * Define table Name
     * @var Zend_Db_Table_Abstract
     */
    protected $table;

    public function __construct(Zend_Db_Table_Abstract $table)
    {
        $this->table = $table;
    }

    /**
     * Find Record by ID
     * @param $id
     * @return array
     * @throws Zend_Db_Table_Exception
     */

    public function findByID($id)
    {
        try {
            $sql = $this->table->find($id);
            return $sql->toArray();

        } catch (Zend_Db_Table_Exception $e) {
            return $e->getMessage() ;
        }
    }

    /**
     * Get All Values from DB
     * @return array
     * @throws Zend_Db_Table_Exception
     */
    public function getAll()
    {
         try {
            $sql = $this->table->select();
            $rows = $this->table->fetchAll($sql)->toArray();

            return $rows;
             
        } catch (Zend_Db_Table_Exception $e) {
            return $e->getMessage() ;
        }
    }

    /**
     * Insert New Record into DB
     * @param array $values
     * @return int
     * @throws Zend_Db_Table_Exception
     */
    public function insertNewRecord(array $values)
    {
        try {
            $this->table->insert($values);
            return $this->table->getAdapter()->lastInsertId();
        } catch (Zend_Db_Table_Exception $e) {
            return $e->getMessage() ;
        }
    }


    /**
     * Remove Record from DB
     * @param int $id
     * @return boolean
     * @throws Zend_Db_Table_Exception
     */
    public function removeRecord($id)
    {
      try {
            $where = $this->table->getAdapter()->quoteInto('id = ?', (int) $id);
            $this->table->delete($where);
            return TRUE;
        } catch (Zend_Db_Table_Exception $e) {
            return $e->getMessage() ;
        }

    }

    /**
     * Update Record in DB
     * @param array $values
     * @param int $id
     * @return boolean
     * @throws Zend_Db_Table_Exception
     */
    public function updateRecord(array $values, $id){

        try {
            $where = $this->table->getAdapter()->quoteInto('id = ?', (int) $id);
            $this->table->update($values, $where);
            return TRUE;
        } catch (Zend_Db_Table_Exception $e) {
            return $e->getMessage() ;
        }

    }


}