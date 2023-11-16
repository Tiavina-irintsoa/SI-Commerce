<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fournisseur extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->id_name = "idfournisseur";
        $this->table = "fournisseur"; 
        $this->all = "fournisseurs";
        $this->view = "v_fournisseur";
        $this->load->model('generic_model' , 'gm');
        $this->list_articles = $this->gm->get_all("article");
        $this->load->helper('fournisseur_helper');
    }


    public function index() {
        $data[$this->all] = $this->gm->get_all($this->view);
        $data['id'] = $this->id_name;
        $this->load->view($this->table, $data);
    }

    public function create(){
        $data['nom'] = "ajout";
        $data["bouton"] = "Ajouter";
        $data['id_name']= $this->id_name;
        $data["list"] = $this->list_articles;
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
        $data["articles"] = $this->gm->get_by_id_list("v_article_fournisseur" , $id  );
        $data["bouton"] = "Modifier";
        $data["url"] = base_url($this->table."/update");
        $data['input_value'] = $this->gm->get_by_id($this->table ,$id );
        $data["list_articles"] = $this->list_articles;
        $data['nom'] = "Modification";
        $data['id_name']= $this->id_name;


        $result = compareAndMergeArrays($data["list_articles"], $data["articles"]);
        $data["list"] = $result;
        $this->load->view($this->table . "_form" , $data );
    }

    public function insert() {
        $data = array(
            'nomfournisseur' => $this->input->post('nomfournisseur'),
            'emailfournisseur' => $this->input->post('emailfournisseur')
        );
        $articles = $this->input->post("articles");

        $id =  array(
            "name" =>  $this->id_name,
            "value" => $this->input->post($this->id_name))
        ;

        $this->gm->insert( $this->table ,  $data);
        $last_insert_id = $this->gm->getLast( $this->table , $this->id_name );
        var_dump($last_insert_id);

        foreach( $articles as $a ){
            $this->gm->insert( "articlefournisseur" , array(
                $this->id_name => $last_insert_id[$this->id_name],
                "idarticle" => ($a)    
            ));   
            // $this->gm->afficherRequete();
        }
        redirect($this->table); 
    }

    public function update() {
        $articles = $this->input->post("articles");

        $id =  array(
            "name" =>  $this->id_name,
            "value" => $this->input->post($this->id_name))
        ;
        $this->gm->delete( "articlefournisseur" , $id );
        // $this->gm->afficherRequete();
        foreach( $articles as $a ){
            $this->gm->insert( "articlefournisseur" , array(
                $this->id_name =>     $this->input->post($this->id_name),
                "idarticle" => ($a)    
            ));   
            // $this->gm->afficherRequete();
        }
        $data = array(
            'nomfournisseur' => $this->input->post('nomfournisseur'),
            'emailfournisseur' => $this->input->post('emailfournisseur')
        );

        $this->gm->update($this->table, $id ,$data);
        // $this->gm->afficherRequete();
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