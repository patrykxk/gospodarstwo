<?php
	// include Database connection file
	include("../connect.php");
	$con = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
	}
	// check request
	if(isset($_POST['id']) && isset($_POST['id']) != "")
	{
		// get User ID
		$id = $_POST['id'];
	 
		// Get User Details
		$query = "SELECT * FROM Uprawy WHERE idUprawy = '$id'";
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
		$response = array();
		if(mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$response = $row;
			}
		}
		else
		{
			$response['status'] = 200;
			$response['message'] = "Data not found!";
		}
		// display JSON data
		echo json_encode($response);
	}
	else
	{
		$response['status'] = 200;
		$response['message'] = "Invalid Request!";
	}
?>