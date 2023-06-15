<?php
session_start();
require_once("../../bdd.php");

if(isset($_POST['mail'])){
    $mail = htmlspecialchars($_POST['mail']);
    $id_user = $_SESSION['id'];
    $mail_user = $_SESSION['mail'];
    
    if($mail_user != $mail){

        $sqlQuery = "SELECT id FROM users WHERE mail = :mail";
        $stmt_friend = $bdd->prepare($sqlQuery);
        $stmt_friend->execute(array(":mail"=>$mail));
        $id_friend = $stmt_friend->fetch();

        if($stmt_friend->rowCount() > 0){

            $sqlQuery = "SELECT id_friend FROM users WHERE id = :id";
            $stmt = $bdd->prepare($sqlQuery);
            $stmt->execute(array(":id"=>$id_user));

            $friend_user = $stmt->fetch(); 

            $sqlQuery = "SELECT id_friend FROM users WHERE id = :id";
            $stmt = $bdd->prepare($sqlQuery);
            $stmt->execute(array(":id"=>$id_friend['id']));

            $friend_friend = $stmt->fetch(); 

            if((strpos($friend_friend['id_friend'],"/".$id_user."/") === false and strpos($friend_user['id_friend'], "/".$id_friend['id']."/") === false) or ($friend_user['id_friend'] == "" and $friend_friend['id_friend']== "")){
                
                $all_id_friend_user = $friend_user['id_friend'] ."/".$id_friend['id']."/";
                $all_id_friend_friend = $friend_friend['id_friend']."/".$id_user."/";
                
                $updateQuery = "UPDATE users SET id_friend = :id_friend WHERE id = :id_user";
                $updateStmt = $bdd->prepare($updateQuery);
                $updateStmt->execute(array(":id_friend"=>$all_id_friend_user, ":id_user"=>$id_user));
                
                $updateQuery = "UPDATE users SET id_friend = :id_friend WHERE id = :id_user";
                $updateStmt = $bdd->prepare($updateQuery);
                $updateStmt->execute(array(":id_friend"=>$all_id_friend_friend, ":id_user"=>$id_friend['id']));

                echo json_encode(array('status' => 'success')); 
            }
            else {
                echo json_encode(array('status' => 'known')); 
            }
        }
        else {
            echo json_encode(array('status' => 'error')); 
        }
    }
    else{
        echo json_encode(array('status' => 'error_mail')); 
    }

}
?>