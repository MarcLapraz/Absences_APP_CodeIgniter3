<h1><?php echo $titre ?> </h1>



<a href ="<?php echo base_url(); ?>index.php/Matiere_Controller/add" class="btn btn-primary pull-right">Ajouter</a>
<table class="table table-striped">
	<tr>
	  <th>Classe</th>
	  <th>Modules</th>
	  <th>libelle</th>
	  <th>Dotation</th>
	  <th>Modification </th>
	 
	</tr>  

		<?php	
		 
			//le nom des variables composant le resultat sont définis par des alias lors de la requête
			foreach ($sql->result() as $object){		
		    	//var_dump($object); // permet de voir les noms des variables à atteindre

		    /*
				STRUCUTURE DE $object 
				object(stdClass)[23]
				public 'matiereNumero' => int 1
				public 'classeCode' => string '1IGE' (length=4)
				public 'moduleLibelle' => string 'Intro à l'economie' (length=19)
				public 'matiereLibelle' => string 'Apprendre à apprendre' (length=22)
				public 'matiereDotation' => int 10
				public 'moduleNumero' => int 2

				ceci pour toutes les matières ! 

		    */
			
		?>	
	<tr> 					 
		<td><?php echo $object->classeCode;?></td>
		<td><?php echo $object->moduleLibelle;?></td>
		<td><?php echo $object->matiereLibelle;?></td>
		<td><?php echo $object->matiereDotation;?></td>
							 	 
		<td>      
			<a class ="btn btn-info btn-xs" href="<?php echo base_url();?>index.php/Matiere_Controller/edit/<?php echo $object->matiereNumero;?>">Modifier </a>  	  
			<a href = "javascript:if(confirm('confirmer la suppresion'))
			  {document.location ='<?php echo base_url();?>index.php/Matiere_Controller/delete/<?php echo $object->matiereNumero; ?>'}" 
			  class = "btn btn-danger btn-xs" >Supprimer </a>		
		</td>
	</tr>				
	<?php	
	}		
	?>
</table>