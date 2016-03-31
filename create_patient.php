<?php
	
	/*
		* Following code will create a new patient row
	*/
	
	// array for JSON response
	$response = array();
	
	//Include db connect class
    require_once __DIR__ . '\db_connect.php';
	
    //Connecting to db
    $db = new DB_CONNECT();
	
	// check for required fields
	if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['date_of_birth']) && isset($_POST['phone_no']) && isset($_POST['email_id']) && isset($_POST['password']) && isset($_POST['doctor_id'])) 
	{
		
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$date_of_birth = $_POST['date_of_birth'];
		$phone_number = $_POST['phone_no'];
		$email_id = $_POST['email_id'];
		$password = $_POST['password'];
		$doctor_id = $_POST['doctor_id'];
		
		//Inserting a new row
		$query = "INSERT INTO patient(first_name, last_name, date_of_birth, phone_no, email_id, password, doctor_id) VALUES('$first_name', '$last_name', '$date_of_birth', '$phone_number', '$email_id', '$password', '$doctor_id')";
		
		
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
			$response["message"] = "Patient successfully created.";
			
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
	else 
	{
		//A required field is missing
		$response["success"] = 0;
		$response["message"] = "The required field(s) is missing";
		
		//Echoing JSON response
		echo json_encode($response);
	}
?>