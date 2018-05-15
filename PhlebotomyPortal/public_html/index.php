  

<?php 
        
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/lib/authentication/Authentication.php";
        
          
        
        
          if(\PhlebotomyPortal\Authentication::checkCredentials("testuser", "lopplop"))
          {
              echo 'working';
          } else {echo 'not working'; }
          
          
          ?>
          
          
      