<?php
    // Démarrer la session
    session_start();

    if(!isset($_SESSION['user'])) {
        // Si l'utilisateur n'est pas connecté
        // Rediriger vers la page de connexion
        header("location:index.php");
    }

    // Destruction de toutes les sections
    session_destroy();

    // redirection vers la page de connexion
    header("location:index.php");
?>