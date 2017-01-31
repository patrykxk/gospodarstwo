<?php
    session_start();
    if( !(isset($_SESSION['logged']))){
        header('Location: index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html>

  <head>
   <link rel="icon" href="css/img/favicon.png">
  <meta charset="utf-8">
  	<TITLE>Gospodarswo</TITLE>
    <link rel="stylesheet" href="css/shift.css" >
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
  <style type="text/css">

  </style>
    <script src="scripts/jquery.min.js"></script>
	<script src="scripts/jquery.js"></script>
	<script src="scripts/bootstrap.min.js"></script> 
    <script src="scripts/clean-blog.min.js"></script>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	
  </head>

  <body style="background-color:#fafafa">
 
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
                        <a href="dzialki.php">Działki</a>
                    </li>				
                    <li>
                        <a href="Rosliny.php">Rośliny</a>
                    </li>
					<li><a></a></li>
					<li>
						<a><?php echo "Witaj ".$_SESSION['user']."!"; ?></a>
					</li>
					<li>
						<a href="wyloguj.php">Wyloguj</a>
					</li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	<!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->

	<div id="dzialki" class="jumbotron">
		<div class="container">

		</div>
	</div>
	
    
        <div class="container" style="margin-top: 50px">	
			<div class="card" style="background-color:#fff">
				
				<h2>Rosliny</h1>
				
				<div class="table-responsive">
				  <table class="table table-hover table-responsive ">
					<thead class="thead-inverse">
						<tr>
							<th>#</th>
							<th>Nazwa rośliny</th>
							<th>Typ</th>
							<th>Podtyp</th>
						</tr>
					</thead>
					<tbody>
						<?php
							require_once "connect.php";
							$connection = @new mysqli($host, $db_user, $db_password, $db_name);

							if ($connection->connect_error) {
								die("Connection failed: " . $connection->connect_error);
							}
							$connection->set_charset("utf8");
							$sql = 'SELECT nazwaRosliny, typ, podtyp FROM Rosliny';
							$result = $connection->query($sql);
							if ($result->num_rows > 0) {
								$i = 1;
								while($row = $result->fetch_assoc()) {
									echo "<tr><td>".$i ."</td><td>".$row['nazwaRosliny']."</td><td>".$row['typ']."</td><td>".$row['podtyp']."</td></tr>";
									$i = $i +1;
								}
							} else {
								echo "0 results";
							}
							$connection->close();
							
								
                    	?>
                    </tbody>
					</table>
				</div>
			</div>
		</div>
   
    

  </body>
</html>
