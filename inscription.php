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
	$Pseudo = htmlspecialchars(ucfirst(trim($Pseudo)));
	$Password = trim($Password);
	$PasswordConfirmation = trim($PasswordConfirmation);
		
	if(empty($Pseudo)){
		$valid = false;
		$_SESSION['flash']['danger'] = "Veuillez mettre un pseudo !";
	}
	
	if(empty($Mail)){
		$valid = false;
		$_SESSION['flash']['danger'] = "Veuillez mettre un mail !";
	}
	
	$req = $DB->query('Select mail from user where mail = :mail', array('mail' => $Mail));
	$req = $req->fetch();
	
	if(!empty($Mail) && $req['mail']){
		$valid = false;
		$_SESSION['flash']['danger'] = "Ce mail existe déjà";
		
	}
	if(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $Mail)){
		$valid = false;
		$_SESSION['flash']['danger'] = "Veuillez mettre un mail conforme !";
	}
	
	if(empty($Password)){
		$valid = false;
		$_SESSION['flash']['danger'] = "Veuillez renseigner votre mot de passe !";

	}elseif($Password && empty($PasswordConfirmation)){
		$valid = false;
		$_SESSION['flash']['danger'] = "Veuillez confirmer votre mot de passe !";
	
	}elseif(!empty($Password) && !empty($PasswordConfirmation)){
		if($Password != $PasswordConfirmation){
			
			$valid = false;
			$_SESSION['flash']['danger'] = "La confirmation est différente !";
		}	
	}
		
	if($valid){
		
		$id_public = uniqid();
		
		$DB->insert('Insert into user (pseudo, mail, password, idpublic) values (:pseudo, :mail,:password, :idpublic)', array('pseudo' => $Pseudo, 'mail' => $Mail, 'password' => crypt($Password, '$2a$10$1qAz2wSx3eDc4rFv5tGb5t'), 'idpublic' => $id_public));
		
		$_SESSION['flash']['success'] = "Vous avez été inscrit avec succes, connectez-vous !";
		header('Location: connexion.php');
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
		
		<title>Inscription</title>
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
		      <a class="navbar-brand" href="./">GDST</a>
		    </div>
		
		    
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="connexion.php">Connexion</a></li>
		      </ul>
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
		            
		            <h1 class="index-h1">Inscription</h1>
		            
		            <br/>
	                
	                <form method="post" action="inscription.php">
	                    
                        <label>Pseudo</label>
                    	<br/>
						<?php
							if(isset($error_pseudo)){
								echo $error_pseudo."<br/>";
							}	
						?>
                    	<input class="input" type="text" name="Pseudo" placeholder="Pseudo" maxlength="20" required="required">	
						<br/>
						<br/>
						<label>Mail</label>
						<input class="input" type="email" name="Mail" placeholder="Votre mail" required="required">	
						<br/>
						<br/>
	
	                    <label for="Password">Mot de passe</label>
	                    	
                    	<br/>
						<?php
							if(isset($error_password)){
								echo $error_password."<br/>";
							}	
						?>

                        <input class="input" type="password" name="Password" placeholder="Mot de passe" required="required">
						<br/>
						<br/>
	
	                    <label>Confirmez votre mot de passe</label>
                    	</br>
						<?php
							if(isset($error_passwordConf)){
								echo $error_passwordConf."<br/>";
							}	
						?>

                        <input class="input" type="password" name="PasswordConfirmation" placeholder="Confirmez votre mot de passe" required="required">
						<br/>
						<br/>
	                    <div class="row">
	                        <div class="col-xs-0 col-sm-10 col-md-2"></div>
	                        <div class="container">
								<button type="submit" class ="bb">S'inscrire</button>
	                        </div>
	                        <div class="col-xs-0 col-sm-1 col-md-2"></div>                                
	                   </div>
	
	                </form>
	                
	            </div>
	
	            <div class="col-xs-0 col-sm-2 col-md-3"></div>
	        </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</body>
			</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
		<footer>
		<P>© 2020, farid, Inc . </p>
	</footer>
</html>
