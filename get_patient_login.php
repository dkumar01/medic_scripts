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
	if (isset($_POST["email_id"]) && isset($_POST["password"])) 
	{
		$email_id = $_POST['email_id'];
		$password = $_POST['password'];
		
		//Get a patient from patients table
		//$result = mysql_query("SELECT TOP 1 patient.email_id, patient.password FROM patient WHERE patient.email_id = $email_id and patient.password = $password");
		
		
		$query = "SELECT email_id, password FROM patient WHERE email_id = '$email_id' and password = '$password'";
		
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
		
		if(mysqli_num_rows($result) > 0)
		{
			$response["success"] = 1;
			$response["message"] = "Login successful!";
			//echo("login successful");
			echo json_encode($response);
			//die(json_encode($response));
		} 
		else 
		{
			$response["success"] = 0;
			$response["message"] = "Invalid Credentials!";
			echo("invalid");
			echo json_encode($response);
			//die(json_encode($response));
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
