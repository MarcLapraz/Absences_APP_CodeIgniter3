<?php
//APPLICATION : Codeigniter -> Application absences travail de diplôme 
//AUTEUR : Marc lapraz 
//DATE : 30.08.2016 -> commentaires et review code
defined('BASEPATH') OR exit('No direct script access allowed');

class Absence_Model extends CI_Model {


	public function getMatieresByClasse ($classeNumero)
	{
		$this->db->select('matieres.libelle as matieresLibelle, matieres.numero as matieresNumero');
		$this->db->from('matieres');
		$this->db->join('modules', 'matieres.numeromodule = modules.numero');
		$this->db->join('classes', 'modules.numeroclasse = classes.numero');
		$this->db->order_by("matieres.libelle", "asc");
		$this->db->where('classes.numero', $classeNumero);

		$sql = $this->db->get()	;
		return $sql->result() ; 			
	}

	

	public function getAllClasses()
	{
		$this->db->select('numero, code');
		$this->db->from('classes');
		$this->db->order_by("classes.code", "asc");

		$sql = $this->db->get()	;	
		return $sql->result();
	}





	public function getLecon ($date, $numeromatiere){


		$this->db->select('lecons.numero as leconNumero');
		$this->db->from('lecons');
			

		//$array = array( 'numeromatiere' => $numeromatiere , 'date' => $date);

		$this->db->where('numeromatiere', $numeromatiere);
		$this->db->where('date', $date);
		
	
	
		$sql = $this->db->get();
		return $sql->result() ; 

	}



	public function getElevesOnLoad($numeroLecon){



		$this->db->select('lecons.numeromatiere as leconNumMat, matieres.libelle as matlib, classes.code as classeCode, eleves.numero as eleveNumero ,eleves.prenom as elevePrenom, eleves.nom as eleveNom, absences.nbperiode as nbPeriode');
		$this->db->from('lecons');

		$this->db->join('matieres' , 'lecons.numeromatiere = matieres.numero');
        $this->db->join ('modules' , 'modules.numero = matieres.numeromodule');
		$this->db->join ('classes' ,'modules.numeroclasse = classes.numero');
		$this->db->join ('eleves' ,'classes.numero = eleves.numeroclasse');
 		$this->db->join ('absences' ,'eleves.numero = absences.numeroeleve', 'left');

 		$this->db->where('lecons.numero',$numeroLecon ); 

 		$sql = $this->db->get();
		return $sql->result() ; 

	}



	public function insertLecon()
	{


		$classes = $this->input->post('classes');
		$matieres = $this->input->post('matieres');
		$date = $this->input->post('datepicker');
		$periode = $this->input->post('periode');
		$login= "marcTESTDIMANCHE!" ; 

		$this->db->insert('lecons', array('numeromatiere' =>$matieres, 'nbperiode' =>$periode, 'date' =>$date, 'login' =>$login));

		//fontion codeigniter native retournant le numero de la dernière leçon insérée.
		$insert_id = $this->db->insert_id();
		return $insert_id ; 
	}



	public function insertAbsence()
	{
		$nbPeriode = $this->input->post('nbPeriode');
		$numeroEleve = $this->input->post('numeroEleve');
		$leconNumero = $this->input->post('leconNumero');
		$commentaire = $this->input->post('commentaire');
		
		$this->db->insert('absences', array('numeroeleve' =>$numeroEleve, 'nbperiode' =>$nbPeriode, 'numerolecon' =>$leconNumero, 'commentaire' =>$commentaire));

		return $numeroEleve ; 
	}



	public function updateAbsence()
	{

		$nbPeriode = $this->input->post('nbPeriode');
		$numeroEleve = $this->input->post('numeroEleve');
		$leconNumero = $this->input->post('leconNumero');
		$commentaire = $this->input->post('commentaire');
	
		// $t = ["pkLecon"=>$pkLecon,"mat"=>$matieres];
		 $data = ["nbperiode" => $commentaire, "nbperiode" =>$nbPeriode ] ; 


	    $this->db->where ("numerolecon", $leconNumero);
	    $this->db->where ("numeroeleve", $numeroEleve);
		$this->db->update('absences', $data); 	


	}



	public function deleteAbsence()
	{
		//$nbPeriode = $this->input->post('nbPeriode');
		$numeroEleve = $this->input->post('numeroEleve');
		$leconNumero = $this->input->post('leconNumero');
	
	
		$this->db->delete('absences', array('numeroeleve' =>$numeroEleve, 'numerolecon' =>$leconNumero));

	
		return $numeroEleve ; 
	}



}