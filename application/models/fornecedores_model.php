<?php
// evita o acesso direto
defined('BASEPATH') OR exit('No direct script access allowed');

class Fornecedores_model extends CI_Model {

    // construtor
    function __construct(){
        parent::__construct();
    }

    public function listar(){
        $query = $this->db->get('fornecedores');
        return $query->result();
    }

    public function salvar($dados_form){
        if ($query =  $this->db->insert('fornecedores', $dados_form)){
            return true;
        }else{
            return false;}
    }

    public function getById($id){
        $this->db->where('cod', $id);

        $this->db->limit(1);

        $query = $this->db->get('fornecedores');

        return $query->row();        
    }

    public function editar($dados, $id){
        if($this->db->update('fornecedores', $dados, array('cod'=>$id))){
            return true;
        }else{
            return false;
        }
    }

    public function deletar($id){        
        if($this->db->delete('fornecedores', array('cod'=>$id))){
            return true;
        }else{
            return false;
        }        
    }
}