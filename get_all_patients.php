<?php
	
	/*
	* Following code will list all the patients
	*/
	
	// array for JSON response
	$response = array();
	
	// include db connect class
	require_once __DIR__ . '\db_connect.php';
	
	// connecting to db
	$db = new DB_CONNECT();
	
	// get all patient from patient table
	$result = mysql_query("SELECT * FROM patient") or die(mysql_error());
	
	// check for empty result
	if (mysql_num_rows($result) > 0) 
	{
		// looping through all results
		// patients node
		$response["patients"] = array();
		
		while ($row = mysql_fetch_array($result)) {
			//Temp user array
			$patient = array();
            $patient["patient_id"] = $result["patient_id"];
            $patient["first_name"] = $result["first_name"];
			$patient["last_name"] = $result["last_name"];
            $patient["date_of_birth"] = $result["date_of_birth"];
            $patient["phone_number"] = $result["phone_number"];
            $patient["email_id"] = $result["email_id"];
            $patient["password"] = $result["password"];
			$patient["doctor_id"] = $result["doctor_id"];
			
			// push single patient into final response array
			array_push($response["patient"], $patient);
		}
		// success
		$response["success"] = 1;
		
		// echoing JSON response
		echo json_encode($response);
		} else {
		// no patient found
		$response["success"] = 0;
		$response["message"] = "No patients found";
	
    // echo no users JSON
    echo json_encode($response);
	}
	?>		