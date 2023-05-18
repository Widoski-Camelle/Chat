            <?php
                // Démarrer la session
                session_start();
                
                if(isset($_SESSION['user'])) { // Si l'ulisateur s'est connecté
                    // Connexion à la base de données
                    include "connexion_bdd.php";

                    // Requête pour afficher les messages
                    $req = mysqli_query($con, "SELECT * FROM messages ORDER BY id_m DESC");
                    if(mysqli_num_rows($req) == 0) {
                        // S'il n'y a pas encore de messages
                        echo "Messagerie vide";
                    } else {
                        // Si oui
                        while($row = mysqli_fetch_assoc($req)) {
                            // Utiliser ce format si c'est vous l'auteur du message
                            if($row['email'] == $_SESSION['user']) {
                                ?>

                                    <div class="message your_message">
                                        <span>Vous</span>
                                        <p><?=$row['msg']?></p>
                                        <p class="date"><?=$row['date']?></p>
                                    </div>

                                <?php
                            } else {
                                // Utiliser ce format si ce n'est pas vous l'auteur du message
                                ?>

                                    <div class="message others_message">
                                        <span><?=$row['email']?></span>
                                        <p><?=$row['msg']?></p>
                                        <p class="date"><?=$row['date']?></p>
                                    </div>

                                <?php
                            }
                        }
                    }
                }
            ?>