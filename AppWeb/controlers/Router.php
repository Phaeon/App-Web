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
                } else if (!empty($_POST['joueur_abs']) && !empty($_POST['raison_abs']) && !empty($_POST['date_abs'])) {

                    $joueur_abs = preg_split('/ /',$_POST['joueur_abs']);

                    if ($_POST['abs'] == "enr_abs")
		    {
			$this->_playCtrl->newAbsentPlayer($joueur_abs[0], $joueur_abs[1], $_POST['raison_abs'], $_POST['date_abs']);
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

			$this->_utilsCtrl->newMatch($_POST['date_match'],$equipe[1],$_POST['compet_match'], $equipe[0], $_POST['adv_match'],$_POST['horaire_match'],$_POST['site_match'],$_POST['terrain_match']);
		    }
                    
                    $this->_connCtrl->admin();
		// Dans le cas d'un ajout de plusieurs matchs
		} else if(isset($_FILES['fichier'])){
        
        		$file_name = $_FILES['fichier']['name'];
      			$file_size = $_FILES['fichier']['size'];
      			$file_ext = strtolower(explode('.',$file_name)[array_key_last(explode('.',$file_name))]);
      
        		// On vérifie si c'est bien un fichier CSV
      			if($file_ext != "csv")
			{
         			echo "<script>alert('Extension non autorisé, veuillez sélectionner un fichier CSV.')</script>";
         			exit();
      			}

			// On vérifie si le fichier n'est pas trop grand
      			if($file_size > 2097152)
			{
         			echo "<script>alert('Fichier trop volumineux (> 2 MB)')</script>";
         			exit();
      			}
        
        		$file_tmp = $_FILES['fichier']['tmp_name'];
        
        		// Importer les données du CSV
        		if(file_exists($file_tmp) )
			{
            			if($id_file=fopen($file_tmp,"r"))
				{
                			flock($id_file,3);
              
                			// Analyser chaque ligne
                			while($tab=fgetcsv($id_file,0,";") )
					{
                	    			// Dans le cas où le nombre de champs n'est pas valide
                	    			if (count($tab) < 8)
						{
                	        			exit();
                	    			}

                	    			$date = $tab[0];
						$categorie = $tab[1];
                	    			$competition = $tab[2];
                	    			$equipe = $tab[3];
                	    			$adversaire = $tab[4];
                	    			$heure = $tab[5];
						$site = $tab[6];
						$terrain = $tab[7];

               	        			$this->_utilsCtrl->NewMatch($date,$categorie,$competition,$equipe,$adversaire,$heure,$site,$terrain);
                			}
                	
                			fclose($id_file);
            			}
        		}
			else
			{
            			echo "Fichier inaccessible.";
        		}
                    
                    	$this->_connCtrl->admin();
		// Dans le cas d'un ajout de score
                } else if (!empty($_POST['match_score'])) {

                    if ($_POST['match'] == 'Score') {

			$match = preg_split('/;/',$_POST['match_score']);

			$this->_utilsCtrl->insertScore($match[4],$match[1],$match[0],$match[2],$match[3],$_POST['domicile'],$_POST['exterieur']);
		    }
                    
                    $this->_connCtrl->admin();
		// Dans le cas d'un retrait de match
                } else if (!empty($_POST['match_retrait'])) {

                    if ($_POST['match'] == 'Supprimer') {

			$match = preg_split('/;/',$_POST['match_retrait']);

			$this->_utilsCtrl->removeMatch($match[0],$match[1],$match[2],$match[3],$match[4]);
		    }
                    
                    $this->_connCtrl->admin();
                // Dans le cas d'un affichage de matchs pour faire une convocation
                } else if (!empty($_POST['date_rencontre'])) {

                    if ($_POST['selection'] == 'Sélectionner') {

			$date = $_POST['date_rencontre'];

			$this->_connCtrl->admin_convoc($date);
		    }
                // Dans le cas d'une publication de convocation
                } else if (!empty($_POST['Publier_convoc'])) {

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

			$csv = fopen("views/convocations/$nom.csv",'w+');

			fwrite($fichier,"<!doctype html>\n<html lang=\"fr\">\n<head>\n\t<meta charset=\"utf-8\">\n\t<title>Convocation</title>\n</head>\n\n<body>\n");
			
			foreach($matchs as $match => $joueurs)
			{
				if($match != "exempt")
				{
					$match = preg_split('/;/',$match);

					fwrite($fichier,"<div>$match[0]</div><br>\n");
					fwrite($fichier,"<div>$match[1]</div><br>\n");
					fwrite($fichier,"<div>$match[2]</div><br>\n");
					fwrite($fichier,"<div>$match[3]</div><br><br><ul>\n\n");

					fwrite($csv,"$match[0];\n");
					fwrite($csv,"$match[1];\n");
					fwrite($csv,"$match[2];\n");
					fwrite($csv,"$match[3];\n\n");

					foreach($joueurs as $joueur)
					{
						fwrite($fichier,"<li>$joueur</li><br>\n");
						fwrite($csv,"$joueur;\n");
					}

					fwrite($fichier,"</ul><br>\n");
					fwrite($csv,"\n");
				}
			}

			fwrite($fichier,"<div>Exempt</div><br><br><ul>\n");
			fwrite($csv,"Exempt;\n\n");

			if(array_key_exists("exempt",$matchs))
			{
				foreach($matchs["exempt"] as $joueur)
				{
					fwrite($fichier,"<li>$joueur</li><br>\n");
					fwrite($csv,"$joueur;\n");
				}
			}

			fwrite($fichier,"</ul></body>\n</html>\n");

			$this->_convCtrl->clearConvocation($nom);
			$this->_utilsCtrl->newConvocation($nom);

			$this->_connCtrl->admin();
                // Dans le cas d'un enregistrement de convocation
                } else if (!empty($_POST['Enregistrer_convoc'])) {

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

			$date = $_SESSION["date_convocation"];

			$this->_convCtrl->clearConvocation($date);

			foreach($matchs as $match => $joueurs)
			{
				if($match != "exempt")
				{
					foreach($joueurs as $joueur)
					{
						$this->_convCtrl->saveConvocation($date,$joueur,$match);
					}
				}
			}

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
