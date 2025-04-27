<?php
session_start();
echo "Session ID: " . session_id() . "<br>";
echo "Variables de session : ";
print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Roulette</title>
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<header id="head">
    <h2 class="alert alert-warning">Jeu de la roulette</h2>
</header>
<br>
<?php if(isset($message_erreur) && $message_erreur != ''): ?>
    <div class="alert alert-danger errorMessage"><?= $message_erreur ?></div>
<?php endif; ?>

<?php if(isset($message_info) && $message_info != ''): ?>
    <div class="alert alert-info infoMessage"><?= $message_info ?></div>
    <?php if(isset($gagne) && $gagne): ?>
        <div class="alert alert-success resultMessage"><?= $message_resultat ?></div>
    <?php else: ?>
        <div class="alert alert-danger resultMessage"><?= $message_resultat ?></div>
    <?php endif; ?>
<?php endif; ?>

<div id="intro">
    <h3><?= isset($_SESSION['joueur_nom']) ? $_SESSION['joueur_nom'] : '' ?></h3>
    <h4><?= isset($_SESSION['joueur_argent']) ? $_SESSION['joueur_argent'] : 0 ?> €</h4>
</div>
<br>
<form method="post" action="roulette.php" id="formJeu">
    <table id="rouletteTable">
        <tr class="bborder">
            <td colspan="3">
                <input type="number" min="1" max="<?= isset($_SESSION['joueur_argent']) ? $_SESSION['joueur_argent'] : 0 ?>" name="mise" placeholder="Votre mise" />
            </td>
        </tr>
        
        <tr class="bborder">
            <td id="textSliderNombre">Miser sur un nombre</td>
            <td>
            
                <label class="switch">
                  <input type="checkbox">
                  <span class="slider round" id="selecteurJeu"></span>
                </label> 
            </td>
            <td id="textSliderParite">Miser sur la parité</td>
        </tr>

        <tr class="bborder" id="trJeu">
            <td id="tdJeuNombre" colspan="3">
                <div class="blockJeu">
                    Choisissez votre nombre<br><br>
                    <input type="number" name="numero" min="1" max="36" />
                </div>
            </td>
            <td id="tdJeuParite" colspan="3">
                <div class="blockJeu">
                    Choisissez la parité<br><br>
                    
                    <input id="btnRadioPair" class="checkBoxParite" name="parite" value="pair" type="radio">
                    <label for="btnRadioPair" id="labelRadioPair" class="labelRadioParite">Pair</label>
                    <input id="btnRadioImpair" class="checkBoxParite" name="parite" value="impair" type="radio">
                    <label for="btnRadioImpair" id="labelRadioImpair" class="labelRadioParite">Impair</label>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="3"><input type="submit" name="btnJouer" class="btn btn-success" value="Jouer" /></td>
        </tr>
        <tr>
            <td colspan="3"><a href="roulette.php?deco" id="quitButton" class="btn btn-danger">Quitter</a></td>
        </tr>
    </table>
</form>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>

</body>
</html>