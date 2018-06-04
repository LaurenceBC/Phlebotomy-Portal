<?php


namespace PhlebotomyPortal;

require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/../framework/lib/database/DatabaseRetrieve.php";
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/../framework/lib/database/DatabaseInsert.php";
class Authentication {
   
    
 
    private function __construct() {
        
    }
    
    public static function addUser($UserRegisterDetails)
    {
        
    }
    
    
    public static function getUserData($UserID)
    {
        //return an array with user info
        
        $UserData = array('UserID' => null,
                          'UserName' => null,
                          'UserEmail' => null,
                          'UserFirstName' => null
            );
        
        $DatabaseRetrieve = new \PhlebotomyPortal\DatabaseRetrieve();
        
        $DatabaseRetrieve->query('SELECT * FROM user_table WHERE UserID = :UserID');
        $DatabaseRetrieve->bind(':UserID', $UserID); //could be passed as type int later
        
        $UserDataRow = $DatabaseRetrieve->getSingleRecord();
        
        $UserData['UserID'] = $UserDataRow['UserID'];
        $UserData['UserID'] = $UserDataRow['UserName'];
                
                
                
        return $UserData;
    }
    
    
    public static function isLoggedIN()
    {
        if((isset($_SESSION['LOGGEDIN'])) && $_SESSION['LOGGEDIN'] === true)
        {
            return true;
        } else {
            return false;
        }
    }
            
    
    
    //CheckCredentials: This method will check a user excists in the database
    //and returns true or false. You must pass a username and non hashed password
    
    public static function checkCredentials($_userName, $_userPassword) {
        
         
        $dbaccess = new \PhlebotomyPortal\DatabaseRetrieve();
                $dbaccess->query('SELECT * FROM user_table WHERE UserName = :username');
                $dbaccess->bind(':username', $_userName);
        
        $rowdata = $dbaccess->getSingleRecord();
        
        if($dbaccess->rowCount() == 1) {
            
            if(password_verify($_userPassword, $rowdata['UserPassword'])) {
               
                $_SESSION['UserID'] = $rowdata['UserID'];
                return true;
            } else { 
                return false; 
            }
            
        }   
        
    }
    
    
    
        

}
