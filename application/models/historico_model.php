<?php
// evita o acesso direto
defined('BASEPATH') OR exit('No direct script access allowed');

class Historico_model extends CI_Model {

    // construtor
    function __construct(){
        parent::__construct();
    }

    public function listar(){
        $query = $this->db->get('historico');
        return $query->result();
    }

    public function salvar($dados_hist){
        if ($query =  $this->db->insert('historico', $dados_hist)){
            return true;
        }else{
            return false;}
    }

    public function getAtivoById($id){
        $this->db->where('ativo', $id);

        $this->db->limit(1);

        $query = $this->db->get('historico');

        return $query->row();        
    }   

    public function getClienteById($id){
        $this->db->where('cliente', $id);

        $this->db->limit(1);

        $query = $this->db->get('historico');

        return $query->row();        
    }   

}