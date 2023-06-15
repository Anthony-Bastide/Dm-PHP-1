<?php
require_once("../../bdd.php");

if(isset($_POST['name']) AND isset($_POST['surname']) AND isset($_POST['description']) AND isset($_POST['id'])){ 
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $description = htmlspecialchars($_POST['description']);
    $id = $_POST['id'];

    $sqlQuery = "UPDATE users SET name = :name, surname = :surname, description =  :description WHERE id = :id";
    $stmt = $bdd->prepare($sqlQuery);
    $stmt->execute(array(":name"=>$name,":surname"=>$surname, ":description"=>$description, ":id"=>$id));

    if($_FILES['file_img']['error'] == 0 and !empty($_FILES['file_img']['name'])){

        $allowed = array('jpg', 'jpeg', 'png');
        $filename = $_FILES['file_img']['name'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $filename = $img_name_base = $name.$id.".".$extension;
        if(!in_array($extension, $allowed)) {
            
            echo json_encode(array('status' => 'error_extension')); 

        } 
        else {

            $max_size = 10097152; 
            $image_info = getimagesize($_FILES['file_img']['tmp_name']);
            $image_size = $image_info[0] * $image_info[1] * $image_info['bits'];
            if ($image_size > $max_size) {
                echo json_encode(array('status' => 'error_size'));
            } 
            else {
                $target_dir = "../../dist/img/profile/";
                $target_file = $target_dir . basename($filename);

                if(move_uploaded_file($_FILES['file_img']['tmp_name'], $target_file)) {

                    $img_name_base = $filename;
                    $sqlQuery = "UPDATE users SET img = :img WHERE id = :id";
                    $stmt = $bdd->prepare($sqlQuery);
                    $stmt->execute(array(":img"=>$img_name_base,":id"=>$id));

                    echo json_encode(array('status' => 'success')); 
                } 
                else {

                    echo json_encode(array('status' => 'error_move')); 

                }
            }

        }

    }
    else {
        echo json_encode(array('status' => 'success')); 
    }
}