<?php

//APPLICATION : Codeigniter -> Application absences travail de diplôme 
//AUTEUR : Marc lapraz 
//DATE : 30.08.2016 -> commentaires et review code

//Le controller classe_controller est lié au modèle matiere_model
//Le controller appele le modèle qui se charge d'interagir avec la base de données. Ensuite, Les résultats sont passés à la vue voir ---> ($data['nom'])

defined('BASEPATH') OR exit('No direct script access allowed');

class Matiere_Controller extends CI_Controller {

	public function _construct()
	{	
		parent::_construct();			
	}


	//Au chargement, appeler la méthode getAllMatieresClasse();
	//l'index représente le comportement par défaut de la page. 
	public function index()
	{
		$this -> getAllMatieresClasse() ; //notation object 
	}
	
	
	//Méthode retournant toutes les classes et leurs matières 
	public function getAllMatieresClasse()
	{	
		//interaction avec la base et stockage du résult dans un tableau 
		$data['sql'] = $this->Matiere_Model->getAllMatieresClasse();
		//stocker le titre dans le tableau $data
		$data['titre'] = 'Affichage des matières';	
		//Charger le header, navigation, et le footer à la vue	
		$this->load->view('layout/header');
		$this->load->view('layout/naviguation');
		//passer le table $data à la vue 
		$this->load->view('matieresView', $data);
		$this->load->view('layout/footer');	
	}
	

	public function add()
	{	
		//interaction avec la base et stockage du résult dans un tableau 
		$data['modules'] = $this->Matiere_Model->getModules();	
		//stocker l'opération dans le tableau $data (optionnel)
		$data['op'] = 'save' ; 
		//stocker le titre dans le tableau $data
		$data['titre'] = 'Ajouter';
		$this->load->view('layout/header');
		//passer le table $data à la vue 
		$this->load->view('matieresSave',$data);
		$this->load->view('layout/footer');
	}


	
	
	public function edit ($numero)
	{		 
	    $data['modules'] = $this->Matiere_Model->getModules();	
		$data['titre'] ='Edition';  
		$data['op']= 'edit' ; 
		$data['sql']= $this->Matiere_Model->getMatiereByNumero($numero);
		$this->load->view('layout/header');
		$this->load->view('MatieresEdit',$data);
		$this->load->view('layout/footer');		
	}
	
	

	public function save()
	{			
	
		$this->setRulesAndLoadHelper();
				
		$op = $this->input->post('op');
		
		$dotationMatiere = $this->input->post('dotationMatiere');
		$libelleMatiere = $this->input->post('libelleMatiere');
		$modulesNum = $this->input->post('modules');
			
		$data = array('dotation' => $dotationMatiere, 'libelle' => $libelleMatiere, 'numeromodule' => $modulesNum  );		
		
		if ($this->form_validation->run() == true) {
		
			if($op == 'save')
			{			
				$this->Matiere_Model->save($data);	
				$this->getAllMatieresClasse();
			}
			
		}else{

			$this->add();

		}
			
	}
	
	
	public function update()
	{			
	
		$this->setRulesAndLoadHelper();
		
		
		$op = $this->input->post('op');
	
		$numero = $this->input->post('matiereNumero');
		
		$dotationMatiere = $this->input->post('dotationMatiere');
		$libelleMatiere = $this->input->post('libelleMatiere');
		$modulesNum = $this->input->post('modules');
			
		
		$data = array('dotation' => $dotationMatiere, 'libelle' => $libelleMatiere, 'numeromodule' => $modulesNum  );	


		var_dump($data) ; 	
		
		if ($this->form_validation->run() == true) {
		
			if($op == 'edit')
			{
			
				$this->Matiere_Model->update($numero, $data);	
				$this->getAllMatieresClasse();
			}
			
		}else{
	
	
			$this->edit($numero);
	
		}
		
	}
	
	
	
	

	//Fonction permettant de supprimer un eleve en fonction de son numéro, ensuite redirection sur le controller par défaut
	//Le controller par défaut est défini dans config/routes.php
	public function delete ($numero)
	{
		$this->Matiere_Model->delete($numero);
		redirect('');		
	}	
	
	
	
	//Définition des règles de validation 	
	public function setRulesAndLoadHelper ()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('dotationMatiere', 'DotationMatiere', 'required');
		$this->form_validation->set_rules('libelleMatiere', 'LibelleMatiere', 'required');
		$this->form_validation->set_rules('modules', 'Modules', 'required|greater_than[0]');	
	}
	
	
	

	
}
