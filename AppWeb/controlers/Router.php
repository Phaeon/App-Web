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

			$equipe = preg_split('/-/',$_POST['equipe_ajout']);

                        $this->_playCtrl->newPlayer($_POST['nom_ajout'], $_POST['prenom_ajout'], $_POST['licence_ajout'],$equipe[0],$equipe[1]);
                    }
                    
                    $this->_connCtrl->admin();
		// Dans le cas d'un changement d'équipe de joueur
		} else if(!empty($_POST['nom_changement'])) {

		    if ($_POST['eff'] == "Changer") {

			$joueur_chang = preg_split('/ /',$_POST['nom_changement']);

			$equipe = preg_split('/-/',$_POST['equipe_changement']);

                        $this->_playCtrl->changePlayer($joueur_chang[0], $joueur_chang[1], $equipe[0], $equipe[1]);
                    }
                    
		    $this->_connCtrl->admin();  
		// Dans le cas d'un retrait de joueur
		} else if(!empty($_POST['nom_retrait'])) {

		    if ($_POST['eff'] == "Supprimer") {

			$joueur_supp = preg_split('/ /',$_POST['nom_retrait']);

                        $this->_playCtrl->removePlayer($joueur_supp[0], $joueur_supp[1]);
                    }
                    
		    $this->_connCtrl->admin();                   
                // Dans le cas d'un ajout/retrait d'absence
                } else if (!empty($_POST['joueur_abs']) && !empty($_POST['raison_abs'])) {
                    $joueur = explode(' ',$_POST['joueur_abs']); // A modifier pour prendre en compte les cas particuliers
                    
                    if ($_POST['abs'] == 'supp_abs') $this->_playCtrl->removeAbsentPlayer($joueur[0], $joueur[1], $_POST['date_abs']);
                    else $this->_playCtrl->newAbsentPlayer($joueur[0], $joueur[1], $_POST['compet_abs'], $_POST['raison_abs']);
                    
                    $this->_connCtrl->admin();
                    
                // Dans le cas d'un ajout de site
                } else if (!empty($_POST['gest_site'])) {
                    
                    if ($_POST['gest_site_button'] == 'supp_site') $this->_utils->removeSite($_POST['gest_site']);
                    else $this->_playCtrl->newSite($_POST['gest_site'], $_POST['gest_site_imp']);
                    
                    $this->_connCtrl->admin();
                    
                    
                } else if (!empty($_POST['gest_equi_nom']) && !empty($_POST['gest_equi_cat'])) {
                    
                    if ($_POST['gest_equi_button'] == 'supp_equi') $this->_utils->removeTeam($_POST['gest_equi_nom'], $_POST['gest_equi_cat']);
                    else $this->_playCtrl->newTeam($_POST['gest_equi_nom'], $_POST['gest_equi_cat'], $_POST['gest_equi_eff']);
                    
                    $this->_connCtrl->admin();
                    
                    
                } else if (!empty($_POST['gest_compet_nom'])) {
                    
                    if ($_POST['gest_compet_button'] == 'supp_compet') $this->_utils->removeCompetition($_POST['gest_compet_nom']);
                    else $this->_playCtrl->newCompetition($_POST['gest_compet_nom'], $_POST['gest_compet_imp']);
                    
                    $this->_connCtrl->admin();
                    
                // Dans le cas d'un ajout/retrait de match
                } else if (!empty($_POST['cal_cate']) && !empty($_POST['cal_compet']) && !empty($_POST['cal_equi']) && !empty($_POST['cal_equi_adv']) && !empty($_POST['cal_date']) && !empty($_POST['cal_heureH']) && !empty($_POST['cal_heureM'])) {
                    
                    if ($_POST['cal_button'] == 'supp_cal') $this->_utils->removeMatch($_POST['cal_date'], $_POST['cal_cate'], $_POST['cal_compet'], $_POST['cal_equi'], $_POST['cal_equi_adv'], $_POST['cal_heureH'], $_POST['cal_heureM']);
                    else $this->_playCtrl->newCompetition($_POST['cal_date'], $_POST['cal_cate'], $_POST['cal_compet'], $_POST['cal_equi'], $_POST['cal_equi_adv'], $_POST['cal_heureH'], $_POST['cal_heureM'], $_POST['cal_site'], $_POST['cal_terrain']);
                    
                    $this->_connCtrl->admin();
                    
                // Dans le cas d'une nouvelle convocation (A MODIFIER EN FONCTION DE LA GENERATION DU FORMULAIRE)
                } else if (!empty($_POST['conv_cate']) && !empty($_POST['conv_date']) && !empty($_POST['conv_compet']) && !empty($_POST['conv_equi_adv']) && !empty($_POST['conv_site']) && !empty($_POST['conv_terrain']) && !empty($_POST['conv_heure'])) {
                    
                    if ($_POST['cal_button'] == 'supp_cal') $this->_utils->removeMatch($_POST['conv_date'], $_POST['conv_compet'], $_POST['conv_equi_adv'], $_POST['conv_heureH'], $_POST['conv_heureM'], $_POST['conv_equi']);
                    else $this->_playCtrl->newCompetition($_POST['conv_date'], $_POST['conv_cate'], $_POST['conv_compet'], $_POST['conv_equi_adv'], $_POST['conv_site'], $_POST['conv_terrain'], $_POST['conv_rdv'], $_POST['conv_heureH'], $_POST['conv_heureM'], $_POST['conv_equi']);
                    
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
