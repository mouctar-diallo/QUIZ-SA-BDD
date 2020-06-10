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
        <tbody id="users">
        <?php
            $query = $bdd->query('SELECT * FROM users WHERE profil = "joueur" ORDER BY score DESC');
            while($result=$query->fetch())
            { ?>
                <tr>
                    <td><?php echo $result['nom'];?></td>
                    <td><?php echo $result['prenom'];?></td>
                    <td><?php echo $result['score'];?></td>
                    <td class="text-center">
                        <a href="#" id='<?=$result['id']; ?>' class="btn btn-primary glyphicon glyphicon-pencil"></a>
                        <a href="#" id='<?=$result['id']; ?>' class= "btn btn-danger glyphicon glyphicon-remove"></a>
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

    getPlayers();
	$(document).ready( function () {
		$('#example').DataTable();
	});
</script>

