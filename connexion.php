

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Connexion</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css" />
</head>
<body>
<header id="head">
	<h2 class="alert alert-warning">Connexion</h2>
</header>
<br>


<form method="post" action="index.php">
	<table id="connexionTable">
		<tr>
			<td colspan="3"><input type="text" name="nom" placeholder="Identifiant" /></td>
		</tr>

		<tr>
			<td colspan="3"><input type="password" name="motdepasse" placeholder="Mot de passe" /></td>
		</tr>

		<tr>
			<td><br><a href="#"><input class="btn btn-warning" name="btnErase" type="reset" value="Effacer" /></a></td>
			<td><br><a href="inscription.php"><div class="btn btn-info">S'inscrire</div></a></td>
			<td><br><input class="btn btn-primary" name="btnConnect" type="submit" value="Jouer" /></td>
		</tr> 
	</table>
</form>
<br><br>

</body>
</html>