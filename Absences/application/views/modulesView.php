	<h1>Gestion des modules</h1>
	<a href ="<?php echo base_url(); ?>index.php/Module_Controller/add" class="btn btn-primary pull-right">Ajouter</a>
	<table class="table table-striped">
		<tr>
		  <th>Classes</th>
		  <th>Libelle</th>
		  <th>Modification</th>  
		</tr>  

		<?php	
		 
		//le nom des variables composant le resultat sont définis par des alias lors de la requête
		foreach ($sql->result() as $object){		
		//var_dump($object); // permet de voir les noms des variables à atteindre

		/*

		object(stdClass)[23]
 		public 'modulenumero' => int 2
  		public 'moduleslibelle' => string 'Intro à l'economie' (length=19)
  		public 'classescode' => string '1IGE' (length=4)
  		public 'classesnum' => int 1

  		ceci pour tous les modules...		
		*/
		?>	
		<tr> 			
			<td><?php echo $object->classescode;?></td>
			<td><?php echo $object->moduleslibelle;?></td>
	
				 
			<td>      
				<a class ="btn btn-info btn-xs" href="<?php echo base_url();?>index.php/Module_Controller/edit/<?php echo $object->modulenumero;?>">Modifier </a>  	  
				<a href = "javascript:if(confirm('confirmer la suppresion'))
				  {document.location ='<?php echo base_url();?>index.php/Module_Controller/delete/<?php echo $object->modulenumero;?>'}" 
				  class = "btn btn-danger btn-xs" >Supprimer </a>		
			</td>
		</tr>	

		<?php	
		}		
		?>

   </table>