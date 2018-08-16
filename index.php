<?php 
// include("blog.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Mon blog</title>
</head>
<body>


	<nav class="navbar navbar-expand-lg navbar-light bg-light" class="navbar navbar-light" >
		<a class="navbar-brand" href="#">Navbar</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">HOME</span><span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Link</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Dropdown
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Something else here</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link disabled" href="#">Disabled</a>
				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div>
	</nav>




	<?php 

	$categorie = $_POST['select'];
	$titre = $_POST['titre'];
	$photo = $_POST["photo"];
	$date = $_POST["date"];
	$comment = $_POST["commentaire"];
	$cpt = 0;
	$btn_modif = $_GET["modifier"];
	var_dump($btn_modif) ;



//on se connecte à mysql :
	try  
	{
		$bdd = new PDO('mysql:host=localhost;dbname=Blog;charset=utf8', 'annie', '12345678');
	}
// en cas d'erreur on affiche un message :
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

//insertion dans la bdd
	$req = $bdd->prepare('INSERT INTO articles(titre, date, photo, commentaire, categorie) VALUES(:titre, :date, :photo, :commentaire, :categorie)');
	$req->execute(array(
		'titre' => $titre,
		'date' => $date,
		'photo' => $photo,
		'commentaire' => $comment,
		'categorie' => $categorie,
	));

//requêtes

	$reponse = $bdd->query('SELECT * FROM articles') ;
	while($donnees=$reponse->fetch())
	{
		$cpt++;
		?>

		<!--  affichage des données --> 
		<fieldset class ="content">
			<form method="get"> 
			<?php  
			echo '<img class="contenu" src="' . $donnees['photo'] . '">';
			echo '<div><h3 id="titre">' . $donnees['titre'] . '</h3><span id="datetime">' . $donnees['date'] . '</span></div>';
			echo '<div class="contenu">' . $donnees['commentaire'] . '</div>';
			echo '<div><button  class="btnadmin btn btn-primary"  data-toggle="modal" data-target="#exampleModalCenter"  name="modifier" value="'.$cpt.'">Modifier</button><a class="btnadmin" href="#content">Supprimer</a></div>';
			?>
		</form> 
		</fieldset>
		<?php 
	}

	?>

					<?php 

					$modif = $bdd->query("SELECT * FROM articles WHERE id ='$btn_modif'") ;

					?>
					
					
						

	<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Modifier un article</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php
					while($res=$modif->fetch())
					{
						
						echo '<textarea>' . $res['photo'] . '</textarea>';
						echo '<textarea>' . $res['titre'] . '</textarea><textarea>' . $res['date'] . '</textarea>';
						echo '<textarea>' . $res['commentaire'] . '</textarea>'; 

					}
					?> 
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>

		<a href="blog.php" >Retour à la page d'ajout d'articles</a> 


		<script type="text/javascript" src="jquery.min.js"></script>
		<script type="text/javascript" src="bootstrap.min.js"></script>
		<!-- <script type="text/javascript">
			$('#myModal').on('shown.bs.modal', function () {
				$('#myInput').trigger('focus')
			});
		</script> -->

	</body>
	</html>