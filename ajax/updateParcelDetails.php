<?php
	// include Database connection file
	include("../connect.php");
	$con = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
	}
	// check request
	if(isset($_POST))
	{
		// get values
		$id = $_POST['id'];
		$identyfikator = $_POST['identyfikator'];
        $powierzchnia = $_POST['powierzchnia'];
        $uwagi = $_POST['uwagi'];
	 

		$query = "UPDATE DzialkaEwidencyjna SET identyfikator = '$identyfikator', powierzchniaDzialki = '$powierzchnia', uwagi = '$uwagi' WHERE id = '$id'";
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}

	}
?>
