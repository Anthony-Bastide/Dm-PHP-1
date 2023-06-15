<?php 
require_once("bdd.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./librairie/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./dist/css/style_unknown.css">
    <title>Document</title>
</head>
<body>
<div class="card" id="card_unknown">
    <div class="card-body">
        <span class="card-title" id="card-title">Vous n'êtes pas Reconnu</span>
        <div class="row">
            <div class="col-12">
                <button id="button_registration" onclick="window.location.href='index.php'" type="button" class="btn btn-outline-primary">Vous Connecter avec votre Compte</button>
            </div>
            <div class="col-12">
                <button id="button_registration" onclick="window.location.href='registration.php'" type="button" class="btn btn-outline-primary">Créer votre compte Tchat</button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="./librairie/bootstrap/js/bootstrap.bundle.js"></script>
</html>