<?php

class Reuniao extends CI_Controller{
  function __construct(){
      parent::__construct();
      $this->load->model('reuniao_model');
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

}

?>
