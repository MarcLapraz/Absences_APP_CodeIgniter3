<?php
		
	foreach ($sql->result() as $obj){	
	
		$numClasse = $obj->classeNum;
		$codeClasse = $obj->classeCode;		
	}
	
?>


<h1><?php echo $titre ?> </h1>

<?php echo validation_errors(); ?> 

<form role = "form" action ="<?php echo base_url();?>index.php/Classe_Controller/update" method ="POST" >

	<input type="hidden" name ="numClasse" value="<?php echo $numClasse ?>"class="form-control">

	<div class="form-group">
		<label>code</label>
		<input type="text" name ="codeClasse" value="<?php echo $codeClasse ?>" class="form-control" placeholder="Saisir le code">
	</div>
   
	<button type="submit" class="btn btn-default">Submit</button>
	
</form>




