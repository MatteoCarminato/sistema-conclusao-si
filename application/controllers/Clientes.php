<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	public function __construct()
 	{
 		parent::__construct();	
 		
 		if (!$this->session->userdata('isAdmin')) 
        redirect('logout');
 		
		$this->load->model(array(
 			 'clientes_model'  
 		));
 	}

 	public function index()
	{  
		$data['title']  = 'Clientes';
 		$this->template->load('template/template.php', 'clientes/listar.php', $data);

		// $data['content'] = $this->load->view("backend/user/list", $data, true);
		// $this->load->view("backend/layout/main_wrapper", $data);
	}

    function ajax_list(){   
       $fetch_data = $this->clientes_model->make_datatables();  
       $data = array();  
       foreach($fetch_data as $row)  
       {  
            $sub_array = array();    
            $sub_array[] = $row->id;  
            $sub_array[] = $row->nome;
            $sub_array[] = $row->cpf;  
            // $sub_array[] = '<button type="button" name="update" id="'.$row->id.'" class="btn btn-warning btn-xs">Update</button>';  
            // $sub_array[] = '<button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-xs">Delete</button>';  
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                 =>     intval($_POST["draw"]),  
            "recordsTotal"         =>     $this->clientes_model->get_all_data(),  
            "recordsFiltered"      =>     $this->clientes_model->get_filtered_data(),  
            "data"                 =>     $data  
       );  
       echo json_encode($output);  
    }  
  



	

}
