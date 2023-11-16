<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require_once('ServiceAchatController.php');
    class DemandeProforma extends ServiceAchatController{
        public function __construct(){
            parent::__construct();
            $this->load->Model('BesoinModel');
        }
        public function listeParNature(){
            $data=array();
            $data['besoins'] = $this->BesoinModel->get_par_nature();
            $data['title'] = 'Besoins par nature';
            $data['page'] = 'besoin_par_nature';
            $this->load->view('template',$data);
        }
        public function index(){
            $data['page'] = 'demandeproforma';
            $data['title'] = 'Faire une demande de proforma';
            $this->load->view('template',$data);
        }
    }