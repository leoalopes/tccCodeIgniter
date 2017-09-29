<?php
Class Reuniao_model extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function cadastro($idgrupo, $motivo, $data){
         $info['id_grupo'] = $idgrupo;
         $info['motivo'] = ucfirst($motivo);
         $info['data'] = $data;

         $query = $this->db->insert('reuniao', $info);

         if($this->db->affected_rows() >= 1){
           return true;
         }
         return false;
    }

    public function editar($idreuniao, $motivo, $data){
         $info['motivo'] = ucfirst($motivo);
         $info['data'] = $data;

         if(new DateTime($data) > new DateTime(date('Y-m-d H:i:s'))){
           $this->db->where('id_reuniao', $idreuniao);
           $query = $this->db->update('reuniao', $info);
           return true;
         }
         return false;
    }

    public function reuniao($idreuniao, $idgrupo){
        $this -> db -> select('*');
        $this -> db -> from('reuniao');
        $this -> db -> where('id_reuniao', $idreuniao);
        $this -> db -> where('id_grupo', $idgrupo);

        $query = $this -> db -> get();

        if($query -> num_rows() >= 1)
          return true;
        else
          return false;
    }

    public function reuniaoPendente($idreuniao, $idgrupo){
        $now = date('Y-m-d H:i:s');
        $this -> db -> select('*');
        $this -> db -> from('reuniao');
        $this -> db -> where('id_reuniao', $idreuniao);
        $this -> db -> where('id_grupo', $idgrupo);
        $this -> db -> where('data >', $now);

        $query = $this -> db -> get();

        if($query -> num_rows() >= 1)
          return $query->row_array();
        else
          return false;
    }

    public function listar($idgrupo){
        $now = date('Y-m-d H:i:s');
        $this->db->select('*');
        $this->db->from('reuniao');
        $this->db->where('id_grupo', $idgrupo);
        $this->db->where('data >', $now);
        $this->db->order_by("data", "asc");

        $query = $this->db->get();

        $i = 0;
        $reunioes = FALSE;
        foreach($query->result_array() as $row){
          $reunioes['pendentes'][$i] = $row;
          $i++;
        }

        $this->db->select('*');
        $this->db->from('reuniao');
        $this->db->where('id_grupo', $idgrupo);
        $this->db->where('data <=', $now);
        $this->db->order_by("data", "desc");

        $query = $this->db->get();

        $i = 0;
        foreach($query->result_array() as $row){
          $reunioes['realizadas'][$i] = $row;
          $i++;
        }
        return $reunioes;
    }

    public function excluir($idreuniao){
      $this->db->where('id_reuniao', $idreuniao);
      $this->db->delete('reuniao');
    }
}
?>
