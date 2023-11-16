<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArticleModel extends CI_Model{
    public function get_all(){
        $query = $this->db->get('v_article');
        return $query->result_array();
    }
    public function get_fournisseurs($article){
        $query = $this->db->get_where('v_article_fournisseur', array('idarticle' => $article['idarticle']));
        return $query->result_array();
    }
}