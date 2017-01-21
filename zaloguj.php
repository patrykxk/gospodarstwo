<?php>
    session_start();
    
    require_once "connect.php";
    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($connection->connect_errno!=0)
    {
		echo "Error: ".$connection->connect_errno;
	}else{
        $login = $_POST['user'];
        $password = $_POST['pass'];
        
        $sql = sprintf("SELECT * FROM Uzytkownik WHERE login='%s'",
			mysqli_real_escape_string($connection,$login));
        
        if ($query_result = @$connection->query($sql)){
            $numberOfUsers = $query_result->num_rows;
            
            if($numberOfUsers>0){
                $row = $query_result->fetch_assoc();
                
                
                if(password_verify($password, $row['password'])){
                    $_SESSION['logged'] = true; 
                    $_SESSION['id'] = $row['idUzytkownika'];
                    $_SESSION['user'] = $row['login'];
                    header('Location: in.php');
                    unset($_SESSION['loginError']);
                    $query_result->free();
                }else{
                    $_SESSION['loginError'] = "Niepoprawny login lub hasło!";
                    header('Location: logowanie.php');
                }
                
            }else{
                
                $_SESSION['loginError'] = "Niepoprawny login lub hasło!";
                header('Location: logowanie.php');
            }
            
        }
        
        
        
        $connection->close();
	}

?>