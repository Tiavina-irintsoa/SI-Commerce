<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ModePaiementModel extends CI_Model {

    public function get_all(){
        $query = $this->db->get('modepaiement');
        return $query->result_array();
    }
}