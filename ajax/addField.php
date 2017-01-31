		
<?php
    session_start();
    if( !(isset($_SESSION['logged']))){
        header('Location: index.php');
        exit();
    }
	
    
        // include Database connection file 
        include("../connect.php");
		
        // get values 
        $nazwaUprawy = $_POST['nazwaUprawy'];
		$idRosliny = $_POST['idRosliny'];
        $powierzchnia = $_POST['powierzchnia'];
        $dataZasiewu = $_POST['dataZasiewu'];
		$iloscZasiewu = $_POST['iloscZasiewu'];
		$dataZbioru = $_POST['dataZbioru'];
		$iloscZbioru = $_POST['iloscZbioru'];
		$idDzialki = $_POST['idDzialki'];
		$uwagi = $_POST['uwagi'];

		$con = @new mysqli($host, $db_user, $db_password, $db_name);
		
		// Check connection
		if ($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
		}
       	$query = "INSERT INTO `Uprawy`(`idDzialkiEwidencyjnej`, `idRosliny`, `powierzchniaUprawy`, `dataZasiewu`, `iloscZasiewu`, `dataZbioru`, `iloscZbioru`, `uwagi`) VALUES
		('$idDzialki', '$idRosliny', '$powierzchnia', '$dataZasiewu', '$iloscZasiewu', '$dataZbioru', '$iloscZbioru', '$uwagi')";
		
		
        if (!$result = mysqli_query($con, $query)) {
            exit(mysqli_error($con));
        }
        echo "1 Record Added!";
    
?>