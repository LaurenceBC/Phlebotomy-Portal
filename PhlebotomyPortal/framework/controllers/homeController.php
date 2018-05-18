<?php



namespace PhlebotomyPortal;
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/controllers/Controller.php";


class homeController extends Controller {
    
    
    
    
    
    public $Title = "Home";
    
    protected $Route = null;
    

    public function __construct($Route) {
        $this->setup($Route);
    }

    private function setup($Route) {
        
        $this->Route = $Route;

    }
    
   
  
    
}
