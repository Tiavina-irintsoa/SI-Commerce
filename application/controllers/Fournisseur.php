<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fournisseur extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->id_name = "idfournisseur";
        $this->table = "fournisseur"; 
        $this->load->model('generic_model' , 'gm'); // Chargez le modèle générique
    }

    public function index() {
        $data['fournisseurs'] = $this->gm->get_all('fournisseur');
        $this->load->view($this->table, $data);
    }

    public function create() {
        $data = array(
            'nomfournisseur' => $this->input->post('nomfournisseur'),
            'emailfournisseur' => $this->input->post('emailfournisseur')
        );

        $this->gm->insert( $this->table ,  $data);
        redirect($this->table); 
    }

    public function edit() {
        $id =  array(
            "name" =>  $this->id_name,
            "value" => $this->input->post($this->id_name))
        ;
        $data = array(
            'nomfournisseur' => $this->input->post('nomfournisseur'),
            'emailfournisseur' => $this->input->post('emailfournisseur')
        );

        $this->gm->update($this->table, $id ,$data);
        redirect($this->table); 
    }

    public function remove(){
        $id =  array(
            "name" =>  $thgis->id_name,
            "value" => $this->input->post($this->id_name))
        ;

        $this->gm->soft_delete($this->table, $id);
        redirect($this->table); 
    }

}

?>