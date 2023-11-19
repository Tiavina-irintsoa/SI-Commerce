<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require_once "UserSession.php";

    class Besoin extends UserSession{

        public function __construct() {
            parent::__construct();
            $this->nav_name = "besoin";
            $this->load->model('generic_model' , 'gm'); 

        }

        public function index($erreur = null){
            $data = array();
            $data['page'] = 'ajoutbesoin';
            $data["nav_name"] = $this->nav_name;
            $data['title'] = 'Ajouter un besoin';
            $this->load->Model('ArticleModel');
            $data['erreur'] = $erreur;
            $data['articles'] = $this->ArticleModel->get_all();
            $this->load->view('template',$data);
        }

        public function validation_all(){
            $data["page"] = "validation";
            $data["nav_name"] = $this->nav_name;
            $data["url"] = "besoin/validation_all";
            $data["titre_liste"] = "Listes des besoin non validés de cette semaine ";
            $data["titre_bouton"] = "Afficher tous les besoins non validés";
            $data["detail_besoin"] = $this->gm->get_all("v_article_detailbesoin" , "idbesoin" ); 
            $data["besoins"] =  $this->gm->get_all("v_besoin_semaine_personnel_poste_all", "datebesoin" );
            $this->load->view("besoin_valide" , $data);
        }

        public function validation(){
            $idservice = $_SESSION['user']['service'];
            $data["page"] = "validation";
            $data["nav_name"] = $this->nav_name;
            $data["url"] = "besoin/validation_all";
            $data["title_all"] = "Listes des besoin non validés avant cette semaine ";
            $data["titre_liste"] = "Listes des besoin non validés de cette semaine ";
            $data["titre_bouton"] = "Afficher tous les besoins non validés";
            $data["detail_besoin"] = $this->gm->get_all("v_article_detailbesoin" , "idbesoin" ); 
            $data["all_besoins"] = $this->gm->get_all("v_besoin_semaine_personnel_poste_pas_semaine", "datebesoin" ,  "asc" , "array" , array( "idservice" => $idservice )  );
            $data["besoins"] =  $this->gm->get_all("v_besoin_semaine_personnel_poste", "datebesoin" , "asc" , "array" , array( "idservice" => $idservice )  );
            $this->load->view("besoin_valide" , $data);
        }

        public function accept(){
            $id = array( 
                "name" => "idbesoin",
                "value" =>$this->input->get("idbesoin") 
            );
            $data = array(
                "datevalidation" => date('Y-m-d H:i:s')
            );
            $this->gm->update( "besoin" , $id , $data );
            redirect( "besoin/validation" );
        }

        public function refus(){
            $id = array( 
                "name" => "idbesoin",
                "value" =>$this->input->get("idbesoin") 
            );
            $data = array(
                "daterefus" => date('Y-m-d H:i:s')
            );
            $this->gm->update( "besoin" , $id , $data );
            redirect( "besoin/validation" );
        }

        public function submit(){
            $articles = $this->input->post('article');
            $quantites = $this->input->post('quantite');
            $date = $this->input->post('date');
            $articles = is_array($articles) ? $articles : [$articles];
            $quantites = is_array($quantites) ? $quantites : [$quantites];
            
            $user = $this->session->user;
            $this->load->Model('BesoinModel');
            $status = $this->BesoinModel->insertAll($articles,$quantites,$date,$user);
            // $this->index('Erreur');
            if($status == true){
                redirect('besoin/index');
            }
            else{
                $this->index('Erreur');
            }
        }
    }