<?php


namespace PhlebotomyPortal;

require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/../framework/views/View.php";


class adminView extends View{
  
    public function mainpage()
    {
       
        ?>
        
        <h1>Admin</h1>
        <a href="?action=adduser">Add user</a>
        <br>
        <a href="?action=searchusers">Search users</a>
        <br>
        <a href="?action=editroles">Edit Roles</a>
      


        <?php 
        
        
        
        
    }
    
}
