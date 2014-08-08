<!DOCTYPE html>
<html>
	<head>
		<title>Grossiste professionnels et particuliers - Ene Merkatua</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" href="style.css" />
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
		<?php include "SPDO.php"; ?> <!-- appel de la base de donnée -->
	</head>
	
	<body>
		<header>
			<div class="container">
				<ul class="nav nav-pills nav-justified">
					<li><img src="images/banniere2.jpg"></img></a></li>
					<li><a href="index.php" class="white">ACCUEIL</a></li>
					<li><a href="boutique.php" class="white">NOTRE BOUTIQUE</a></li>
					<li><a href="#" class="white">NOS PRODUITS</a></li>
					<li><a href="#" class="white">NOUS CONTACTER <span class="glyphicon glyphicon-envelope"></a></li>
				</ul>
			</div>
		</header> 
		
<!------------------------- BOUTON CREATION PROJET ----------------------------------------------------------------------------->
		<div class= "container-fluid" id="bloc">
		
		<div class="col-xs-4">
			<form method="post" action="boutique.php">
				<input type="hidden" name="action" value="create"/>
				<input type="submit" class="btn btn-primary btn-lg" value="Creer un nouveau Projet"/>
			</form>
		</div>

<!--------------------------- PANEL CREATION ------------------------------------------------------------------------->		
		<?php if(isset($_POST['action'])){ ?>
		<?php if($_POST['action'] == "create"){ ?>
			<div class="col-xs-4">
				<form method="post" enctype="multipart/form-data" action="boutique.php">
					<div class="thumbnail">
						<img src="images/bouffe1.jpg" alt="...">
						<div class="caption">
						<h3>
							<div class="form-group">
								<label>Nom du produit</label>
								<input type="text" class="form-control input-sm" name="nom_produit" placeholder="Nom du produit"/>
							</div> 
						</h3>
						<p> 
							<div class="form-group">
								<label>Description du produit:</label>
								<input type="text" class="form-control input-sm" name="description" placeholder="Description du produit"/>
							</div> 
						</p>
						<select name="choix">
							<option value="choix1">Choix 1</option>
							<option value="choix2">Choix 2</option>
							<option value="choix3">Choix 3</option>
							<option value="choix4">Choix 4</option>
						</select>
						<div class="form-group">
							<label>Images du produit:</label>
							<!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
							<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
							<!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES -->
							Envoyez ce fichier : <input type="file" name="userfile" />
						</div>
						<input type="submit" class="btn btn-lg btn-success" value="Valider"/>
						</div>
					</div>
				</form>
			</div><?php } } ?>
			
<!----------------------------------------------- on inscrit dans la base de donnée le nouveau produit -------------------------------------------------->						
			<?php if(isset($_POST['nom_produit'])){ 	
			if($_POST['nom_produit']!= NULL || $_POST['nom_produit']!= NULL){
			SPDO::getInstance()->query("INSERT INTO items( name, description ) VALUES ('".$_POST['nom_produit']."', '".$_POST['description']."') ");
			foreach (SPDO::getInstance()->query("SELECT id FROM items WHERE id=LAST_INSERT_ID()") as $id);
			$dossier = 'images/';
			$fichier = "bouffe".$id['id'].".jpg";
			move_uploaded_file($_FILES['userfile']['tmp_name'], $dossier . $fichier);
			} }
			?>
			<?php if(isset($_POST['action'])){ 
			if($_POST['action'] == "delete"){ 
			SPDO::getInstance()->query("DELETE FROM items WHERE id = ".$_POST['id']);			
			} }	
			?>

<!------------------------------------------- AFFICHAGE DES PANELS -------------------------------------------------------------------->		
			<?php	foreach (SPDO::getInstance()->query('SELECT id, name, description FROM items') as $key) //selection des produits 
			{		?>
			
			<div class="col-xs-4">
				<div class="thumbnail">
					<img id=img_product src=<?php print "images/bouffe".$key['id'].".jpg" ?> alt="...">
					<div class="caption">						
						<h3><?php print $key['name'];?></h3>
						<p> <?php print $key['description'];?> </p>
						<form method="post" action="boutique.php">				<!--- SUPPRESION DU PANEL ----->
							<input type="hidden" name="action" value="delete"/>
							<input type="hidden" name="id" value="<?php print $key["id"] ?>"/>
							<input type="submit" class="btn btn-primary btn-lg" value="Supprimer"/>
						</form>							
					</div>
				</div>
			</div>	
			<?php			} ?>


			
		</div>
		
		<!------------------------- FOOTERS -------------------------------------------------------------------------------------------->					
		<div class="container-fluid" style="background-color:#CF072C">
			<p class="navbar-text navbar-right">Réalisé par <a href="#" class="navbar-link" style="color:white">La FAMILLE</a></p>
		</div>

		<footer>
				<div class="container">
					<div id="footer-logo"> ENE MERKATUA </div>
					Ene merkatua  © 2014
					<div id="footer-separation"></div>
					<a>
						<img src="images/drapeau.png"></img>
					</a>
				</div>				
		</footer>	
		
	</body>
</html>
