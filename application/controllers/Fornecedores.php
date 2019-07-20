<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fornecedores extends CI_Controller {

    // construtor
    function __construct(){
        parent::__construct();

        // Autenticação do usuário
        $user = $this->session->userdata('nome');
        if(empty($user)){
            redirect('setup');
        }

        // Instância model
        $this->load->model('fornecedores_model', 'fornecedores');
    }

    // CARREGAR VIEWS
	public function index(){
        // Seta dados das páginas
        $dados['usuario'] = $this->session->userdata('nome');
        $dados['titulo'] = 'Fornecedores';
        
        // Select * from fornecedores
        $dados['fornecedores'] = $this->fornecedores->listar();

        // Carrega view
        $this->load->view('fornecedores/fornecedores', $dados);        
    }

    public function cadastrar(){
        // Seta dados das páginas
        $dados['usuario'] = $this->session->userdata('nome');
        $dados['titulo'] = 'Fornecedores';

        // Carrega view
        $this->load->view('fornecedores/cadastrar', $dados);
    }

    public function editar(){
        // Seta dados das páginas
        $dados['usuario'] = $this->session->userdata('nome');
        $dados['titulo'] = 'Fornecedores';
        $dados['fornecedor'] = null;

        // Carrega view
        $this->load->view('fornecedores/editar', $dados);
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
        if($this->fornecedores->salvar($dados_form)){
            $this->session->set_flashdata('success', 'Fornecedor cadastrado com sucesso.');
        }else{
            $this->session->set_flashdata('error', 'Ocorreu um erro ao cadastrar fornecedor!');
        }   
        redirect('fornecedores/cadastrar');  
    }

    // OPERAÇÕES
    public function buscar(){
        // Seta dados da página
        $dados['usuario'] = $this->session->userdata('nome');
        $dados['titulo'] = 'Fornecedores';
        $dados['fornecedor'] = null;

        // Recupera dados do formulário
        $cod = $this->input->post('cod');

        // Se a requisição for feita através da pág. principal 
        // O valor é recuperado através de get
        if ($cod == null){
            $cod = $this->uri->segment(3);
        }
        
        // Pesquisa no bd
        $query = $this->fornecedores->getById($cod);

        // Se retornar o resultado correto
        if ($query != null){
            $dados['fornecedor'] = $query;
        }else{
            $this->session->set_flashdata('error', 'Código do fornecedor não identificado!');
        }

        $this->load->view('fornecedores/editar', $dados);      
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
        if($this->fornecedores->editar($dados_form, $cod)){
            $this->session->set_flashdata('success', 'Dados do fornecedor atualizados com sucesso.');
        }else{
            $this->session->set_flashdata('error', 'Ocorreu um erro ao atualizar os dados do fornecedor!');
        }   
    
        redirect('fornecedores/editar');  
    }

    public function excluir(){
        // O valor é recuperado através de get
        $cod = $this->uri->segment(3);

        // Verifica se o codigo existe
        if($cod!=null){
            $query = $this->fornecedores->getById($cod);
        }

        if ($query != null){
            // Executa operação do banco de dados
            if($this->fornecedores->deletar($query->cod)){
                $this->session->set_flashdata('success', 'Dados do fornecedor excluídos com sucesso.');
            }else{
                $this->session->set_flashdata('error', 'Ocorreu um erro ao excluir os dados do fornecedor!');
            }
        }else{
            $this->session->set_flashdata('error', 'Ocorreu um erro ao localiazar o fornecedor!');
        }
        redirect('fornecedores/');
    }
}