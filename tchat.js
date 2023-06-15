function registration(event){
    event.preventDefault();
    var password = document.getElementById("password").value;
    var password2 = document.getElementById("password2").value;
    if(password == password2){
        var formElem = document.getElementById("registration_form");
        var formdata = new FormData(formElem);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "include/js/registration.php");
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if(response.status === 'success'){
                    window.location.href = '/tchat/index.php'; 
                } 
                else {
                    window.location.href = '/tchat/known.php'; 
                }
            }
            else {
                alert("Erreur lors de l'envoi de la requête.");
            }
        };
        xhr.send(formdata);
    }
    else{
        document.getElementById("password2").className = "form-control is-invalid";
        alert("Erreur les deux mot-pass sont pas identique.");
    }
}
function connection(event){
    event.preventDefault();
    var formElem = document.getElementById("connection_form");
    var formdata = new FormData(formElem);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "include/js/connection.php");
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if(response.status === 'success'){
                window.location.href = '/tchat/chat.php'; 
            } 
            else {
                window.location.href = '/tchat/unknown.php'; 
            }
        }
        else {
            alert("Erreur lors de l'envoi de la requête.");
        }
    };
    xhr.send(formdata);
}
function update_profil(event){
    event.preventDefault();
    var formElem = document.getElementById("update_profil");
    var formdata = new FormData(formElem);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "include/js/update_profil.php");
    xhr.onload = function() {
        if (xhr.status === 200) {
            if(xhr.responseText.length > 0) {
                var response = JSON.parse(xhr.responseText);
                switch (response.status) {
                    case 'error_extension':
                        document.getElementById("file_img").className = "form-control is-invalid";
                        alert("Erreur : Veuillez ne mettre que des images");
                        break;
                    case 'error_move':
                        document.getElementById("file_img").className = "form-control is-invalid";
                        alert("Erreur : Veuillez ressayer plus tard nous avons un petit problème");
                        break;
                    case 'error_size':
                        document.getElementById("file_img").className = "form-control is-invalid";
                        alert("Erreur : Image es trop grande");
                        break;
                    case 'success':
                        window.location.reload();
                        break;
                }
            }
        }
        else {
            alert("Erreur lors de l'envoi de la requête.");
        }
    };
    xhr.send(formdata);
}
function add_friend(event){
    event.preventDefault();
    var formElem = document.getElementById("form_add_friend");
    var formdata = new FormData(formElem);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "include/js/add_friend.php");
    xhr.onload = function() {
        if (xhr.status === 200) {
            if(xhr.responseText.length > 0) {
                var response = JSON.parse(xhr.responseText);
                switch (response.status) {
                    case 'error':
                        document.getElementById("mail").className = "form-control is-invalid";
                         alert("Erreur : On ne connaît pas cette adresse mail");
                        break;
                    case 'known':
                        document.getElementById("mail").className = "form-control is-invalid"; 
                        alert("Erreur : Vous avez déja en ami(e)");
                        break;
                    case 'error_mail':
                        document.getElementById("mail").className = "form-control is-invalid"; 
                        alert("Erreur : C'est votre adresse mail");
                        break;
                    case 'success':
                        window.location.href = '/tchat/chat.php';
                        break;
                }
            }
        }
        else {
            alert("Erreur lors de l'envoi de la requête.");
        }
    };
    xhr.send(formdata);
}
function del_friend(event){
    event.preventDefault();
    var formElem = document.getElementById("del_friend_form");
    var formdata = new FormData(formElem);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "include/js/del_friend.php");
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if(response.status === 'success'){
                window.location.href = '/tchat/chat.php'; 
            } 
        }
        else {
            alert("Erreur lors de l'envoi de la requête.");
        }
    };
    xhr.send(formdata);
}
function add_group(event){
    event.preventDefault();
    var formElem = document.getElementById("add_group_form");
    var formdata = new FormData(formElem);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "include/js/add_group.php");
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if(response.status === 'success'){
                window.location.href = '/tchat/chat.php'; 
            } 
            else {
                document.getElementById("group_name").className ="form-control is-invalid"; 
                alert("Erreur : Ce nom de groupe est deja utiliser");
            }
        }
        else {
            alert("Erreur lors de l'envoi de la requête.");
        }
    };
    xhr.send(formdata);
}
function del_group(event){
    event.preventDefault();
    var formElem = document.getElementById("del_group_form");
    var formdata = new FormData(formElem);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "include/js/del_group.php");
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if(response.status === 'success'){
                window.location.href = '/tchat/chat.php'; 
            } 
        }
        else {
            alert("Erreur lors de l'envoi de la requête.");
        }
    };
    xhr.send(formdata);
}
function update_group(event){
    event.preventDefault();
    var formElem = document.getElementById("update_group_form");
    var formdata = new FormData(formElem);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "include/js/update_group.php");
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if(response.status === 'success'){
                window.location.href = '/tchat/chat.php'; 
            } 
            else
            {
                document.getElementById("group_name").className ="form-control is-invalid"; 
                alert("Erreur : Vous devait choisir un groupe");
            }
        }
        else {
            alert("Erreur lors de l'envoi de la requête.");
        }
    };
    xhr.send(formdata);
}
function add_message(event){
    event.preventDefault();
    var formElem = document.getElementById("add_message_form");
    var formdata = new FormData(formElem);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "include/js/add_message.php");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if(response.status === 'success'){
                reload_chat_poster();
            } 
            else
            {
                document.getElementById("new_message").className ="form-control is-invalid"; 
                alert("Erreur : Il faut envoyer un message");
            }
        }
        else if (xhr.readyState === 4) {
            alert("Erreur lors de l'envoi de la requête.");
        }
    };
    xhr.send(formdata);
}
function update_group_poster(select_element) {
    var selected_value = select_element.options[select_element.selectedIndex].value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("update_poster").innerHTML = xhr.responseText;
        }
    };
    xhr.open("POST", "include/js/update_group_poster.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("group=" + selected_value);
}
function chat_poster(select_element) {
    var selected_value = select_element.options[select_element.selectedIndex].value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("chat_poster").innerHTML = xhr.responseText;
        }
    };
    xhr.open("POST", "include/js/chat_poster.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("group=" + selected_value);
}
function reload_chat_poster() {
    var selected_value = document.getElementById("group_name").value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("chat_poster").innerHTML = xhr.responseText;
        }
    };
    xhr.open("POST", "include/js/chat_poster.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("group=" + selected_value);
}