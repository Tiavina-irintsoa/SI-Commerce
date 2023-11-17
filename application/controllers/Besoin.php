<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require_once "UserSession.php";

    class Besoin extends UserSession{

        public function __construct() {
            parent::__construct();
            $this->load->model('generic_model' , 'gm'); // Chargez le modèle générique

        }

        public function index($erreur = null){
            $data = array();
            $data['page'] = 'ajoutbesoin';
            $data['title'] = 'Ajouter un besoin';
            $this->load->Model('ArticleModel');
            $data['erreur'] = $erreur;
            $data['articles'] = $this->ArticleModel->get_all();
            $this->load->view('template',$data);
        }

        public function article_besoin(){

        }

        public function validation(){
            $data["besoins"] =  $this->gm->get_all("v_besoin_semaine_personnel_poste", "datebesoin" );
            $this->load->view("validation_besoin" , $data);
        }

        public function submit(){
            $articles = $this->input->post('article');
            $quantites = $this->input->post('quantite');
            var_dump($articles);
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