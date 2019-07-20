<?php
// evita o acesso direto
defined('BASEPATH') OR exit('No direct script access allowed');

class Exemplo1_model extends CI_Model {

    // construtor
    function __construct(){
        parent::__construct();
    }

    public function salvar(){
        echo 'metodo salvar do model..';
	}
}