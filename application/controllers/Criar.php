<?php
class Criar extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('projetos_model');
  }

  function projeto(){
    $this->form_validation->set_rules('nome', 'nome', 'trim|required|alpha|min_length[3]|max_length[30]|xss_clean|callback_insert');

    if($this->form_validation->run() == FALSE){
      $this->load->view('user/index');
    } else {
      $user = explode('@', $this->session->get_userdata('logged_in')['email'])[0];
      $projeto = $this->input->post('nome');
      redirect($user.'/'.$projeto);
    }
  }

  function insert(){
    return $this->projetos_model->cadastro();
  }

  function grupo(){

  }


}
