<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {

    // construtor
    function __construct(){
        parent::__construct();       
        
        // Bibliotecas
        $this->load->library('form_validation'); 
    }

    // Carrega view da tela de Login
    public function index(){
        $dados['titulo'] = 'p-tracker - Login';
        $this->load->view('login', $dados);        
    }

    // Rota verificação de login
    public function Login(){
        // Validação do formulário
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('senha', 'senha', 'required');

        // Formulário válido
        if($this->form_validation->run()){
            $email = $this->input->post('email');
            $senha = $this->input->post('senha');

            // Instância do bd
            $this->load->model('usuarios_model');
            
            // Verifica se os dados estão cadastrados
            if(!empty($data = $this->usuarios_model->logarUsuario($email, $senha))){
                // Usuário encontrado
                $session_data = array(
                    'nome' => $data->nome
                );

                $this->session->set_userdata($session_data);
                redirect('home');
            }else{
                // Usuário não encontrado
                $this->session->set_flashdata('error', 'E-mail ou senha inválidos!');
                redirect('setup');
            }
        }else{
            // Formulário inválido para envio
            $this->index();
        }
    }

    // Função para fechar a sessão
    public function Logout(){
        $this->session->unset_userdata('nome');
        redirect('setup');
    }	
}