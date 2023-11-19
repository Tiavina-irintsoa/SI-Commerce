<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "UserSession.php";

class ServiceAchatController extends UserSession{
    public function __construct(){
        parent::__construct();
        $user = $this->session->user;
        if(!isset($user['achat'])){
            redirect('welcome');
        }
    }
}