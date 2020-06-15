//generation des inputs dynamique page Questionnaire DEBUT
var increment=0;
var control=0;
function dynamique(){
	var type = document.getElementById('type').value
	document.getElementById('type').addEventListener('change',function(e){
		increment = 0;
		var nbre = document.getElementById('nbre').value=0
	});
	if(type=='0')
	{
		alert('choisissez le type svp')
	}else{
		increment++
		var div = document.createElement('div');
		div.setAttribute('id','line'+increment)
		div.setAttribute('class','dynamique')
		var dynamique = document.getElementById('dynamique')
		dynamique.appendChild(div);
		var position = document.getElementById('line'+increment)
		var nbre = document.getElementById('nbre')
		var span = document.createElement('span')
		div.appendChild(span);
		
		if(type=='choixT'){
			control++
			if(control==1)
			{
				nbre.setAttribute('value',+increment)
				champ = document.createElement('input')
				champ.setAttribute('error','error'+increment)
				span.setAttribute('id','error'+increment)
				champ.setAttribute('type','text')
				//champ.setAttribute('required','required')
				champ.setAttribute('class','form-dynamique')
				champ.setAttribute('name','champs')
				champ.setAttribute('placeholder','entrer la reponse')
				position.appendChild(champ)

				var btn_supp = document.createElement('input')
				btn_supp.setAttribute('type','button')
				btn_supp.setAttribute('class','btn-delete')
				btn_supp.setAttribute('name','supprimer'+increment)
				btn_supp.addEventListener('click',function(e){
					deleteChamp(increment);
					increment--;
					var nbre = document.getElementById('nbre').value=increment;
					control = 0;
			});
				position.appendChild(btn_supp)
			}else{alert('un seul champ autorisé pour le type texte')}
		}
			
	if (type=='choixM') 
	{
		//if (increment <= 3) {
			nbre.setAttribute('value',+increment)
			champ = document.createElement('input')
			champ.setAttribute('error','error'+increment)
			span.setAttribute('id','error'+increment)
			champ.setAttribute('type','text')
			champ.setAttribute('class','form-dynamique')
			champ.setAttribute('name','champs'+increment)
			//champ.setAttribute('required','required')
			champ.setAttribute('placeholder','Reponse'+' '+increment)
			position.appendChild(champ)
			//checkbox
			var checkbox = document.createElement('input')
			checkbox.setAttribute('type','checkbox')
			checkbox.setAttribute('name','champs[]')
			checkbox.setAttribute('id','check')
			checkbox.setAttribute('style','margin-left: 2%;')
			checkbox.setAttribute('value','champ'+increment)
			position.appendChild(checkbox);

			var btn_supp = document.createElement('input')
			btn_supp.setAttribute('type','button')
			btn_supp.setAttribute('class','btn-delete')
			btn_supp.setAttribute('name','supprimer'+increment)
			btn_supp.addEventListener('click',function(e){
				deleteChamp(increment);
				increment--;
				var nbre = document.getElementById('nbre').value=increment;
			});
			position.appendChild(btn_supp)
			//obligeons le user de cocher 
			$(function(){
				$('#checked').click(function(){
					var check = $("input[type='checkbox']:checked").length;
					if (check < 1) {
						alert('veuillez cochez au moins deux reponses');
						return false;
					}
				});
			});
	//}else{ alert('trois reponses au maximum')}
			
	}else if(type=='choixS'){
		//if (increment <= 3) {
			nbre.setAttribute('value',+increment)
			champ = document.createElement('input')
			champ.setAttribute('error','error'+increment)
			span.setAttribute('id','error'+increment)
			champ.setAttribute('type','text')
			//champ.setAttribute('required','required')
			champ.setAttribute('class','form-dynamique')
			champ.setAttribute('name','champs'+increment)
			champ.setAttribute('placeholder','Reponse'+' '+increment)
			position.appendChild(champ)
			//radio
			var radio = document.createElement('input')
			radio.setAttribute('type','radio')
			radio.setAttribute('name','champs[]')
			radio.setAttribute('value','champ'+increment)
			radio.setAttribute('style','margin-left: 2%;')
			position.appendChild(radio);

			var btn_supp = document.createElement('input')
			btn_supp.setAttribute('type','button')
			btn_supp.setAttribute('class','btn-delete')
			btn_supp.setAttribute('name','supprimer')
			btn_supp.addEventListener('click',function(e){
				deleteChamp(increment);
				increment--;
				var nbre = document.getElementById('nbre').value=increment;
			});
			position.appendChild(btn_supp)
		//}else{ alert('trois reponses au maximum')}
		//obligeons le user de cocher 
			$(function(){
				$('#checked').click(function(){
					var radio = $("input[type='radio']:checked").val();
					if (!radio) {
						alert('veuillez selectionner la bonne reponse');
						return false;
					}
				});
			});
	}
}
} 
//fonction qui gere la validation des inputs generés
validGenerateInputsFields = ()=>{
	var inputs = $('input');
    for (input of inputs) {
        if (input.hasAttribute('error')) {
            var span = input.getAttribute('error');
            if (!input.value) {
                document.getElementById(span).innerText="ce champ est obligatoire";
                e.preventDefault();
			}else{
				document.getElementById(span).innerText=" ";
			}
		}
	}
}
//gestion des questions
 $('#enregistrer').click(function(event){
	 event.preventDefault();
	var textearea = $('#question').val();
	var nbPoints = $('#error-nbpoints').val();
	var type = $('#type').val();
	//si user commence a saisir on efface le message d'erreur
	$('#question').keyup(function() {
		$('#textearea').html(' ');
	});
	$('#error-nbpoints').keyup(function() {
		$('#nbpoints').html(' ');
	});
	$('#type').change(function() {
		$('#vide').html(' ');
	});
	//tester si les fields sont vides
	if(!textearea.trim()){
		$('#textearea').html('la question est obligatoire *');
		return false;
	}else if(!nbPoints.trim()){
		$('#nbpoints').html('le nombre de points est obligatoire *');
		return false;
	}else if(nbPoints<5){
		$('#nbpoints').html('le nombre de points doit etre superieur a 5');
		return false;
	}else if(type=='0'){
		$('#vide').html('choisissez un type de reponse');
		return false;
	}
	//rassurons de ne pas envoyé de valeur champs vides 
	validGenerateInputsFields();
	//send to server and process response
	form = $('#form')
	var datas = form.serializeArray();
	
	$.ajax({
		url: 'traitements/traitementQuestion.php',
		type: 'POST',
		data: datas,
		
		success: function(response){
			if (response) {
				alert('la question est enregistré avec succès');
				form.trigger("reset");
			}
		}
	});
 })

 $(document).on('click','.ligne',function(){
	row = $(this);
 })
 //******************** REMOVE QUESTIONS  */
 $(document).on('click','.delete',function(){
	if (confirm('voulez-vous supprimez la question ?')) {
		var id_question = $(this).attr('id');
		$.ajax({
			url : 'traitements/removeQuestion.php',
			type : 'POST',
			data :{
				id_question,
			},
			success : function(response){
				if (response=="supprimer") {
					alert('suppression réussi');
					row.hide('fast', function(){
						$( this ).remove();
					})
				}
			}
		})
	}
	return false;
 })
  //******************** UPDATE QUESTIONS  */
 $(document).on('click','.update',function(){
	var id = $(this).attr('id');
	alert(id)
 })

 
//*************************************************************************************************
function deleteChamp(l){
	var supprimer = document.getElementById('line'+l);
	supprimer.remove();
}


function ifChange(){
	var dynam = document.getElementById('dynamique');
	dynam.innerHTML=" ";
}

$('#type').change((venet)=>{
	ifChange();
})
//generation des inputs dynamique
$('#add').click(function(event){
	event.preventDefault();
    dynamique();
})

