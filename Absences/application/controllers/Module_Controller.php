<?php
//APPLICATION : Codeigniter -> Application absences travail de diplôme 
//AUTEUR : Marc lapraz 
//DATE : 30.08.2016 -> commentaires et review code

//Le controller classe_controller est lié au modèle classe_model
//Le controller appele le modèle qui se charge d'interagir avec la base de données. Ensuite, Les résultats sont  passés à la vue.

defined('BASEPATH') OR exit('No direct script access allowed');

class Module_Controller extends CI_Controller {


	public function _construct()
	{	
		parent::_construct();	
	}

	public function index()
	{	

		$this->getAllModulesClasse();

	}
	
	public function getAllModulesClasse()
	{	
		$data['sql'] = $this->Module_Model->getAllModulesClasse();			
		$this->load->view('layout/header');
		$this->load->view('layout/naviguation');
		$this->load->view('modulesView', $data);
		$this->load->view('layout/footer');	
	}
	
	
	
	public function add()
	{	
		$data['classes'] = $this->Module_Model->getClasses();	
		$data['titre'] = 'Ajouter';
		$this->load->view('layout/header');
		$this->load->view('modulesSave',$data);
		$this->load->view('layout/footer');
	}
	

	public function edit ($numero)
	{		
		$data['titre'] ='Edition';  
		$data['classes'] = $this->Module_Model->getClasses();	
		$data['sql']= $this->Module_Model->getModuleByNumero($numero);
		$this->load->view('layout/header');
		$this->load->view('modulesEdit',$data);
		$this->load->view('layout/footer');		
	}
	
	
	
	public function save()
	{		
	

		$this->setRulesAndLoadHelper();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
			
		$code = $this->input->post('moduleLibelle');
		$numClasse = $this->input->post('classes');

		$data = array('libelle' => $code, 'numeroclasse'=>$numClasse);
		
		if ($this->form_validation->run() == true) 
		{	
			$this->Module_Model->save($data);
			$this->getAllModulesClasse();

		}else{
		
		$this->add() ; 	
		}
	}
	

	
	
	public function update()
	{
		$this->setRulesAndLoadHelper();					
		$numero = $this->input->post('numeromodule');
		$moduleLibelle = $this->input->post('moduleLibelle');
		$numClasse = $this->input->post('classes');
		$data = array( 'libelle' => $moduleLibelle, 'numeroclasse' => $numClasse);
		
		if ($this->form_validation->run() == true) 
		{            
			$this->Module_Model->update($numero, $data);	
			$this->index() ; 
			
		} else{
		
			$this->edit($numero) ; 
		
		}			
	}








	
	//Appel de la fonction delete 
	//l'implémentation de la méthode se trouve dans le modèle (Module_Model)
	public function delete ($numero)
	{
		$this->Module_Model->delete($numero);
		redirect('/index.php/Module_Controller');		
	}
	




    // Pour éviter une répétition de code, les règles de validations sont créees dans une fonction sépparée.	
	public function setRulesAndLoadHelper ()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('moduleLibelle', 'ModuleLibelle', 'required');
		$this->form_validation->set_rules('classes', 'Classes', 'required|greater_than[0]');
	
	}
	
	
	
	
}
