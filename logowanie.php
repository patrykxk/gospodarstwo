<?php
    session_start();
?>
<!DOCTYPE html>
<html>
  <head>
   <link rel="icon" href="css/img/favicon.png">
  	<TITLE>Twoje gospodarstwo</TITLE>
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

	
	<div class="container">
		<div id="panel" class=".col-xs-6 .col-sm-4">
			<label style="color:red">
			<?php  
				if(isset($_SESSION['loginError'])){
					echo $_SESSION['loginError'];
					unset($_SESSION['loginError']);
				}
			?>
			</label>
			<form NAME = "form1" action="zaloguj.php" method="post">
				<label for="username">Nazwa użytkownika:</label>
				<input type="text" id="username" name="user">
				<label for="password">Hasło:</label>
				<input type="password" id="password" name="pass">
				<div id="lower">
					<input value="Zaloguj" style="margin-top: 10px;margin-bottom: 10px;" type="submit">
				</div>
			</form>
		</div>
	</div>
	
</body>
</html>