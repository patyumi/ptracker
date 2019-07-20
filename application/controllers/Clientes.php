<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

    // construtor
    function __construct(){
        parent::__construct();

        // Autentica usuário
        $user = $this->session->userdata('nome');
        if(empty($user)){
            redirect('setup');
        }

        // Instância model
        $this->load->model('clientes_model', 'clientes');
    }

     // Carrega as views
	public function index(){
        // método padrão do controller
        $dados['usuario'] = $this->session->userdata('nome');
        $dados['titulo'] = 'Clientes';

        $dados['clientes'] = $this->clientes->listar();

		$this->load->view('clientes/clientes', $dados);
    }
   
    public function cadastrar(){
        $dados['usuario'] = $this->session->userdata('nome');
        $dados['titulo'] = 'Clientes';
        $this->load->view('clientes/cadastrar', $dados);
    }

    public function editar(){
        $dados['usuario'] = $this->session->userdata('nome');
        $dados['titulo'] = 'Clientes';
        $dados['clientes'] = null;
        $dados['historico'] = null;

        $this->load->view('clientes/editar', $dados);
    }
                
    // Realiza operações
    public function salvar(){        
        // Array com dados do formulário
        $dados_form['cnpj'] = $this->input->post('cnpj');
        $dados_form['nomeFantasia'] = $this->input->post('nomeFantasia');
        $dados_form['endereco'] = $this->input->post('endereco');
        $dados_form['telefone'] = $this->input->post('telefone');
        $dados_form['email'] = $this->input->post('email');
           
        // Executa operação do banco de dados
        if($this->clientes->salvar($dados_form)){
            $this->session->set_flashdata('success', 'Cliente cadastrado com sucesso.');
        }else{
            $this->session->set_flashdata('error', 'Ocorreu um erro ao cadastrar cliente!');
        }   
        redirect('clientes/cadastrar');  
    }

    public function buscar(){
        $dados['usuario'] = $this->session->userdata('nome');
        $dados['titulo'] = 'Clientes';
        $dados['clientes'] = null;
        $dados['historico'] = null;

        $cod = $this->input->post('cod');
 
         // Se a requisição for feita através da pág. principal 
         // O valor é recuperado através de get
         if ($cod == null){
             $cod = $this->uri->segment(3);
         }
         
         $query = $this->clientes->getById($cod);
 
         if ($query != null){
             // Instância model histórico
             $this->load->model('historico_model', 'historico');
 
             $hist = $this->historico->getClienteById($query->cod);
 
             $dados['clientes'] = $query;
             $dados['historico'] = $hist;        
         }else{
             $this->session->set_flashdata('error', 'Código do cliente não identificado!');
         }

         $this->load->view('clientes/editar', $dados);
    }                
    

    public function alterar(){
        // Array com dados do formulário
        $cod = $this->input->post('cod');
        $dados_form['cnpj'] = $this->input->post('cnpj');
        $dados_form['nomeFantasia'] = $this->input->post('nomeFantasia');
        $dados_form['endereco'] = $this->input->post('endereco');
        $dados_form['telefone'] = $this->input->post('telefone');
        $dados_form['email'] = $this->input->post('email');
            
        // Executa operação do banco de dados
        if($this->clientes->editar($dados_form, $cod)){
            $this->session->set_flashdata('success', 'Dados do cliente atualizados com sucesso.');
        }else{
            $this->session->set_flashdata('error', 'Ocorreu um erro ao atualizar os dados do cliente!');
        }   

        redirect('clientes/editar');  
    }

    public function excluir(){
         // O valor é recuperado através de get
         $cod = $this->uri->segment(3);

         // Verifica se o codigo existe
         if($cod!=null){
             $query = $this->clientes->getById($cod);
         }
 
         if ($query != null){
             // Executa operação do banco de dados
             if($this->clientes->deletar($query->cod)){
                 $this->session->set_flashdata('success', 'Dados do cliente excluídos com sucesso.');
             }else{
                 $this->session->set_flashdata('error', 'Ocorreu um erro ao excluir os dados do cliente!');
             }
         }else{
             $this->session->set_flashdata('error', 'Ocorreu um erro ao localiazar o cliente!');
         }
         redirect('clientes/');
    }
}