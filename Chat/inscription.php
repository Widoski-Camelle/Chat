<?php
    // Démarrer la session
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | Chat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        if(isset($_POST['button_inscription'])) {
            // Si le formulaire est envoyé
            // Se connecter à la base de données
            include "connexion_bdd.php";

            // Extraire les données du formulaire
            extract($_POST);

            // Vérifions si les champs sont vides
            if(isset($email) && isset($mdp1) && isset($mdp2) && $email != "" && $mdp1 != "" && $mdp2 != "") {
                // Vérifions que les mots de passe sont conformes
                if($mdp2 != $mdp1) {
                    // S'ils sont différents
                    $error = "Les mots de passe sont différents";
                } else {
                    // Si non, vérifions si l'email existe
                    $req = mysqli_query($con, "SELECT * FROM utilisateurs WHERE email = '$email'");
                    if(mysqli_num_rows($req) == 0) {
                        // Si l'email n'existe pas, créons le compte
                        $req = mysqli_query($con, "INSERT INTO utilisateurs VALUES (NULL, '$email', '$mdp1')");
                        if($req) {
                            // Si le compte a été créé, créons une variable pour afficher un message dans la page de connexion
                            $_SESSION['message'] = "<p class='message_inscription'>Votre compte a été créé avec succès !</p>";
                            // Redirection sur la page de connexion
                            header("location:index.php");
                        } else {
                            // Si non
                            $error = "Inscription échouée";
                        }
                    } else {
                        // Si l'email existe
                        $error = "Cet email existe déjà";
                    }
                }
            } else {
                // Si les champs sont vides
                $error = "Veuillez remplir tous les champs";
            }
        }
    ?>

    <form action="" method="POST" class="form_connexion_inscription">
        <h1>INSCRIPTION</h1>
        <p class="message_error">
            <?php
            // Affichons l'erreur
                if(isset($error)) {
                    echo $error;
                }
            ?>
        </p>

        <label>Email</label>
        <input type="email" name="email">

        <label>Mots de passe</label>
        <input type="password" name="mdp1" class="mdp1">

        <label>Confirmation Mots de passe</label>
        <input type="password" name="mdp2" class="mdp2">

        <input type="submit" value="Inscription" name="button_inscription">
        <p class="link">Vous avez un compte ? <a href="index.php">Se connecter</a></p>
    </form>
    
    <script src="script.js"></script>
</body>
</html>