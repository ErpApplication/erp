<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Courier extends CI_Controller {

    private $_user;

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->model('Addoperator_model');
        $this->load->model('Courier_model');
        $this->load->model('Common_model');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }
    }

    public function index() {
            $data['currentPage'] = "courier";
            $this->load->view('courier/courierList',$data);
    }


    public function courierListwebAPI(){

        $start = $_GET['start'];
        $length = $_GET['length'];
        $search = $_GET['search']["value"];

         $data = $this->db->query("SELECT courier_id_PK as id, courier_name,courier_address,country_id_FK,state_id_FK,city_id_FK,contact_person,contact_number,created_date,isActive FROM `tbl_courier`as user WHERE courier_name LIKE '%".$search."%' OR courier_address LIKE '%".$search."%' OR contact_person LIKE '%".$search."%' order by id Desc limit ".$start.",".$length."");

        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT courier_id_PK as id, courier_name,courier_address,country_id_FK,state_id_FK,city_id_FK,contact_person,contact_number,created_date,isActive FROM `tbl_courier`");
        $result1 = $data12->result();
        $data1['recordsFiltered'] = $data12->num_rows();

        echo json_encode($data1);

 }


    public function addCourier() {

        try {
            $data['currentPage']= 'courier';

          $breadcrumb=array(
            'Dashboard'=> base_url().'dashboard',
            '/Add Courier'=> ""

            );
          $data['breadcrumbArray']=$breadcrumb;
          $data['title']="Add Courier";

          $data['currentPage']='master';
          $data['currentSubMenu']='courier';

          $data['uid']='';
          $country_list=$this->Addoperator_model->get_country();
          $data['country_list']=$country_list;
             
          $this->load->view('assests/header');
          $this->load->view('assests/sidebar',$data);
          $this->load->view('assests/mainContent',$data);

          $this->load->view('courier/courierForm',$data);

        } catch (Exception $ex) {
            echo $ex->getMessage() . '-' . $ex->getLine();
            die;
        }
    }


    public function get_update_courier_list(){
    $uid = $this->uri->segment(3);
    $uid=base64_decode($uid);

    $resp = $this->Courier_model->get_list_for_edit($uid);
    $data['resultSet'] = $resp[0];
    
    $re=$this->Common_model->get_country();
    $data['country_list']=$re;
    $data['uid']=$uid;


        $breadcrumb=array(
        'Dashboard'=> base_url().'dashboard',
        '/Courier list'=> base_url()."Courier",
        '/Update Courier'=> ""

    );


    $data['breadcrumbArray']=$breadcrumb;
    $data['title']="Update Courier";

    $data['currentPage']='master';
    $data['currentSubMenu']='courier';

    $this->load->view('assests/header'); 
    $this->load->view('assests/sidebar',$data);
    $this->load->view('assests/mainContent',$data);
    $this->load->view('courier/courierForm',$data);
    
}

public function GetCourierDetail(){
    $uid = $this->input->post('uid');
    $data['uid']=$uid;
    $resp = $this->Courier_model->get_list_for_edit($uid);
    $data['resultSet'] = $resp[0];
    $country_list=$this->Common_model->get_country();
    $data['country_list']=$country_list;
    $data['uid']=$uid;
    echo json_encode($data);
  
}

public function add_courier(){
        $uid = $this->input->post('uid');
        $data['uid']=$uid;
        $courier_name = $this->input->post('courier_name');

        $contact_person = $this->input->post('contact_person');

        $courier_country_id = $this->input->post('courier_country_id');

        $courier_state_id = $this->input->post('courier_state_id');

        $courier_city_id = $this->input->post('courier_city_id');

        $courier_address = $this->input->post('courier_address');

        $pincode = $this->input->post('pincode');

        $landline_code = $this->input->post('landline_code');

        $gst = $this->input->post('gst');

        $landline = $this->input->post('landline');

        $contact_number = $this->input->post('contact_number');
        
        $courier_contact_code = $this->input->post('courier_contact_code');

      
        $this->form_validation->set_rules('courier_name','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter Courier Name",'regex_match' => 'Please Enter character and space in Courier Name'));
       
        $this->form_validation->set_rules('courier_country_id','','required',array('required'=>"Please Select country"));
        
        $this->form_validation->set_rules('courier_state_id','','required',array('required'=>"Please Select state"));
        
        $this->form_validation->set_rules('courier_city_id','','required',array('required'=>"Please Select city"));
        
        $this->form_validation->set_rules('courier_address','','required','regex_match[/^[a-zA-Z0-9, ]+$/]|trim',array('required'=>"Please Enter Courier Address",'regex_match' => 'Please Enter  character number comma and space in Courier Address'));
      
        $this->form_validation->set_rules('pincode','','required|min_length[6]|max_length[6]|regex_match[/^[0-9]+$/]', array('required' => 'Please Enter pincode','max_length'=>'Please Enter 6 digit  in pincode', 'regex_match' => 'Please Enter  number in pincode','min_length'=>'Please Enter minimum 6 number in pincode'));
        
        $this->form_validation->set_rules('gst','','exact_length[15]|alpha_numeric|max_length[15]|regex_match[/^[a-zA-Z0-9]+$/]', array('exact_length'=>'Please enter 15 digit in gst','alpha_numeric'=>'Please Enter alphanumeric in gst','regex_match' => 'Please Enter  character or number in gst','max_length'=>'Please Enter minimum 15 character or number'));
        
        $this->form_validation->set_rules('contact_person','','trim|regex_match[/^[a-zA-Z ]+$/]',array('regex_match' => 'Please Enter  character and space in contact person'));
        
        $this->form_validation->set_rules('landline','','min_length[5]|regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in landline number','min_length'=>'Please Enter minimum 5 digit  in Landline Number'));
        
        $this->form_validation->set_rules('landline_code','','min_length[2]|regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in STD code number','min_length'=>'Please Enter minimum 2 digit  in STD code'));
       
        $this->form_validation->set_rules('contact_number','','min_length[10]|regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in contact number','min_length'=>'Please Enter minimum 10 digit  in contact number'));
        
        $this->form_validation->set_rules('courier_contact_code','','min_length[1]|regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in contact number','min_length'=>'Please Enter minimum 1 digit in country Code'));
        
        $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
        if($this->form_validation->run()){      
    $data=array(
      
      'courier_name'=>$courier_name,
            'courier_address'=>$courier_address,
            'pincode'=>$pincode,
            'GST'=>$gst,
            'country_id_FK'=>$courier_country_id,
            'state_id_FK'=>$courier_state_id,
            'city_id_FK'=>$courier_city_id,
            'landline'=>$landline,
            'landline_code'=>$landline_code,
            'contact_person'=>$contact_person,
            'contact_number'=>$contact_number,
            'country_code'=>$courier_contact_code
            
    );
      
      if($uid ==""){
        $res=$this->Courier_model->insert_courier($data);
      }else{
        $res = $this->Courier_model->update_courier_record($uid, $data);
      }

        if ($res)
        {
            $data["status"] = 1;
            echo json_encode($data);
            
        }
       
                  
    else
    {
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
