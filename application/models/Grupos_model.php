<?php

Class Grupos_model extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function isAdmin($idu, $idg){
        $this->db->select('admin');
        $this->db->from('usuarios_grupo');
        $this->db->where('id_usuario', $idu);
        $this->db->where('id_grupo', $idg);

        $query = $this->db->get();

        if(empty($query->result_array()))
          return true;
        return $query->result_array()[0]['admin'];
    }

    public function permissoesProjeto($idp, $idu){
        $this->db->select('leitura, escrita');
        $this->db->from('permissoes_projeto');
        $this->db->where('id_projeto', $idp);
        $this->db->where('id_usuario', $idu);

        $query = $this->db->get();

        if(empty($query->row_array()))
          return false;
        return $query->row_array();
    }

    public function inserir($nome, $usuarios){
        $info['nome'] = ucfirst($nome);
        $info['id_usuario'] = $this->session->userdata('logged_in')['id_usuario'];
        $idu = $info['id_usuario'];
        $this->db->insert('grupo', $info);

        $id = $this->db->insert_id();

        if(isset($usuarios) && count($usuarios) > 0){
          foreach($usuarios as $user){
            $info2['id_grupo'] = $id;
            $info2['admin'] = false;
            if($user['id'] == $idu)
              $info2['admin'] = true;
            $info2['id_usuario'] = $user['id'];
            $this->db->insert('usuarios_grupo', $info2);
          }
        }

        return true;
    }

    public function update($nome, $usuarios, $usuariosold, $idgrupo){
        $ginfo['nome'] = ucfirst($nome);
        $this->db->where('id_grupo', $idgrupo);
        $this->db->update('grupo', $ginfo);
        if(!empty($usuarios)){
          foreach($usuarios as $u){
              $flag = false;
              if(!empty($usuariosold)){
                foreach($usuariosold as $i => $uold){
                    if($u['id'] == $uold['id_usuario']){
                        $flag = true;
                        $u['admin'] = ($u['admin'] == 'true' ? 1 : 0);
                        if($u['admin'] != $uold['admin']){
                            //update admin
                            $ainfo['admin'] = $u['admin'];
                            $this->db->where('id_usuario', $u['id']);
                            $this->db->where('id_grupo', $idgrupo);
                            $this->db->update('usuarios_grupo', $ainfo);
                        }
                        unset($usuariosold[$i]);
                    }
                }
              }
              if(!$flag){
                  $info['admin'] = ($u['admin'] == 'true' ? 1 : 0);
                  $info['id_usuario'] = $u['id'];
                  $info['id_grupo'] = $idgrupo;
                  $this->db->insert('usuarios_grupo', $info);
              }
          }
        }

        if(!empty($usuariosold)){
          foreach($usuariosold as $u){
              $this->db->where('id_usuario', $u['id_usuario']);
              $this->db->where('id_grupo', $idgrupo);
              $this->db->delete('usuarios_grupo');
          }
        }

        return true;
    }

    public function excluir($idgrupo){
      $this->db->where('id_grupo', $idgrupo);
      $this->db->delete('usuarios_grupo');

      $this->db->where('id_grupo', $idgrupo);
      $this->db->delete('reuniao');

      $this->db->where('id_grupo', $idgrupo);
      $this->db->delete('grupo');
    }

    public function listUsuariosProjeto($idgrupo, $idprojeto){
      $query = $this->db->query("select u.id_usuario, u.nome, u.email from grupo g, usuario u where u.id_usuario = g.id_usuario and g.id_grupo = " . $idgrupo);
      $usuarios[0] = $query->row_array();

      $query = $this->db->query("select u.id_usuario, u.nome, u.email, ug.admin, pp.leitura, pp.escrita from grupo g, usuario u, usuarios_grupo ug, permissoes_projeto pp where u.id_usuario = ug.id_usuario and ug.id_grupo = g.id_grupo and pp.id_usuario = u.id_usuario and g.id_grupo = " . $idgrupo . " and pp.id_projeto = " . $idprojeto);
      $i = 1;

      foreach($query->result_array() as $row){
        $usuarios[$i] = $row;
        $i++;
      }

      return $usuarios;
    }

    public function listUsuarios($idgrupo){
      $query = $this->db->query("select u.id_usuario, u.nome, u.email from grupo g, usuario u where u.id_usuario = g.id_usuario and g.id_grupo = " . $idgrupo);
      $usuarios[0] = $query->row_array();

      $query = $this->db->query("select u.id_usuario, u.nome, u.email, ug.admin from grupo g, usuario u, usuarios_grupo ug where u.id_usuario = ug.id_usuario and ug.id_grupo = g.id_grupo and g.id_grupo = " . $idgrupo);
      $i = 1;

      foreach($query->result_array() as $row){
        $usuarios[$i] = $row;
        $i++;
      }

      return $usuarios;
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

    public function listProjects($idgrupo){
      $this->db->select('*');
      $this->db->from('projeto_grupo');
      $this->db->where('id_grupo', $idgrupo);
      $query = $this->db->get();

      $i = 0;
      $projetos = FALSE;
      foreach($query->result_array() as $row){
        $this->db->select('*');
        $this->db->from('projeto');
        $this->db->where('id_projeto', $row['id_projeto']);
        $query = $this->db->get();
        $projetos[$i] = $query->result_array()[0];
        $i++;
      }
      return $projetos;
    }

    public function permissaoEditProj($idusuario, $idgrupo, $idprojeto){
        $this->db->select('*');
        $this->db->from('grupo');
        $this->db->where('id_grupo', $idgrupo);
        $this->db->where('id_usuario', $idusuario);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1) {
          return true;
        }

        $this->db->select('admin');
        $this->db->from('usuarios_grupo');
        $this->db->where('id_grupo', $idgrupo);
        $this->db->where('id_usuario', $idusuario);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1) {
          if($query->row_array()['admin'])
            return true;
        }

        $this->db->select('escrita');
        $this->db->from('permissoes_projeto');
        $this->db->where('id_projeto', $idprojeto);
        $this->db->where('id_usuario', $idusuario);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1) {
          if($query->row_array()['escrita'])
            return true;
        }
        return false;
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

    public function isProject($idgrupo, $projeto){
        $query = $this->db->query("select p.* from projeto_grupo pg, grupo g, projeto p where pg.id_grupo = g.id_grupo and g.id_grupo = " . $idgrupo . " and pg.id_projeto = p.id_projeto and p.nome = '" . $projeto . "'");

        if($query->num_rows() == 1) {
          return $query->result_array();
        }

        return false;
    }

    public function naoCadastrado($projeto, $idgrupo){
        $query = $this->db->query("select p.* from projeto p, grupo g, projeto_grupo pg where g.id_grupo = " . $idgrupo . " and p.nome = '" . $projeto . "' and  p.id_projeto = pg.id_projeto and pg.id_grupo = g.id_grupo");

        if($query->num_rows() >= 1) {
          return false;
        }

        $p['nome'] = $projeto;
        $this->db->insert('projeto', $p);

        $id = $this->db->insert_id();

        $pg['id_projeto'] = $id;
        $pg['id_grupo'] = $idgrupo;
        $this->db->insert('projeto_grupo', $pg);

        $pp['id_projeto'] = $id;
        $pp['id_usuario'] = $this->session->userdata('logged_in')['id_usuario'];
        $pp['leitura'] = true;
        $pp['escrita'] = true;
        $this->db->insert('permissoes_projeto', $pp);

        return true;
    }
}
?>
