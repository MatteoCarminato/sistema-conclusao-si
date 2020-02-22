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
		$data['titulo']  = 'Lista de Clientes';
 		$this->template->load('template/template.php', 'clientes/listar.php', $data);
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


    public function cadastro()
    {
       $data['titulo']  = 'Cadastro de Clientes';
        $this->template->load('template/template.php', 'clientes/cadastro.php', $data);
    }

    /** Função de Cadastro **/
    public function cadastrar()
    {
        /** Validação de campos preenchidos **/
        $this->form_validation->set_rules('usuario', 'usuario', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('senha1', 'senha1', 'required');
        $this->form_validation->set_rules('senha2', 'senha2', 'required');

        if ($this->form_validation->run() == FALSE)
        {

           $this->session->set_flashdata('message', 'Preencha todos os campos corretamente');
             redirect('login/cadastro');
                
        }
        else
        {
            // Confirmar senha se coincidi
            $password = $this->input->post('senha1');
            $password2 = $this->input->post('senha2');

            if ($password <> $password2) { 
                $this->session->set_flashdata('message', 'As senhas não confere.');
                redirect('login/cadastro');
            }


            // Confirma se existe o email
            $this->db->select('email');
            $this->db->where('email', $this->input->post('email'));
            $retorno = $this->db->get('admin')->num_rows();

            if($retorno > 0 ){
                $this->session->set_flashdata('message', 'Esse email já esta cadastrado');
                redirect('login/cadastro');
            }

            // Confirma se existe o usuario
            $this->db->select('usuario');
            $this->db->where('usuario', $this->input->post('usuario'));
            $retorno = $this->db->get('admin')->num_rows();

            if($retorno > 0 ){
                $this->session->set_flashdata('message', 'Esse usuário já esta cadastrado');
                redirect('login/cadastro');
            }

            $data['user'] = (object)$userData = array(
                'nome'      => $this->input->post('nome'),
                'email'     => $this->input->post('email'),
                'senha'     => md5($this->input->post('senha1')),
                'usuario'   => $this->input->post('usuario'),
                'user_id'   =>$this->randomID(),    
            );

            if ($this->login_model->criar_admin($userData)) {
                    $this->session->set_flashdata('usuario_cadastrado', 'Usuário cadastrado com sucesso!');
                    redirect('login');

                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                    redirect('login');
                }
            }
    }

    public function consulta()
    {

        $this->load->library('curl');
        $cep = $this->input->post('cep');
        echo $this->curl->consulta($cep);
    }
    public function randomID($mode = 2, $len = 6)
    {
        $result = "";
        if($mode == 1):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 2):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        elseif($mode == 3):
            $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 4):
            $chars = "0123456789";
        endif;

        $charArray = str_split($chars);
        for($i = 0; $i < $len; $i++) {
                $randItem = array_rand($charArray);
                $result .="".$charArray[$randItem];
        }
        return $result;
    }

  



	

}
