		<h1>Gestion des élèves</h1>
		<a href ="<?php echo base_url(); ?>index.php/Eleve_Controller/addNewEleve" class="btn btn-primary pull-right">Ajouter</a>
		<table class="table table-striped">
		<tr>
		 
		  <th>Nom</th>
		  <th>Prenom</th>	
		  <th>Code Classes</th>
		  <th>Modification</th>  
		</tr>  

		<?php			 
		//le nom des variables composant le resultat sont définis par des alias lors de la requête
		foreach ($sql->result() as $object){		
		//var_dump($object); // permet de voir les noms des variables à atteindre
		?>	
			<tr> 			
				
				 <td><?php echo $object->eleveNom;?></td>
				 <td><?php echo $object->elevePrenom;?></td>		
				 <td><?php echo $object->classeCode;?></td>
				 
			 <td>      
				<a class ="btn btn-info btn-xs" href="<?php echo base_url();?>index.php/Eleve_Controller/edit/<?php echo $object->eleveNumero;?>">Modifier </a>  	  
				<a href = "javascript:if(confirm('confirmer la suppresion'))
				  {document.location ='<?php echo base_url();?>index.php/Eleve_Controller/delete/<?php echo $object->eleveNumero;?>'}" 
				  class = "btn btn-danger btn-xs" >Supprimer </a>		
			 </td>
			</tr>				
		<?php	

		
		}		
		?>
   </table>