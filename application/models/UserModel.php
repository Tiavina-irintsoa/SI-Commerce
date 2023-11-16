<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    require_once('ServiceModel.php');
    class Model extends CI_Model{
        public function auth($login,$motdepasse){
            $query = $this->db->get_where('personnel', array('login' => $login, 'motdepasse' => $motdepasse));
            if($query->num_rows()==0){
                return null;
            }   
            $user = $query->row_array();
            $service = get_service($user);
            $user['chef'] = is_chef_service($user);
            $this->load->Model('ServiceModel');
            if($service == $this->ServiceModel->get_achat()){
                $user['achat'] = true;
            }
            else if($service == $this->ServiceModel->get_finance()){
                $user['finance'] = true;
            }
            else if($service == $this->ServiceModel->get_commercial()){
                $user['commercial'] = true;
            }
            return $user;
        }
        public function get_service($user){
            $query = $this->db->get_where('v_service_poste_personnel', array('matricule' => $user['matricule']));
            return $query->row_array();
        }
        public function is_chef_service($user){
            $query = $this->db->get_where('v_chef_service', array('matricule' => $user['matricule']));
            if($query->num_rows == 0){
                return false;
            }
            return true;

        }
    }
?>