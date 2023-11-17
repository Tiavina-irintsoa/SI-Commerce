&<?php

    defined('BASEPATH') or exit('No direct script access allowed');
    
    class PDF extends CI_Controller{

        public function __construct() {
            parent::__construct();
            $this->load->model('pdfmodel' , 'pdf');
        }

        public function index(){
            ob_start();
            $data = array(
                array("Colonne 1", "Colonne 2"),
                array("Donnée 1", "Donnée 2"),
                array("Donnée 4", "Donnée 5")
            );
            $societe = 'Miraculous LadyBug';
            $f = 'Fournisseur';
            $delai = '08-08-2023';
            $this->pdf->liste_proforma($societe, $f, $delai, $data);            
            ob_end_flush();       
        }
    }
?>