<?php
session_start();
require_once("../../bdd.php");
require_once("../function.php");

if(isset($_POST['group']) and $_POST['group'] !="")
{
    $id_user = $_SESSION['id'];
    $id_group = $_POST['group'];
    $tab_friend = recup_table_friend_user($id_user, $bdd);

    $sqlQuery = "SELECT id_user FROM group_user WHERE id = :id";
    $stmt = $bdd->prepare($sqlQuery);
    $stmt->execute(array(":id"=>$id_group));

    $tab_id_group = $stmt->fetch(); 

    ?>
        <div class="row">
            <div class="col-12" id="select_group">
                <label for="select_udpdate_group">Ami(e)s :</label>
                <select class="form-select" id="select_udpdate_group" name="select_udpdate_group[]" multiple>
                    <option></option>
                    <?php
                        foreach($tab_friend as $friend){
                            ?>
                                <option value="<?= $friend['id'] ?>" <?php if(strpos($tab_id_group['id_user'], $friend['id']) !== false){echo "selected" ;} ?>><?= $friend['name']." ".$friend['surname'] ?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>
        </div>
    <?php
}

?>