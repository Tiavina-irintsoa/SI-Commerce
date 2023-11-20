<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require_once('ServiceAchatController.php');
    class DemandeProforma extends ServiceAchatController{
        public function __construct(){
            parent::__construct();
            $this->nav_name = "demandeproforma";
            $this->load->Model('BesoinModel');
            $this->load->Model('ProformaModel');
            $this->load->model('PdfModel' , 'pdf');
        }

        public function listeParNature(){
            $data=array();
            $data["nav_name"] = $this->nav_name;
            $data['besoins'] = $this->BesoinModel->get_par_nature();
            $data['title'] = 'Besoins par nature';
            $data['page'] = 'besoin_par_nature';
            $this->load->view('template',$data);
        }
        public function submit(){
            $error = false;
            if(!isset($_POST['date'])){
                $this->index('Date invalide');
                $error = true;
            }
            else{
                $date = $this->input->post('date');
            
            $articles = $this->session->articles;
            for ($i=0; $i <count($articles) && !$error ; $i++) { 
                if(!isset($_POST['FOURNISSEUR'.$articles[$i]['idarticle']])){
                    $this->index('Fournisseurs invalides pour '.$articles[$i]['nomarticle']);
                    $error = true;
                }
                else{ 
                    $fournisseurs = $this->input->post('FOURNISSEUR'.$articles[$i]['idarticle']);
                    $fournisseurs = is_array($fournisseurs) ? $fournisseurs : [$fournisseurs];
                    if(count($fournisseurs)<3){
                        $this->index('Fournisseurs invalides pour '.$articles[$i]['nomarticle']);
                        $error = true;
                    }
                    $articles[$i]['fournisseurs_choisis'] = $fournisseurs;
                }
                if($error){
                    break;
                }
            }
            if($error==false){
                $user = $this->session->user;
                $status  =$this->ProformaModel->sendDemande($articles,$date,$user);
                $this->session->unset_userdata('articles');
                redirect('demandeProforma/listeParNature');
            }
            }
        }
        public function index($erreur = null){
            $data['today']= date("Y-m-d");
            $data['page'] = 'demandeproforma';
            $data['title'] = 'Faire une demande de proforma';
            $data['erreur']  =$erreur;
            $data["nav_name"] = $this->nav_name;
            $data['articles']=$this->BesoinModel->get_fournisseur();
            $this->session->set_userdata('articles',$data['articles']);
            $this->load->view('template',$data);
        }
    }