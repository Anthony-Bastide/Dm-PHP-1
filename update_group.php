<?php
session_start();
require_once("../../bdd.php");

if(isset($_POST['select_udpdate_group']) and isset($_POST['group_name']))
{
    $select_udpdate_group = $_POST['select_udpdate_group'];
    $id_group = htmlspecialchars($_POST['group_name']);
    $id_user_group = "";
    $id_user = $_SESSION['id'];

    if (is_array($select_udpdate_group)) {
        $select_udpdate_group = array_map('htmlspecialchars', $select_udpdate_group);
    } 
    else {
        $select_udpdate_group = htmlspecialchars($select_udpdate_group);
    }

    foreach($select_udpdate_group as $udpdate_group)
    {
        $id_user_group .= "/".$udpdate_group."/";
    }
    $id_user_group .= "/".$id_user."/";

    $sqlQuery = "UPDATE group_user SET id_user = :id_user WHERE id = :id";
    $stmt_del = $bdd->prepare($sqlQuery);
    $stmt_del->execute(array("id_user"=>$id_user_group, ":id"=>$id_group));
    
    echo json_encode(array('status' => 'success'));
}
else{
    echo json_encode(array('status' => 'error'));
}