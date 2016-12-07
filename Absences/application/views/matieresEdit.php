
<?php	
	if($op=='edit'){	
		foreach ($sql->result() as $object){	
		//var_dump($object); 
		// --> permet de voir la structure de données à parcourir, les noms de variable sont définies lors de la requete -> Matiere_Model 
			
		/*
		STRUCTURE DE L'OBJET $object 
		object(stdClass)[64]
		public 'matiereNumero' => int 1
		public 'classeCode' => string '1IGE' (length=4)
		public 'moduleLibelle' => string 'Intro à l'economie' (length=19)
		public 'matiereLibelle' => string 'Apprendre à apprendre' (length=22)
		public 'matiereDotation' => int 10
		public 'moduleNumero' => int 2

		*/

		$matiereNumero = $object->matiereNumero ; 	
		$codeClasse = $object->classeCode;
		$libelleModule = $object->moduleLibelle;
		$libelleMatiere = $object->matiereLibelle;
		$dotationMatiere = 	$object->matiereDotation;
		$moduleNumero = $object->moduleNumero;
			
		}
	}
?>

<h1><?php echo $titre ?> </h1>

<?php echo validation_errors(); ?> 



<form role = "form" action ="<?php echo base_url();?>index.php/Matiere_Controller/update" method ="POST" >


<input type="hidden" name ="op" value="<?php echo $op ?>"class="form-control">
<input type="hidden" name ="matiereNumero" value="<?php echo $matiereNumero   ?>"class="form-control">





<label>yes</label>
<?php    

	//var_dump($modules) ; 
	$attributes = 'class = "form-control" id = "modules" name = "dropdown"';
	echo form_dropdown('modules',$modules, $moduleNumero ,$attributes);
	
?>


<div class="form-group">
	<label>Libelle</label>
	<input type="text" name ="libelleMatiere" value="<?php echo $libelleMatiere ?>" class="form-control" placeholder="Saisir le prénom">
</div>
 
 
<div class="form-group">
	<label>Dotation</label>
	<input type="text" name ="dotationMatiere" value="<?php echo $dotationMatiere ?>" class="form-control" placeholder="Saisir le prénom">
</div>

 
 
   
 
   
  <button type="submit" class="btn btn-default">Submit</button>
</form>