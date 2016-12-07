<?php
//APPLICATION : Codeigniter -> Application absences travail de diplôme 
//AUTEUR : Marc lapraz 

defined('BASEPATH') OR exit('No direct script access allowed');

class Fiche_Model extends CI_Model {

	//Cette fonctionne retourne toute les classes 
	public function getAllClasses()
	{
	$this->db->select('numero, code');
	$this->db->from('classes');
	$this->db->order_by("classes.code", "asc");

	$sql = $this->db->get()	;	
	
	return $sql->result();

	}

	//Cette fonction retourne l'ensemble des élèves d'une classe
	public function getEleves($classeNumero)
	{
 	$this->db->select('numero, nom, prenom');
	$this->db->from('eleves');
	$this->db->order_by("numeroclasse", "asc");
	$this->db->where('numeroclasse', $classeNumero);

	$sql = $this->db->get()	;	
	
	 return $sql->result();

	}

	//Cette fonction retourn l'ensemble des absences d'un élève
	public function getAbsences($eleveNumero)
	{
 	$this->db->select('(((matieres.dotation*absences.nbperiode)/100.00)) as pourcentage , 
 		matieres.dotation as matieresDotation, modules.libelle as modulesLibelle ,lecons.date as leconsDate, 
 		absences.nbperiode as absencesNbPeriode, matieres.libelle as matieresLibelle ,
 		absences.commentaire as absencesCommentaire');

	$this->db->from('absences');
	$this->db->join('lecons', 'absences.numerolecon = lecons.numero');
	$this->db->join('matieres', 'lecons.numeromatiere = matieres.numero');
	$this->db->join('modules', 'matieres.numeromodule = modules.numero');
	$this->db->where('absences.numeroeleve', $eleveNumero);
	
	$sql = $this->db->get()	;	
	
	return $sql->result() ; 
	
	}

















	
}