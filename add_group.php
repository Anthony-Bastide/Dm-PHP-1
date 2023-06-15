<?php
session_start();
require_once("../../bdd.php");

if(isset($_POST['select_add_group']) and isset($_POST['group_name'])){
    $group_name = htmlspecialchars($_POST['group_name']);
    $tab_id_friend = $_POST['select_add_group'];
    $id_user = $_SESSION['id'];
    $all_id_friend="";
    $cpt_verif = 0;

    $sqlQuery = "SELECT id_user FROM group_user WHERE name = :name";
    $stmt_name = $bdd->prepare($sqlQuery);
    $stmt_name->execute(array(":name"=>$group_name));

    $tab_verif_id = $stmt_name->fetchAll(); 

    foreach($tab_verif_id as $verif_id)
    {
        if(strpos($verif_id['id_user'], "/".$id_user."/") !== false)
        {
            $cpt_verif ++;
        }
    }
    if($cpt_verif == 0){

        if (is_array($tab_id_friend)) {
            $tab_id_friend = array_map('htmlspecialchars', $tab_id_friend);
        } 
        else {
            $tab_id_friend = htmlspecialchars($tab_id_friend);
        }

        foreach($tab_id_friend as $id_friend)
        {
            $all_id_friend.="/".$id_friend."/";
        }

        $all_id_friend .= "/".$id_user."/";

        $updateQuery = "INSERT INTO group_user (name, id_user) VALUES(:name, :id_user)";
        $updateStmt = $bdd->prepare($updateQuery);
        $updateStmt->execute(array(":name"=>$group_name, ":id_user"=>$all_id_friend));

        echo json_encode(array('status' => 'success'));
    }
    else {
        echo json_encode(array('status' => 'error'));
    }

}

?>