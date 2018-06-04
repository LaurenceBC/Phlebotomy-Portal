<?php



namespace PhlebotomyPortal;

require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/../framework/controllers/Controller.php";
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/../framework/views/adminView.php";
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/../framework/models/adminModel.php";

class adminController extends Controller {
    
    
    private $ControllerView = null;
    private $ControllerModel = null;


    public $Title = "PHS Portal Admin";
    
   
    
    
    //This is the main 'page' shown if no or main is passed as ?action
    protected function main()
    {
        
        if(!$this->ACL->hasPermission('VIEWADMIN', $this->UserPermissions)) {
            $this->ControllerView->errorMessage('ACCESSDENIED', 'admin');
        } else {
            $this->ControllerView->mainpage();
        } 
        
    }

    
    public function __construct($Route) {
         parent::__construct();
        $this->setup($Route);
        $this->ControllerView = new \PhlebotomyPortal\adminView();  
         $this->ControllerModel = new \PhlebotomyPortal\adminModel(); 
    }

    //Add anything that needs setting up in class here
    private function setup($Route) {
        $this->Route = $Route;
    }
    
    
    
    public function adduser()
    {
        if(!$this->ACL->hasPermission('ADDADMIN', $this->UserPermissions)) {
            $this->ControllerView->errorMessage('ACCESSDENIED', 'admin');
        } else {
            
         
            
            
        }  
    }
    
    
    
}
