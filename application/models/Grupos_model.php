<?php

Class Grupos_model extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function inserir($nome, $usuarios){
        $info['nome'] = $nome;
        $info['id_usuario'] = $this->session->userdata('logged_in')['id_usuario'];
        $this->db->insert('grupo', $info);

        $id = $this->db->insert_id();

        foreach($usuarios as $user){
          $info2['id_grupo'] = $id;
          $info2['admin'] = false;
          $info2['id_usuario'] = $user['id'];
          $this->db->insert('usuarios_grupo', $info2);
        }

        return true;
    }
}
?>
