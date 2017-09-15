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

    public function listarDeGrupo($idproj){
        $this->db->select('*');
        $this->db->from('documentacao');
        $this->db->where('id_projeto', $idproj);

        return $this->db->get()->result_array();
    }

    public function inserir($idprojeto, $projeto, $titulo, $conteudo){
        $info['id_usuario'] = $this->session->userdata('logged_in')['id_usuario'];
        $info['id_projeto'] = $idprojeto;
        $info['titulo'] = $titulo;
        $info['conteudo'] = str_replace('</p><p>', '</p><br><p>', $conteudo);
        $info['conteudo'] = str_replace('<p>', '<span>', $info['conteudo']);
        $info['conteudo'] = str_replace('</p>', '</span>', $info['conteudo']);
        $info['conteudo'] = str_replace('<span></span>', '', $info['conteudo']);
        $info['conteudo'] = str_replace("<b></b>", "", $info['conteudo']);
        $info['conteudo'] = str_replace("<b>\n</b>", "", $info['conteudo']);
        $info['conteudo'] = str_replace("<b>\t</b>", "", $info['conteudo']);
        $info['conteudo'] = str_replace("<b>".PHP_EOL."</b>", "", $info['conteudo']);

        $query = $this->db->insert('documentacao', $info);

        return true;
    }

    public function update($titulo, $conteudo, $id){
        $info['titulo'] = $titulo;
        $info['conteudo'] = $conteudo;

        $this->db->where('id_documentacao', $id);
        $this->db->update('documentacao', $info);

        if($this->db->affected_rows() == 1){
          return true;
        }
        return true;
    }

    public function findById($iddoc, $iduser, $idproj){
        $this->db->select('*');
        $this->db->from('documentacao');
        $this->db->where('id_documentacao', $iddoc);
        $this->db->where('id_usuario', $iduser);
        $this->db->where('id_projeto', $idproj);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1){
          return $query->result_array();
        }

        return false;
    }

}
?>
