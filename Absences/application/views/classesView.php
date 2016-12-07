		<h1><?php echo $titre ?></h1>
		<a href ="<?php echo base_url(); ?>index.php/Classe_Controller/addNewClasse" class="btn btn-primary pull-right">Ajouter</a>
		<table class="table table-striped">
		<tr>
		
		  <th>Code</th>
		  <th>Modification</th>
		  
		</tr>  

		<?php	
		 
		//le nom des variables composant le resultat sont définis par des alias lors de la requête
		foreach ($sql->result() as $object){		
		?>	
			<tr> 			
				 
				 <td><?php echo $object->classeCode;?></td>
			
				 
			 <td>      
				<a class ="btn btn-info btn-xs" href="<?php echo base_url();?>index.php/Classe_Controller/edit/<?php echo $object->classeNum;?>">Modifier </a>  	  
				<a href = "javascript:if(confirm('confirmer la suppression'))
				  {document.location ='<?php echo base_url();?>index.php/Classe_Controller/delete/<?php echo $object->classeNum;?>'}" 
				  class = "btn btn-danger btn-xs" >Supprimer </a>		
			 </td>
			</tr>				
		<?php	

		
		}		
		?>
   </table>