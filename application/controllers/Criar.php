<?php
class Criar extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('projetos_model');
  }

  function projeto(){
    $this->form_validation->set_rules('nome', 'nome', 'trim|required|alpha|min_length[3]|max_length[20]|xss_clean|callback_check_database');

    if($this->form_validation->run() == FALSE){
      $data['session'] = $this->session->userdata('logged_in');
      $data['projetos'] = $this->projetos_model->listProjects();
      $data['id'] = explode('@', $data['session']['email'])[0];
      $this->form_validation->set_error_delimiters('', '');
      $this->load->view('user/index', $data);
    } else {
      $this->projetos_model->cadastro();
      $user = explode('@', $this->session->userdata('logged_in')['email'])[0];
      $projeto = $this->input->post('nome');
      redirect("$user/projeto/$projeto");
    }
  }

  function check_database(){
    if($this->projetos_model->naocadastrado()){
      return true;
    }
    $this->form_validation->set_message('check_database', 'Você já possui um projeto com esse nome.');
    return false;
  }

  function grupo(){

  }


}
