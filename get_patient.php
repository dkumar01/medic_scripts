<?php	
 
/*
 * Following code will get a single patient details
 * A patient is identified by patient id (pid)
 */
 
// array for JSON response
$response = array();
 
//Include db connect class
require_once __DIR__ . '\db_connect.php';
 
//Connecting to db
$db = new DB_CONNECT();
 
//Check for post data
//if (isset($_GET["patient_id"])) 
//{
  //  $pid = $_GET['patient_id'];
 
    //Get a patient from patients table
    $result = mysql_query("SELECT * FROM patient WHERE patient_id = $patient_id");
 
    if (!empty($result))
	{
        //Check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $patient = array();
            $patient["patient_id"] = $result["patient_id"];
            $patient["first_name"] = $result["first_name"];
			$patient["last_name"] = $result["last_name"];
            $patient["date_of_birth"] = $result["date_of_birth"];
            $patient["phone_number"] = $result["phone_number"];
            $patient["email_id"] = $result["email_id"];
            $patient["password"] = $result["password"];
			$patient["doctor_id"] = $result["doctor_id"];
            
			//Success
            $response["success"] = 1;
 
            //User node
            $response["patient"] = array();
 
            array_push($response["patient"], $patient);
 
            //Echoing JSON response
            echo json_encode($response);
        } 
		else 
		{
            //No patient found
            $response["success"] = 0;
            $response["message"] = "No patient found";
 
            //Echo no users JSON
            echo json_encode($response);
        }
    } 
	else
	{
        // no patient found
        $response["success"] = 0;
        $response["message"] = "No patient found";
 
        // echo no users JSON
        echo json_encode($response);
    }
//} 
/*else 
{
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}*/
?>