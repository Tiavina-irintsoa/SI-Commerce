<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserSession extends CI_Controller{
    public function __construct(){
        parent::__construct();
		if(!$this->session->has_userdata('user')){
            redirect('welcome/login');
        }
    }
}

?>