<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    require_once('ServiceModel.php');
    class UserModel extends CI_Model{
        public function auth($login,$motdepasse){
            $query = $this->db->get_where('personnel', array('login' => $login, 'motdepasse' => $motdepasse));
            if($query->num_rows()==0){
                return null;
            }   
            $user = $query->row_array();
            $user['service'] = $this->get_service($user);
            $user['chef'] = $this->is_chef_service($user);
            $this->load->Model('ServiceModel');
            if($user['service'] == $this->ServiceModel->get_achat()){
                $user['achat'] = true;
            }
            else if($user['service'] == $this->ServiceModel->get_finance()){
                $user['finance'] = true;
            }
            else if($user['service'] == $this->ServiceModel->get_commercial()){
                $user['commercial'] = true;
            }
            return $user;
        }
        public function get_service($user){
            $query = $this->db->get_where('v_service_poste_personnel', array('matricule' => $user['matricule']));
            $res =  $query->row_array();
            return $res['idservice'];
        }
        public function is_chef_service($user){
            $query = $this->db->get_where('v_chef_service', array('matricule' => $user['matricule']));
            
            if($query->num_rows() == 0){
                return false;
            }
            return true;
        }
    }
?>