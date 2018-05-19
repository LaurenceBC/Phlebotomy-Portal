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


    
    //For now this will check against hard coded values, but it could
    public function hasPermission($PermissionRequired, $UserPermissions)
    {
        
        if(in_array($PermissionRequired, $UserPermissions))
        {
            return true;
        } else {return false;}
        
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
    
    
//    SELECT
//  user_table.UserID,
//  permissions_table.PermissionName
//FROM
//  user_table,
//  roles_permissions_table
//  INNER JOIN permissions_table ON roles_permissions_table.PermissionID = permissions_table.PermissionID
//    
    
    public function getPermissionsByUserID($UserID)
    {
        
        $UserPermissions = array();
        
        $this->dbaccessRead->query('SELECT permissions_table.PermissionName FROM
                                    user_table,
                                    roles_permissions_table
                                    INNER JOIN permissions_table ON roles_permissions_table.PermissionID = permissions_table.PermissionID
                                    WHERE
                                    user_table.UserID = :UserID');
        
        $this->dbaccessRead->bind(':UserID', $UserID);
        
        $UserPermissionsRow = $this->dbaccessRead->getResultSet();
        
        
        foreach ($UserPermissionsRow as $Permission)
        {
            array_push($UserPermissions, $Permission['PermissionName']);
        }
        
        
       
        return $UserPermissions;
        
    }
    
    
    
}
