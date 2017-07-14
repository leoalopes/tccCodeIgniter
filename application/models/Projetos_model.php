<?php
Class Projetos_model extends CI_Model{
    public function __construct() {
        $this->load->database();
    }

    function naocadastrado(){
      $nome = $this->input->post('nome');
      $id = $this->session->userdata('logged_in')['id_usuario'];
      $this->db->select('id_projeto');
      $this->db->from('projeto');
      $this->db->where('nome', $nome);
      $this->db->where('id_usuario', $id);

      $query = $this->db->get();

      if($query -> num_rows() >= 1) {
        return false;
      }
      return true;
    }

    function cadastro(){
       $info['id_usuario'] = $this->session->userdata('logged_in')['id_usuario'];
       $info['nome'] = $this->input->post('nome');

       $query = $this->db->insert('projeto', $info);

       if($this->db->affected_rows() >= 1){
         return true;
       }
       return false;
    }

    function projeto(){
        $query = $this->db->query("select nome from projeto where id_usuario = " . $id);
    }

    function group($nome){
        $id = $this->session->userdata('logged_in')['id_usuario'];
        $this -> db -> select('nome');
        $this -> db -> from('grupo');
        $this -> db -> where('id_usuario', $id);
        $this -> db -> where('nome', $nome);
        $this -> db -> limit(1);

        $query = $this -> db -> get();

        if($query -> num_rows() == 1)
          return true;
        else
          return false;
    }

    function listProjects(){
      $id = $this->session->userdata('logged_in')['id_usuario'];
      $query = $this->db->query("select nome from projeto where id_usuario = " . $id);
      $i = 0;
      $projetos = FALSE;
      foreach($query->result_array() as $row){
        $projetos[$i] = $row;
        $i++;
      }
      return $projetos;
    }

    function listGroups(){

    }
}
?>
