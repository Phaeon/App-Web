<?php

require_once('controlers/HomeControler.php');
require_once('controlers/ConnexionControler.php');
require_once('controlers/PlayerControler.php');
require_once('controlers/CalendarControler.php');
require_once('controlers/ConvocControler.php');
require_once('controlers/UtilsControler.php');
require_once('views/View.php');

class Router {

    private $_mainCtrl; // OK
    private $_connCtrl; // OK
    private $_playCtrl; // OK
    private $_calCtrl;
    private $_convCtrl;
    private $_utilsCtrl; // OK

    public function __construct() {
        $this->_mainCtrl = new HomeControler();
        $this->_connCtrl = new ConnexionControler();
        $this->_playCtrl = new PlayerControler();
        $this->_calCtrl = new CalendarControler();
        $this->_convCtrl = new ConvocControler();
        $this->_utilsCtrl = new UtilsControler();
    }

    // Route une requête entrante : exécution l'action associée
    public function routerRequest() {
        try {
            if (!empty($_SESSION['admin'])) 
            {
                // Dans le cas d'un ajout de joueur
                if (!empty($_POST['nom_ajout']) && !empty($_POST['prenom_ajout'])) {
                    
                    if ($_POST['eff'] == "Enregistrer") {

                        $this->_playCtrl->newPlayer($_POST['nom_ajout'], $_POST['prenom_ajout'], $_POST['licence_ajout'],$_POST['categorie_ajout']);
                    }
                    
                    $this->_connCtrl->admin();
		// Dans le cas d'un changement de catégorie de joueur
		} else if(!empty($_POST['nom_changement'])) {

		    if ($_POST['eff'] == "Changer") {

			$joueur_chang = preg_split('/ /',$_POST['nom_changement']);

                        $this->_playCtrl->changePlayer($joueur_chang[0], $joueur_chang[1], $_POST['categorie_changement']);
                    }
                    
		    $this->_connCtrl->admin();  
		// Dans le cas d'un retrait de joueur
		} else if(!empty($_POST['nom_retrait'])) {

		    if ($_POST['eff'] == "Supprimer") {

			$joueur_supp = preg_split('/ /',$_POST['nom_retrait']);

                        $this->_playCtrl->removePlayer($joueur_supp[0], $joueur_supp[1]);
                    }
                    
		    $this->_connCtrl->admin();
		// Dans le cas d'un ajout d'équipe
		} else if(!empty($_POST['equipe_ajout']) && !empty($_POST['cat_ajout'])) {

		    if ($_POST['equipe'] == "Créer") {

                        $this->_playCtrl->newTeam($_POST['equipe_ajout'], $_POST['cat_ajout']);
                    }
                    
		    $this->_connCtrl->admin();
		// Dans le cas d'un retrait d'équipe
		} else if(!empty($_POST['equipe_retrait'])) {

		    if ($_POST['equipe'] == "Supprimer") {

			$equipe = preg_split('/-/',$_POST['equipe_retrait']);

                        $this->_playCtrl->removeTeam($equipe[0], $equipe[1]);
                    }
                    
		    $this->_connCtrl->admin();                
                // Dans le cas d'un ajout d'absence
                } else if (!empty($_POST['joueur_abs']) && !empty($_POST['raison_abs'])) {

                    $joueur_abs = preg_split('/ /',$_POST['joueur_abs']);

                    if ($_POST['abs'] == "enr_abs")
		    {
			$this->_playCtrl->newAbsentPlayer($joueur_abs[0], $joueur_abs[1], $_POST['raison_abs']);
		    }
                    
                    $this->_connCtrl->admin();
                // Dans le cas d'un retrait d'absence
                } else if (!empty($_POST['retirer_abs'])) {

                    $joueur_abs = preg_split('/ /',$_POST['retirer_abs']);
                  
		    if ($_POST['abs'] == "supp_abs")
		    {
		    	$this->_playCtrl->removeAbsentPlayer($joueur_abs[0], $joueur_abs[1]);
		    }
                    
                    $this->_connCtrl->admin();
                // Dans le cas d'un ajout de compétition
                } else if (!empty($_POST['compet_ajout'])) {
                    
                    if ($_POST['compet'] == 'Enregistrer') {
			$this->_utilsCtrl->newCompetition($_POST['compet_ajout']);
		    }
                    
                    $this->_connCtrl->admin();
                // Dans le cas d'un retrait de compétition
                } else if (!empty($_POST['compet_retrait'])) {
                    
                    if ($_POST['compet'] == 'Supprimer') {
			$this->_utilsCtrl->removeCompetition($_POST['compet_retrait']);
		    }
                    
                    $this->_connCtrl->admin();
                // Dans le cas d'un ajout de match
                } else if (!empty($_POST['equipe_match'])) {

                    if ($_POST['match'] == 'Enregistrer') {

			$equipe = preg_split('/-/',$_POST['equipe_match']);

			$this->_utilsCtrl->newMatch($_POST['date_match'],$equipe[1],$_POST['compet_match'], $equipe[0], $_POST['adv_match'],$_POST['horaire_match'],"Site","Terrain");
		    }
                    
                    $this->_connCtrl->admin();
		// Dans le cas d'un retrait de match
                } else if (!empty($_POST['match_retrait'])) {

                    if ($_POST['match'] == 'Supprimer') {

			$match = preg_split('/-/',$_POST['match_retrait']);

			$this->_utilsCtrl->removeMatch($match[0],$match[1],$match[2],$match[3],"$match[4]-$match[5]-$match[6]");
		    }
                    
                    $this->_connCtrl->admin();
                // Dans le cas d'un affichage de matchs pour faire une convocation
                } else if (!empty($_POST['date_rencontre'])) {

                    if ($_POST['selection'] == 'Sélectionner') {

			$date = $_POST['date_rencontre'];

			$this->_connCtrl->admin_convoc($date);
		    }
                // Dans le cas d'une publication de convocation
                } else if (!empty($_POST['Publier'])) {

                	$joueurs_presents = $_SESSION["joueurs_presents"];
			$matchs = [];

			foreach($joueurs_presents as $joueur)
			{
				if(isset($_POST["$joueur[0]-$joueur[1]"]))
				{
					$match = $_POST["$joueur[0]-$joueur[1]"];

					if(!array_key_exists("$match",$matchs))
					{
						$matchs["$match"] = ["$joueur[0] $joueur[1]"];
					}
					else
					{
						array_push($matchs["$match"],"$joueur[0] $joueur[1]");
					}
				}
				else
				{
					if(!array_key_exists("exempt",$matchs))
					{
						$matchs["exempt"] = ["$joueur[0] $joueur[1]"];
					}
					else
					{
						array_push($matchs["exempt"],"$joueur[0] $joueur[1]");
					}
				}
			}

			$nom = $_SESSION["date_convocation"];

			$fichier = fopen("views/convocations/$nom.html",'w+');

			fwrite($fichier,"<!doctype html>\n<html lang=\"fr\">\n<head>\n\t<meta charset=\"utf-8\">\n\t<title>Titre de la page</title>\n</head>\n\n<body>\n");
			
			foreach($matchs as $match => $joueurs)
			{
				if($match != "exempt")
				{
					fwrite($fichier,"<div>$match</div><br><br><ul>\n\n");

					foreach($joueurs as $joueur)
					{
						fwrite($fichier,"<li>$joueur</li><br>\n");
					}

					fwrite($fichier,"</ul><br>\n");
				}
			}

			fwrite($fichier,"<div>Exempt</div><br><br><ul>\n");

			if(array_key_exists("exempt",$matchs))
			{
				foreach($matchs["exempt"] as $joueur)
				{
					fwrite($fichier,"<li>$joueur</li><br>\n");
				}
			}

			fwrite($fichier,"</ul></body>\n</html>\n");

			$this->_utilsCtrl->newConvocation($nom);

			$this->_connCtrl->admin();
                    
                } else if (!empty($_POST['deco'])) {
                    session_destroy();
                    $this->_mainCtrl->home();
                } 
		else 
		{
		    $this->_connCtrl->admin();
                }
                
            }
            else
            {
                if (empty($_POST['user']) && empty($_POST['password'])) {
                    $this->_mainCtrl->home();
                } else {
                    $this->_connCtrl->connexion($_POST['user'], $_POST['password']);
                }
            }
        }
        catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    
    private function error($msgError) {
        $vue = new View("Error");
        $vue->generate(array('msgError' => $msgError));
    }

}
