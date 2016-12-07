

<body>

<h1>Fiche de présence d'un élève</h1>


<div id='classes-dropdown'  class="col-sm-4" > 
<h4>Choisir une classe : </h4>
<?php
    $attributes = 'class = "form-control" id = "classes" name = "dropdown"';
    print form_dropdown('classes',$classes,'',$attributes);
?>
</div>	


<div id='eleves-dropdown'  class="col-sm-4">
<h4>Choisir un élève : </h4>
	<select name = 'eleves' id="eleves" class="form-control" >
		
	</select>
</div>


<div id='tableauAbsencesLeAppendNestPasLa' class="container">
  <table name = 'tableAbsences' id="tableAbsences" class="table table-striped">
       
  </table>
</div>



</body>

<script type = "text/javascript" src ="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type ="text/javascript">

	$attributes = 'class = "form-control" id = "classes" name = "dropdown"';
	//PREMIER APPEL AJAX -> ajax_SelectEleve se trouve dans le CONTROLLER Fiche_Controller 
	$(document).ready(function(){
		//	Listener sur le classe-dropdown		
		$('#classes-dropdown select').change(function (){
			var selClasse = $(this).val();	
				$.ajax({
					url: "/Absences/index.php/Fiche_Controller/ajax_SelectEleve",    
					async: false,   
					type: "POST",
					data:  "classe_numero="+selClasse,     
					dataType: "html",		
		     		success: function(data){

		     			var dropdownEleves = $('#eleves-dropdown select');
		     			dropdownEleves.empty();


             			 var formEleves = $('#tableAbsences');
              			formEleves.empty();
              			//injecter les données sur la page. 
		     			var eleves = $.parseJSON(data);
		     			$.each(eleves, function(i, eleve) {
		     				dropdownEleves.append('<option value="' + eleve.numero + '">' + eleve.prenom +'  '+ eleve.nom+'</option>');
		     			});
		     		//Aide au débug 
		     		console.log('eleves', eleves);
		     		}    					
				});
		
			});
			
		})


//SECOND APPEL AJAX -> ajax_ficheEleve se trouve dans le CONTROLLER fiche_Controller 
  $(document).ready(function(){
              
        $('#eleves-dropdown select').change(function (){
                                                        
            var selEleve = $("#eleves").val();
            
            $.ajax({             
                url: "/Absences/index.php/Fiche_Controller/ajax_ficheEleve",    
                async: false,   
                type: "POST",
                data:  "eleve_numero="+selEleve,     
                dataType: "html",       
                success: function(data){


                    var tabAbsences = $('#tableAbsences');
                    tabAbsences.empty();
              
              		//Parser la réponse 
                    var absences = $.parseJSON(data);

                    //Création du tableau des absences d'un élève 
                    tabAbsences.append( '<thead><tr><th>Nom du module</th><th>Matieres</th><th>Nombre de période</th><th>Date</th><th>Commentaires</th></tr></thead>');
                    
                    //Boucler sur la réponse 
                    $.each(absences, function(i, absences) {
                       //injection dans la page 
                      tabAbsences.append('<tr> <td>'+ absences.modulesLibelle +'</td><td>'+absences.matieresLibelle +'</td> <td>'+ absences.absencesNbPeriode +'</td> <td>'+ absences.leconsDate +'</td> <td>'+ absences.absencesCommentaire +'</td> </tr>');

                    });
                    //Aide au débug voir -> outils chrome  -> console
                    console.log('absences', absences);

                }                       
            });
    
        });
        
    });


</script>











