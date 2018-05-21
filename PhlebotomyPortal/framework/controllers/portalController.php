<?php


namespace PhlebotomyPortal;


require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/../framework/controllers/Controller.php";


class portalController extends Controller {
  
    
    
    
    public $Title = "Portal";
    protected $Route = null;

    public function __construct($Route = null) {
        $this->setup($Route);
    }

    private function setup($Route) {

        $this->Route = $Route;
    }

    protected function main() {
        
    }

}
