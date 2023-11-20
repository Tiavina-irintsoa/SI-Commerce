<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require_once('UserSession.php');
    class BonDeCommande extends USerSession {
        public function __construct(){
            parent::__construct();
            $user = $this->session->user;
            $this->nav_name = "proforma";
            $this->load->model('pdfmodel' , 'pdf');
            $this->load->Model('BonComModel' , 'bm');
        }

        public function all_bdc(){
            $data["nav_name"] = $this->nav_name;
            $data["listes"] = $this->bm->get_bdc(); 
            $data["titre_liste"] = "Listes des bons de commandes par délai de livraison";
            $this->load->view("liste_bdc_envoye" , $data);
        }

        public function pdf_bdc_detail(){
            $id = $this->input->get('id');
            $fournisseur = $this->input->get('fournisseur');
            $delai = $this->input->get('delai');

            $details = $this->bm->get_detail_bdc($id, $fournisseur);      
            $info = $this->bm->get_information($id);
            
            ob_start();
            $data['idfournisseur'] = $fournisseur;
            $data['fournisseur'] = $details[0]['nomfournisseur'];
            $data['societe'] = 'Miraculous';
            $data['date'] = $date = date('Y-m-d', strtotime($details[0]['datecreation']));
            $data['delai'] = $delai;
            $data['numero'] = $id;
            $data['details'] = $details;

            $data['partielle'] = 'NON'; 
            if($info['livraisonpartielle'] == 1){
                $data['partielle'] = 'OUI';
            }
            $data['mode'] = $info['nommode'];

            $this->pdf->content_bdc($data);            
            ob_end_flush();  
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
                $details = $this->bm->get_detail_bdc($id, $f['idfournisseur']);
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