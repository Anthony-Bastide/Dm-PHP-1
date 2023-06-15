<?php
session_start();
require_once("../../bdd.php");

if(isset($_POST['select_del_friend']) and $_POST['select_del_friend'] != ""){
    $id_friend = htmlspecialchars($_POST['select_del_friend']);
    $id_user = $_SESSION['id'];

    $sqlQuery = "SELECT id_friend FROM users WHERE id = :id";
    $stmt_user = $bdd->prepare($sqlQuery);
    $stmt_user->execute(array(":id"=>$id_user));
    $tab_id_friend_user = $stmt_user->fetch();

    $sqlQuery = "SELECT id_friend FROM users WHERE id = :id";
    $stmt_friend = $bdd->prepare($sqlQuery);
    $stmt_friend->execute(array(":id"=>$id_friend));
    $tab_id_friend_friend = $stmt_friend->fetch();

    $id_friend_del_user = str_replace("/".$id_friend."/", "", $tab_id_friend_user['id_friend']);

    $sqlQuery = "UPDATE users SET id_friend = :id_friend WHERE id = :id";
    $stmt_user = $bdd->prepare($sqlQuery);
    $stmt_user->execute(array(":id_friend"=>$id_friend_del_user, ":id"=>$id_user));

    $id_friend_del_friend = str_replace("/".$id_user."/", "", $tab_id_friend_friend['id_friend']);

    $sqlQuery = "UPDATE users SET id_friend = :id_friend WHERE id = :id";
    $stmt_friend = $bdd->prepare($sqlQuery);
    $stmt_friend->execute(array(":id_friend"=>$id_friend_del_friend, ":id"=>$id_friend));

    echo json_encode(array('status' => 'success')); 
}

?>