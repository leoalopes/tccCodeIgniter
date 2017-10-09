<?php

class Grupo extends CI_Controller{
  function __construct(){
      parent::__construct();
      $this->load->model('user_model');
      $this->load->model('projetos_model');
      $this->load->model('grupos_model');
      $this->load->model('reuniao_model');
      $this->load->model('documentos_model');
  }

  public function view($user, $idgrupo){
      if($this->user_model->user($user)){
        $data['session'] = $this->session->userdata('logged_in');
        $grupo = $this->grupos_model->isMember($idgrupo, $data['session']['id_usuario']);
        if($grupo){
          $data['id'] = $user;
          $data['grupo'] = $grupo[0];
          $data['admin'] = $this->grupos_model->isAdmin($data['session']['id_usuario'], $idgrupo);
          $data['projetos'] = $this->grupos_model->listProjects($idgrupo);
          $data['reunioes'] = $this->reuniao_model->listar($idgrupo);
          $this->load->view('grupo/home', $data);
        } else {
          redirect($user, 'refresh');
        }
      } else {
        redirect('home', 'refresh');
      }
  }

  public function edit($user, $idgrupo){
      if($this->user_model->user($user)){
        $data['session'] = $this->session->userdata('logged_in');
        $grupo = $this->grupos_model->isMember($idgrupo, $data['session']['id_usuario']);
        if($grupo){
          $data['id'] = $user;
          $data['grupo'] = $grupo[0];
          $data['admin'] = $this->grupos_model->isAdmin($data['session']['id_usuario'], $idgrupo);
          if($data['admin']){
            $data['usuarios'] = $this->grupos_model->listUsuarios($idgrupo);
            $this->load->view('grupo/edicao', $data);
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

  public function editProjeto($user, $idgrupo, $projeto){
      if($this->user_model->user($user)){
        $data['session'] = $this->session->userdata('logged_in');
        $grupo = $this->grupos_model->isMember($idgrupo, $data['session']['id_usuario']);
        if($grupo){
          $proj = $this->grupos_model->isProject($idgrupo, $projeto);
          if($this->grupos_model->permissaoEditProj($data['session']['id_usuario'], $idgrupo, $proj[0]['id_projeto'])){
            $data['id'] = $user;
            $data['grupo'] = $grupo[0];
            $data['usuarios'] = $this->grupos_model->listUsuariosProjeto($idgrupo, $proj[0]['id_projeto']);
            $data['projeto'] = $proj[0];
            $this->load->view('grupo/edicaoProjeto', $data);
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

  public function update(){
    $idgrupo = $this->input->post('idgrupo');
    $nome = $this->input->post('nome');
    $usuarios = $this->input->post('usuarios');
    $usuariosold = $this->input->post('usuariosold');
    $data['session'] = $this->session->userdata('logged_in');
    $grupo = $this->grupos_model->isMember($idgrupo, $data['session']['id_usuario']);
    if($grupo && $this->grupos_model->isAdmin($data['session']['id_usuario'], $idgrupo)){
      $this->grupos_model->update($nome, $usuarios, $usuariosold, $idgrupo);
    }
  }

  public function delete(){
    $idgrupo = $this->input->post('idgrupo');

    foreach($this->grupos_model->listProjects($idgrupo) as $projeto){
      echo $projeto['id_projeto'];
      $this->projetos_model->excluir($projeto['id_projeto']);
    }

    $this->grupos_model->excluir($idgrupo);
  }

  public function reuniao($user, $idgrupo){
      if($this->user_model->user($user)){
        $data['session'] = $this->session->userdata('logged_in');
        $grupo = $this->grupos_model->isMember($idgrupo, $data['session']['id_usuario']);
        if($grupo){
          if($this->grupos_model->isAdmin($data['session']['id_usuario'], $idgrupo)){
            $data['id'] = $user;
            $data['grupo'] = $grupo[0];
            $data['admin'] = 1;
            $data['projetos'] = $this->grupos_model->listProjects($idgrupo);
            $this->load->view('grupo/reuniao', $data);
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

  public function projeto($user, $idgrupo, $projeto){
      if($this->user_model->user($user)){
        $data['session'] = $this->session->userdata('logged_in');
        $grupo = $this->grupos_model->isMember($idgrupo, $data['session']['id_usuario']);
        if($grupo){
          $proj = $this->grupos_model->isProject($grupo[0]['id_grupo'], $projeto);
          if($proj){
            $data['id'] = $user;
            $data['grupo'] = $grupo[0];
            $data['projeto'] = $proj[0];
            $data['documentacoes'] = $this->documentos_model->listarDeGrupo($data['projeto']['id_projeto']);
            $data['permissoes'] = $this->grupos_model->permissoesProjeto($data['projeto']['id_projeto'], $data['session']['id_usuario']);
            $this->load->view('grupo/projeto.php', $data);
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

  public function criarProjeto(){
      $projeto = ucfirst($this->input->post('nome'));
      $grupo = $this->input->post('id_grupo');
      if(strlen($projeto) > 3 && strlen($projeto) <= 60){
        if($this->grupos_model->naoCadastrado($projeto, $grupo)){
          echo '';
        } else {
          echo 'O grupo já possui um projeto com esse nome.';
        }
      } else {
        echo 'O nome deve possuir entre 3 e 60 caracteres.';
      }
  }
}
