<?php 
session_start();
require_once("bdd.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./librairie/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./dist/css/style_index.css">
    <title>Document</title>
</head>
<body>
<div class="card" id="card_connection">
    <div class="card-body">
        <span class="card-title" id="card-title">Connexion</span>
        <div class="card" id="form_card_connection">
            <form method="POST" id="connection_form" enctype="multipart/form-data" onsubmit="return connection(event);">
                <div class="row">
                    <div class="col-12" id="mail">
                        <label for="mail">Email :</label>
                        <input type="email" name="mail" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" id="pass">
                        <label for="password">Mot de Passe :</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 offset-md-4">
                        <button id="button_form_mailpas" type="submit" class="btn btn-outline-primary">Continuer</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-12">
                <button id="button_registration" onclick="window.location.href='registration.php'" type="button" class="btn btn-outline-primary">Créer votre compte Tchat</button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="./librairie/bootstrap/js/bootstrap.bundle.js"></script>
<script src="./dist/js/tchat.js"></script>
</html>