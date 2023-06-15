<?php
session_start();
require_once("../../bdd.php");

if(isset($_POST['group_name']) and isset($_POST['new_message']) and $_POST['new_message'] != "")
{
    $id_group = htmlspecialchars($_POST['group_name']);
    $new_message = htmlspecialchars($_POST['new_message']);
    $id_user = $_SESSION['id'];
    $datetime = date('Y-m-d H:i:s');
    
    $updateQuery = "INSERT INTO message (id_user, id_group, message, time) VALUES(:id_user, :id_group, :message, :time)";
    $updateStmt = $bdd->prepare($updateQuery);
    $updateStmt->execute(array(":id_user"=>$id_user, ":id_group"=>$id_group, ":message"=>$new_message, ":time"=>$datetime));

    echo json_encode(array('status' => 'success'));
}
else
{
    echo json_encode(array('status' => 'error'));
}
?>