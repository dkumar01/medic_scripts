<?php
 
/*
 * Following code will get single patient's statistics
 * A patient is identified by patient id (pid)
 */
 
// array for JSON response
$response = array();
 
//Include db connect class
require_once __DIR__ . '\db_connect.php';
 
//Connecting to db
$db = new DB_CONNECT();
 
//Check for post data
if (isset($_GET["patient_id"])) 
{
    $pid = $_GET['patient_id'];
 
    //Get a patient from patients table
    $result = mysql_query("SELECT * FROM patient_statistics WHERE patient_id = $patient_id");
 
    if (!empty($result))
	{
        //Check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $patient_statistics = array();
            $patient_statistics["statistics_id"] = $result["statistics_id"];
            $patient_statistics["patient_id"] = $result["patient_id"];
			$patient_statistics["date_of_submission"] = $result["date_of_submission"];
            $patient_statistics["glucose_level"] = $result["glucose_level"];
            $patient_statistics["weight"] = $result["weight"];
            $patient_statistics["cholesterol"] = $result["cholesterol"];
            $patient_statistics["comments"] = $result["comments"];
			
			//Success
            $response["success"] = 1;
 
            //User node
            $response["patient_statistics"] = array();
 
            array_push($response["patient_statistics"], $patient_statistics);
 
            //Echoing JSON response
            echo json_encode($response);
        } 
		else 
		{
            //No statistics found
            $response["success"] = 0;
            $response["message"] = "No statistics found";
 
            //Echo no users JSON
            echo json_encode($response);
        }
    } 
	else
	{
        //No statistics found
        $response["success"] = 0;
        $response["message"] = "No statistics found";
 
        //Echo no users JSON
        echo json_encode($response);
    }
} 
else 
{
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>