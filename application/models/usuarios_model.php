<?php
// evita o acesso direto
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    // construtor
    function __construct(){
        parent::__construct();
    }

    // Query verifica se o email e senha existem no bd
    public function logarUsuario($email, $senha){
        $this->db->where('email', $email);
        $this->db->where('senha', $senha);
        
        $query = $this->db->get('usuarios');

        if($query->num_rows() == 1){
            foreach($query->result() as $row){
                $row->nome;
                $row->email;
            }
        }

        return $row;
    }
}