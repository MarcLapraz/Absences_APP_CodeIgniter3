<?php
//APPLICATION : Codeigniter -> Application absences travail de diplôme 
//AUTEUR : Marc lapraz 

defined('BASEPATH') OR exit('No direct script access allowed');

class Eleve_Model extends CI_Model {

	

	public function getEtudiantsByClasse ($classeNumero)
 	{

 		$this->db->select('eleves.numero as eleveNumero , eleves.nom as eleveNom, eleves.prenom as elevePrenom, classes.numero as classeNumero,  classes.code as classeCode');
		$this->db->from('eleves');
		$this->db->join('classes', 'eleves.numeroclasse = classes.numero');
		$this->db->where('classes.numero', $classeNumero);
		$this->db->order_by("eleves.numero", "asc");
		$this->db->order_by("classes.numero", "asc");

		$sql = $this->db->get()	;
		
		return $sql->result(); 			
 	}	



	//cette fonction retourne tous les étudiants et leur classe 
	public function getAllEtudiantClasse()
	{	
		$this->db->select('eleves.numero as eleveNumero , eleves.nom as eleveNom, eleves.prenom as elevePrenom, classes.numero as classeNumero,  classes.code as classeCode');
		$this->db->from('eleves');
		$this->db->join('classes', 'eleves.numeroclasse = classes.numero');
		
		$this->db->order_by("classes.numero", "asc");
		$this->db->order_by("eleves.nom", "asc");
		
		
		$sql = $this->db->get()	;
		
		return $sql; 			
	}

	//cette fonction retourne un étudiant et sa classe en fonction du paramètre numéro
	public function getEleveByNumero ($numero)
	{		
		$this->db->select ('eleves.numero as eleveNumero , eleves.nom as eleveNom, eleves.prenom as elevePrenom, classes.numero as classeNumero,  classes.code as classeCode');
		$this->db->from('eleves');
		$this->db->join('classes', 'eleves.numeroclasse = classes.numero');
		$this->db->where('eleves.numero', $numero);
		$sql = $this->db->get();
		
		return $sql; 
	}


	public function save($data)	
	{	
		
		$this->db->insert('eleves',$data) ; 	
	}
	
	
	public function update ($numero,$data) 
	{	
		$this->db->where ("numero", $numero);
		$this->db->update('eleves', $data); 	
		
	}
	

	public function delete ($numero)
	{		
		$this->db->where ("numero", $numero);
		$this->db->delete('eleves'); 	
	}





	//Retourne un tableau de classes trié par numéro
	//Cette fonction devrait faire appelle a la methode getClasses située dans classe_model
	//dans le cadre de ce développement, j'ai choisi de la laisser ici en sachant que cela n'est pas optimal (répétion de code)
	public function getClasses (){
		
		$this->db->select('numero');
        $this->db->select('code');
        $this->db->from('classes');
        $this->db->order_by("numero", "asc");


        $query = $this->db->get();
        $result = $query->result();

      
        $numero = array('-Veuillez choisir-');
        $code = array('-Veuillez choisir-');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($numero, $result[$i]->numero);
            array_push($code, $result[$i]->code);
        }
        return $classe_result = array_combine($numero, $code);
		
    }
		
		
		
		
		

// fin du model	
}