<?php
//APPLICATION : Codeigniter -> Application absences travail de diplôme 
//AUTEUR : Marc lapraz 
//DATE : 30.08.2016 -> commentaires et review code
defined('BASEPATH') OR exit('No direct script access allowed');

class Absence_Controller extends CI_Controller {

	public function _construct()
	{	
		parent::_construct();					
	}

  	//Fonction par défaut de la page. 
  	//Récupérer toutes les classes et parcourir la réponse.
  	//Pour chaque classe, créer un tableu clé/valeur
  	//nommer le tableu et le passer à la vue pour la présentation.
	public function index()
	{		

		$this->load->view('layout/header');
		$this->load->view('layout/naviguation');	
		$classes = $this->Absence_Model->getAllClasses();

		foreach ($classes as $classe){
			$classeFinal [$classe->numero] = $classe->code ; 	
		}

		$info = array('classes'=> $classeFinal);	
		$this->load->view('absencesView', $info) ; 
		$this->load->view('layout/footer');				
	}

		
	//Fonction ajax qui retourne toutes les matières d'une classe
	public function ajax_MatieresByClasseNumero()
	{
		if(isset($_POST) && isset ($_POST['classeNumero'] ))	
		{
			$classeNumero = $_POST['classeNumero'];		

			//$this->input->post ('classeNumero') ; 

		    $matieres = $this->Absence_Model->getMatieresByClasse ($classeNumero); 
		    //Encodage en Json
		    header('Content-Type: application/json');
		   	echo json_encode($matieres);
							
		}else{
				
			$this->index();
		}
	}	


	//Cette fonction a pour but de tester la présence d'une lecons dans la liste des lecons créées
	public function ajax_CheckLecon()
	{
		if(isset($_POST) && isset ($_POST['date'] ))	
		{
			
		$date = $this->input->post('date');		
		$matiere = $this->input->post('numeroMatiere');
		$classe = $this->input->post('classe');

		//get lecon by date et nummatiere			
		$numLecon = $this->Absence_Model->getLecon($date,$matiere) ; 

		//get eleves absences by Lecons			
		$eleves = $this->Absence_Model->getElevesOnLoad ($numLecon[0]->leconNumero);

		//ajouter un titre dans le tableau pour faciliter la récupération des données
		$toEncode = ["eleves" => $eleves] ;

		//Encodage 
 		header('Content-Type: application/json');
		echo json_encode($toEncode);


		}else{
			// retour à l'affichage 
			$this->index();
		}
	}


	public  function ajax_saveForm(){

	 	if(isset($_POST) && isset ($_POST['classes'] ))	
		{
			//Récupération de la clé primaire insérée
			$pkLecon =  $this->Absence_Model->insertLecon();  

			//Récupératio de tous les élèves d'une classe
			$eleves = $this->Eleve_Model->getEtudiantsByClasse ($_POST['classes'] ); 

			//Préparation de la structure de données
			$toEncode = ["pkLecon"=>$pkLecon,"eleves"=>$eleves];
			
			 //encodage
			header('Content-Type: application/json');
			echo json_encode($toEncode); 
		}else{
				
			//retour à la fonction par défaut du controlleur
			$this->index();
		}
	}



	//Insertion d'une absence
	public function ajax_InsertAbsence(){

	 	if(isset($_POST) && isset ($_POST['nbPeriode'] ))	
		{

		$this->Absence_Model->insertAbsence(); 

		}
	}

	//Modifier une absence
	public  function ajax_updateAbsence(){

	 	if(isset($_POST) && isset ($_POST['nbPeriode'] ))	
		{

		$this->Absence_Model->updateAbsence(); 

		}
	}


	//Effacer une absence
	public  function ajax_deleteAbsence(){

	 	if(isset($_POST) && isset ($_POST['nbPeriode'] ))	
		{

		$this->Absence_Model->deleteAbsence(); 

		}
	}

	
}	

