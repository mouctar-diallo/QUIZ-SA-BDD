//VALIDATION FORM
var inputs = document.getElementsByTagName('input');
//masquez le message d'erreur  si l e user  commence a saisir	
for (input of inputs) {
    input.addEventListener('keyup',function(e){
        if (e.target.hasAttribute('error')) {
            var span = e.target.getAttribute('error');
            document.getElementById(span).innerText="";
        }
    })
}
//verifions si les fiels ne sont pas vides
document.getElementById('form').addEventListener('submit',function(e){
   
    var inputs = document.getElementsByTagName('input');
    var erreur = false;
    for (input of inputs) {
        if (input.hasAttribute('error')) {
            var span = input.getAttribute('error');
            if (!input.value) {
                document.getElementById(span).innerText="ce champ est obligatoire"
                e.preventDefault();
            }else{
                document.getElementById(span).innerText=""
                //appelons la fonction ajax nous permettant de communiquer avec le serveur
                connexionUsers();
                saveUsers()
            }
        }
    }
    return false;
});
//END
//fonction qui gere l'affichage de l'image
var loadFile = function(event) {
var reader = new FileReader();
reader.onload = function(){
    var output = document.getElementById('output');
    output.src = reader.result;
};
reader.readAsDataURL(event.target.files[0]);
};
//fin