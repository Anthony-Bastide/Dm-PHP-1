<?php
session_start();
require_once("../../bdd.php");

if(isset($_POST['select_del_group']))
{
    $id_group = htmlspecialchars($_POST['select_del_group']);
    $id_user = $_SESSION['id'];

    $sqlQuery = "SELECT id_user FROM group_user WHERE id = :id";
    $stmt = $bdd->prepare($sqlQuery);
    $stmt->execute(array(":id"=>$id_group));

    $tab_id_group = $stmt->fetch(); 

    $id_user_group = $new_str = str_replace($id_user.'/', '', $tab_id_group['id_user']);
        
    $sqlQuery = "UPDATE group_user SET id_user = :id_user WHERE id = :id";
    $stmt_del = $bdd->prepare($sqlQuery);
    $stmt_del->execute(array("id_user"=>$id_user_group, ":id"=>$id_group));

    echo json_encode(array('status' => 'success'));
}

?>