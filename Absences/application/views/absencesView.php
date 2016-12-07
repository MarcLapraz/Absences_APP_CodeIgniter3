<body>

	<h1>Saisie d'une nouvelle lecon </h1>
	<?php echo validation_errors(); ?> 	
	<form method="post" name="myForm1" id="myForm" enctype="multipart/form-data" >

	<div class="container-fluid">

		<div id='classes-dropdown'  class="col-md-3"> 
			<?php
				$attributes = 'class = "form-control" id = "classes" name = "dropdown"';
				print form_dropdown('classes',$classes,'',$attributes);
			?>
		</div>	

		<div id='matieres-dropdown'  class="col-md-3">
			<select name = 'matieres' id="matieres" class="form-control" ></select>
		</div>

		<div id='datepicker'  class="col-md-2">
			<input type="date" name="datepicker" id = "datepicker" class = "form-control">
		</div>

		<div id='nbPeriodes-dropdown' class="col-md-2">
			<select name = 'periode'  id="periode" class="form-control">
				<option value="1">1 période </option>
				<option value="2">2 périodes </option>
				<option value="3">3 périodes </option>
				<option value="4">4 périodes </option>
				<option value="5">5 périodes </option>
				<option value="6">6 périodes </option>
				<option value="7">7 périodes </option>
				<option value="8">8 périodes </option>
				<option value="9">9 périodes </option>
				<option value="10">10 périodes </option>
			</select>
		</div>

		<div id='submitbutton' class="col-md-2">
			<button id="submitbutton" type="button" class="btn btn-primary">Primary</button>
		</div>

		<div id='deletebutton' class="col-md-2 hidden" >
			<button id='deletebutton' type="button" class="btn btn-danger">Danger</button>
		</div>
	
	</div>
</form>
	
	
<div id='tableauEleveLeAppendNestPasLa' class="container">
	<table name = 'tableEleves' id="tableEleves" class="table table-striped"></table>
</div>

  
<script type ="text/javascript">
// load eleves + absences si existe...
$(document).ready(function(){
    $('input[type="date"]').change(function(){
        
        //alert(this.value);         
		var numMatiere = $('#matieres').val();
		var classes = $('#classes').val();
        var inputDate = this.value;

        $.ajax({

				url: "/Absences/index.php/Absence_Controller/ajax_CheckLecon",    
				async: false,   
				type: "POST",
				data: {date: inputDate, numeroMatiere: numMatiere, classe : classes},  
				dataType: "html",		
	     		success: function(data){
	     		var tabEleves = $('#tableEleves');
	     		
                var ArrayEleves = $.parseJSON(data);
           
          		console.log(ArrayEleves) ; 

          		var eleves = ArrayEleves.eleves ; 
          	
 				tabEleves.append( '<thead><tr><th>Eleves Numero </th><th>Eleve </th><th>nb période </th><th>commentaire </th></tr></thead><tbody>');


                $.each(eleves, function (i,eleves)
                {
                	var classesAdd = '' ; 

                	if (eleves.nbPeriode > 0 ){

                		classesAdd = 'valid insert'

                	} 

					tabEleves.append('<tr > <td class="col-md-2" >'+ eleves.eleveNumero +'</td><td class="col-md-4">'+eleves.eleveNom +' '+ eleves.elevePrenom  + '</td> <td class="col-md-2"><select id ="test" class="form-control '+classesAdd +'" onchange="myFunction2(this)"> '+
							'<option selected= "selected"> '+eleves.nbPeriode+' </option>'+ 
							'<option  value="0">0</option>'  +	
							'<option  value="1">1</option>' +
							'<option  value="2">2 </option>' +
							'<option  value="3">3 </option>' +
							'<option  value="4">4 </option>' +
							'<option  value="5">5 </option>' +
							'<option  value="6">6 </option>' +
							'<option  value="7">7 </option>' +
							'<option  value="8">8 </option>' +
							'<option  value="9">9 </option> </select > </td> <td>  <input type="text" class="form-control" id="commentaire"> </td></tr>'
							);			
                });

                tabEleves.append('</tbody>') ;    
	     		}    					
	 					
			});

    });
});


</script>

<script type ="text/javascript">
	//attendre que le dom soit complet
	//Le changement de la classe selectionnée $('#classes-dropdown select') va entrainer une mise à jour des matières disponibles. 

	$(document).ready(function(){	
		$('#classes-dropdown select').change(function (){
			var classeNumero = $(this).val();
			$.ajax({

				url: "/Absences/index.php/Absence_Controller/ajax_MatieresByClasseNumero",    
				async: false,   
				type: "POST",
				data:  "classeNumero="+classeNumero,     
				dataType: "html",		
	     		success: function(data){
	     			//dropdownMatieres réf le select de la liste déroulante :
	     			var dropdownMatieres = $('#matieres-dropdown select');
	     			dropdownMatieres.empty();

          			//L'appel ajax est un succès, on peut parser la réponse.
	     			var matieres = $.parseJSON(data);
	     			$.each(matieres, function(i, matiere) {
	     				dropdownMatieres.append('<option value="'+ matiere.matieresNumero + '">' 
	     				+ matiere.matieresLibelle +'</option>');
	     			});
	     		}    					
			});
		});			
	})
	</script>
  	


  	<script type ="text/javascript">
  	//attendre que le dom soit complet...
  	//la réponse est sous la forme {pkLecon: "351", eleves: [,…]} encodée en JSON. Il faut donc commencer par parser la réponse
  	//avant de pouvoir atteindre les données. 
	$(document).ready(function(){
		$('#submitbutton').click(function (e){	
			$.ajax({
				url: "/Absences/index.php/Absence_Controller/ajax_saveForm",    
				async: false,   
				type: "POST",
				//cette technique fonctionne mais ne permet pas de nommer le tablea
				data: $("#myForm").serialize(), 
				dataType: "html",		
	     		success: function(data){

	     		//Présentation des bouttons..
	 			var submitButton = $('#submitbutton');
	     		submitButton.hide();	
	     		var tabEleves = $('#tableEleves');
                tabEleves.empty();

                var ArrayElevesAndPKLecon = $.parseJSON(data);
                //atteindes les matieres
           		var eleves = ArrayElevesAndPKLecon.eleves ; 
           		//ON EN A BESOIN PLUS LOIN...
           		var pkLecon = ArrayElevesAndPKLecon.pkLecon ; 
           		//variable globale à la page...
           		window.pk = pkLecon ; 
           	

           		//tabEleves est une Table html => pas de balise <table></table> car elles existent déja...
                tabEleves.append( '<thead><tr><th>Eleves Numero </th><th>Eleve </th><th>nb période </th><th>commentaire </th></tr></thead><tbody>');

                $.each(eleves, function (i,eleves)
                {
					tabEleves.append('<tr > <td class="col-md-2" >'+ eleves.eleveNumero +'</td><td class="col-md-4">'+eleves.eleveNom +' '+ eleves.elevePrenom +'</td> <div id ="sel" ><td class="col-md-2"><select id ="test" class="form-control" onchange="myFunction2(this)"></div> <option value="0">0 période</option>' +
							'<option value="1">1 périodes</option>' +
							'<option value="2">2 périodes</option>' +
							'<option value="3">3 périodes</option>' +
							'<option value="4">4 périodes</option>' +
							'<option value="5">5 périodes</option>' +
							'<option value="6">6 périodes</option>' +
							'<option value="7">7 périodes</option>' +
							'<option value="8">8 périodes</option>' +
							'<option value="9">9 périodes</option> </select> </td> <td>  <input type="text" class="form-control" id="commentaire"> </td></tr>');
                });
                tabEleves.append('</tbody>') ; 
	     		}    					
			});
		});
	})

//Cette fonction permet d'envoyer une requête Ajax en fonction de la class appliquée à l'élément Select de la table
//PARAM : thisSelect refère this du select de la table.
//Système d'ajout et suppresion de classe pour détecter l'opération désirée. (insert, update ou delete)
	function myFunction2(thisSelect) {
		
		//Depuis la liste déroulante, on remonte de 2 niveaux. On récupère la ligne complète lors de chaque event. "onchange"
		var row =  $(thisSelect).parent().parent();
		//Depuis la ligne, rechercher le numéro de l'élève ainsi que les commsntaire
		var numEleve = row[0].cells[0].innerText;
		var commentaire = row[0].cells[3].children[0].value;
		//Si la valeur sélectionnée est égale à zéro, l'utilisateur désire faire un delete

		//La valeur select dans la liste passe de X>0 -> 0 
		if (thisSelect.value == 0){

			$(thisSelect).removeClass('valid') ; 
			$(thisSelect).removeClass('insert') ; 
			$(thisSelect).removeClass('update') ; 
			alert ('delete') ; 
				$.ajax({					
				url: "/Absences/index.php/Absence_Controller/ajax_deleteAbsence",    
				async: false,   
				type: "POST",
				data: {nbPeriode: thisSelect.value, numeroEleve: numEleve, leconNumero: window.pk, commentaire : commentaire},  
				dataType: "html",		
				success: function(data){
				//ALERT INSERE !!!

				}    					
			});
    	} 
    	//le premier évenenemnt doit forcément être un insert 
    	else if (!$(thisSelect).hasClass('valid')){

    		$(thisSelect).addClass('valid') ; 
    		$(thisSelect).addClass('insert') ; 
    		alert ('insert') ; 
	    	$.ajax({					
				url: "/Absences/index.php/Absence_Controller/ajax_insertAbsence",    
				async: false,   
				type: "POST",
				data: {nbPeriode: thisSelect.value, numeroEleve: numEleve, leconNumero: window.pk, commentaire : commentaire},  
				dataType: "html",		
				success: function(data){
				//TO DO : ALERT

				}    					
			});

    	} 
    	// si il y a deja eu un insert ou un update,l'utilisateur doit pouvoir faire uniquement un update.
    	else if ($(thisSelect).hasClass('insert') || $(thisSelect).hasClass('update')){

			$(thisSelect).addClass('update') ; 
			$(thisSelect).removeClass('insert') ;
			alert ('update') ; 
				$.ajax({					
				url: "/Absences/index.php/Absence_Controller/ajax_updateAbsence",    
				async: false,   
				type: "POST",
				data: {nbPeriode: thisSelect.value, numeroEleve: numEleve, leconNumero: window.pk, commentaire : commentaire},  
				dataType: "html",		
				success: function(data){
				//ALERT INSERE !!!

				}    					
			});

    	} 
}

</script>






<script type="text/javascript">

//cette fonction ajoute un listener sur le bouton submit	
$(document).ready(function(){
	$("#submitbutton").click(function() {
	$('#deletebutton').removeClass('hidden');
	$('#periode').attr("disabled", true); 

	$('#matieres').attr("disabled", true); 
	$('#classes').attr("disabled", true); 
	$('#bday').attr("disabled", true); 
    });
});

</script>















</body>





</html>

