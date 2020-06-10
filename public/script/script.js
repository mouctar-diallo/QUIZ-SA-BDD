var login = document.getElementById('login');
var password = document.getElementById('password');
var btn_deconnexion = document.getElementById('btn-deconnexion');
var authentification = document.getElementById('authentification');
var text_header = document.getElementById('text');
var inscript = document.getElementById('inscript');

if (inscript) {
    btn_deconnexion.remove();
}
//modifie le texte du header si on est dans la page admin
var page_accueil = document.getElementById('accueil');
if(page_accueil){
    text_header.innerText="Welcome to administration page";
}
//supprime le bouton deconnexion si on est a la page d'accueil index
if(authentification){
    btn_deconnexion.remove();
}