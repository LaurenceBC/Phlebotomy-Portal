<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PhlebotomyPortal;

/**
 * Description of portalController
 *
 * @author larry
 */
class portalController {
  
    
    
    public $Title = "Portal";
    
    private $Route = null;
    

    public function __construct($Route = null) {
        $this->setup($Route);
    }

    private function setup($Route) {
        
        $this->Route = $Route;

    }
    
    
}
