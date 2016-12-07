
<?php
	foreach ($sql->result() as $obj){		
		//var_dump($obj); 
		// --> permet de voir la structure de données à parcourir, 
		//les noms de variable sont définies lors de la requete -> eleve_Model 
		//STRUCTURE  de l'object a parcourir (Exemple) :
		//object(stdClass)[29]
		//public 'eleveNum' => int 1
		//public 'eleveNom' => string 'Aubrya' (length=6)
		//public 'elevePrenom' => string 'Michaël' (length=7)
		//public 'classeNum' => int 1
		//public 'classeCode' => string '1IGE' (length=4)

		$numEleve = $obj->eleveNumero;		
		$nomEleve = $obj->eleveNom ;
		$prenomEleve = $obj->elevePrenom ; 
		$numClasse = $obj->classeNumero;

		//$codeClasse = $obj->classeCode; 		
	}
	
?>

<h1><?php echo $titre ?> </h1>

<?php echo validation_errors(); ?> 

<form role = "form" action ="<?php echo base_url();?>index.php/Eleve_Controller/update" method ="POST" >

<input type="hidden" name ="numEleve" value="<?php echo $numEleve ?>"class="form-control">

	<?php    
	//var_dump($classes) ; 
	$attributes = 'class = "form-control" id = "classes" name = "dropdown"';
	echo form_dropdown('classes',$classes, $numClasse ,$attributes);		
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