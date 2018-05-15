<?php


namespace PhlebotomyPortal;


class Router {
   
    
    
    public function __construct() {
        
       
    }
    
    //This is the controller returned
    private $ControllerObject;
    
    private static function buildController($Route)
    {
        
        
        
        //include class, pass action if any, pass params if any
        
        require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/controller/" . $Route['controller'] . "php";
        
        
        
        $ClassObject;
        
        
        //Check for a controller in the Route before continuing.
        if(empty($Route['controller'])) {
            
            //Show homepage?
            
            echo 'Home page';
            
            
        } else {
        
            switch ($Route['controller']) {

                case 'portal' :
                     //At this point the class will check the user has roles to access
                    $ClassObject = new \PhlebotomyPortal\portalController();


                case 'admin' :
                    
                    $ClassObject = new 
                    
                default :




                }
        
        }
       
        
        //Then request the action. ie action=view request view method.
        $ClassObject->{$Route['action']}();
       
        
    }


    private static function getRoute()
    {
        //return the uri as path = controller
        //                  query = params
        
        $uri; //Holds the URI.
        $controller; //Holds the controller name (which is the URI path) ie /
        $action; //ie CRUD options for now
        $params;
        
        //First fetch the uri
        
        try{
            
             $uri = parse_url( $_SERVER['REQUEST_URI']);
            
        } catch (Exception $ex) {
            echo 'Error';
        }
        
        
        //Get the controller name from the URI and append "Controller" to the end.
        //so it matches the file name.
        $controller = basename($uri['path']) . "Controller";
        
        
        
        parse_str($uri['query'], $actionstring); //Gives us the action
        $action = $actionstring['view'];
        
        
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
