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
		<TITLE>Gospodarstwo</TITLE>
		<link rel="stylesheet" href="css/shift.css" >
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/main.css">
	  <style type="text/css">

	  </style>
		<script src="scripts/jquery.min.js"></script>
		<script src="scripts/jquery.js"></script>
		<script src="scripts/bootstrap.min.js"></script> 
		<script src="scripts/clean-blog.min.js"></script>
		<script src="script/script.js"></script>
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
				
				<div class=container>
					<h2>Twoje działki</h1>
					<div class="pull-right">
					<button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal" style="margin: 0px 5px 5px;">Dodaj nową działkę</button>
					</div>
				</div>
				
				<div class="table-responsive" id="table">
					
				  <table id="mytable" class="table table-hover table-responsive ">
					<thead >
						<tr>
							<th>#</th>
							<th>Identyfikator</th>
							<th>Powierzchnia [ha]</th>
							<th>Uwagi</th>
							<th>Edytuj</th>
							<th>Usuń</th>
							<th>Przejdź do upraw</th>
						</tr>
					</thead>
					<tbody>
						<?php
							require_once "connect.php";
							$connection = @new mysqli($host, $db_user, $db_password, $db_name);
							$connection->set_charset("utf8");
							if ($connection->connect_error) {
								die("Connection failed: " . $connection->connect_error);
							}
							
							$sql = 'SELECT id, Identyfikator, powierzchniaDzialki, Uwagi FROM DzialkaEwidencyjna WHERE idUzytkownika =
							(SELECT idUzytkownika from Uzytkownik WHERE login ="'.$_SESSION['user'].'")';
							$result = $connection->query($sql);
							if ($result->num_rows > 0) {
								$i = 1;
								while($row = $result->fetch_assoc()) {
									echo "<tr><td>".$i ."</td><td>".$row['Identyfikator']."</td><td>".$row['powierzchniaDzialki']."</td><td>".$row['Uwagi']."</td>";
									echo '<td>
											
										   <a onclick="GetParcelDetails('.$row['id'].')""title="Edytuj" class="open-Dialog btn btn-primary btn-xs" >
										   
											<span class="glyphicon glyphicon-pencil"></span>
										   </a>
										  </td>
										<td>
											<p data-placement="top" data-toggle="tooltip" title="Usuń">
												<button onclick="DeleteRow('.$row['id'].')" class="btn btn-danger btn-xs"  data-title="Delete" >
													<span class="glyphicon glyphicon-trash"></span>
												</button>
											</p>
										</td>
										
										<td>
											<a href=uprawy.php?id='.$row['id'].'&identyfikator='.$row['Identyfikator'].' title="Uprawy" class="btn btn-success btn-xs" href="#edit"><span class="glyphicon glyphicon-chevron-right"></span></a>
											
										</td>
										
										</tr>';
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
		
		
		<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
						<h4 class="modal-title custom_align" id="Heading">Dodawanie nowej działki</h4>
					</div>
					<div class="modal-body">
						 <div class="form-group">
							<label for="identyfikator">Identyfikator</label>
							<input type="text" id="identyfikator" class="form-control " type="text" placeholder="Identyfikator">
						</div>
						<div class="form-group">
						<label for="powierzchnia">Powierzchnia</label>
							<input type="text" id="powierzchnia" class="form-control " type="text" placeholder="Powierzchnia">
						</div>
						<div class="form-group">
						<label for="uwagi">Uwagi</label>
							<input type="text" id="uwagi" type="uwagi" class="form-control" placeholder="Uwagi">
						</div>
							
					</div>

				  <div class="modal-footer ">
					<button type="button" onclick="addRecord()" class="btn btn-warning btn-lg" style="width: 100%;" ><span class="glyphicon glyphicon-ok-sign"></span>Dodaj</button>
				  </div>
				</div>
			<!-- /.modal-content --> 
			</div>
			  <!-- /.modal-dialog --> 
		</div>
		
		<div class="modal fade" id="update_parcel_modal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
						<h4 class="modal-title custom_align" id="Heading">Edytowanie wiersza</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="update_identyfikator">Identyfikator</label>
							<input class="form-control " id="update_identyfikator" type="text" placeholder="Identyfikator">
						</div>
						<div class="form-group">
							<label for="update_powierzchnia">Powierzchnia</label>
							<input class="form-control" id="update_powierzchnia" type="text" placeholder="Powierzchnia">
						</div>
						<div class="form-group">
							<label for="update_uwagi">Uwagi</label>
							<input class="form-control" id="update_uwagi" type="text" placeholder="Powierzchnia">
						</div>
							
					</div>


				  <div class="modal-footer ">
					<button type="button" onclick="UpdateParcelDetails()" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Zaktualizuj</button>
					<input type="hidden" id="hidden_parcel_id">
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
