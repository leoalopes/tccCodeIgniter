<?php

class Reuniao extends CI_Controller{
  function __construct(){
      parent::__construct();
      $this->load->model('user_model');
      $this->load->model('projetos_model');
      $this->load->model('grupos_model');
      $this->load->model('reuniao_model');
      $this->load->model('documentos_model');
  }

  public function cadastro(){
    $idgrupo = $this->input->post('idgrupo');
    $motivo = $this->input->post('motivo');
    $data = $this->input->post('data');
    $notificar = $this->input->post('notificar');
    if($this->reuniao_model->cadastro($idgrupo, $motivo, $data)){
      echo '';
      if($notificar == "true"){
        //enviar email e talzzzzzz
      }
    } else {
      echo 'Ocorreu um erro tente novamente mais tarde.';
    }
  }

  public function edicao(){
    $idreuniao = $this->input->post('idreuniao');
    $motivo = $this->input->post('motivo');
    $data = $this->input->post('data');
    $notificar = $this->input->post('notificar');
    if($this->reuniao_model->editar($idreuniao, $motivo, $data)){
      echo '';
      if($notificar == "true"){
        //enviar email e talzzzzzz
      }
    } else {
      echo 'Não é possível atualizar a data.';
    }
  }

  public function delete($user, $idgrupo, $idreuniao){
      if($this->user_model->user($user)){
        $data['session'] = $this->session->userdata('logged_in');
        $grupo = $this->grupos_model->isMember($idgrupo, $data['session']['id_usuario']);
        if($grupo){
          if($this->reuniao_model->reuniao($idreuniao, $idgrupo)){
            $this->reuniao_model->excluir($idreuniao);
            redirect("$user/grupo/$idgrupo", 'refresh');
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

  public function edit($user, $idgrupo, $idreuniao){
      if($this->user_model->user($user)){
        $data['session'] = $this->session->userdata('logged_in');
        $grupo = $this->grupos_model->isMember($idgrupo, $data['session']['id_usuario']);
        if($grupo){
          $reuniao = $this->reuniao_model->reuniaoPendente($idreuniao, $idgrupo);
          if($reuniao){
            $data['id'] = $user;
            $data['grupo'] = $grupo[0];
            $data['admin'] = $this->grupos_model->isAdmin($data['session']['id_usuario'], $idgrupo);
            $data['projetos'] = $this->grupos_model->listProjects($idgrupo, $data['session']['id_usuario']);
            $data['reuniao'] = $reuniao;
            $this->load->view('grupo/editarReuniao', $data);
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

?>
