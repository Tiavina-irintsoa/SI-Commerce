<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require_once('UserSession.php');
    class Proforma extends USerSession {
        public function __construct(){
            parent::__construct();
            $this->nav_name = "proforma";
            $this->load->Model('Generic_model' , 'gm');
            $this->load->Model('ProformaModel' , 'pm');
        }

        public function saisie_submit(){
            $pu = $this->input->post("pu");
            $dispo = $this->input->post("dispo");
            $idarticle = $this->input->post("idarticle");
            $idfournisseur = $this->input->post("idfournisseur") ;
            $iddemande = $this->input->post("iddemande") ;
            $detaisproforma = array();
            foreach( $pu as $i => $p  ){
                $detaisproforma[] = array(
                    "idarticle" => $idarticle[$i],
                    "disponible" => $dispo[$i],
                    "prixunitaire" => $p 
                );
            }

            $status = $this->pm->insertSaisie( $detaisproforma , $idfournisseur , $iddemande );
            if( $status == TRUE ){
                redirect("proforma/demande_fournisseur?iddemande=".$iddemande);
            }
        }

        public function saisie(){
            $idarticle = $this->input->post("idarticle");
            $nomarticle = $this->input->post("nomarticle");
            $articles = array();
            foreach( $idarticle as $i => $id ){
                $articles[] = array(
                    "idarticle" => $id ,
                    "nomarticle" => $nomarticle[$i]
                );
            }
            $data['articles'] = $articles;
            $data['idfournisseur'] = $this->input->post("idfournisseur") ;
            $data['iddemande'] = $this->input->post("iddemande") ;
            $data["titre_liste"] = "Saisie des articles pour le proforma";
            $this->load->view("saisie_proforma" , $data);
        }

        public function demande_fournisseur(){
            $iddemande = $this->input->get("iddemande");
            $where = array(
                "iddemande" => $iddemande
            );
            $data['demandes'] =  $this->gm->get_all("v_demande_proforma_fournisseur_nom"  , "idfournisseur" ,  'asc', 'array', $where ); 
            $data['proforma'] =  $this->gm->get_all("proforma"  , "iddemande" ,'asc', 'array', $where ); 
            $data['details_proforma'] =  $this->gm->get_all("v_detailsproforma_article"  , "iddemande" ,'asc', 'array', $where ); 
            $data['articles'] =  $this->gm->get_all("v_demande_proforma_fournisseur_article"  , "idfournisseur , idarticle" ,  'asc', 'array', $where ); 
            $data["titre_liste"] = "Listes des demandes de proforma envoyés par fournisseur";
            $this->load->view("demande_par_fournisseur" , $data);
        }
    
        public function delai(){
            $data["nav_name"] = $this->nav_name;
            $data["demandes"] = $this->gm->get_all("demandeproforma"  , "delailivraison" ); 
            $data["titre_liste"] = "Listes des demandes par délai de livraison";
            $this->load->view("demande_par_delai" , $data);
        }
    }

?>