<?php
//APPLICATION : Codeigniter -> Application absences travail de diplôme 
//AUTEUR : Marc lapraz 
//DATE : 30.08.2016 -> commentaires et review code

//Le controller fiche_controller est lié à plusieurs modèle
//Le controller doit étendre, hériter la classe CI_Controller
//Le controller appele le modèle qui se charge d'interagir avec la base de données. Ensuite, Les résultats sont passés à la vue.
//En bas de page, vous trouverez la structure des données envoyées / recu par AJAX

/*La vue associée à ce controller : 
                                    - ficheView.php  -> Présentation 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Fiche_Controller extends CI_Controller {

	//permet de construire CI_Controller
	public function _construct()
	{	
		parent::_construct();				
	}


//Comportement par défaut de la page.
//Charger le header et la barre de navigation.
//Récupérer toutes les classes pour alimenter la liste déroulante classes-dropdown
//Le reste de la page se construit par des appels ajax --> voir fichesView.php
	public function index()
	{		
		$this->load->view('layout/header');
		$this->load->view('layout/naviguation');
		$classes = $this->Fiche_Model->getAllClasses();

		foreach ($classes as $classe)
		{
			$classeFinal [$classe->numero] = $classe->code ; 	
		}

		$AllClasses = array('classes'=> $classeFinal);	
		$this->load->view('fichesView', $AllClasses) ; 
		$this->load->view('layout/footer');					
	}

	
//Cette fonction est appellé par la vue fichesView.php lors du PREMIER appel AJAX
//Cette fonction retourne l'ensemble des élèves en fonction du numéro passé en param. $_POST
//Cette fonction retourne une réponse encodée en json.
	
	public function ajax_SelectEleve()
	{
		if(isset($_POST) && isset ($_POST['classe_numero'] ))	
		{
			$num = $this->input->post('classe_numero') ; 
		    $eleves = $this->Fiche_Model->getEleves ($num); 
		    header('Content-Type: application/json');
		    echo json_encode($eleves);
							
		}else{
				
			$this->index();
		}
	}	


//Cette fonction est appellé par la vue fichesView.php
//Cette fonction retourne l'ensemble des absences d'un élève en fonction du numéro passé en param. $_POST
//Cette fonction retourne une réponse encodée en json.
	public function ajax_ficheEleve()
	{
		if(isset($_POST) && isset ($_POST['eleve_numero'] ))	
		{
			$num = $this->input->post('eleve_numero') ; 
		    $absencesEleve = $this->Fiche_Model->getAbsences($num); 
		    header('Content-Type: application/json');
		    echo json_encode($absencesEleve);
							
		}else{			
			$this->index();
		}
	}	

}	


//------------------------------------------------------------------------------------------------------------------------------------------
//STRUCTURE DE DONNEES : 

//Exemple Structure de données AJAX FICHE ELEVE  : 

/*
0
:
{pourcentage: "1.2000000000000000", matieresDotation: 40, modulesLibelle: "Projet",…}
absencesCommentaire
:
""
absencesNbPeriode
:
3
leconsDate
:
"2016-01-04"
matieresDotation
:
40
matieresLibelle
:
"Gestion de projet"
modulesLibelle
:
"Projet"
pourcentage
:
"1.2000000000000000"
*/


//EXEMPLE STRUCTURE DE DONNES AJAX SELECT ELEVE 

/*
0
:
{numero: 20, nom: "Balmer", prenom: "Fabian"}
nom
:
"Balmer"
numero
:
20
prenom
:
"Fabian"
*/