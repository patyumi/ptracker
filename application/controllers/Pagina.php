<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina extends CI_Controller {

    // Construtor da classe pai
    function __construct(){
        parent::__construct();
        $this->load->helper('url');

        // Verifica se a sessão é válida para acessar as páginas
        $user = $this->session->userdata('nome');
        if(empty($user)){
            redirect('setup');
        }
    }

    public function home(){
        $this->load->model('historico_model','historico');

        $dados['historico'] = $this->historico->listar();

        $this->load->model('ativos_model','ativos');
        

        $dados['totalAtivos'] = $this->ativos->count();
        $dados['estoque'] = $this->ativos->countEstoque();
        $dados['comodato'] = $this->ativos->countComodato();

        

        $dados['usuario'] = $this->session->userdata('nome');
        $dados['titulo'] = 'Dashboard';

        
		$this->load->view('home', $dados);
    }
     
}
