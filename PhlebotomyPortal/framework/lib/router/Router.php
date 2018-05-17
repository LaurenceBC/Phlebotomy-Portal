<?php


namespace PhlebotomyPortal;


class Router {
   
    
    
    public function __construct() {
        
        $this->buildController($this->getRoute());
    }
    
    //This is the controller returned
    private $ControllerTittle;
    
    public function getTitle()
    {
        return $this->ControllerTittle;
    }
    
    private function buildController($Route)
    {
        
     
        
        
        //include class, pass action if any, pass params if any.
        //Check a controller name was actually passed other wise throw to home.
        
        if(!isset($Route['controller']) || $Route['controller'] !== 'index.phpController') //proof i have no clue.
        {
        require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/controllers/" . $Route['controller'] . ".php";
        } else { //if no controller assume home conntroller
           require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/controllers/homeController.php";
        }
        
        $ClassObject = null;
        
        
        //Check for a controller in the Route before continuing.
//        if(isset($Route['controller'])) {
//            
//            //Show homepage?
//            
//            echo 'Home page';
//            
//            
//        } else {
        
       
        //Remember controller has Controller at end of name so portal would be portalController
        
        
            switch ($Route['controller']) {

                case 'portalController' :
                     //At this point the class will check the user has roles to access
                    $ClassObject = new \PhlebotomyPortal\portalController($Route);
                    
                  
                   
                    break;

                case 'adminController' :
                    
                   
                    
                    break;
                        
                   //Default is home controller.  
                default :
                    $ClassObject = new \PhlebotomyPortal\homeController();
                    break;




                }
                
                  $this->ControllerTittle = $ClassObject->Title;
                    
        
//        }
       
        
        //Then request the action. ie action=view request view method.
       // $ClassObject->{$Route['action']}();
       
        
    }


    private function getRoute()
    {
        //return the uri as path = controller
        //                  query = params
                $uri; //Holds the URI.
        $controller =""; //Holds the controller name (which is the URI path) ie /
        $action =""; //ie CRUD options for now
        $params ="";
        
        //First fetch the uri
        
        try{
            
             $uri = parse_url( $_SERVER['REQUEST_URI']);
            
        } catch (Exception $ex) {
            echo 'Error' . $ex;
        }
        
        
        //Get the controller name from the URI and append "Controller" to the end.
        //so it matches the file name.
        $controller = basename($uri['path']) . "Controller";
        if(null !== parse_str($uri['query'], $actionstring)) //Gives us the action
        { 
            $action = $actionstring['action'];
                    
        }
        
        
        parse_str($uri['query'], $acionparameters);
        $params = $acionparameters['params'];
       
        //Create an array with controll action and array of params
        $RouteArray = array("controller" => $controller,
                            "action" => $action,
                            "params" => explode("/",$params),
                );
        
        
        
       //Return the array     
       return $RouteArray;
        
        
    }
    
    
}
