<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServiceAchatController extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $user = $this->session->user;
        if(!isset($user['achat'])){
            redirect('welcome');
        }
    }
}