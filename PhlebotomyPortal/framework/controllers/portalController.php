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
  
/* @var $ControllerView type */
$ControllerView = new PhlebotomyPortal\portalView;
$ControllerModel = new PhlebotomyPortal\portalModel;

    public function __construct() {
        //setup
        $this->setup(); //Run setup
        
        //Start output of contents
        $this->ControllerView
    }

    function setup() {
        
        

    }
    
    
}
