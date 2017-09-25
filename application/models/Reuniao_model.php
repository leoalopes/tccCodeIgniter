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

    public function listar($idgrupo){
        $this->db->select('*');
        $this->db->from('reuniao');
        $this->db->where('id_grupo',$idgrupo);

        $query = $this->db->get();

        $i = 0;
        $reunioes = FALSE;
        foreach($query->result_array() as $row){
          $reunioes[$i] = $row;
          $i++;
        }
        return $reunioes;
    }
}
?>
