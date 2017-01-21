<?php
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    include("../connect.php");
	$con = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
	}
    // get user id
    $id = $_POST['id'];
 
    
    $query = "DELETE FROM DzialkaEwidencyjna WHERE id = '$id'";
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
}
?>