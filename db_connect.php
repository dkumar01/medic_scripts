<?php
 
/**
 * A class file to connect to database
 */
class DB_CONNECT {
	
	/*$DB_SERVER = "localhost"; 
	$DB_USER = "root";
	$DB_PASSWORD = "";
	$DB_DATABASE = "medic";*/
	
	
    // constructor
    function __construct() {
        // connecting to database
        $this->connect();
    }
 
    // destructor
    function __destruct() {
        // closing db connection
        $this->close();
    }
 
    /**
     * Function to connect with database
     */
    function connect() {
        // import database connection variables
        require_once __DIR__ . '\db_config.php';
 
        // Connecting to mysql database
        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysqli_error());
		
        // Selecing database
        $db = mysqli_select_db($con, DB_DATABASE) or die(mysqli_error()) or die(mysqli_error());
 
        // returing connection cursor
        return $con;
    }
 
    /**
     * Function to close db connection
     */
    function close() {
        // closing db connection
        mysqli_close(mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD));
    }
 
}
 
?>