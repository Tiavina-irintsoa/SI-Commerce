<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->Model('UserModel');
    }
    public function index(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->UserModel->auth($username,$password);
        if($user == null){
            $data = array();
            $data['erreur'] = "Nom d'utilisateur ou mot de passe incorrect";
            $this->load->view('login',$data);
        }
        else{
            $this->session->set_userdata('user',$user);
            redirect("welcome/start");
        }
    }
    public function disconnect(){
        $this->session->sess_destroy();
        redirect('Welcome');
    }
}