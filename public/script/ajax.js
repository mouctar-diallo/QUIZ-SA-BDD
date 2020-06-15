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
            url: "http://localhost/QUIZ-SA-BDD/traitements/getPlayers.php",
            
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
                    <a href="#" id="_id_${users.id}" class= "edit"></a>
                    <a href="#" id="_id_${users.id}" class= "delete"></a>
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

$("#btn-logout").on('click',(e)=>{
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

 })  

 //modification et suppression du joueur

 crudPlayers = ()=>{
     //recuperer la ligne du tr cliqué
    $('.users').click(function(){
        tr = $(this);
   });
   //get firstname
   $(document).on('blur','.firstname',function(){
       id_player = $(this).data('id');
       firstname = $(this).text();
       editPlayers(id_player,firstname,'nom')
   });

   //get lastname
   $(document).on('blur','.lastname',function(){
       id_player = $(this).data('id');
      lastname = $(this).text();
      editPlayers(id_player,lastname,'prenom')
   });
  
   function editPlayers(id_player,newValue,champ_a_modifier){
       $.ajax({
           url: 'traitements/editPlayer.php',
           type: 'POST',
           data:{
               id: id_player,
               value:newValue,
               cible: champ_a_modifier,
           },
           success: function(response){
               alert(response)
           }
       })
   }
  
   //delete
   $(document).on('click','.remove',function(){
      if(confirm("voulez vraiment supprimé le joueur ?")){
           id_player = $(this).find('a').attr('id');
           $.ajax({
               url: 'traitements/removePlayer.php',
               type: 'POST',
               data:{
                   id : id_player,
               },
               success: function(response){
                   if (response=="supprimer") {
                       alert('le joueur a eté supprimer avec succès');
                       //supprimons la ligne correspondante
                       tr.hide( 2000, function() {
                           $( this ).remove();
                       });
                   }else{
                       alert("le joueur n'a pas eté supprimer");
                   }
               }
           })
      }
      return false;
   });
 }

//RECUPERONS LES 5 MEILLEURS PLAYERS


const body = $('#top-players');

$(document).ready(()=>{
    $.ajax({
            type: "POST",
            url: "traitements/getTopPlayers.php",
            dataType: "JSON",
            success: function (data) {
                body.html(' ');
                addLigne(data,body);
            }
    });

    //affiche
function addLigne(data,body){
    $.each(data, (indice,users)=>{
        body.append(`
            <tr class="text-center">
                <td id="_id_${users.id}">${users.nom}</td>
                <td id="_id_${users.id}">${users.prenom}</td>
                <td id="_id_${users.id}">${users.score}</td>
                <td class="text-center">
                    <a href="#" id="_id_${users.id}" class= "edit"></a>
                    <a href="#" id="_id_${users.id}" class= "delete"></a>
                </td>
            </tr>
            `);
        });
    }
});




