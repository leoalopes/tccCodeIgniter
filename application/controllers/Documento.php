<?php

class Documento extends CI_Controller{
  function __construct(){
      parent::__construct();
      $this->load->model('user_model');
      $this->load->model('projetos_model');
      $this->load->model('grupos_model');
      $this->load->model('documentos_model');
  }

  public function cadastro($user, $project){
      if($this->user_model->user($user)){
        $data['session'] = $this->session->userdata('logged_in');
        if($this->projetos_model->projeto($project, $data['session']['id_usuario'])){
          $data['projeto'] = $project;
          $data['id'] = $user;
          $this->load->view('documentacao/cadastro', $data);
        } else {
          redirect($user, 'refresh');
        }
      } else {
        redirect('home', 'refresh');
      }
  }

  public function cadastroDeGrupo($user, $idgrupo, $projeto){
      if($this->user_model->user($user)){
        $data['session'] = $this->session->userdata('logged_in');
        $grupo = $this->grupos_model->isMember($idgrupo, $data['session']['id_usuario']);
        if($grupo){
          $proj = $this->grupos_model->isProject($grupo[0]['id_grupo'], $projeto);
          $data['grupo'] = $grupo[0];
          if($proj){
            if($this->grupos_model->permissaoEditProj($data['session']['id_usuario'], $idgrupo, $proj[0]['id_projeto'])){
              $data['projeto'] = $proj[0];
              $data['id'] = $user;
              $this->load->view('documentacao/cadastroGrupos', $data);
            } else {
              redirect("$user/grupo/".$grupo[0]['id_grupo']."/projeto"."/".$proj[0]['nome'], 'refresh');
            }
          } else {
            redirect("$user/grupo/".$grupo[0]['id_grupo'], 'refresh');
          }
        } else {
          redirect($user, 'refresh');
        }
      } else {
        redirect('home', 'refresh');
      }
  }

  public function form_cadastro(){
    $titulo = $this->input->post('titulo');
    $conteudo = $this->input->post('conteudo');
    $projeto = $this->input->post('projeto');

    if(strlen($titulo) < 3){
      echo "O título deve ter no mínimo 3 caracteres.";
      return;
    }

    if(strlen($titulo) > 100){
      echo "O título deve ter no máximo 100 caracteres.";
      return;
    }

    $idprojeto = $this->projetos_model->projeto($projeto, $this->session->userdata('logged_in')['id_usuario'])[0]['id_projeto'];
    if($this->documentos_model->inserir($idprojeto, $titulo, $conteudo)){
      echo "";
    } else {
      echo "Tente novamente mais tarde.";
    }
  }

  public function form_cadastroGrupos(){
    $titulo = $this->input->post('titulo');
    $conteudo = $this->input->post('conteudo');
    $idprojeto = $this->input->post('idprojeto');

    if(strlen($titulo) < 3){
      echo "O título deve ter no mínimo 3 caracteres.";
      return;
    }

    if(strlen($titulo) > 100){
      echo "O título deve ter no máximo 100 caracteres.";
      return;
    }

    if($this->documentos_model->inserir($idprojeto, $titulo, $conteudo)){
      echo "";
    } else {
      echo "Tente novamente mais tarde.";
    }
  }

  public function form_edicao(){
    $titulo = $this->input->post('titulo');
    $conteudo = $this->input->post('conteudo');
    $id = $this->input->post('iddoc');

    if(strlen($titulo) < 3){
      echo "O título deve ter no mínimo 3 caracteres.";
      return;
    }

    if(strlen($titulo) > 100){
      echo "O título deve ter no máximo 100 caracteres.";
      return;
    }

    if($this->documentos_model->update($titulo, $conteudo, $id)){
      echo "";
    } else {
      echo "Erro! Tente novamente mais tarde.";
    }
  }

  public function editar($user, $projeto, $iddoc){
    if($this->user_model->user($user)){
      $data['session'] = $this->session->userdata('logged_in');
      $p = $this->projetos_model->projeto($projeto, $data['session']['id_usuario']);
      if($p){
        $p = $p[0]['id_projeto'];
        $documento = $this->documentos_model->findById($iddoc, $p);
        if($documento){
          $data['projeto'] = $projeto;
          $data['documento'] = $documento[0];
          $data['id'] = $user;
          $this->load->view('documentacao/edicao', $data);
        } else {
          redirect("$user/projeto/$projeto", 'refresh');
        }
      } else {
        redirect($user, 'refresh');
      }
    } else {
      redirect('home', 'refresh');
    }
  }

  public function editarDeGrupo($user, $idgrupo, $projeto, $iddoc){
    if($this->user_model->user($user)){
      $data['session'] = $this->session->userdata('logged_in');
      $grupo = $this->grupos_model->isMember($idgrupo, $data['session']['id_usuario']);
      if($grupo){
        $p = $this->grupos_model->isProject($idgrupo, $projeto);
        if($p){
          $p = $p[0];
          if($this->grupos_model->permissaoEditProj($data['session']['id_usuario'], $idgrupo, $p['id_projeto'])){
            $idproj = $p['id_projeto'];
            $documento = $this->documentos_model->findById($iddoc, $idproj);
            if($documento){
              $data['grupo'] = $grupo[0];
              $data['projeto'] = $p;
              $data['documento'] = $documento[0];
              $data['id'] = $user;
              $this->load->view('documentacao/edicaoGrupos', $data);
            } else {
              redirect("$user/grupo/$idgrupo/projeto/$projeto", 'refresh');
            }
          } else {
            redirect("$user/grupo/$idgrupo/projeto/$projeto", 'refresh');
          }
        } else {
          redirect("$user/grupo/$idgrupo", 'refresh');
        }
      } else {
        redirect($user, 'refresh');
      }
    } else {
      redirect('home', 'refresh');
    }
  }

  public function deletar($user, $projeto, $iddoc){
    if($this->user_model->user($user)){
      $data['session'] = $this->session->userdata('logged_in');
      $p = $this->projetos_model->projeto($projeto, $data['session']['id_usuario']);
      if($p){
        $p = $p[0]['id_projeto'];
        $documento = $this->documentos_model->findById($iddoc, $p);
        if($documento){
          $this->documentos_model->deletar($iddoc, $p);
          redirect("$user/projeto/$projeto", 'refresh');
        } else {
          redirect("$user/projeto/$projeto", 'refresh');
        }
      } else {
        redirect($user, 'refresh');
      }
    } else {
      redirect('home', 'refresh');
    }
  }

  public function deletarDeGrupo($user, $idgrupo, $projeto, $iddoc){
    if($this->user_model->user($user)){
      $data['session'] = $this->session->userdata('logged_in');
      $grupo = $this->grupos_model->isMember($idgrupo, $data['session']['id_usuario']);
      if($grupo){
        $p = $this->grupos_model->isProject($idgrupo, $projeto);
        if($p){
          $p = $p[0];
          $idproj = $p['id_projeto'];
          $documento = $this->documentos_model->findById($iddoc, $idproj);
          if($documento){
            $this->documentos_model->deletar($iddoc, $idproj);
            redirect("$user/grupo/$idgrupo/projeto/$projeto", 'refresh');
          } else {
            redirect("$user/grupo/$idgrupo/projeto/$projeto", 'refresh');
          }
        } else {
          redirect("$user/grupo/$idgrupo", 'refresh');
        }
      } else {
        redirect($user, 'refresh');
      }
    } else {
      redirect('home', 'refresh');
    }
  }
}
