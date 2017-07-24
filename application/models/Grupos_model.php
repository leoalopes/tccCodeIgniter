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

        if(isset($usuarios) && count($usuarios) > 0){
          foreach($usuarios as $user){
            $info2['id_grupo'] = $id;
            $info2['admin'] = false;
            $info2['id_usuario'] = $user['id'];
            $this->db->insert('usuarios_grupo', $info2);
          }
        }

        return true;
    }

    public function listGroups(){
      $id = $this->session->userdata('logged_in')['id_usuario'];
      $query = $this->db->query("select id_grupo, nome from grupo where id_usuario = " . $id);
      $i = 0;
      $grupos = FALSE;
      foreach($query->result_array() as $row){
        $grupos[$i] = $row;
        $i++;
      }
      $query = $this->db->query("select u.id_grupo, g.nome from usuarios_grupo u, grupo g where u.id_grupo = g.id_grupo and u.id_usuario = " . $id);
      foreach($query->result_array() as $row){
        $grupos[$i] = $row;
        $i++;
      }
      return $grupos;
    }

    public function isMember($idgrupo, $idusuario){
        $this->db->select('*');
        $this->db->from('grupo');
        $this->db->where('id_grupo', $idgrupo);
        $this->db->where('id_usuario', $idusuario);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1) {
          return $query->result_array();
        }

        $query = $this->db->query("select g.* from usuarios_grupo u, grupo g where u.id_grupo = g.id_grupo and u.id_usuario = " . $idusuario . " and u.id_grupo = " . $idgrupo);

        if($query->num_rows() == 1) {
          return $query->result_array();
        }
        return false;
    }
}
?>
