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
		<script src="scripts/bootstrap.min.js"></script> 
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

	
	
    <div class="jumbotron">
    
      <div class="container">
        <h1>Twoje gospodarstwo</h1>
        <p>Zarządzaj efektywnie swoimi uprawami.</p>
      </div>
	</div> 
    
    <div class="neighborhood-guides">
        <div class="container">
            <h2>Idealne wsparcie Twojej pracy</h2>
            <p>
			Nasz portal to innowacyjne rozwiązanie dla każdego gospodarstwa, jakiego nie znajdziesz nigdzie indziej. To system, którego celem jest efektywne zarządzanie uprawą, magazynowanymi materiałami, hodowlą, a co za tym idzie również energią i czasem użytkowników. Program został stworzony dla osób, które chcą zwiększać efektywność swojej działalności rolnej w prosty i przyjemny sposób. Przejrzysty wygląd i intuicyjne rozwiązania sprawią, że każdy użytkownik doskonale poradzi sobie z obsługą tego systemu, nawet bez przeszkolenia z zakresu obsługi komputera.
			</p>
        </div>
    </div>
    

  </body>
</html>