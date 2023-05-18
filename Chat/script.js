// Confirmation du mot de passe
// Vérifions si le mot de passe et sa confirmation sont conformes
var mdp1 = document.querySelector('.mdp1');
var mdp2 = document.querySelector('.mdp2');

mdp2.onkeyup = function() {
    // Evénement quand on écrit dans le champ : Confirmation du mot de passe
    message_error = document.querySelector('.message_error');

    if(mdp1.value != mdp2.value) {
        message_error.innerText = "Les mots de passe ne sont pas conformes !";
    } else {
        message_error.innerText = "";
    }
}