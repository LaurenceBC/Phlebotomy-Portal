<?php


namespace PhlebotomyPortal;

require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/lib/acl/ACL.php";

abstract class Controller {
    
    
     protected $Route = null;
     protected $ACL = null;
     protected $UserPermissions = null;


     public function __construct() {
         $this->ACL = new ACL();
         $this->UserPermissions = $this->ACL->getPermissionsByUserID($_SESSION['UserID']); //Naughty
         print_r($this->UserPermissions);
         
     }
     
     public function executeAction() {
    
        //If there is an action, execute it
        //Pass any parmaters which must be in order first in.
        if(!$this->Route['action'] == null)
        {
            //this ... is a splat operator. 
            $this->{$this->Route['action']}(...$this->Route['params']);
        } //Else execute main();
        else
        {
            $this->main();
        }
        
        //This could be made better by using reflection to check if a method
        //is valid.
        
        
    }
    
    
}
