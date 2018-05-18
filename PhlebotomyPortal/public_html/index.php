

<?php 
        
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/lib/authentication/Authentication.php";
        
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/lib/database/DatabaseInsert.php";
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/lib/router/Router.php";


   

session_start();




//if this is a post request to login then process the request and continue the login check.
    
if(isset($_POST['login'])) {
   $_SESSION['LOGGEDIN'] = \PhlebotomyPortal\Authentication::checkCredentials($_POST['username'], $_POST['password']);
   
} 
if (!\PhlebotomyPortal\Authentication::isLoggedIN()) {
    ?>
                     <div id='loginbox'>

                    <form action="" method="post">
                        <input type="hidden" name="login"> 
                        <label>User Name :</label> <input type='text' name='username' value="username">
                        <label>Password :</label> <input placeholder="**********" type="password" name='password' value="password">


                        <input type="submit"  value="login" />
                    </form>

                        <?php
                if(isset($_POST['login']))
                {
                    echo 'Wrong Username or password';
                }

    //Redirect ?action=login
    
   
} else {
    
    //Retrieve user information
    
    
    //Builds route
    
    //Build route. Which builds the contents
    $Route = new PhlebotomyPortal\Router();
    
  
    ?>
    <html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $Route->getTitle()  ?></title>
    </head>
    <body>
        
        <header>
            
            <menu>
                
                
            </menu>
            
        </header>
  
        <div id="PageContents">
            
            <?php  $Route->ClassObject->executeAction(); ?>
            
        </div>
        
        
        
    </body>
    </html>



<?php } ?>
