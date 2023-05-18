<?php

    // Connexion à la base de données
    $con = mysqli_connect("localhost", "root", "", "chat");

    // Gérer les accents et autres caractères français
    $req = mysqli_query($con, "SET NAMES UTF8");

    if(!$con) {
        // Si la connexion échoue, afficher :
        echo "Connexion échouée";
    }

?>