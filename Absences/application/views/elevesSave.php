
<?php
	$nomEleve = '';
	$prenomEleve = '';
?>

<h1><?php echo $titre ?> </h1>

<?php echo validation_errors(); ?>

<form role = "form" action ="<?php echo base_url();?>index.php/Eleve_Controller/save/" method ="POST" >





	<?php    
 
	$attributes = 'class = "form-control" id = "classes" name = "dropdown"';
	echo form_dropdown('classes',$classes,'',$attributes);

		
	?>


  <div class="form-group">
		<label>Nom</label>
		<input type="text" name ="nomEleve" value="<?php echo $nomEleve ?>" class="form-control" placeholder="Saisir le nom">
  </div>
  
  
  
  <div class="form-group">
		<label>Prénom</label>
		<input type="text" name ="prenomEleve" value="<?php echo $prenomEleve ?>" class="form-control" placeholder="Saisir le prénom">
  </div>
   

 

  <button type="submit" class="btn btn-default">Submit</button>
</form>