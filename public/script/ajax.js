const URL_ROOT="index.php?page";
//connexion de l'utilisateur
function connexionUsers(){

    $(document).on('click','#btn-connexion',(e)=>{
        e.preventDefault()
        var login = $('#login').val();
        var password = $('#password').val();
        if(login == ' ' || password == ' '){
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'traitements/traitement.php',
            data:
            {
                'connexion': 1,
                'login':login,
                'password':password,
            },
            success: function(response)
            {
                if(response=="empty")
                {
                    $('#error-3').html('tout les champs sont  obligatoire');
                } else if(response=="incorrect")
                {
                    $('#error-3').html('login ou mot de passe incorrecte');
                }
                //chargeons la page correspondante sur notre index
                else{
                    window.location.replace(`${URL_ROOT}=${response}`)
                }
            }
        })
    }); 
}
//insert users
function saveUsers(){

    $('#save-player').on('click',(e)=>{
        //e.preventDefault();
        var nom = $('#nom').val();
        var prenom = $('#prenom').val();
        var login = $('#login').val();
        var password = $('#password').val();
        var confirmer = $('#confirmer').val();
        var image = $('#avatar').val();

        $.ajax({
            type: 'POST',
            url: 'traitements/traitement.php',
            data:
            { 
                'inscription':1,
                'nom': nom,
                'prenom': prenom,
                'Login': login,
                'password': password,
                'confirmer':confirmer,
                'image': image,
            },
            success: function(response)
            {
                if(response=='yesLogin'){
                    $('#errorx').html('le login existe dejà');
                }else if(response=='nopassword'){
                    $('#errorx').html('les deux mot de passe doivent etre identiques');
                }else if(response=='empty'){
                    $('#errorx').html('remplissez tout les champs svp');
                }else if(response=='player'){
                    $('#pages').load('index.php');
                }else{
                    $('#pages').load('index.php?page=admin&p=dashbord');
                }
            }
        })
    });
}

getPlayers = ()=>{
    //get joueurs
const tbody = $('#tbody');
$(document).ready(()=>{
    $.ajax({
            type: "POST",
            url: "http://localhost/sonatel_academy/reprise/traitements/getPlayers.php",
            
            dataType: "JSON",
            success: function (data) {
                tbody.html()
                printData(data,tbody);
            }
    });

    //affiche
function printData(data,tbody){
    $.each(data, (indice,users)=>{
        tbody.append(`
            <tr class="text-center">
                <td id="_id_${users.id}">${users.nom}</td>
                <td id="_id_${users.id}">${users.prenom}</td>
                <td id="_id_${users.id}">${users.score}</td>
                <td class="text-center">
                    <a href="#" id="_id_${users.id}" class= "btn btn-primary glyphicon glyphicon-pencil"></a>
                    <a href="#" id="_id_${users.id}" class= "btn btn-danger glyphicon glyphicon-remove"></a>
                </td>
            </tr>
        `);
    });
}
});

}

//appeler la page d'inscription si on clique sur le lien create account
$("#create-player").click((e)=>{
    e.preventDefault();
    const inscription = $('#pages');
    inscription.load(`${URL_ROOT}=create`);
});

//deconnexion users
$("#btn-deconnexion").on('click',(e)=>{
    e.preventDefault();
    window.location.replace('index.php?statut=deconnecter');
});

//navigation du menu de la page d'administration

$(".nav-lien").click(function(){
       
    target=$(this);
    const url= target.attr("lien");
        
    const accueil=$("#accueil");
    accueil.html("")
    accueil.load(`${url}`);
    //window.location.replace(`${url}`);
 })  
 

