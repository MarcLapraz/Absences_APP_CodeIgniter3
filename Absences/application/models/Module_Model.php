<?php
//APPLICATION : Codeigniter -> Application absences travail de diplôme 
//AUTEUR : Marc lapraz 

defined('BASEPATH') OR exit('No direct script access allowed');

class Module_Model extends CI_Model {


	//cette fonction retourne tous les étudiants et leur classe 
	public function getAllModulesClasse()
	{	
		$this->db->select('modules.numero as modulenumero, modules.libelle as moduleslibelle, classes.code as classescode,classes.numero as classesnum');
		$this->db->from('modules');
		$this->db->join('classes', 'modules.numeroclasse = classes.numero');
		$this->db->order_by('classes.numero', 'asc');
		$this->db->order_by('modules.libelle', 'asc');
		
		$sql = $this->db->get()	;
		
		return $sql ; 			
	}



	public function getModuleByNumero ($numero)
	{		

		$this->db->select('modules.numero as modulenumero, modules.libelle as moduleslibelle, classes.code as classescode,classes.numero as classesnum');
		$this->db->from('modules');
		$this->db->join('classes', 'modules.numeroclasse = classes.numero');
		$this->db->order_by('classes.numero', 'asc');
		$this->db->order_by('modules.libelle', 'asc');
		$this->db->where('modules.numero', $numero);
		
		$sql = $this->db->get()	;

		return $sql; 

	}


	public function save($data)	
	{		
		$this->db->insert('modules',$data) ; 	
	}
	
	
	
	public function update ($numero,$data) 
	{	
		$this->db->where ("numero", $numero);
		$this->db->update('modules', $data); 	
		
	}


	public function delete ($numero)
	{		
		$this->db->where ("numero", $numero);
		$this->db->delete('modules'); 	
	}



	//return an array 
	public function getClasses (){
		
		$this->db->select('numero');
        $this->db->select('code');
        $this->db->from('classes');
        $this->db->order_by('numero', 'asc');

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
		
		
		
		
		
		
	
	
	
	
	
	
	
	
}