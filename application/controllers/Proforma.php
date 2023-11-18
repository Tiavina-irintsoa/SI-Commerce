<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require_once('UserSession.php');
    class Proforma extends USerSession {
        public function __construct(){
            parent::__construct();
            $this->nav_name = "proforma";
            $this->load->Model('Generic_model' , 'gm');
        }

        public function delai(){
            $data["nav_name"] = $this->nav_name;
            $data["demandes"] = $this->gm->get_all("demandeproforma"  , "delailivraison" ); 
            $data["titre_liste"] = "Listes des demandes par délai de livraison";
            $this->load->view("demande_par_delai" , $data);
        }
    }

?>