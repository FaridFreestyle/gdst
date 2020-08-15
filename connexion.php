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
	
	$Mail = htmlspecialchars(trim($Mail));
	$Password = trim($Password);
		
	if(empty($Mail)){
		$valid = false;
		$_SESSION['flash']['warning'] = "Veuillez renseigner votre mail !";
	}
	
	if(empty($Password)){
		$valid = false;
		$error_password = "Veuillez renseigner un mot de passe !";
	}
	
	
	$req = $DB->query('Select * from user where mail = :mail and password = :password', array('mail' => $Mail, 'password' => crypt($Password, '$2a$10$1qAz2wSx3eDc4rFv5tGb5t')));
	$req = $req->fetch();
		
	if(!$req['mail']){
		$valid = false;
		$_SESSION['flash']['danger'] = "Votre mail ou mot de passe ne correspondent pas";
	}
	
	
	if($valid){
		
		//$_SESSION['id'] = $req['id'];
		$_SESSION['id'] = $req['idpublic'];
		$_SESSION['pseudo'] = $req['pseudo'];
		$_SESSION['mail'] = $req['mail'];
		$_SESSION['password'] = $req['password'];
		
		$_SESSION['flash']['info'] = "Bonjour " . $_SESSION['pseudo'];
		header('Location: accueil.php');
		exit;
			
	}
	
}	
?>

<!DOCTYPE html>
<html lang="fr">
	<header>
		 <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<link rel="icon" href="./image/hh.jpg" />
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
		<link href="bootstrap/js/bootstrap.js" rel="stylesheet" type="text/css"/>
		<link href="style.css" rel="stylesheet" type="text/css" media="screen"/>
		
		<title>Connexion</title>
	</header>
	
	<body>
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="./">GDST</a>
		    </div>
		  </div>
		</nav>

		<?php 
		    if(isset($_SESSION['flash'])){ 
		        foreach($_SESSION['flash'] as $type => $message): ?>
				<div id="alert" class="alert alert-<?= $type; ?> infoMessage"><a class="close">X</span></a>
					<?= $message; ?>
				</div>	
		    
			<?php
			    endforeach;
			    unset($_SESSION['flash']);
			}
		?> 

	
		<div class="container-fluid">
				
	        <div class="row">
		        
	            <div class="col-xs-1 col-sm-2 col-md-3"></div>
	            <div class="col-xs-10 col-sm-8 col-md-6">
		            
		            <h1 class="index-h1">Connexion</h1>
		            
		            <br/>
	                
	                <form method="post" action="">
	                    
                        <label>Mail</label>
	
                    	<input class="input" type="email" name="Mail" placeholder="Mail" value="<?php if (isset($Mail)) echo $Mail; ?>" required="required">	

						<br/>
						<br/>
	                    <label>Mot de passe</label>
	                    	
                    	<br/>
						<?php
							if(isset($error_password)){
								echo $error_password."<br/>";
							}	
						?>

                        <input class="input" type="password" name="Password" placeholder="Mot de passe" value="<?php if (isset($Password)) echo $Password; ?>" required="required">

	
						<br/><br/>
	                    <div class="row">
	                        <div class="container">
								<button type="submit" class="bb"> Se connecter</button>
							</div>                              
	                   </div>
	                   <br/>
							<span class = "psq">Créer <a href="inscription.php"> un compt?</a></span>
	                </form>
	                
	            </div>
	
	            <div class="col-xs-0 col-sm-2 col-md-3"></div>
	        </div>
        </div>

		<script src="bootstrap/js/bootstrap.min.js"></script>
	</body>
		</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
		<footer>
		<P>© 2020, farid, Inc . </p>
	</footer>
</html>
