<?php
    // Démarrer la session
    session_start();

    if(!isset($_SESSION['user'])) {
        // Si l'utilisateur n'est pas connecté
        // Rediriger vers la page de connexion
        header("location:index.php");
    }

    $user = $_SESSION['user']; // Email de l'utilisateur
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$user?> | Chat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="chat">
        <div class="button-email">
            <span><?=$user?></span>
            <a href="deconnexion.php" class="Deconnexion_btn">Déconnexion</a>
        </div>

        <!-- Messages -->
        <div class="messages_box">Chargement ...</div>
        <!-- Fin Messages -->

        <?php
            // Envoi des messages
            if(isset($_POST['send'])) {
                // Récupérons le message
                $message = $_POST['message'];
                
                // Connexion à la base de données
                include "connexion_bdd.php";

                // Echappons les caractères spéciaux
                $message = mysqli_real_escape_string($con, $message);

                // Vérifions si le champs n'est pas vide
                if(isset($message) && $message != "") {
                    // Insérer le message dans la base de données
                    $req = mysqli_query($con, "INSERT INTO messages VALUES (NULL, '$user', '$message', NOW())");
                    // On actualise la page
                    header('location:chat.php');
                } else {
                    // Si le message est vide, on actualise la page
                    header('location:chat.php');
                }
            }
        ?>

        <form action="" class="send_message" method="POST">
            <textarea name="message" cols="30" rows="2" placeholder="Votre message"></textarea>
            <input type="submit" value="Envoyé" name="send">
        </form>
    </div>
    
    <script>
        // Actualisation automatique du chat avec AJAX
        var message_box = document.querySelector('.messages_box');
        setInterval(function() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200) {
                    message_box.innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "messages.php", true); // Récupération de la page Messages
            xhttp.send()
        }, 500); // Actualiser le chat tous les 500ms
    </script>
</body>
</html>