<?php
 
		$moduleLibelle= '' ; 	
		$classeCode = '';		
?>

<h1><?php echo $titre ?> </h1>

<?php echo validation_errors(); ?>


<form role = "form" action ="<?php echo base_url();?>index.php/Module_Controller/save/" method ="POST" >


<label>Classes</label>
<?php    

//var_dump($classes) ; 

/*
STRUCUTRE DE $CLASSES -> VOIR MODULE_CONTROLLER add()
array (size=9)
  '-Veuillez choisir-' => string '-Veuillez choisir-' (length=18)
  1 => string '1IGE' (length=4)
  2 => string '2IGP' (length=4)
  3 => string '1PROCE' (length=6)
  4 => string '2PROCE' (length=6)
  5 => string '3PROCE' (length=6)
  6 => string '4PROCE' (length=6)
  7 => string '1TECBAT' (length=7)
  8 => string '3TECBAT' (length=7)

*/

//cas sauvegarde, on ne connait pas encore le numero de la classe car il n'existe pas encore ! 
$attributes = 'class = "form-control" id = "classes" name = "dropdown"';
echo form_dropdown('classes', $classes, '',$attributes);

	
?>


  <div class="form-group">
		<label>Libelle</label>
		<input type="text" name ="moduleLibelle"  class="form-control" placeholder="Saisir le libelle du module">
  </div>
  
  
 
  <button type="submit" class="btn btn-default">Submit</button>
</form>