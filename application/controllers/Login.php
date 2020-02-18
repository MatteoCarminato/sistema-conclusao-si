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
        	$user = $this->login_model->checkUser($userData);

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
		$this->load->view('login/login.php');
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
