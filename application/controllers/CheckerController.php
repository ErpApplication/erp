<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CheckerController extends CI_Controller {

    private $_user;

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->model('Checker_model');
        $this->load->model('Common_model');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }
    }

    public function index() {
            $data['currentPage'] = "checker";
            $this->load->view('checker/checkerList',$data);
    }


    public function checkerListwebAPI(){

        $start = $_GET['start'];
        $length = $_GET['length'];
        $search = $_GET['search']["value"];

         $data = $this->db->query("SELECT checker_id_PK as id, firstName,lastName,mobile_number,email,created_date,isActive FROM tbl_checker
          WHERE firstName LIKE '%".$search."%' OR lastName LIKE '%".$search."%' OR mobile_number LIKE '%".$search."%' order by id Desc limit ".$start.",".$length."");

        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT checker_id_PK as id, firstName,lastName,mobile_number,email,created_date,isActive FROM tbl_checker");
        $result1 = $data12->result();
        $data1['recordsFiltered'] = $data12->num_rows();

        echo json_encode($data1);

 }


    public function addChecker() {

        try {
            $data['currentPage']= 'checker';

          $breadcrumb=array(
            'Dashboard'=> base_url().'dashboard',
            '/Add Checker'=> ""

            );
          $data['breadcrumbArray']=$breadcrumb;
          $data['title']="Add Checker";

          $data['currentPage']='master';
          $data['currentSubMenu']='Checker';

          $data['uid']='';
             
          $this->load->view('assests/header');
          $this->load->view('assests/sidebar',$data);
          $this->load->view('assests/mainContent',$data);

          $this->load->view('checker/checkerForm',$data);

        } catch (Exception $ex) {
            echo $ex->getMessage() . '-' . $ex->getLine();
            die;
        }
    }


 public function get_update_checker_list(){
    $uid = $this->uri->segment(3);
    $uid= base64_decode($uid);
  
    $resp = $this->Checker_model->get_list_for_edit($uid); 
    $data['resultSet'] = $resp[0];
    $data['uid']=$uid;

     $breadcrumb=array(
        'Dashboard'=> base_url().'dashboard',
        '/Checker List'=> base_url()."checkerController",
        '/Update Checker'=> ""

    );


    $data['breadcrumbArray']=$breadcrumb;
    $data['title']="Update Checker";

    $data['currentPage']='master';
    $data['currentSubMenu']='checker';
    

    $this->load->view('assests/header');
    $this->load->view('assests/mainContent',$data);
    $this->load->view('assests/sidebar',$data);
     
    $this->load->view('checker/checkerForm',$data);
}

public function GetCheckerDetail(){
    $uid = $this->input->post('uid');
   
    $data['uid']=$uid;
    $resp = $this->Checker_model->get_list_for_edit($uid);
    $data['resultSet'] = $resp[0];
   
    echo json_encode($data);
  
}
       public function add_ckecker(){
         $uid = $this->input->post('uid');
         $data['uid']=$uid;
       
        $checkerfirstname = $this->input->post('checkerfirstname');
        
        $checkerlastname = $this->input->post('checkerlastname');
        
        $checkerCountryCode = $this->input->post('checkerCountryCode');
        $checkerMobileNumber = $this->input->post('checkerMobileNumber');
        
        $checkerEmail = $this->input->post('checkerEmail');
           
        $this->form_validation->set_rules('checkerfirstname','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter Ckecker First Name",'regex_match' => 'Please Enter Character And Space In Ckecker Name'));

        $this->form_validation->set_rules('checkerlastname','','required|trim|regex_match[/^[a-zA-Z]+$/]',array('required'=>"Please Enter Ckecker Last Name",'regex_match' => 'Please Enter Only Character In Ckecker Last Name'));

        $this->form_validation->set_rules('checkerCountryCode','','required|trim|min_length[2]|regex_match[/^[0-9]+$/]',array('required'=>"Please Enter Checker Country Code",'regex_match' => 'Please Enter Only numeric In Checker Country Code','min_length'=>'Please Enter Minimum 2 numeric value in Checker Country Code'));
        
        $this->form_validation->set_rules('checkerMobileNumber','','required|trim|min_length[10]|regex_match[/^[0-9]+$/]',array('required'=>"Please Enter Checker Mobile Number",'regex_match' => 'Please Enter Only numeric In Checker Mobile Number','min_length'=>'Please Enter Minimum 10 numeric value in Checker Mobile Number'));

        $this->form_validation->set_rules('checkerEmail','','required|trim|valid_email',array('required'=>"Please Select Branch",'valid_email'=>'Please Enter Valid Email'));        

        $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');



        if($this->form_validation->run())
        {      
        $data=array(
            
            'firstName'=>$checkerfirstname,
            'lastName'=>$checkerlastname,
            'country_code'=>$checkerCountryCode,
            'mobile_number'=>$checkerMobileNumber,
            'email'=>$checkerEmail
        
        );
          
          if($uid ==""){
            $res=$this->Checker_model->insert_checker($data);
          }else{
            $res=$this->Checker_model->update_checker_record($uid,$data);
          }

        if ($res)
        {
            $data["status"] = 1;
            echo json_encode($data);
            
        }else{
            $data["status"] = 0;
             echo json_encode($data);
             }
    
    }else{

        $data['message']=validation_errors();
    
        $data["status"] = 0;
        echo json_encode($data);


    }
      
    }



}
