<?php


namespace PhlebotomyPortal;

use PDO;

require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/lib/database/DatabaseAccessLayer.php";

class DatabaseRetrieve extends \PhlebotomyPortal\DatabaseAccessLayer {
    
    
    public function __construct() { 
        
        parent::__construct();
        
    }
    
    //Returns a result set.
    public function getResultSet() {
        $this->execute();
        return $this->dbObject->fetchAll(PDO::FETCH_ASSOC);
    }

    //Returns a single record.
    public function getSingleRecord() {
        $this->execute();
        return $this->dbObject->fetch(PDO::FETCH_ASSOC);
    }

    
    //Returns row count.
    public function rowCount() {
        return $this->dbObject->rowCount();
    }
    
}
