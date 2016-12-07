<?php
//APPLICATION : Codeigniter -> Application absences travail de diplôme 
//AUTEUR : Marc lapraz 
//DATE : 30.08.2016 -> commentaires et review code

//Le controller classe_controller est lié au modèle classe_model
//Le controller appele le modèle qui se charge d'interagir avec la base de données. Ensuite, Les résultats sont  passés à la vue.
//Le controller doit hériter /étendre la classe CI_Controller 
/*Les vues associées à ce controller : 
                                    - classesEdit.php  -> form. pour éditer une nouvelle classe
                                    - classesSave.php -> form. pour sauvegarder une nouvelle classe
                                    - classesView.php -> visualiser toutes les classes */


defined('BASEPATH') OR exit('No direct script access allowed');

class Classe_Controller extends CI_Controller {

    //permet de construire CI_Controller
	public function _construct()
	{	
		parent::_construct();	
	}

	//Appel de la méthode par défaut , la fonction index est toujours la méthode par défaut du controller
	public function index()
	{	
		$this->viewAll();
	}

	//Cette fonction est appelée par défaut lors du chargement de la page 
	//Elle permet d'afficher toutes les classes sur la vue classesView.php
	public function viewAll()
	{	
		$data['sql'] = $this->Classe_Model->getAllClasses();	
		$data['titre'] = 'Voir tous les élèves';
		$this->load->view('layout/header');
		$this->load->view('layout/naviguation');
		$this->load->view('classesView', $data);
		$this->load->view('layout/footer');	
	}
		
	//Cette fonction est appelée lors du clic sur le bouton "ajouter" présent sur la vue classeView.php
	public function addNewClasse()
	{	
		$data['titre'] = 'Ajouter';
		$this->load->view('layout/header');
		$this->load->view('classesSave',$data);
		$this->load->view('layout/footer');
	}
	

	//Cette fonction est appelée lors du clic sur le bouton "Modifier" présent sur la vue classesView.php
	//Le numéro est récupéré depuis le formulaire et passée en paramètre lors de l'appel de la méthode getClasseByNumero ($numero)
	public function edit ($numero)
	{		
		$data['titre'] ='Edition';  
		$data['sql']= $this->Classe_Model->getClasseByNumero($numero);
		$this->load->view('layout/header');
		$this->load->view('classesEdit',$data);
		$this->load->view('layout/footer');		
	}


    //appelé lors du clic sur le bouton "valider" sur la vue classeSave.php
    //dans ce cas, il faut récupérer les champs codeClasse et op présents sur classeSave.php
    //Test des règles de validations -> si ok -> insert dans la DB.
	public function save()
	{		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('codeClasse', 'CodeClasse', 'required');	
		$code = $this->input->post('codeClasse');
		$data = array('code' => $code);
		
		if ($this->form_validation->run() == true) {
			
			$this->Classe_Model->insert($data);
			$this->index() ; 
			
		}else{
		
			$this->addNewClasse() ; 	
		}
	}



	// appellé lors du clic "Valider" sur la vue classeEdit
	public function update()
	{
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('codeClasse', 'CodeClasse', 'required');
		$numero = $this->input->post('numClasse');
		$code = $this->input->post('codeClasse');		
		$data = array('code' => $code);

		if ($this->form_validation->run() == true) {
                    
			$this->Classe_Model->update($numero, $data);	
			$this->index(); 
			
		} else{
		
			$this->edit($numero) ; 
		
		}
			
	}

	
	//Appel de la fonction delete 
	//l'implémentation de la méthode se trouve dans le modèle (classe_Model)
	public function delete ($numero)
	{
		$this->Classe_Model->delete($numero);
		$this->index();	
	}
	
	

}
