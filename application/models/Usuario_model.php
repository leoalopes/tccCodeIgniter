<?php

class Usuario_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function login() {
        $email = $this->input->post('email');
        $senha = $this->input->post('senha');
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

    public function cadastrar($info) {
        $this->db->insert('usuario', $info);
        if($this->db->affected_rows() > 0){
          return $this->db->insert_id();
        }
        return false;
    }

    public function searchByEmail($email){
      $useremail = $this->session->userdata("logged_in")['email'];
      $this->db->select('id_usuario, nome, email');
      $this->db->from('usuario');
      $this->db->where('email !=', $useremail);
      $this->db->like('email', $email, 'both');

      return $this->db->get()->result_array();
    }
}
