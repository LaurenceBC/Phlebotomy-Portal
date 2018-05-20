<?php



namespace PhlebotomyPortal;

require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/lib/database/DatabaseRetrieve.php";
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/lib/database/DatabaseInsert.php";

abstract class Model {
 
    public $DatabaseRead = null;
    protected $DatabaseWrite = null;


    public function __construct() {
        $this->DatabaseRead = new DatabaseRetrieve();
        $this->DatabaseWrite = new DatabaseInsert();
       
        
    }
    
    
    
}
