<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArticleModel extends CI_Model{
    public function get_all(){
        $query = $this->db->get('v_article');
        return $query->result_array();
    }
}