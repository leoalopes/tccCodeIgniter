<?php

class User_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function user($user) {
        if($this->isUser($user)){
            $data['session'] = $this->session->userdata('logged_in');
            $email = explode('@', $data['session']['email'], 2);
            if($user === $email[0]){
                return true;
            }
        }
        redirect('home', 'refresh');
    }

    public function isUser($user) {
        $this->db->select('email');
        $this->db->from('usuario');

        $query = $this->db->get();

        foreach($query->result() as $emails) {
            $array = explode('@', $emails->email, 2);
            if($user === $array[0]) {
                return true;
            }
        }

        return false;
    }

}
