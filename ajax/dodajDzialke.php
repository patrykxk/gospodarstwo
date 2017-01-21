<?php
    session_start();
    if( !(isset($_SESSION['logged']))){
        header('Location: index.php');
        exit();
    }
    if(isset($_POST['identyfikator']) && isset($_POST['powierzchnia']) && isset($_POST['uwagi']))
    {
        // include Database connection file 
        include("../connect.php");
		
        // get values 
        $identyfikator = $_POST['identyfikator'];
        $powierzchnia = $_POST['powierzchnia'];
        $uwagi = $_POST['uwagi'];
		$login = $_SESSION['user'];
		
		
		$con = @new mysqli($host, $db_user, $db_password, $db_name);
		
		// Check connection
		if ($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
		}
        $query = "INSERT INTO DzialkaEwidencyjna(identyfikator, powierzchniaDzialki, idUzytkownika, uwagi) VALUES('$identyfikator', '$powierzchnia',
		(SELECT idUzytkownika from Uzytkownik WHERE login='$login'), '$uwagi')";
		
        if (!$result = mysqli_query($con, $query)) {
            exit(mysqli_error($con));
        }
        echo "1 Record Added!";
    }
?>