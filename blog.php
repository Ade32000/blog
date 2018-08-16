<?php


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Ajout articles</title>
</head>
<body id="bodyblog">
	
	<fieldset id="ajout">
		<h2>Ajouter un nouvel article</h2> 
		<form method="post" action="index.php" enctype="multipart/form-data">
			<p>Catégorie : <select id="monselect" name="select">
				<option value="Santé" selected>Santé</option>
				<option value="Beauté">Beauté</option> 
				<option value="Bricolage">Bricolage</option>	
			</select></p>
			<p>Titre de l'article : <input type="text" name="titre" /></p> 
			<p>Date : <input type="Date" name="date"></p>
			<p>Commentaire: <br /><textarea name="commentaire" rows="10" cols="50"></textarea></p> 
			<input type="hidden" name="MAX_FILE_SIZE" value="2097152"> 
			<p>URL de la photo : </p> 
			<input id="file" type="text" name="photo"> 
			<br /><br /> 
			<input type="submit" name="ok" value="Envoyer"> <a id="link" href="index.php" >VISITER LE BLOG</a> 
		</form> 
	</fieldset>
	<br /> 
	


	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap.min.js"></script>

	
</body>
</html>

