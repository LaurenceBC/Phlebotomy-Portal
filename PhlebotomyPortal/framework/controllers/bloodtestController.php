<?php

namespace PhlebotomyPortal;

require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/../framework/controllers/Controller.php";
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/../framework/views/bloodtestView.php";
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/../framework/models/bloodtestModel.php";

class bloodtestController extends Controller {
    
    
    
    
    private $ControllerView = null;
    private $ControllerModel = null;
    public $Title = "Blood test";

    //This is the main 'page' shown if no or main is passed as ?action
    protected function main() {
        $this->ControllerView->mainpage();
    }
    
     public function __construct($Route) {
        parent::__construct();
        $this->setup($Route);
        $this->ControllerView = new \PhlebotomyPortal\bloodtestView();
        $this->ControllerModel = new \PhlebotomyPortal\bloodtestModel();
    }

    //Add anything that needs setting up in class here
    private function setup($Route) {
        $this->Route = $Route;
    }
    
    
}
