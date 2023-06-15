<?php
session_start();
require_once("../../bdd.php");
require_once("../function.php");

if(isset($_POST['group']) and $_POST['group'] !="")
{
    $id_goupe = $_POST['group'];
    $tab_messge = recup_table_message_for_chat($id_goupe, $bdd);
    $id_user = $_SESSION['id'];
    ?>
    <div class="row">
        <div class="col-10 offset-md-1">
            <div class="card" id="message_card_chat">
                <?php
                foreach($tab_messge as $message)
                {
                    if($message['message'] != "")
                    {
                        $user = recup_table_users_by_id($message['id_user'], $bdd);
                        if($message['id_user'] == $id_user)
                        {
                            ?>
                            <div class="row">
                                <div class="col-12">
                                    <table id="table_msg">
                                        <tr>
                                            <td class="msg_text_user"><div id="text_msg_user" class="card" title="<?= $message['time'] ?>"><?= $message['message'] ?></div></td>
                                            <td class="msg_img_user"><img title="<?= $user['surname'] ?>" class="image-rond image-ronde-profile_msg" src="./dist/img/profile/<?php if($user['img']!=""){echo $user['img'];}else{echo 'profile.png';} ?>"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <?php
                        }
                        else
                        {
                            ?>
                            <div class="row">
                                <div class="col-12">
                                    <table id="table_msg">
                                        <tr>
                                            <td class="msg_img_friend"><img title="<?= $user['surname'] ?>" class="image-rond image-ronde-profile_msg" src="./dist/img/profile/<?php if($user['img']!=""){echo $user['img'];}else{echo 'profile.png';} ?>"></td>
                                            <td class="msg_text_friend"><div class="card" id="text_msg_friend" title="<?= $message['time'] ?>"><?= $message['message'] ?></div></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
            <div class="input-group" id="send_msg">
                <input type="text" name="new_message" id="new_message" class="form-control" placeholder="Envoyer un Message">
                <div class="input-group-text" onclick="add_message(event)"><img id="icon_msg" src="./dist/img/icon/send.png"></div>
            </div>
        </div>
    </div>
    <?php
}