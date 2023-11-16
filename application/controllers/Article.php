<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // set_default_timezone('Indian/Antananarivo');
        $this->id_name = "idarticle";
        $this->table = "article"; 
        $this->all = "articles";
        $this->view = "v_article";
        $this->load->model('generic_model' , 'gm'); // Chargez le modèle générique
        $this->categoriearticle = $this->gm->get_all("categoriearticle")  ;
    }


    public function index() {
        $data[$this->all] = $this->gm->get_all($this->view);
        $data['id'] = $this->id_name;
        $this->load->view($this->table, $data);
    }

    public function create(){
        $data["categories"] = $this->categoriearticle;
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
        $data= array(
            $this->id_name => $id['value']
        );
        $data["categories"] = $this->categoriearticle;
        $data["bouton"] = "Modifier";
        $data["url"] = base_url($this->table."/update");
        $data['input_value'] = $this->gm->get_by_id($this->table ,$id );
        $data['nom'] = "Modification";
        $data['id_name']= $this->id_name;
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
        $this->gm->afficherRequete();
        redirect($this->table); 
    }

    public function remove(){

        $where = array(
            $this->id_name =>  $this->input->get($this->id_name)
        ); 
        $this->gm->soft_delete($this->table, $where);

        $this->gm->afficherRequete();

        redirect($this->table); 
    }

}

?>