<?php
session_start();
include_once('includes.php');	
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
</head>
	<header>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<link rel="icon" href="./image/hh.jpg" />
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
		<link href="bootstrap/js/bootstrap.js" rel="stylesheet" type="text/css"/>
		<link href="style.css" rel="stylesheet" type="text/css" media="screen"/>

		<title>Accueil</title>
	</header>
	
	<body>
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
		    
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="accueil.php">GDST</a>
		    </div>
		
		    
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav navbar-right">
		      	<li><a href="accueil.php">Accueil</a></li>
		      	<li><a href="Planifier.php">Planifier</a></li>
		      	<li><a href="modifier.php">Modifier votre profil</a></li>
		        <li><a href="deconnexion.php">Deconnexion</a></li>
		      </ul>
		    </div>
		  </div>
		</nav>
		

		</br></br>
		<div class="container-fluid">
			<h1 class="index-h1">Accueil</h1> 	
	       	<p>Bonjour <?php 
		    	if(!isset($_SESSION['id'])){
			       echo "vous n'êtes pas connecté !";
		    	}else{
			    	echo $_SESSION ['pseudo'];
		       	}
		       	?>	
		    </p>
        </div>




        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</body>
		</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
		<footer>
		<P>© 2020, farid, Inc . </p>
	</footer>
</html>
