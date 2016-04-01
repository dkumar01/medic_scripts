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
	$query = "SELECT * FROM patient_statistics WHERE patient_id = 1";
	
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
		$response["patients_statistics"] = array();
		
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
			array_push($response["patients_statistics"], $statistics);
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
?>		