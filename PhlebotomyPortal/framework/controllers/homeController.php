<?php



namespace PhlebotomyPortal;
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/controllers/Controller.php";
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/views/homeView.php";


class homeController extends Controller {
    
    
    
    private $ControllerView = null;
    private $ControllerModel = null;


    public $Title = "Home";
    
   
    
    
    //This is the main 'page' shown if no or main is passed as ?action
    protected function main()
    {
        
        if(!$this->ACL->hasPermission('VIEWPORTAL', $this->UserPermissions)) {
            $this->ControllerView->errorMessage('ACCESSDENIED');
        } else {
            $this->ControllerView->mainpage();
        } 
        
    }

    
    public function __construct($Route) {
         parent::__construct();
        $this->setup($Route);
        $this->ControllerView = new \PhlebotomyPortal\homeView();  
    }

    //Add anything that needs setting up in class here
    private function setup($Route) {
        $this->Route = $Route;
    }
    
   
    
    
}
