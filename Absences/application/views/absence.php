		<h1>APPLICATION ABSENCES</h1>
		<a href ="<?php echo base_url(); ?>index.php/home/add" class="btn btn-primary pull-right">Ajouter</a>
		<table class="table table-striped">
		<tr>
		  <th>Numero</th>
		  <th>Nom</th>
		  <th>Prenom</th>
		  <th>Numero Classes</th>
		   <th>Code Classes</th>
		  <th>Modification</th>  
		</tr>  

		<?php	
		

		//le nom des variables composant le resultat sont définis par des alias lors de la requête
		//foreach ($sql->result() as $obj1){		
		//var_dump($obj1); // permet de voir les noms des variables à atteindre
		?>	
			<tr> 			
				 
				 
			 <td>      
				<a class ="btn btn-info btn-xs" href="<?php echo base_url();?>index.php/home/edit/<?php echo $obj1->eleveNum;?>">Modifier </a>  	  
				<a href = "javascript:if(confirm('confirmer la suppresion'))
				  {document.location ='<?php echo base_url();?>index.php/home/delete/<?php echo $obj1->eleveNum;?>'}" 
				  class = "btn btn-danger btn-xs" >Supprimer </a>		
			 </td>
			</tr>				
		<?php	

		
		}		
		?>
   </table>