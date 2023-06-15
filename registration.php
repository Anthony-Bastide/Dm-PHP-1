<?php

require_once("../../bdd.php");

if(isset($_POST['mail']) and isset($_POST['password']) and isset($_POST['password2']) and isset($_POST['name']) and isset($_POST['surname'])){
    $mail = htmlspecialchars($_POST['mail']);
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);

    $sqlQuery = "SELECT * FROM users WHERE mail = :mail";
    $stmt = $bdd->prepare($sqlQuery);
    $stmt->execute(array(":mail"=>$mail));

    $rows = $stmt->fetchAll();


    if( count($rows) == 0 ){
        $sqlQuery = "INSERT INTO users (mail, password, name, surname) VALUES(:mail, SHA1(:password), :name, :surname)";
        $stmt = $bdd->prepare($sqlQuery);
        $stmt->execute(array(":mail"=>$mail,":password"=>$password, ":name"=>$name, ":surname"=>$surname));
        echo json_encode(array('status' => 'success')); // Retourne une réponse JSON en cas de succès
    }
    else {
        echo json_encode(array('status' => 'known')); // Retourne une réponse JSON en cas d'échec
    }
}

?>