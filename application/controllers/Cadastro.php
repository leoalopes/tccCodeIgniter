<?php
class Cadastro extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation', 'email'));
        $this->load->database();
        $this->load->model('contas_model');
    }
    
    function index()
    {
        $this->cadastro();
    }

    function cadastro()
    {
        //set validation rules
        $this->form_validation->set_rules('nome', 'nome', 'trim|required|alpha|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[usuario.email]');
        $this->form_validation->set_rules('senha', 'senha', 'trim|required|md5');
        
        //validate form input
        if ($this->form_validation->run() == FALSE) {
            $data["title"] = 'Cadastro';
            $this->load->view('conta/cadastro', $data);
        } else {
            $sess_array = array(
                'nome' => $this->input->post('nome'),
                'email' => $this->input->post('email'),
                'senha' => $this->input->post('senha')
            );
            
            if (!$this->contas_model->cadastrar($sess_array)) {
                $this->form_validation->set_message('erro_banco', 'Serviço ocupado, tente novamente mais tarde');
                $data["title"] = 'Cadastro';
                $this->load->view('conta/cadastro', $data);
            } else {
                $this->session->set_userdata('logged_in', $sess_array);
                redirect('home', 'refresh');
            }
        }
    }
}
?>