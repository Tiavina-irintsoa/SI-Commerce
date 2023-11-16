<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller{
    public function __construct(){
        $this->load->Model('UserModel');
    }
    public function index(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->UserModel->auth($username,$password);
        if($user == null){
            $data = array();
            $data['erreur'] = "Nom d'utilisateur ou mot de pass incorrect";
            $this->load->view('login',$data);
        }
    }
}