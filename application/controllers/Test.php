<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
    public function index(){
        $this->load->view("html/index.php");
    }

    public function table(){
        $this->load->view("html/table.php");
    }
}

?>