<?php
	
	/*
		* Following code will create a new patient_statistics row
	*/
	
	// array for JSON response
	$response = array();
	
	// check for required fields
	//if (isset($_POST['patient_id']) && isset($_POST['date_of_submission']) && isset($_POST['glucose_level']) && isset($_POST['cholesterol']) && isset($_POST['weight']) && isset($_POST['comments'])) 
	{
		
		/*$patient_id = $_POST['patient_id'];
		$date_of_submission = $_POST['date_of_submission'];
		$glucose_level = $_POST['glucose_level'];
		$cholesterol = $_POST['cholesterol'];
		$weight = $_POST['weight'];
		$comments = $_POST['comments'];*/
		
		
		//Include db connect class
		require_once __DIR__ . '\db_connect.php';
		
		//Connecting to db
		$db = new DB_CONNECT();
		
		//Inserting a new row
		$query = "INSERT INTO patient_statistics(patient_id, date_of_submission, glucose_level, cholesterol, weight, comments) VALUES(1, '2016/11/02 12:8', 255, 255, 255, 'derpa')";
		
		//Check if row was inserted
		try 
		{
			$con = mysqli_connect("localhost","root","","medic");
			$result = mysqli_query($con, $query);
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
		//Check if row was inserted
		if ($result == true) 
		{
			// successfully inserted into database
			$response["success"] = 1;
			$response["message"] = "Entry successfully created.";
			
			//Echoing JSON response
			echo json_encode($response);
		} 
		else
		{
			//Failed to insert row
			$response["success"] = 0;
			$response["message"] = "Oops! There was an error";
			
			//Echoing JSON response
			echo json_encode($response);
		}
	} 
	/*else 
	{
		//A required field is missing
		$response["success"] = 0;
		$response["message"] = "The required field(s) is missing";
		
		//Echoing JSON response
		echo json_encode($response);
	}*/
?>