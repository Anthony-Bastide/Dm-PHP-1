<?php
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=tchat;charset=utf8', 'root', '');
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
?>