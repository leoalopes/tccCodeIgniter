<?php
Class Projetos_model extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function naocadastrado(){
      $nome = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),ucfirst($this->input->post('nome')));
      $id = $this->session->userdata('logged_in')['id_usuario'];
      $this->db->select('id_projeto');
      $this->db->from('projeto');
      $this->db->where('nome', $nome);
      $this->db->where('id_usuario', $id);

      $query = $this->db->get();

      if($query->num_rows() >= 1) {
        return false;
      }
      return true;
    }

    public function cadastro(){
       $info['id_usuario'] = $this->session->userdata('logged_in')['id_usuario'];
       $info['nome'] = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),ucfirst($this->input->post('nome')));

       $query = $this->db->insert('projeto', $info);

       if($this->db->affected_rows() >= 1){
         return true;
       }
       return false;
    }

    public function atualizar($nome, $idprojeto){
       $info['nome'] = $nome;

       $this->db->where('id_projeto', $idprojeto);
       $this->db->update('projeto', $info);
    }

    public function excluir($idprojeto){
      //DELETAR TABELAS DE ATIVIDADES

      $this->db->where('id_projeto', $idprojeto);
      $this->db->delete('documentacao');

      $this->db->where('id_projeto', $idprojeto);
      $this->db->delete('permissoes_projeto');

      $this->db->where('id_projeto', $idprojeto);
      $this->db->delete('projeto_grupo');

      $this->db->where('id_projeto', $idprojeto);
      $this->db->delete('projeto');
    }

    public function projeto($nome, $id){
        $this->db->select('*');
        $this->db->from('projeto');
        $this->db->where('nome', $nome);
        $this->db->where('id_usuario',$id);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1) {
          return $query->result_array();
        }
        return false;
    }

    public function group($nome){
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

    public function listProjects(){
      $id = $this->session->userdata('logged_in')['id_usuario'];
      $query = $this->db->query("select * from projeto where id_usuario = " . $id);
      $i = 0;
      $projetos = FALSE;
      foreach($query->result_array() as $row){
        $projetos[$i] = $row;
        $i++;
      }
      return $projetos;
    }
}
?>
