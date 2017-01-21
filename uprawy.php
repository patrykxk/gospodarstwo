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
	
	<script>
		$(document).on("click", ".open-Dialog", function () {
			 var myId = $(this).data('id');
			 $(".modal-body #dzialkaId").val( myId );
		});

	</script>
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
                    <li>
                        <a href="#">Nawozy</a>
                    </li>
                    <li>
                        <a href="#">Opryski</a>
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
	

	<div id="dzialki" class="jumbotron">
		<div class="container">

		</div>
	</div>
	
    
        <div class="container" style="margin-top: 50px">	
			<div class="card" style="background-color:#fff">
				
				<h2>Uprawy na działce o numerze: <?php echo $_GET["identyfikator"] ?></h1>
				
				<div class="table-responsive">
				  <table id="mytable" class="table table-hover table-responsive ">
					<thead >
						<tr>
							<th>#</th>
							<th>Nazwa</th>
							<th>Nazwa rośliny</th>
							<th>Powierzchnia</th>
							<th>dataZasiewu</th>
							<th>Ilość zasiewu[t]</th>
							<th>dataZabioru</th>
							<th>Ilość zbioru[t]</th>
							<th>Edytuj</th>
							<th>Usuń</th>
						</tr>
					</thead>
					<tbody>
						<?php
							require_once "connect.php";
							$connection = @new mysqli($host, $db_user, $db_password, $db_name);

							if ($connection->connect_error) {
								die("Connection failed: " . $connection->connect_error);
							}
							
							$sql = 'SELECT * FROM Uprawy WHERE idDzialkiEwidencyjnej='.$_GET["id"];
							$result = $connection->query($sql);
							if ($result->num_rows > 0) {
								$i = 1;
								while($row = $result->fetch_assoc()) {
									$sql2 = 'SELECT nazwaRosliny from Rosliny WHERE id='.$row['idRosliny'].' limit 1';
									$result2 = $connection->query($sql2);
									$value = $result2->fetch_row();
									
									echo "<tr><td>".$i ."</td><td>".$row['nazwa']."</td><td>".$value[0]."</td><td>".$row['powierzchniaUprawy']."</td>";
									echo "<td>".$row['dataZasiewu']."</td><td>".$row['iloscZasiewu[t]']."</td><td>".$row['dataZbioru']."</td><td>".$row['iloscZbioru[t]']."</td>";
									echo '<td>
										   <a data-toggle="modal" data-id=" '.$row['id']. '" title="Edytuj" class="open-Dialog btn btn-primary btn-xs" href="#edit"><span class="glyphicon glyphicon-pencil"></span></a>
										   
										  </td>
										<td>
										
										<p data-placement="top" data-toggle="tooltip" title="Usuń"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p>
										</a></td></tr>';
									$i = $i +1;
								}
							}
							$connection->close();
							
								
                    	?>
                    </tbody>
					</table>
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
						<h4 class="modal-title custom_align" id="Heading">Edytowanie wiersza</h4>
					</div>
					<div class="modal-body">
						
						 <div class="form-group">
							<input class="form-control " type="text" placeholder="Identyfikator">
						</div>
						<div class="form-group">
							<input class="form-control " type="text" placeholder="Powierzchnia">
						</div>
						<div class="form-group">
							<textarea rows="2" class="form-control" placeholder="Uwagi"></textarea>
						</div>
						<div class="form-group">
							
							<input class="form-control" type="text" name="dzialkaId" id="dzialkaId"/>
						</div>
							
					</div>


				  <div class="modal-footer ">
					<button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Zaktualizuj</button>
				  </div>
				</div>
			<!-- /.modal-content --> 
			</div>
			  <!-- /.modal-dialog --> 
		</div>
		
		
		
		<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
				  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				<h4 class="modal-title custom_align" id="Heading">Usuwanie wiersza</h4>
			  </div>
				  <div class="modal-body">
			   
			   <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span>Czy na pewno chcesz usunąć ten wiersz?</div>
			   
			  </div>
				<div class="modal-footer ">
				<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Tak</button>
				<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Nie</button>
			  </div>
				</div>
			<!-- /.modal-content --> 
		  </div>
			  <!-- /.modal-dialog --> 
		</div>
    

  </body>
</html>
