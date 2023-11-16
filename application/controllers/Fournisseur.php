<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fournisseur extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->id_name = "idfournisseur";
        $this->table = "fournisseur"; 
        $this->all = "fournisseurs";
        $this->load->model('generic_model' , 'gm'); // Chargez le modèle générique
    }


    public function index() {
        $data[$this->all] = $this->gm->get_all($this->table);
        $data['id'] = $this->id_name;
        $this->load->view($this->table, $data);
    }

    public function create(){
        $data['nom'] = "ajout";
        $data["bouton"] = "Ajouter";
        $data["url"] = base_url($this->table."/insert");
        $this->load->view($this->table . "_form" , $data);
    }

    public function edit(){
        $id =  array(
            "name" =>  $this->id_name,
            "value" => $this->input->get($this->id_name))
        ;
        $data["bouton"] = "Modifier";
        $data= array(
            $this->id_name => $id['value']
        );
        $data["url"] = base_url($this->table."/update");
        $data['input_value'] = $this->gm->get_by_id($this->table ,$id );
        $data['nom'] = "Modification";
        $this->load->view($this->table . "_form" , $data );
    }

    public function insert() {
        $data = array(
            'nomfournisseur' => $this->input->post('nomfournisseur'),
            'emailfournisseur' => $this->input->post('emailfournisseur')
        );
        $this->gm->insert( $this->table ,  $data);
        redirect($this->table); 
    }

    public function update() {
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

        $where = array(
            $this->id_name =>  $this->input->post($this->id_name)
        ); 
        $this->gm->soft_delete($this->table, $where);
        redirect($this->table); 
    }

}

?>