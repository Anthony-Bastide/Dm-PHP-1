<?php
session_start();
require_once("bdd.php");
require_once("./include/function.php");
if(!is_connected($_SESSION['id'])){
    header('Location:prohibition.php');
}
$id_user = $_SESSION['id'];
$user = recup_table_users_by_id($id_user, $bdd);
$tab_friend = recup_table_friend_user($id_user, $bdd);
$tab_group = recup_table_groupe_user($id_user, $bdd);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./librairie/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./dist/css/style_chat.css">
    <title>Document</title>
</head>
<body>

    <div class="modal fade modal-lg " id="modify_profil" tabindex="-1" aria-labelledby="modify_profilLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modify_profilLabel">Modification du Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="update_profil" enctype="multipart/form-data" onsubmit="return update_profil(event);">
                <div class="modal-body">
                    <div class="row" id="name_surname_profil">
                        <div class="col-6" id="name">
                            <label for="name">Nom :</label>
                            <input type="text" name="name" value="<?= $user['name'] ?>" class="form-control" required>
                        </div>
                        <div class="col-6" id="surname">
                            <label for="surname">Prenom :</label>
                            <input type="text" name="surname" value="<?= $user['surname'] ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="row" id="file_profil">
                        <div class="col-9" id="input_file">
                            <label for="file_img" class="form-label">Nouvelle Image de Profil :</label>
                            <input class="form-control" title="Le fichier doit être une image (jpg, jpeg, png)" id="file_img" name="file_img" type="file">
                        </div>
                        <div class="col-3">
                            <img class="img_profile" src="./dist/img/profile/<?php if($user['img']!=""){echo $user['img'];}else{echo 'profile.png';} ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8 offset-md-2">
                            <label for="description">Description Profil :</label>
                            <textarea name="description" class="form-control"><?= $user['description'] ?></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?= $id_user ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Sauvegarder les Modifications</button>
                </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">

        <div class="col-3">
            <div class="card" id="card_profile">
                <div class="card-image">
                    <img src="./dist/img/profile/<?php if($user['img']!=""){echo $user['img'];}else{echo 'profile.png';} ?>">
                </div>
                <div class="card-body">
                    <div class="card-title">
                        <h3><?= $user['surname']." ".$user['name'] ?></h3>
                    </div>
                    <div class="card-excerpt">
                        <br>
                        <p><?= $user['description'] ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6" id="body_chat">
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Tchat</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="chat.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modify_profil">Profil</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Ami(e)s
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="add_friend.php">Ajouter un Ami(e)</a></li>
                                <li><a class="dropdown-item" href="del_friend.php">Supprimer un Ami(e)</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="add_group.php">Ajouter un Groupe</a></li>
                                <li><a class="dropdown-item" href="del_group.php">Supprimer un Groupe</a></li>
                                <li><a class="dropdown-item" href="update_group.php">Modifier un Groupe</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="disconect.php">Déconnexion</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    </div>
                </div>
            </nav>
            <div class="card" id="card_chat">
                <div class="card-body">
                    <span class="card-title" id="card-title">Chat</span>
                    <form method="POST" id="add_message_form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-4 offset-md-4">
                                <label for="group_name">Nom du Groupe :</label>
                                <select class="form-select" type="text" name="group_name" id="group_name" onchange="chat_poster(this)" required>
                                    <option></option>
                                    <?php
                                        foreach($tab_group as $group){
                                            ?>
                                                <option value="<?= $group['id'] ?>"><?= $group['name'] ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div id="chat_poster">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card" id="card_friend">
                <div class="card-body">
                    <div class="card-title">
                        <h3 id="tilte_friend">Liste d'Amis</h3>
                    </div>
                    <div class="card-excerpt">
                        <br>
                        <table id="table_list_name">
                            <tbody>
                                <?php
                                if (!empty($tab_friend)) {
                                    foreach($tab_friend as $friend)
                                    {
                                        ?>
                                        <tr>
                                            <td id="td_list_img">
                                                <img class="image-rond image-ronde-profile" src="./dist/img/profile/<?php if($friend['img']!=""){echo $friend['img'];}else{echo 'profile.png';} ?>">
                                            </td>
                                            <td id="name_list">
                                                <p class="list_name"><?= $friend['name']."-".$friend['surname'] ?></p>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <a class="a_see_more" href="#">Voir Plus</a>
                    </div>
                </div>
            </div>
        </div>  

    </div>

</body>
<script src="./librairie/bootstrap/js/bootstrap.bundle.js"></script>
<script src="./dist/js/tchat.js"></script>
</html>