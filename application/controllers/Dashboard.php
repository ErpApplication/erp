<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    private $_user;

    public function __construct() {

        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        // Load database
        $this->load->model('authentication');
        $this->load->model('dashboard_model');

        // Load helper
       // $this->load->helper('webuser');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }


    }

    public function index() {



            // $data["userCount"] = $this->dashboard_model->userCount()->count;
            // $data["offerCOunt"] = $this->dashboard_model->offerCOunt()->count;
            // $data["productCount"] = $this->dashboard_model->productCount()->count;
            // $data["orderCount"] = $this->dashboard_model->orderCount()->count;

        $data['currentPage'] = "dashboard";

          $this->load->view('home',$data);
            

       
    }

}
