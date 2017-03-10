<?php
class Login extends CI_Controller {
 
 function __construct() {
   parent::__construct();
   $this->load->model('contas_model');
 }
 
 function index() {
   //This method will have the credentials validation
   $this->load->library('form_validation');
 
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
?>