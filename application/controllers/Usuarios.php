<?php

class Usuarios extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation', 'email'));
        $this->form_validation->set_error_delimiters('', '');
        $this->load->database();
        $this->load->model('usuario_model');
    }

    public function index(){
        redirect('/conta/login', 'refresh');
    }

	  public function view($page) {
        if ( ! file_exists(APPPATH.'views/conta/'.$page.'.php')) {
            show_404();
        }
        $this->load->helper(array('form'));
        $this->load->view('conta/'.$page);
    }

    public function search(){
      $email = $this->input->post("email");
      echo json_encode($this->usuario_model->searchByEmail($email));
    }

    public function logout(){
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
        $this->session->sess_destroy();
        redirect('about');
    }

    function cadastro() {
        $this->form_validation->set_rules('nome', 'nome', 'trim|required|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[usuario.email]');
        $this->form_validation->set_rules('senha', 'senha', 'trim|required|md5');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('conta/cadastro');
        } else {
            $sess_array = array(
                'nome' => $this->input->post('nome'),
                'email' => $this->input->post('email'),
                'senha' => $this->input->post('senha')
            );
            $id = $this->usuario_model->cadastrar($sess_array);
            if (!$id) {
                $this->load->view('conta/cadastro');
            } else {
                $sess_array['id_usuario'] = $id;
                $this->session->set_userdata('logged_in', $sess_array);
                redirect('home', 'refresh');
            }
        }
    }

    function login() {
       $this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean|valid_email');
       $this->form_validation->set_rules('senha', 'senha', 'trim|required|xss_clean|callback_check_database');

       if($this->form_validation->run() == FALSE) {
           $this->load->view('conta/login');
       } else {
           redirect('home', 'refresh');
       }

    }
    function check_database($senha) {
       $email = $this->input->post('email');

       $result = $this->usuario_model->login();

       if($result) {
         $sess_array = array();
         foreach($result as $row) {
           $sess_array = array(
             'id_usuario' => $row->id_usuario,
             'nome' => $row->nome,
             'email' => $row->email,
             'senha' => $row->senha
           );
           $this->session->set_userdata('logged_in', $sess_array);
         }
         return TRUE;
       }
       else {
         $this->form_validation->set_message('check_database', 'E-mail ou senha inválidos');
         return false;
       }
    }
}
