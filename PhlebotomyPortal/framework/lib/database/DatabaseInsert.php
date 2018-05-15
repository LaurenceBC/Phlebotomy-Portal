<?php


class DatabaseInsert extends \PhlebotomyPortal\DatabaseAccessLayer {
   
    
    //Constructor
    private function __construct(){}

    
    public static function singleRecord(){
          $this->execute();
          return $this->dbObject->fetch(PDO::FETCH_ASSOC);
    } 

    //Method returns an INT value of the last auto increment (rowID)
    public static function getLastRecordInsertID() {
        return $this->dbconnection->lastInsertId();
    }

    
    //Transaction methods.
    
    public static function beginTransaction() {
        return $this->dbconnection->beginTransaction();
    }


    public static function endTransaction() {
        return $this->dbconnection->commit();
    }

    public function cancelTransaction() {
        return $this->dbh->rollBack();
    }
    
    public function resultset(){
          $this->execute();
          return $this->dbObject->fetchAll(PDO::FETCH_ASSOC);
    }

   
      


    
}
