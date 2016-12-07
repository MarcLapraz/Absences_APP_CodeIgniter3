
<?php	
	if($op=='save'){	
		//foreach ($sql->result() as $object){	
		//var_dump($object); // --> permet de voir la structure de données à parcourir, les noms de variable sont définies lors de la requete -> eleve_Model 
			
		$matiereNumero = '';	
		$codeClasse =  '';
		$libelleModule = '';
		$libelleMatiere =  '';
		$dotationMatiere = '';
		$moduleNumero = '';
			
	//	}
	}
?>

<h1><?php echo $titre ?> </h1>

<?php echo validation_errors(); ?> 



<form role = "form" action ="<?php echo base_url();?>index.php/Matiere_Controller/save" method ="POST" >


<input type="hidden" name ="op" value="<?php echo $op ?>"class="form-control">
<input type="hidden" name ="matiereNumero" value="<?php echo $matiereNumero   ?>"class="form-control">





<label>Liste des modules : </label>
<?php    

	//var_dump($modules) ; 
	$attributes = 'class = "form-control" id = "modules" name = "dropdown"';
	echo form_dropdown('modules',$modules, $moduleNumero ,$attributes);
	
?>


<div class="form-group">
	<label>Libelle</label>
	<input type="text" name ="libelleMatiere" value="<?php echo $libelleMatiere ?>" class="form-control" placeholder="Saisir le libelle de la matière">
</div>
 
 
<div class="form-group">
	<label>Dotation</label>
	<input type="text" name ="dotationMatiere" value="<?php echo $dotationMatiere ?>" class="form-control" placeholder="Saisir la dotation">
</div>

 
 
   
 
   
  <button type="submit" class="btn btn-default">Submit</button>
</form>