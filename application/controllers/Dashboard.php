<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
 	{
 		parent::__construct();	
 		
 		if (!$this->session->userdata('isAdmin')) 
        redirect('logout');
 		
		$this->load->model(array(
 			// 'dashboard/admin_model'  
 		));
 	}

 	public function index()
	{
		$this->template->load('template/template.php', 'template/pagina.php');
		// $this->load->view('template/template.php');
	}


	

}
