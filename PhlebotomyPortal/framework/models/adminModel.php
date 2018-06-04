<?php



namespace PhlebotomyPortal;


require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/../framework/models/Model.php";

class adminModel extends Model {
   
    
      public function __construct() {
        parent::__construct();
    }
    
    
    
    public function addUser($NewUserDetails, $UserType)
    {
        $this->DatabaseWrite->query('INSERT INTO user_table (UserName,UserPassword,UserEmail,UserCreatedDate');
        $this->DatabaseWrite->bind(':UserName', $NewUserDetails['UserName']);
        
        $this->DatabaseWrite->bind(':UserPassword', $NewUserDetails['UserName']);
        
        
        $this->DatabaseWrite->bind(':UserEmail', $NewUserDetails['UserEmail']);
        $this->DatabaseWrite->bind(':UserCreatedDate', null);
              
    }
    
    
    
}
