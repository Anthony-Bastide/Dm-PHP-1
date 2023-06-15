<?php

session_start();
require_once("../../bdd.php");

if(isset($_POST['mail']) and isset($_POST['password'])){
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $hashpass = hash('SHA1',$password);

    $selectQuery = "SELECT * FROM users WHERE  mail = :mail AND password = :password";
    $stmtUser = $bdd->prepare($selectQuery);
    $stmtUser->execute(array(":mail"=>$mail, ":password" =>$hashpass));

    if($stmtUser->rowCount() > 0){
        $data = $stmtUser->fetch();
        $_SESSION['mail'] = $data['mail'];
        $_SESSION['id'] = $data['id'];
        echo json_encode(array('status' => 'success')); 
    }
    else {
        echo json_encode(array('status' => 'known'));
    }
}

?>