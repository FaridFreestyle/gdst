<?php
session_start();
include_once('includes.php');

if(!isset($_SESSION['pseudo'])){
	header('Location: accueil.php');
	exit;
}

if(!empty($_POST)){
	extract($_POST);
	$valid = true;

	if($modifier == "form"){
		$Pseudo = htmlspecialchars(trim($Pseudo));
	
		if(empty($Pseudo)){
			$valid = false;
			$_SESSION['flash']['danger'] = "Veuillez mettre un pseudo !";
			
		}
		
		$req = $DB->query("Select pseudo from user where idpublic = :id", array('id' => $_SESSION['id']));
		$req = $req->fetch();
		
		if($Pseudo == $_SESSION['pseudo']){
			$valid = false;
			$_SESSION['flash']['info'] = "Votre pseudo est le même";
		
		}
		
		if($valid){
			
			$DB->insert("UPDATE user SET pseudo = :newpseudo where idpublic = :id ", array('id' => $_SESSION['id'], 'newpseudo' => $Pseudo));
			
			$_SESSION['pseudo'] = $Pseudo;
			$_SESSION['flash']['success'] = "Votre pseudo a bien été modifié !";
			header('Location: modifier.php');
			exit;
		}
		
	}elseif($modifier == "mdp"){
		
		$Password = trim($Password);
		$PasswordConfirmation =trim($PasswordConfirmation);
		$NewPassword = trim($NewPassword);
		
		$req = $DB->query("Select * from user where idpublic = :id", array('id' => $_SESSION['id']));
		$req = $req->fetch();
		
		if(empty($Password)){
			$valid = false;
			$_SESSION['flash']['warning'] = "Veuillez mettre votre mot de passe !";
		
		}elseif($Password && empty($PasswordConfirmation)){
			$valid = false;
			$_SESSION['flash']['warning'] = "Veuillez confirmer votre mot de passe";

		}elseif($Password != $PasswordConfirmation){
			$valid = false;
			$_SESSION['flash']['danger'] = "Votre mot de passe ne correspond pas au mot de passe !";

		}else if($req['password'] != (crypt($Password, '$2a$10$1qAz2wSx3eDc4rFv5tGb5t'))){
			$valid = false;
			$_SESSION['flash']['danger'] = "Votre mot de passe n'est pas le bon !";
			
		}else if(empty($NewPassword)){
			$valid = false;
			$_SESSION['flash']['warning'] = "Veuillez mettre un nouveau mot de passe !";
	
		}else if($valid){
			
			$DB->insert("UPDATE user SET password = :newpassword where idpublic = :id", array('id' => $_SESSION['id'], 'newpassword' => (crypt($NewPassword, '$2a$10$1qAz2wSx3eDc4rFv5tGb5t'))));
			
			$_SESSION['flash']['success'] = "Votre nouveau mot de passe a été enregistré !";
			header('Location: modifier.php');
			exit;
			
		}	
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
		
		<title>Modifier profil</title>
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
		
		<div class="container-fluid">
			
	        <div class="row">
		       	
		       	<div class="col-xs-1 col-sm-2 col-md-3"></div>
		       	<div class="col-xs-10 col-sm-8 col-md-6">
			       	
			       <h1 class="index-h1">Modifier votre profil</h1>
			       	
			       <br/>
	                
	                <form method="post" action="modifier.php">
	                    
                        <label>Pseudo</label>
                        
                    	<input class="input" type="text" name="Pseudo" placeholder="Pseudo" value="<?= $_SESSION['pseudo'];  ?>" maxlength="20" required="required">

						<br/>
						<br/>
						
	                    <div class="row">
		                        <input type="hidden" value="form" name="modifier"/>
		                        <div class="container">
									<button type="submit" class="bb">Modifier</button>
								</div>                        
	                   </div>
						
	                </form>
	                
	                <br/>
	                <br/>
	                
	                <form method="post" action="modifier.php">

	                    <label>Mot de passe</label>	                 

                        <input class="input" type="password" name="Password" value="<?php if(isset($Password)){ echo $Password; }?>" placeholder="Mot de passe" required="required"/>
					
						<br/>
	
	                    <label>Confirmez votre mot de passe</label>

                        <input class="input" type="password" name="PasswordConfirmation" value="<?php if(isset($PasswordConfirmation)){ echo $PasswordConfirmation; }?>" placeholder="Confirmation du mot de passe" required="required"/>
	                    
	                    <br/>
	                    
	                    <label>Nouveau mot de passe</label>
                        <input class="input" type="password" name="NewPassword" placeholder="Nouveau mot de passe" required="required"/>
						
						<br/><br/>
						
	                    <div class="row">
		                        <input type="hidden" value="mdp" name="modifier"/>
		                        <div class="container">
									<button type="submit" class="bb">Modifier</button>
								</div>
	                                                    
	                   </div>
	
	                </form>
			       
					<br/>
		       	</div>
	            <div class="col-xs-1 col-sm-2 col-md-3"></div>
	        </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</body>
			</br></br></br></br></br></br></br></br></br></br></br></br></br></br>
		<footer>
		<P>© 2020, farid, Inc . </p>
	</footer>
</html