<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        // Load database
        $this->load->model('authentication');
          $this->load->library('session');
          $this->load->helper('security');



    }

    public function index() {
        $this->load->view('login');

    }

    public function do_login() {
        try {
            $this->form_validation->set_rules('username', 'email', 'trim|required|xss_clean', array('required'=>'Username Is Empty','valid_email' => 'Incorrect Username. Please try again.'));
            $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean',array('required'=>'Password Is Empty'));

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'email' => $this->input->post('username'),
                    'password' => $this->input->post('password')
                );
                $result = $this->authentication->login($data);

                if ($result == TRUE) {

                     redirect('dashboard');
                    
                } else {
                    $this->session->set_flashdata('error_msg', 'Incorrect username/password, Please try again.');
                      redirect('login');
                }
            } else {
                if($this->input->post('username') == ""){
                    $this->session->set_flashdata('errors_msg', 'Please enter user name');
                    $this->load->view('login');
                }elseif($this->input->post('password') == ""){
                    # code...
                    $this->session->set_flashdata('errors_msg', 'Please enter password.');
                    $this->load->view('login');
                }else{
                    $this->session->set_flashdata('errors_msg', 'Please enter valid user name or password.');
                    $this->load->view('login');
                }
                
            }
        } catch (Exception $ex) {
            echo $ex->getMessage() . $ex->getLine();
            die;
        }
    }

    public function logout() {
        $this->session->unset_userdata('user');
        $this->session->sess_destroy();
        redirect('login');
    }

}
