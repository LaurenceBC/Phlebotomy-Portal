<?php



namespace PhlebotomyPortal;



class ACL {
    //put your code here


    private $dbaccessRead;
    private $dbaccessWrite;
    
    
    public function __construct() {
        
        $this->dbaccessRead = new \PhlebotomyPortal\DatabaseRetrieve();
        $this->dbaccessWrite = new \PhlebotomyPortal\DatabaseRetrieve();
        
    }



    
    public function getRolesByUserID($UserID)
    {
        
        $this->dbaccessRead->query("SELECT FROM ");
        $this->dbaccessRead->bind(':UserID', $UserID);        
        $RolesResultSet = $this->dbaccessRead->getResultSet();
       
        $Roles = array();
        
        foreach ($RolesResultSet as $Role)
        {
            array_push($Roles, $Role);
        }
        
        return $Roles;
    }
    
    public function getRolePermissions($Role)
    {
        
    }
    
    
    
}
