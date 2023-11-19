<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
    public function index(){
        $this->load->view("html/index.php");
    }

    public function table(){
        $this->load->view("table.php");
    }

    public function form(){
        $this->load->view("form.php");
    }
}

?>