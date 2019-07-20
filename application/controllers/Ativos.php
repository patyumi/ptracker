<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ativos extends CI_Controller {

    // construtor
    function __construct(){
        parent::__construct();        

        // Autenticação do usuário
        $user = $this->session->userdata('nome');
        if(empty($user)){
            redirect('setup');
        }

        // Instância model
        $this->load->model('ativos_model', 'ativos');
    }
    
     // CARREGAR VIEWS
	public function index(){   
        // Seta dados das páginas
        $dados['usuario'] = $this->session->userdata('nome');
        $dados['titulo'] = 'Ativos';

        // Select * from ativos
        $dados['ativos'] = $this->ativos->listar();    

        // Carrega view
		$this->load->view('ativos/ativos', $dados);
    }
   
    public function cadastrar(){
        // Seta dados das páginas
        $dados['usuario'] = $this->session->userdata('nome');
        $dados['titulo'] = 'Ativos';

        // Instância model
        $this->load->model('fornecedores_model', 'fornecedores');
        $this->load->model('clientes_model', 'clientes');

        // Select * from fornecedores/clientes
        $dados['fornecedores'] = $this->fornecedores->listar();        
        $dados['clientes'] = $this->clientes->listar();

        // Carrega view
        $this->load->view('ativos/cadastrar', $dados);
    }

    public function editar(){
        // Seta dados das páginas
        $dados['usuario'] = $this->session->userdata('nome');
        $dados['titulo'] = 'Ativos';
        $dados['ativos'] = null;
        $dados['historico'] = null;

        $this->load->view('ativos/editar', $dados);
    }
                
    // OPERAÇÕES
    public function salvar(){        
        // Array com dados do formulário
        $dados_form['serial'] = $this->input->post('serial');
        $dados_form['fabricacao'] = $this->input->post('ano');
        $dados_form['longitude'] = $this->input->post('longitude');
        $dados_form['latitude'] = $this->input->post('latitude');
        $dados_form['status'] = $this->input->post('status');

        //Array com dados a serem salvos no histórico
        $dados_hist['operacao'] = "INSERÇÃO";
        $dados_hist['data'] = date('Y-m-d H:i:s');              
        $dados_hist['ativo'] = $this->input->post('serial');        
        $dados_hist['cliente'] = $this->input->post('cliente');
        $dados_hist['fornecedor'] = $this->input->post('fornecedor');

        // Instância model histórico
        $this->load->model('historico_model', 'historico');
           
        // Executa operação do banco de dados
        if($this->ativos->salvar($dados_form) && $this->historico->salvar($dados_hist)){
            $this->session->set_flashdata('success', 'Ativo cadastrado com sucesso.');
        }else{
            $this->session->set_flashdata('error', 'Ocorreu um erro ao cadastrar ativo!');
        }   
        redirect('ativos/cadastrar');  
    }

    public function buscar(){
        $dados['usuario'] = $this->session->userdata('nome');
        $dados['titulo'] = 'Ativos';
        $dados['ativos'] = null;
        $dados['historico'] = null;

        // Instância model
        $this->load->model('fornecedores_model', 'fornecedores');
        $this->load->model('clientes_model', 'clientes');

        // Select * from fornecedores/clientes
        $dados['fornecedores'] = $this->fornecedores->listar();        
        $dados['clientes'] = $this->clientes->listar();

        $cod = $this->input->post('cod');

        // Se a requisição for feita através da pág. principal 
        // O valor é recuperado através de get
        if ($cod == null){
            $cod = $this->uri->segment(3);
        }
        
        $query = $this->ativos->getById($cod);

        if ($query != null){
            // Instância model histórico
            $this->load->model('historico_model', 'historico');

            $hist = $this->historico->getAtivoById($query->serial);

            $dados['ativos'] = $query;
            $dados['historico'] = $hist;        
        }else{
            $this->session->set_flashdata('error', 'Código do ativo não identificado!');
            redirect('ativos/editar');
        }
        
        $this->load->view('ativos/editar', $dados);
    }

    public function alterar(){
        // Array com dados do formulário
        $cod = $this->input->post('cod');
        $dados_form['serial'] = $this->input->post('serial');
        $dados_form['fabricacao'] = $this->input->post('ano');
        $dados_form['longitude'] = $this->input->post('longitude');
        $dados_form['latitude'] = $this->input->post('latitude');
        $dados_form['status'] = $this->input->post('status');

         //Array com dados a serem salvos no histórico
         $dados_hist['operacao'] = "ALTERAÇÃO";
         $dados_hist['data'] = date('Y-m-d H:i:s');      
         $dados_hist['dataComodato'] = $this->input->post('data');     
         $dados_hist['ativo'] = $this->input->post('serial');        
         $dados_hist['cliente'] = $this->input->post('cliente');
         $dados_hist['fornecedor'] = $this->input->post('fornecedor');

         $serial = $this->input->post('serial');
 
         // Instância model histórico
         $this->load->model('historico_model', 'historico');
            
        // Executa operação do banco de dados
        if($this->ativos->editar($dados_form, $cod) && $this->historico->salvar($dados_hist) ){
            $this->session->set_flashdata('success', 'Dados do ativo atualizados com sucesso.');
        }else{
            $this->session->set_flashdata('error', 'Ocorreu um erro ao atualizar os dados do ativo!');
        }   
    
        redirect('ativos/editar');  
    }

    public function excluir(){
         // O valor é recuperado através de get
         $cod = $this->uri->segment(3);

         // Verifica se o codigo existe
         if($cod!=null){
             $query = $this->ativos->getById($cod);
         }

         //Array com dados a serem salvos no histórico
         $serial = $query->serial;
         $dados_hist['operacao'] = "EXCLUSÃO";
         $dados_hist['data'] = date('Y-m-d H:i:s');         
         $dados_hist['ativo'] = $serial;        
         $dados_hist['cliente'] = null;
         $dados_hist['fornecedor'] = null;
 
         // Instância model histórico
         $this->load->model('historico_model', 'historico');
            
        // Executa operação do banco de dados
        $this->historico->salvar($dados_hist);
 
         if ($query != null){
             // Executa operação do banco de dados
             if($this->ativos->deletar($query->cod)){
                 $this->session->set_flashdata('success', 'Dados do ativo excluidos com sucesso.');
             }else{
                 $this->session->set_flashdata('error', 'Ocorreu um erro ao excluir os dados do ativo!');
             }
         }else{
             $this->session->set_flashdata('error', 'Ocorreu um erro ao localiazar o ativo!');
         }
         redirect('ativos/');
    }

    public function gerarCode($id=null){

        $this->load->library('ciqrcode');
        header("Content-Type: image/png");

        $params['data'] = 'http://localhost/ci/ativos/buscar/'.$id;

        $this->ciqrcode->generate($params);      
    }    
}