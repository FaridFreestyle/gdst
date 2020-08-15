<?php
session_start();
include_once('includes.php');

if(isset($_SESSION['pseudo'])){
	header('Location: accueil.php');
	exit;
}

if(!empty($_POST)){
	extract($_POST);
	$valid = true;
	if($valid){
		
		
	}
}	
?>

<!DOCTYPE html>
<html lang="fr">
	<header>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<title>GDST</title>
		<link rel="icon" href="./image/hh.jpg" />
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
		<link href="bootstrap/js/bootstrap.js" rel="stylesheet" type="text/css"/>
		<link href="style.css" rel="stylesheet" type="text/css" media="screen"/>
		
		
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
		      <a class="navbar-brand" href="#">GDST</a>
		    </div>
		
		    
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="connexion.php">Connexion</a></li>
		      </ul>
		    </div>
		  </div>
		</nav>
		
		<h1 class="index-h1">Gestion De Son Temps</h1>
		</br></br></br>
		<div class="container">
			<img class="displayed" src="./image/im2.png" alt="acceuil" usemap="#shop"/>
		</div>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</body>
			</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
		<footer>
		<P>© 2020, farid, Inc . </p>
	</footer>
</html>