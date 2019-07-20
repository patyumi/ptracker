<?php
// evita o acesso direto
defined('BASEPATH') OR exit('No direct script access allowed');

class Ativos_model extends CI_Model {

    // construtor
    function __construct(){
        parent::__construct();
    }

    public function listar(){
        $query = $this->db->get('ativos');
        return $query->result();
    }

    public function salvar($dados_form){
        if ($query =  $this->db->insert('ativos', $dados_form)){
            return true;
        }else{
            return false;}
    }

    public function getById($id){
        $this->db->where('cod', $id);

        $this->db->limit(1);

        $query = $this->db->get('ativos');

        return $query->row();        
    }

    public function editar($dados, $id){
        if($this->db->update('ativos', $dados, array('cod'=>$id))){
            return true;
        }else{
            return false;
        }
    }

    public function deletar($id){        
        if($this->db->delete('ativos', array('cod'=>$id))){
            return true;
        }else{
            return false;
        }        
    }

    public function count(){
        $query = $this->db->count_all('ativos'); // Produces an integer, like 17
        return $query;
    }

    public function countEstoque(){
        $this->db->count_all_results('ativos');  // Produces an integer, like 25
        $this->db->like('status', 'Em estoque');
        $this->db->from('ativos');
        $query = $this->db->count_all_results();

        return $query;
    }

    public function countComodato(){
        $this->db->count_all_results('ativos');  // Produces an integer, like 25
        $this->db->like('status', 'Comodato');
        $this->db->from('ativos');
        $query = $this->db->count_all_results();

        return $query;
    }
}