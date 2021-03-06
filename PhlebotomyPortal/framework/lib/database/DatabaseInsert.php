<?php

namespace PhlebotomyPortal;

use PDO;
class DatabaseInsert extends \PhlebotomyPortal\DatabaseAccessLayer {
   
    
    //Constructor
    public function __construct() {
       parent::__construct();
    }

    
    public function singleRecord(){
          $this->execute();
          return $this->dbObject->fetch(PDO::FETCH_ASSOC);
    } 

    //Method returns an INT value of the last auto increment (rowID)
    public function getLastRecordInsertID() {
        return $this->dbconnection->lastInsertId();
    }

    
    //Transaction methods.
    
    public function beginTransaction() {
        return $this->dbconnection->beginTransaction();
    }


    public function endTransaction() {
        return $this->dbconnection->commit();
    }

    public function cancelTransaction() {
        return $this->dbh->rollBack();
    }
    
//    public function resultset(){
//          $this->execute();
//          return $this->dbObject->fetchAll(PDO::FETCH_ASSOC);
//    }

   
      


    
}
