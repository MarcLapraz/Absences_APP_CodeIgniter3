<?php
//APPLICATION : Codeigniter -> Application absences travail de diplôme 
//AUTEUR : Marc lapraz 

defined('BASEPATH') OR exit('No direct script access allowed');

class Matiere_Model extends CI_Model {


	
	//cette fonction retourne tous les étudiants et leur classe 
	public function getAllMatieresClasse()
	{	
		$this->db->select('matieres.numero as matiereNumero, classes.code as classeCode ,modules.libelle as moduleLibelle, matieres.libelle as matiereLibelle, matieres.dotation as matiereDotation , modules.numero as moduleNumero');
		$this->db->from('matieres');
		$this->db->join('modules', 'matieres.numeromodule = modules.numero');
		$this->db->join('classes', 'modules.numeroclasse = classes.numero');
		
		$this->db->order_by("classes.numero", "asc");
		$this->db->order_by("modules.libelle", "asc");
		
		$sql = $this->db->get()	;
		
		return $sql ; 			
	}


	//Cette fonction retourne une matière en fonction de son numéro
	public function getMatiereByNumero ($numero)
	{		
		
		$this->db->select('matieres.numero as matiereNumero, classes.code as classeCode ,modules.libelle as moduleLibelle, matieres.libelle as matiereLibelle, matieres.dotation as matiereDotation , modules.numero as moduleNumero');
		$this->db->from('matieres');
		$this->db->join('modules', 'matieres.numeromodule = modules.numero');
		$this->db->join('classes', 'modules.numeroclasse = classes.numero');
		
		$this->db->order_by("classes.numero", "asc");
		$this->db->order_by("modules.libelle", "asc");
		
		$this->db->where ("matieres.numero", $numero);
		
		
		$sql = $this->db->get();
		
		return $sql; 
	}


	//Fonction de sauvegarde d'une matière
	public function save($data)
	{	
		$this->db->insert('matieres',$data) ; 	
	}
	
	//Effacement d'une matière
	public function delete ($numero)
	{		
		$this->db->where ("numero", $numero);
		$this->db->delete('matieres'); 	
	}
	

	//Màj d'une matière
	public function update ($numero,$data) 
	{	
		$this->db->where ("numero", $numero);
		$this->db->update('matieres', $data); 	
		
	}
	
	//return an array 
	public function getModules (){
		
		$this->db->select('numero');
		$this->db->select('libelle');
        $this->db->from('modules');
        $query = $this->db->get();
        $result = $query->result();

      
        $numero = array('-Veuillez choisir-');
        $libelle = array('-Veuillez choisir-');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($numero, $result[$i]->numero);
            array_push($libelle, $result[$i]->libelle);
		
        }
        return $module_result = array_combine($numero, $libelle);
		
    }
		
}