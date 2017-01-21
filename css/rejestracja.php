<?php
    session_start();
        if (isset($_POST['email']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;
		
		//Sprawdź poprawność username'a
		$user = $_POST['user'];
		
		//Sprawdzenie długości usera
		if ((strlen($user)<3) || (strlen($user)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_user']="user musi posiadać od 3 do 20 znaków!";
		}
		
		if (ctype_alnum($user)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_user']="user może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		
		// Sprawdź poprawność adresu email
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
       
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
		}
		
		//Sprawdź poprawność hasła
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		
		if ((strlen($password1)<6) || (strlen($password1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 6 do 20 znaków!";
		}
		
		if ($password1!=$password2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Podane hasła nie są identyczne!";
		}	

		$haslo_hash = password_hash($password1, PASSWORD_DEFAULT);
		
		
		
		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_user'] = $user;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_password1'] = $password1;
		$_SESSION['fr_password2'] = $password2;
		if (isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			if ($connection->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//Czy email już istnieje?
				$queryResult = $connection->query("SELECT idUzytkownika FROM Uzytkownik WHERE email='$email'");
				
				if (!$queryResult) throw new Exception($connection->error);
				
				$ile_takich_maili = $queryResult->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
				}		

				//Czy user jest już zarezerwowany?
				$queryResult = $connection->query("SELECT idUzytkownika FROM Uzytkownik WHERE login='$user'");
				
				if (!$queryResult) throw new Exception($connection->error);
				
				$ile_takich_userow = $queryResult->num_rows;
				if($ile_takich_userow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_user']="Istnieje już użytkownik o takim loginie! Wybierz inny.";
				}
				
				if ($wszystko_OK==true)
				{
					//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
					
					if ($connection->query("INSERT INTO `Uzytkownik` (`idUzytkownika`, `imie`, `nazwisko`, `login`, `password`, `email`) VALUES (NULL, NULL, NULL, '$user', '$haslo_hash', '$email')"))
					{
						$_SESSION['udanarejestracja']=true;
						header('Location: witamy.php');
					}
					else
					{
						throw new Exception($connection->error);
					}
					
				}
				
				$connection->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		
	}
	
	
?>

﻿<!DOCTYPE html>
<html>
  <head>
  	<TITLE>Gospodarstwo - zaloz konto</TITLE>
    <link rel="stylesheet" href="css/shift.css" >
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="css/arkusz.css" rel="stylesheet" type="text/css">
    <script src="scripts/jquery.min.js"></script>
	<script src="scripts/bootstrap.min.js"></script> 
	<script src="scripts/clean-blog.min.js"></script>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  
  </head>

  <body>
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.php">Twoje Gospodarstwo</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php">Strona główna</a>
                    </li>
                    <li>
                        <a href="rejestracja.php">Rejestracja</a>
                    </li>
					<li>
						<a href="logowanie.php">Logowanie</a>
					</li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	
	<div id="logowanie" class="jumbotron">
		<div class="container">
		<h1>Twoje gospodarstwo</h1>
		<p>Zarządzaj efektywnie swoimi uprawami.</p>
		</div>
	</div>
	
	<div class="neighborhood-guides">
		<div class="center">
			<div id="panel">
				<form method="post" NAME = "form1">
					
					<label for="username">Wpisz nazwę użytkownika:</label>
					<input type="text" id="username" value="<?php
						if (isset($_SESSION['fr_user']))
						{
							echo $_SESSION['fr_user'];
							unset($_SESSION['fr_user']);
						}
					?>" name="user">
					<label style="color:red">
					<?php
						if (isset($_SESSION['e_user']))
						{
							echo '<div class="error">'.$_SESSION['e_user'].'</div>';
							unset($_SESSION['e_user']);
						}
					?>
					</label>
					
					
					<label for="username">E-mail:</label>
					<input type="text" id="username" value="<?php
						if (isset($_SESSION['fr_email']))
						{
							echo $_SESSION['fr_email'];
							unset($_SESSION['fr_email']);
						}
					?>" name="email">
					<label style="color:red">
					<?php
						if (isset($_SESSION['e_email']))
						{
							echo '<div class="error">'.$_SESSION['e_email'].'</div>';
							unset($_SESSION['e_email']);
						}
					?>
					</label>
					
					<label for="password">Wpisz hasło:</label>
					<input type="password" id="password" value="<?php
						if (isset($_SESSION['fr_password1']))
						{
							echo $_SESSION['fr_password1'];
							unset($_SESSION['fr_password1']);
						}
					?>" name="password1">
					<label style="color:red">
					<?php
						if (isset($_SESSION['e_haslo']))
						{
							echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
							unset($_SESSION['e_haslo']);
						}
					?>
					</label>
					
					<label for="password">Powtórz hasło:</label>
					<input type="password" id="password" value="<?php
						if (isset($_SESSION['fr_password2']))
						{
							echo $_SESSION['fr_password2'];
							unset($_SESSION['fr_password2']);
						}
					?>" name="password2">
					
					
					
					<div id="lower">
						<input value="Zarejestruj" style="margin-top: 10px;margin-bottom: 10px;" type="submit">
					</div>
				</form>
			</div>
		</div>
	</div>
    
  </body>
</html>