<?php


namespace PhlebotomyPortal;


abstract class Controller {
    
    
     public function executeAction() {
    
        //If there is an action, execute it
        //Pass any parmaters which must be in order first in.
        if(!$this->Route['action'] == null)
        {
            //this ... is a splat operator. 
            $this->{$this->Route['action']}(...$this->Route['params']);
        }
        
    }
}
