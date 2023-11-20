<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require_once('UserSession.php');
    class BonDeCommande extends USerSession {
        public function __construct(){
            parent::__construct();
            $this->nav_name = "proforma";
            $this->load->Model('BonComModel' , 'bm');
        }
    
        public function all_bdc_finance(){
            $data["nav_name"] = $this->nav_name;
            $data["listes"] = $this->bm->get_bdcFinance(); 
            $data["titre_liste"] = "Listes des bons de commandes par délai de livraison";
            $data["user"] = 1; //finance
            $this->load->view("liste_bdc" , $data);
        }

        public function all_bdc_adjoint(){
            $data["nav_name"] = $this->nav_name; 
            $data["listes"] = $this->bm->get_bdcAdjoint(); 
            $data["titre_liste"] = "Listes des bons de commandes par délai de livraison";
            $data["user"] = 2; //adjoint
            $this->load->view("liste_bdc" , $data);
        }

        public function bdc_detail(){
            $id = $this->input->get('id');
            $data["user"] = $this->input->get('user');
            $data["nav_name"] = $this->nav_name; 
            $fournisseurs = $this->bm->get_fournisseur($id); 
            foreach ($fournisseurs as $f){
                $details = $this->bm->get_detail_bdc($id, $f['idfournisseur']); ;
                $detailsBdc[] = $details;
            }
            $data['listes'] = $detailsBdc;             
            $info = $this->bm->get_information($id);
            $data['partielle'] = 'NON'; 
            if($info['livraisonpartielle'] == 1){
                $data['partielle'] = 'OUI';
            }
            $data['mode'] = $info['nommode'];
            $data["titre_liste"] = "Détail du bon de commande";
            $this->load->view("details_bdc" , $data);
        }

        public function send_pdg(){
            $id = $this->input->get('id');
            $this->bm->set_dateValidationFinance($id); 
            $this->load->view("welcome");
        }

        public function accepter_pdg(){
            $id = $this->input->get('id');
            $this->bm->set_datevalidationAdjoint($id); 
            $this->load->view("welcome");
        }
    }

?>