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
    $patient_id = $_GET['patient_id'];
 
	// get all statistics from patient_statistics table
	$query = "SELECT * FROM patient_statistics WHERE patient_id = $patient_id";
	
	try 
	{
		$con = mysqli_connect("localhost","root","","medic");
		$result = mysqli_query($con, $query);
		//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		//$patient_id = $row["patient_id"];
		mysqli_close($con);
	}
	catch (mysqli_sql_exception $ex) 
	{
		//die("Failed to run query: " . $ex->getMessage());
		
		$response["success"] = 0;
		$response["message"] = "Database Error. Please Try Again!";
		
		echo json_encode($response);
		//die(json_encode($response));
		
	}
	
	
	// check for empty result
	if (mysqli_num_rows($result) > 0) 
	{
		// looping through all results
		// patients node
		$response["patient_statistics"] = array();
		
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
		{
			//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			//Temp user array
			$statistics = array();
            $statistics["statistics_id"] = $row["statistics_id"];
            $statistics["patient_id"] = $row["patient_id"];
			$statistics["date_of_submission"] = $row["date_of_submission"];
            $statistics["glucose_level"] = $row["glucose_level"];
            $statistics["cholesterol"] = $row["cholesterol"];
            $statistics["weight"] = $row["weight"];
            $statistics["comments"] = $row["comments"];
			
			// push single patient into final response array
			array_push($response["patient_statistics"], $statistics);
		}
		// success
		$response["success"] = 1;
		
		// echoing JSON response
		echo json_encode($response);
	} 
	else {
		// no patient found
		$response["success"] = 0;
		$response["message"] = "No statistics found";
		
		// echo no users JSON
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