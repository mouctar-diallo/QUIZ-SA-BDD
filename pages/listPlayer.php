<h1 class="text-center">Liste des joueurs</h1>
<div class="col-md-12">
    <table class="table table-striped table-bordered table-hover" id="example">
        <thead>
            <tr>
                <th class="bg-primary text-white">nom</th>
                <th class="bg-primary text-white">prenom</th>
                <th class="bg-primary text-white">score</th>
                <th class="bg-danger text-white">action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $query = $bdd->query('SELECT * FROM users WHERE profil = "joueur" ORDER BY score DESC');
            while($result=$query->fetch())
            { ?>
                <tr class="users">
                    <td class="firstname"  contenteditable="true"  data-id='<?=$result['id']; ?>' ><?php echo $result['nom'];?></td>
                    <td class="lastname"  contenteditable="true" data-id='<?=$result['id']; ?>' ><?php echo $result['prenom'];?></td>
                    <td><?php echo $result['score'];?></td>
                    <td class="text-center">
                        <button class="modify glyphicon glyphicon-pencil bg-primary"><a href="#" id='<?=$result['id']; ?>'></a></button>
                        <button class="remove glyphicon glyphicon-remove bg-danger"><a href="#" id='<?=$result['id']; ?>'></a></button>
                    </td>
                </tr>
            <?php
            }
        ?> 
        </tbody>
    </table>
</div>
</div>
<script>
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
    getPlayers();
	$(document).ready( function () {
		$('#example').DataTable();
	});
</script>
