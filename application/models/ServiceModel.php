<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class ServiceModel extends CI_Model{
        public function get_achat(){
            $query = $this->db->get('achat');
            $resp = $query->row_array();
            return $resp['idachat'];
        }
        public function get_finance(){
            $query = $this->db->get('finance');
            $resp = $query->row_array();
            return $resp['idfinance'];
        }
        public function get_commercial(){
            $query = $this->db->get('commercial');
            $resp = $query->row_array();
            return $resp['idcommercial'];
        }
    }