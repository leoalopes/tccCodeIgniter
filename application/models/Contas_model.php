<?php

class Contas_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function login($email, $senha) {
        $this->db->select('id_usuario, nome, email, senha');
        $this->db->from('usuario');
        $this->db->where('email', $email);
        $this->db->where('senha', MD5($senha));
        $this->db->limit(1);

        $query = $this->db->get();

        if($query -> num_rows() == 1) {
          return $query->result();
        } else {
          return false;
        }
    }

    function cadastrar($info) {
        $this->db->insert('usuario', $info);
        if($this->db->affected_rows() > 0){
            return $this->db->insert_id();
        }
        return false;
    }

}
