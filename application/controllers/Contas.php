<?php

class Contas extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation', 'email'));
        $this->load->database();
        $this->load->model('contas_model');
    }

    public function index(){
        redirect('/conta/login', 'refresh');
    }

	public function view($page) {
        if ( ! file_exists(APPPATH.'views/conta/'.$page.'.php')) {
            show_404();
        }

        $data['title'] = ucfirst($page);

        $this->load->helper(array('form'));
        $this->load->view('conta/'.$page, $data);
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
        //set validation rules
        $this->form_validation->set_rules('nome', 'nome', 'trim|required|alpha|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[usuario.email]');
        $this->form_validation->set_rules('senha', 'senha', 'trim|required|md5');

        //validate form input
        if ($this->form_validation->run() === FALSE) {
            $data["title"] = 'Cadastro';
            $this->load->view('conta/cadastro', $data);
        } else {
            $sess_array = array(
                'nome' => $this->input->post('nome'),
                'email' => $this->input->post('email'),
                'senha' => $this->input->post('senha')
            );

            $id = $this->contas_model->cadastrar($sess_array);
            if (!$id) {
                $this->form_validation->set_message('erro_banco', 'Serviço ocupado, tente novamente mais tarde');
                $data["title"] = 'Cadastro';
                $this->load->view('conta/cadastro', $data);
            } else {
                $sess_array['id_usuario'] = $id;
                $this->session->set_userdata('logged_in', $sess_array);
                redirect('home', 'refresh');
            }
        }
    }

    function login() {
       //This method will have the credentials validation

       $this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean|valid_email');
       $this->form_validation->set_rules('senha', 'senha', 'trim|required|xss_clean|callback_check_database');

       if($this->form_validation->run() == FALSE) {
         //Field validation failed.  User redirected to login page
           $data["title"] = 'Login';
           $this->load->view('conta/login', $data);
       } else {
         //Go to private area
         redirect('home', 'refresh');
       }

    }
    function check_database($senha) {
       //Field validation succeeded.  Validate against database
       $email = $this->input->post('email');

       //query the database
       $result = $this->contas_model->login($email, $senha);

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
