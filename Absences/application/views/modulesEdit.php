
<?php
	
	foreach ($sql->result() as $obj){	
		//var_dump($obj); // --> permet de voir la structure de données à parcourir, 

		//les noms de variable sont définies grace aux alias au moment de la requete -> eleve_Model 
		//STRUCTURE DE L'OBJET $obj
		//object(stdClass)[29]
			//public 'modulenumero' => int 2
			//public 'moduleslibelle' => string 'Intro à l'economie' (length=19)
			//public 'classescode' => string '1IGE' (length=4)
			//public 'classesnum' => int 1

		$modulenumero = $obj->modulenumero ; 
		$classecode = $obj->classescode ; 
		$classenum = $obj->classesnum ;  
		$libelle = $obj->moduleslibelle ; 
	}
	
?>

<h1><?php echo $titre ?> </h1>
<?php echo validation_errors(); ?> 

<form role = "form" action ="<?php echo base_url();?>index.php/Module_Controller/update"<?php echo $modulenumero ?> method ="POST" >

<input type="hidden" name ="numeromodule" value="<?php echo $modulenumero ?>"class="form-control">
<input type="hidden" name ="numeroclasse" value="<?php echo $classenum ?>"class="form-control">


<label>Classes</label>
<?php    


	var_dump($classes) ; 
	//$classes à  la structure suivante : 

/*
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
  	//$sttribute -> class bootstrap 
	$attributes = 'class = "form-control" id = "classes" name = "dropdown"';
	//dropdown avec helpers 
	echo form_dropdown('classes', $classes, $classenum ,$attributes);
	
?>


  <div class="form-group">
		<label>Libelle</label>
		<input type="text" name ="moduleLibelle"  class="form-control"  value="<?php echo $libelle ?>" placeholder="Saisir le libelle du module">
  </div>
  

  <button type="submit" class="btn btn-default">Submit</button>
</form>