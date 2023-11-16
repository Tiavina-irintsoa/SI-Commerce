<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if($this->session->has_userdata('user')){
			echo 'connected';
		}
		redirect('login');
	}	
	public function login(){
		$this->load->view('login');
	}
	public function test(){
		$data['page'] = 'test';
		$this->load->view('template.php',$data);
	}

	// public function email(){
	// 	$config = array(
	// 		'protocol' => 'smtp', 
	// 		'smtp_host' => 'localhost',
	// 		'smtp_port' => 587,
	// 		'smtp_user' => 'votre-adresse-email@gmail.com',
	// 		'smtp_pass' => 'votre-mot-de-passe',
	// 		'mailtype' => 'html', // Type de contenu (texte ou HTML)
	// 		'charset' => 'utf-8',
	// 		'newline' => "\r\n"
	// 	);
		
	// 	$this->email->initialize($config);
	// 	$this->email->from('votre-adresse-email@gmail.com', 'Votre Nom');
	// 	$this->email->to('destinataire@example.com');
	// 	$this->email->subject('Sujet de l\'e-mail');
	// 	$this->email->message('Contenu de l\'e-mail');

	// 	if ($this->email->send()) {
	// 		echo 'E-mail envoyé avec succès.';
	// 	} else {
	// 		show_error($this->email->print_debugger());
	// 	}
		
	// }	
}
