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
		$nazwaUprawy = $_POST['nazwaUprawy'];
		$idRosliny = $_POST['idRosliny'];
        $powierzchnia = $_POST['powierzchnia'];
        $dataZasiewu = $_POST['dataZasiewu'];
		$iloscZasiewu = $_POST['iloscZasiewu'];
		$dataZbioru = $_POST['dataZbioru'];
		$iloscZbioru = $_POST['iloscZbioru'];
		$uwagi = $_POST['uwagi'];
	 

		$query = "UPDATE Uprawy SET `idRosliny`='$idRosliny', `powierzchniaUprawy`='$powierzchnia', `dataZasiewu`='$dataZasiewu', `iloscZasiewu`='$iloscZasiewu', `dataZbioru`='$dataZbioru', `iloscZbioru`='$iloscZbioru', uwagi = '$uwagi' WHERE idUprawy = '$id'";
//$query = "UPDATE Uprawy SET `powierzchniaUprawy`='$powierzchnia' WHERE idUprawy = '$id'";


		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}

	}
?>
