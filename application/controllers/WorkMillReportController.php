<?php
/**
 * Created by PhpStorm.
 * User: Dibyendu
 * Date: 4/1/19
 * Time: 12:24 AM
 */

class WorkMillReportController extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Webservice_general_model');
        $this->load->model('WorkIssueMill_model');
        $this->load->library('form_validation');
    }

    public function index(){
        $data['currentPage']='WorkMillReportController';
        $this->load->view('assests/header');
        $this->load->view('assests/sidebar',$data);
        $this->load->view('assests/mainContent');
        $this->load->view('workMillReport/workMillReport');
    }

    public function reportView(){

    }
}