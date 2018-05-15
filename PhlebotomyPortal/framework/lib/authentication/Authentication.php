<?php


namespace PhlebotomyPortal;
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/lib/database/DatabaseRetrieve.php";

class Authentication {
   
    
 
        
          
    
    
    //CheckCredentials: This method will check a user excists in the database
    //and returns true or false. You must pass a username and non hashed password
    
    public static function checkCredentials($_userName, $_userPassword) {
        
        DatabaseRetrieve::query("SELECT * FROM users_table WHERE username = :username");
        DatabaseRetrieve::bind(':username', $_userPassword);
        
        $rowdata = DatabaseRetrieve::getSingleRecord();
        
        if(DatabaseRetrieve::rowCount() == 1) {
            
            if(password_verify($_userPassword, $rowdata['userpassword'])) {
                
                return true;
                
            } else {
                
                return false;
                
            }
            
        }
              
        
        
        
    }
    
    
    
        

}
