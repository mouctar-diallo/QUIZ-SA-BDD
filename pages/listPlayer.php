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
    //function edit and delete players
    crudPlayers();
    
    getPlayers();
	$(document).ready( function () {
		$('#example').DataTable();
	});
</script>
