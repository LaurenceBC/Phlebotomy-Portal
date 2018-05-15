<?php


namespace PhlebotomyPortal;


class DatabaseRetrieve extends DatabaseAccessLayer{
    
    
      function __construct($sql) {
        parent::__construct();
        $this->query($sql);
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
