<?php

function is_connected($session)
{

    if(!empty($session) ){
        return true;
    }
    else{
        return false;
    }
}

function recup_table_users_by_id($id, $bdd)
{

    $tab_user = array();

    $sqlQuery = "SELECT * FROM users WHERE id = :id";
    $stmt = $bdd->prepare($sqlQuery);
    $stmt->execute(array(":id"=>$id));

    $tab_user = $stmt->fetch();
    
    return $tab_user;

}
function recup_table_friend_user($id, $bdd)
{

    $tab_friend = array();
    $tab_id_friend = array();
    $cpt = 0;

    $sqlQuery = "SELECT id_friend FROM users WHERE id = :id";
    $stmt = $bdd->prepare($sqlQuery);
    $stmt->execute(array(":id"=>$id));

    $tab_id_friend = $stmt->fetch();

    $tab_id_friend = explode("/", $tab_id_friend["id_friend"]);

    foreach($tab_id_friend as $id_friend)
    {
        if($id_friend != ""){
            $sqlQuery = "SELECT * FROM users WHERE id = :id";
            $stmt = $bdd->prepare($sqlQuery);
            $stmt->execute(array(":id"=>$id_friend));

            $tab_friend[$cpt] = $stmt->fetch();
        }
        $cpt++;
    }
    return $tab_friend;
}
function recup_table_groupe_user($id, $bdd)
{

    $results = array(); 

    $sqlQuery = "SELECT * FROM group_user";
    $stmt = $bdd->prepare($sqlQuery);
    $stmt->execute();

    $tab_goupe_user = $stmt->fetchAll();
    
    foreach ($tab_goupe_user as $group) {
        if (strpos($group['id_user'], $id."/") !== false) {
            $group_name = $group['name'];
            $results[] = array("id_user"=>$group['id_user'], "name"=>$group_name, "id"=>$group['id']);
        }
    }

    return $results;
}
function recup_table_message_for_chat($id_goup, $bdd)
{
    $tab_message = array();

    $sqlQuery = "SELECT * FROM ( SELECT * FROM message WHERE id_group = :id_group ORDER BY time DESC LIMIT 10 ) sub ORDER BY time ASC;";
    $stmt = $bdd->prepare($sqlQuery);
    $stmt->execute(array(":id_group"=>$id_goup));

    $tab_message = $stmt->fetchAll();

    return $tab_message;
}
?>