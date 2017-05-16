<?php
Class Projetos_model extends CI_Model{
    function project($nome){
       $id = $this->session->userdata('logged_in')['id_usuario'];
       $this -> db -> select('nome');
       $this -> db -> from('projeto');
       $this -> db -> where('id_usuario', $id);
       $this -> db -> where('nome', $nome);
       $this -> db -> limit(1);

       $query = $this -> db -> get();

       if($query -> num_rows() == 1)
         return true;
       else
         return false;
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
