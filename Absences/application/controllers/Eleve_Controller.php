<?php

//APPLICATION : Codeigniter -> Application absences travail de diplôme 
//AUTEUR : Marc lapraz 
//DATE : 30.08.2016 -> commentaires et review code

//Le controller classe_controller est lié au modèle classe_model
//Le controller appele le modèle qui se charge d'interagir avec la base de données. Ensuite, Les résultats sont passés à la vue.
//Le controller doit hériter /étendre la classe CI_Controller.
/*Les vues associées à ce controller : 
                                    - elevesEdit.php  -> form. pour éditer un élève
                                    - elevesSave.php -> form. pour sauvegarder un nouvel élève
                                    - elevesView.php -> visualiser tous les élèves */


defined('BASEPATH') OR exit('No direct script access allowed');

class Eleve_Controller extends CI_Controller {

	//permet de construire CI_Controller
	public function _construct()
	{	
		parent::_construct();		
	}

	//Appel de la méthode par défaut , la fonction index est toujours la méthode par défaut du controller
	public function index()
	{
		$this -> viewAll();
	}
	
	
	//Cette fonction est appelée par défaut lors du chargement de la page 
	//Elle permet d'afficher toutes les classes sur la vue elevesView.php
	public function viewAll()
	{	
		$data['sql'] = $this->Eleve_Model->getAllEtudiantClasse();			
		$this->load->view('layout/header');
		$this->load->view('layout/naviguation');
		$this->load->view('elevesView', $data);
		$this->load->view('layout/footer');	
	}
	
	//Cette fonction est appelée lors du clic sur le bouton "ajouter" présent sur la vue elevesView.php
	//Sur la page eleveSave, nous devons pouvoir lister toutes les classes
	public function addNewEleve()
	{	
		$data['classes'] = $this->Eleve_Model->getClasses();	
		$data['titre'] = 'Ajout d un élève';
		$this->load->view('layout/header');
		$this->load->view('elevesSave',$data);
		$this->load->view('layout/footer');
	}


	//Cette fonction est appelée lors du clic sur le bouton "Modifier" présent sur la vue EleveView.php
	public function edit ($numero)
	{		 	
		$data['classes'] = $this->Eleve_Model->getClasses();	
		$data['titre'] ='Edition d un élève';  
		$data['sql']= $this->Eleve_Model->getEleveByNumero($numero);
		$this->load->view('layout/header');
		$this->load->view('elevesEdit',$data);
		$this->load->view('layout/footer');		
	}
	
	
	//appelé lors du clic sur le bouton "valider" sur la vue elevesSave.php
	public function save()
	{			
		$this->setRulesAndLoadHelper();
		$nom = $this->input->post('nomEleve');
		$prenom = $this->input->post('prenomEleve');
		$numClasse = $this->input->post('classes');
			
		$data = array('nom' => $nom, 'prenom' => $prenom, 'numeroclasse' => $numClasse);		
		
		if ($this->form_validation->run() == true) 
		{		
			$this->Eleve_Model->save($data);	
			$this->index();
				
		}else{
	
			$this->addNewEleve();
	
		}
	
	}
	
	// appellé lors du clic "Valider" sur la vue elevesEdit
	public function update()
	{			
		$this->setRulesAndLoadHelper();
		$numero = $this->input->post('numEleve');
		$nom = $this->input->post('nomEleve');
		$prenom = $this->input->post('prenomEleve');
		$numClasse = $this->input->post('classes');

		$data = array('nom' => $nom, 'prenom' => $prenom, 'numeroclasse' => $numClasse);		
		
		if ($this->form_validation->run() == true) 
		{
			$this->Eleve_Model->update($numero, $data);	
			$this->index();		
		}else{
	
			$this->edit($numero);
		}
		
	}
	
	
	//Fonction permettant de supprimer un eleve en fonction de son numéro, ensuite redirection sur le controller par défaut
	//Le controller par défaut est défini dans config/routes.php
	public function delete ($numero)
	{
		$this->Eleve_Model->delete($numero);
		$this->index();
			
	}	
	

	//Création des règles de validation à appliquer 
	public function setRulesAndLoadHelper ()
	{	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nomEleve', 'nomEleve', 'required');
		$this->form_validation->set_rules('prenomEleve', 'PrenomEleve', 'required');
		$this->form_validation->set_rules('classes', 'Classes', 'required|greater_than[0]');
	
	}
	
	
}
