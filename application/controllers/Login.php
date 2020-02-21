<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
 	{
 		parent::__construct();

 		$this->load->model(array(
 			'login_model' 
 		));
 	}


	/** Tela de login **/
	public function index()
	{
		$this->load->view('login/login.php');
	}

	/** Função de logar **/
	public function entrar()
	{
		if ($this->session->userdata('isLogIn'))
			redirect('dashboard');

		/** Validação de campos preenchidos **/
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('senha', 'senha', 'required');

		$data['user'] = (object)$userData = array(
			'email'	=> $this->input->post('email'),
			'senha'	=> $this->input->post('senha'),
		);

		if ($this->form_validation->run() == FALSE)
        {
               $this->session->set_flashdata('message', 'Preencha os campos corretamente');
				redirect('login');
        }
        else
        {
        	/** Checar usuario existe **/
        	$user = $this->login_model->checar_usuario($userData);

        	if($user->num_rows() > 0) 
			{ 

				$sData = array(
					'isAdmin' 	  => true,
					'id' 		  => $user->row()->id,
					'user_id' 	  => $user->row()->user_id,
					'nome' 	      => $user->row()->nome,
					'usuario'	  => $user->row()->usuario,
					'email' 	  => $user->row()->email,

				);	
				
				//salvar os dados do usuario na sessão 
				$this->session->set_userdata($sData);

				$this->session->set_flashdata('message','Bem vindo'.$user->row()->nome.'');
				redirect('dashboard');
        	} else {
        	 //Caso o usuario nao existe.
        	$this->session->set_flashdata('message', 'Inválida a combinação de usuario/senha');
				redirect('login');
			}
        }
	}

	public function cadastro()
	{
		$this->load->view('login/registrar.php');
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
				'nome'		=> $this->input->post('nome'),
				'email'		=> $this->input->post('email'),
				'senha' 	=> md5($this->input->post('senha1')),
				'usuario'	=> $this->input->post('usuario'),
				'user_id'	=>$this->randomID(),	
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
