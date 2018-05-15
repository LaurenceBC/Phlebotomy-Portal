<?php


namespace PhlebotomyPortal;
use PDO;


class DatabaseAccessLayer {
    
    //Holds the PDO database connection object
    static $dbconnection;
    
    //Holds the PDO ojbect
    static $dbObject;
    
    
    //Class constructor trys to establish a connection.
    //Required to be called in classes extending. Hint parent::__construct();
    public function connect()
    {
        try {
            self::$dbconnection = $this->GetConnection();
        } 
        catch (PDOException $pdoException){
            
            $this->error = $pdoException->getMessage();
        }
    }
    
    
    //Database connection details.
    public static $Host = "127.0.0.1";
    public static $DatabaseName = "phlebotomyportal";
    public static $DatabaseUser = "root";
    public static $DatabasePassword = ""; 

    //Returns a PDO connection object.
    public static function getConnection() 
    {

        $this->returnedconnection = null;

        //Try to establish a new connection.
        try {
            $this->returnedconnection = new PDO(
                    "mysql:host=" .  self::$Host .
                    ";dbname=" .     self::$DatabaseName, 
                                     self::$DatabaseUser, 
                                     self::$DatabasePassword);

        //Catch the exception for error output.
        } catch (PDOException $exception) {
            echo "Something went wrong. Reply reads: " . $exception->getMessage();
        }

        return $this->returnedconnection;
    }
  

    //Now the connection is out the way these methods are required 
    //for inserting and retrieving classes
    
    public static function query($query) {
        
        self::$dbObject = self::$dbconnection->prepare($query);
    }

    public static function execute() {
        return self::$dbObject->execute();
        
    }

    //This is the binding method that will help prevent SQL injection.
    //The method takes the value and checks for data type if not stated in type.
    public static function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        self::$dbObject->bindValue($param, $value, $type);
    }


}
