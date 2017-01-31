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
	<script src="script/script.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>
		
    <script src="scripts/clean-blog.min.js"></script>
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script>
		$(document).on("click", ".open-Dialog", function () {
			 var myId = $(this).data('id');
			 $(".modal-body #dzialkaId").val( myId );
		});
		$(document).ready(function () {
			$('#dataZasiewu').datepicker({
				format: "yyyy-mm-dd",
				language: "pl",
				todayHighlight: true
			});

		});
		$(document).ready(function () {
			$('#dataZbioru').datepicker({
				format: "yyyy-mm-dd",
				language: "pl",
				todayHighlight: true
			});
		});
		$(document).ready(function () {
			$('#update_dataZasiewu').datepicker({
				format: "yyyy-mm-dd",
				language: "pl",
				todayHighlight: true
			});

		});
		$(document).ready(function () {
			$('#update_dataZbioru').datepicker({
				format: "yyyy-mm-dd",
				language: "pl",
				todayHighlight: true
			});
		});
		
		$(function() {
		  $('#selectpicker').on('change', function(){
			var selected = $(this).find("option:selected").val();
			$("#idRosliny").val(selected);
		  }); 
		});
		$(function() {
		  $('#selectpicker_update').on('change', function(){
			var selected = $(this).find("option:selected").val();
			$("#update_idRosliny").val(selected);
		  }); 
		});
		
		
     //$("idRosliny").val(fields.idRosliny);
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
					<h2>Uprawy na działce o numerze: <?php echo $_GET["identyfikator"] ?></h2>
					<div class="pull-right">
					<button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal" style="margin: 0px 5px 5px;">Dodaj nową uprawę</button>
					</div>
				</div>
				<div class="table-responsive" id="table2">
				  <table id="mytable" class="table table-hover table-responsive ">
					<thead >
						<tr>
							<th>#</th>
							<th>Nazwa rośliny</th>
							<th>Powierzchnia</th>
							<th>dataZasiewu</th>
							<th>Ilość zasiewu[t]</th>
							<th>dataZabioru</th>
							<th>Ilość zbioru[t]</th>
							<th>Uwagi</th>
							<th>Edytuj</th>
							<th>Usuń</th>
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
							
							$sql = 'SELECT * FROM Uprawy WHERE idDzialkiEwidencyjnej='.$_GET["id"];
							$result = $connection->query($sql);
							if ($result->num_rows > 0) {
								$i = 1;
								while($row = $result->fetch_assoc()) {
									$sql2 = 'SELECT nazwaRosliny from Rosliny WHERE id='.$row['idRosliny'].' limit 1';
									$result2 = $connection->query($sql2);
									$value = $result2->fetch_row();
									
									echo "<tr><td>".$i ."</td><td>".$value[0]."</td><td>".$row['powierzchniaUprawy']."</td>";
									echo "<td>".$row['dataZasiewu']."</td><td>".$row['iloscZasiewu']."</td><td>".$row['dataZbioru']."</td><td>".$row['iloscZbioru']."</td><td>".$row['uwagi']."</td>";
									echo'<td>
											<a onclick="getFieldDetails('.$row['idUprawy'].')" title="Edytuj" class="open-Dialog btn btn-primary btn-xs" >
												<span class="glyphicon glyphicon-pencil"></span>
											</a>
										</td>
										<td>
											<p data-placement="top" data-toggle="tooltip" title="Usuń">
												<button onclick="removeField('.$row['idUprawy'].')" class="btn btn-danger btn-xs"  data-title="Delete" >
													<span class="glyphicon glyphicon-trash"></span>
												</button>
											</p>
										</td></tr>';
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
						<h4 class="modal-title custom_align" id="Heading">Dodawanie nowej uprawy</h4>
					</div>
					
					<div class="modal-body">
						<div class="form-group">
							<label for="idRosliny">Roslina</label>
							<select class="form-control selectpicker" id="selectpicker" data-live-search="true">
								<?php
									require_once "connect.php";
									$connection = @new mysqli($host, $db_user, $db_password, $db_name);
									$connection->set_charset("utf8");
									if ($connection->connect_error) {
										die("Connection failed: " . $connection->connect_error);
									}
									
									$sql = 'SELECT * FROM Rosliny';
									$result = $connection->query($sql);
									if ($result->num_rows > 0) {
										
										while($row = $result->fetch_assoc()) {
											echo "<option value=".$row['id']. ">".$row['nazwaRosliny']. "</option>";
													
										}
									}
									$connection->close();
								?>
							</select>
							<input type="hidden" id="idRosliny" type="text">
							
						</div>
						<div class="form-group">
							<label for="powierzchnia">Powierzchnia</label>
							<input type="text" id="powierzchnia" class="form-control " type="text" placeholder="Powierzchnia">
						</div>
						<div class="form-group">
							<label for="dataZasiewu">Data Zasiewu</label>
							<i class="fa fa-calendar"></i>
							<input type="text" id="dataZasiewu" class="form-control" placeholder="dd/mm/rrrr" />
						</div>
						<div class="form-group">
							<label for="ilosc zasiewu">Ilość zasiewu [t]</label>
							<input type="text" id="iloscZasiewu" class="form-control " type="text" placeholder="Ilość zasiewu[t]">
						</div>
						<div class="form-group">
							<label for="DataZbioru">Data zbioru[t]</label>
							<i class="fa fa-calendar"></i>
							<input class="form-control" id="dataZbioru" name="date" placeholder="dd/mm/rrrr" type="text"/>
						</div>
						<div class="form-group">
							<label for="ilosc zasiewu">Ilość zbioru[t]</label>
							<input type="text" id="iloscZbioru" class="form-control " type="text" placeholder="Ilość zbioru[t]">
						</div>
						<div class="form-group">
							<label for="uwagi">Uwagi</label>
							<input type="text" id="uwagi" type="uwagi" class="form-control" placeholder="Uwagi">
						</div>
					</div>

				  <div class="modal-footer ">
					<button type="button" onclick="addField(<?php echo $_GET["id"]?>)" class="btn btn-warning btn-lg" style="width: 100%;" ><span class="glyphicon glyphicon-ok-sign"></span>Dodaj</button>
				  </div>
				</div>
			<!-- /.modal-content --> 
			</div>
			  <!-- /.modal-dialog --> 
		</div>
		
		
		<div class="modal fade" id="update_field_modal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
						<h4 class="modal-title custom_align" id="Heading">Edytowanie wiersza</h4>
					</div>
					
					<div class="modal-body">
						<div class="form-group">
							<label for="update_idRosliny">Roslina</label>
							<select class="form-control selectpicker" id="selectpicker_update" data-live-search="true">
								<?php
									require_once "connect.php";
									$connection = @new mysqli($host, $db_user, $db_password, $db_name);
									$connection->set_charset("utf8");
									if ($connection->connect_error) {
										die("Connection failed: " . $connection->connect_error);
									}
									
									$sql = 'SELECT * FROM Rosliny';
									$result = $connection->query($sql);
									if ($result->num_rows > 0) {
										
										while($row = $result->fetch_assoc()) {
											echo "<option value=".$row['id']. ">".$row['nazwaRosliny']. "</option>";
													
										}
									}
									$connection->close();
								?>
							</select>
							<input type="hidden" id="update_idRosliny" class="form-control " type="text" placeholder="Id Rosliny">
						</div>
						<div class="form-group">
							<label for="update_powierzchnia">Powierzchnia</label>
							<input type="text" id="update_powierzchnia" class="form-control " type="text" placeholder="Powierzchnia">
						</div>
						<div class="form-group">
							<label for="update_dataZasiewu">Data Zasiewu</label>
							<i class="fa fa-calendar"></i>
							<input type="text" id="update_dataZasiewu" class="form-control" placeholder="dd/mm/rrrr" />
						</div>
						<div class="form-group">
							<label for="update_iloscZasiewu">Ilość zasiewu [t]</label>
							<input type="text" id="update_iloscZasiewu" class="form-control " type="text" placeholder="Ilość zasiewu[t]">
						</div>
						<div class="form-group">
							<label for="update_dataZbioru">Data zbioru[t]</label>
							<i class="fa fa-calendar"></i>
							<input class="form-control" id="update_dataZbioru" name="date" placeholder="dd/mm/rrrr" type="text"/>
						</div>
						<div class="form-group">
							<label for="update_iloscZasiewu">Ilość zbioru[t]</label>
							<input type="text" id="update_iloscZbioru" class="form-control " type="text" placeholder="Ilość zbioru[t]">
						</div>
						<div class="form-group">
							<label for="update_uwagi">Uwagi</label>
							<input type="text" id="update_uwagi" type="uwagi" class="form-control" placeholder="Uwagi">
						</div>
					</div>

				  <div class="modal-footer ">
					<button type="button" onclick="updateFieldDetails()" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Zaktualizuj</button>
					<input type="hidden" id="hidden_field_id">
				  </div>
				</div>
			<!-- /.modal-content --> 
			</div>
			  <!-- /.modal-dialog --> 
		</div>
		
		

  </body>
</html>
