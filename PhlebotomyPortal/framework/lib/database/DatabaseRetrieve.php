<?php


namespace PhlebotomyPortal;

require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/lib/database/DatabaseAccessLayer.php";

class DatabaseRetrieve extends \PhlebotomyPortal\DatabaseAccessLayer {
    
    
    private function __construct(){}
    
    //Returns a result set.
    public static function getResultSet() {
       
        $this->execute();
        return $this->dbObject->fetchAll(PDO::FETCH_ASSOC);
    }

    //Returns a single record.
    public static function getSingleRecord() {
        $this->execute();
        return $this->dbObject->fetch(PDO::FETCH_ASSOC);
    }

    
    //Returns row count.
    public static function rowCount() {
        return $this->dbObject->rowCount();
    }
    
}
