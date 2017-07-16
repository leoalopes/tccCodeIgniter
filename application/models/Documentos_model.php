<?php
Class Documentos_model extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listar($projeto, $id){
        $this->db->select('id_projeto');
        $this->db->from('projeto');
        $this->db->where('nome', $projeto);
        $this->db->where('id_usuario', $id);
        $idprojeto = $this->db->get()->result_array();


        $this->db->select('*');
        $this->db->from('documentacao');
        $this->db->where('id_projeto', $idprojeto[0]['id_projeto']);

        return $this->db->get()->result_array();
    }

}
