<?php

namespace PhlebotomyPortal;


require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/controllers/Controller.php";
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/views/patientsView.php";
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/models/patientsModel.php";



class patientsController extends Controller {
  
     
    private $ControllerView = null;
    private $ControllerModel = null;


    public $Title = "Patients";
    
   
    
    
    //This is the main 'page' shown if no or main is passed as ?action
    protected function main()
    {
        $this->ControllerView->mainpage();
        
    }
    
    protected function viewpatients()
    {
        if(!$this->ACL->hasPermission('VIEWPATIENTS', $this->UserPermissions)) {
            $this->ControllerView->errorMessage('ACCESSDENIED');
        } else {
            $this->ControllerView->viewpatients($this->ControllerModel->getPatientsRecords());
        } 
    }
    
    public function addnewpatient()
    {
        //check they have permissions
             if(!$this->ACL->hasPermission('ADDPATIENT', $this->UserPermissions)) {
            $this->ControllerView->errorMessage('ADDPATIENTDENIED');
        } else {
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                //Pass post array into model and get back request.
                
                //if yay then say yay
                
                
                //if error then error
                
            } else {
                $this->ControllerView->addnewpatient();
            }
        }
        
        
        
    }



    public function __construct($Route) {
         parent::__construct();
        $this->setup($Route);
        $this->ControllerView = new \PhlebotomyPortal\patientsView();  
        $this->ControllerModel = new \PhlebotomyPortal\patientsModel();
    }

    //Add anything that needs setting up in class here
    private function setup($Route) {
        $this->Route = $Route;
    }
    
   
    
    
}
