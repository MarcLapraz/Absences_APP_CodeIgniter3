<?php
//APPLICATION : Codeigniter -> Application absences travail de diplôme 
//AUTEUR : Marc lapraz 

defined('BASEPATH') OR exit('No direct script access allowed');

class Classe_Model extends CI_Model {


	
	//DESCRIPTION : Retourne l'ensemble des classes triées par numero
	public function getAllClasses()
	{	
		$this->db->select('classes.numero as classeNum,  classes.code as classeCode');
		$this->db->from('classes');
		$this->db->order_by("classes.numero", "asc");
		$sql = $this->db->get()	; 

		return $sql ; 
	}


	//DESCRIPTION : Retourne une classe en fonction du numero de classe (numéro) passé en paramètre
	public function getClasseByNumero ($numero)
	{		
		$this->db->select ('classes.numero as classeNum,  classes.code as classeCode');
		$this->db->from('classes');
		$this->db->where('classes.numero', $numero);
		$sql = $this->db->get();
		
		return $sql; 
	}
	
	//DESCRIPTION : Méthode insert ; Permet de mémoriser une nouvelle classe en base de données
	//PARAM : Les données à insérer, la base de données se charger de la clé primaire
	//$data : nouvelles données sous la forme d'un tableau
	public function insert ($data)
	{	
		$this->db->insert('classes',$data) ; 	
	}
	
	//DESCRIPTION : Méthode delete ; Permet de supprimer une classe en base de données
	public function delete ($numero)
	{		
		$this->db->where ("numero", $numero);
		$this->db->delete('classes'); 	
	}
	

	//DESCRIPTION : Méthode update ; Permet de modifier une classe ; 
	//PARAM : le numéro de la classe et les nouvelles données
	//$numero : entier -> numero de la classe
	//$data : nouvelles données sous forme d'un tableau.
	public function update ($numero,$data) 
	{	
		$this->db->where ("numero", $numero);
		$this->db->update('classes', $data); 	
		
	}
	
	
	
		
		
		
		
		
		
	
	
	
	
	
	
	
	
}