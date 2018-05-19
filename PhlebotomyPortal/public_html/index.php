

<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/lib/authentication/Authentication.php";

require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/lib/database/DatabaseInsert.php";
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/lib/router/Router.php";




session_start();




//if this is a post request to login then process the request and continue the login check.

if (isset($_POST['login'])) {
    $_SESSION['LOGGEDIN'] = \PhlebotomyPortal\Authentication::checkCredentials($_POST['username'], $_POST['password']);
}
if (!\PhlebotomyPortal\Authentication::isLoggedIN()) {
    ?>

    <html>
        <head>
            <meta charset="UTF-8">
            <title>Login</title>
            <link rel="stylesheet" href="/public_html/css/main.css">
        </head>
        <body>

            <div id="LoginContainer">

                <form action="" method="post">
                    <input type="hidden" name="login"> 
                    <label>User Name :</label> <input type='text' name='username' value="username" class="textbox" >
                    <label>Password :</label> <input placeholder="**********" type="password" name='password' value="password" class="textbox">
    <?php
    if (isset($_POST['login'])) {
        echo 'Wrong Username or password';
    }
    ?>

                    <input type="submit"  value="login" class="button"/>
                </form>
            </div>

        </body>
    <?php
    //Redirect ?action=login
} else {

    //Retrieve user information
    $UserData = PhlebotomyPortal\Authentication::getUserData($_SESSION['UserID']);
    //Builds route
    //Build route. Which builds the contents
    $Route = new PhlebotomyPortal\Router();
    ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <title><?php echo $Route->getTitle() ?></title>
                <link rel="stylesheet" href="/public_html/css/main.css">
            </head>
            <body>

                <header>

                    <nav>
                        
                        
                        <ul>
                          <li><a href="home">Home</a></li>
                          <li><a href="portal">Portal</a></li>
                          <li><a href="patients">Patients</a></li>
                          
                            <li><a href="patients">Admin</a></li>
                       
                        </ul>
                        
                        <div id="UserPortalNavPanel">
                            <ul>
                                <img src="./img/icons/icon_calendar.png" width="50" height="50" alt="icon_logout"/>

                                <img src="./img/icons/icon_user.png" width="50" height="50" alt="icon_logout"/>

                                <img src="img/icons/icon_logout.png" width="50" height="50" alt="icon_logout"/>

                            </ul>
                                                 
                        </div>
                        
                    </nav>
                    

                </header>

                <div id="PageContents">

    <?php $Route->ClassObject->executeAction(); ?>

                </div>



            </body>
        </html>



<?php } ?>
