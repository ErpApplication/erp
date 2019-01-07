<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BranchController extends CI_Controller {

    private $_user;

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->model('Addoperator_model');
        $this->load->model('Branch_model');
        $this->load->model('Common_model');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }
    }

    public function index() {
            $data['currentPage'] = "branch";
            $this->load->view('branch/branchList',$data);
    }


    public function branchListwebAPI(){

        $start = $_GET['start'];
        $length = $_GET['length'];
        $search = $_GET['search']["value"];

         $data = $this->db->query("SELECT branch_id_PK as id, branch_name,branch_address,country_id_FK,state_id_FK,city_id_FK,admin_id_FK,manager_number,manager_email,created_date,isActive FROM `tbl_branch`as user WHERE branch_name LIKE '%".$search."%' OR branch_address LIKE '%".$search."%' OR manager_email LIKE '%".$search."%' order by id Desc limit ".$start.",".$length."");

        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT branch_id_PK as id, branch_name,branch_address,country_id_FK,state_id_FK,city_id_FK,admin_id_FK,manager_number,manager_email,created_date,isActive FROM `tbl_branch`");
        $result1 = $data12->result();
        $data1['recordsFiltered'] = $data12->num_rows();

        echo json_encode($data1);

 }


    public function addBranch(){
        $data['currentPage']='master';
        $data['currentSubMenu']='branch';

        $data['msg'] = "";
        
        $data['type']="";
        $breadcrumb['dashboard']="";

        $breadcrumb=array(
             'Dashboard'=> base_url()."dashboard",
             '/Branch List'=> base_url()."BranchController",
             '/Add Branch'=> ""
 
         );
 
 
         $re=$this->Common_model->get_country();
         $data['country_list']=$re;

         $data['previous_selected_countryID']="101";
         $data['previous_selected_stateID']="";
         $data['previous_selected_cityID']="";

         $data['breadcrumbArray']=$breadcrumb;
         $data['title']="Add Branch";
         $data['groupName']="";
         $data['uid']="";
 
         $this->load->view('assests/header');
         $this->load->view('assests/mainContent',$data);
          $this->load->view('assests/sidebar',$data);
 
        $this->load->view('branch/branchForm',$data);
    }

    public function BranchAdd(){
        $uid = $this->input->post('uid');
        $data['uid']=$uid;
       
        $branch_name = $this->input->post('branch_name');

        $manager_email = $this->input->post('manager_email');

        $country_id = $this->input->post('country_id');

        $state_id = $this->input->post('state_id');

        $city_id = $this->input->post('city_id');

        $branch_address = $this->input->post('branch_address');

        $branch_contact_code = $this->input->post('branch_contact_code');
        
        $branch_contact_number = $this->input->post('branch_contact_number');

        $manager_name = $this->input->post('manager_name');

        $pincode = $this->input->post('pincode');

        $branch_landline_code = $this->input->post('branch_landline_code');
        
        $branch_landline = $this->input->post('branch_landline');

        $this->form_validation->set_rules('branch_name','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter Branch Name",'regex_match' => 'Please Enter character and space in Branch Name'));  
        
        $this->form_validation->set_rules('branch_landline_code','','min_length[2]|regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in STD code number','min_length'=>'Please Enter minimum 2 digit  in STD code'));

        $this->form_validation->set_rules('branch_landline','','min_length[5]|regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in landline number','min_length'=>'Please Enter minimum 5 digit  in Landline Number'));
        
        $this->form_validation->set_rules('manager_email','','required|trim|valid_email|regex_match[/^[a-zA-Z@.0-9_]+$/]',array('required'=>"Please Enter Manager Email",'regex_match' => 'Please Enter only character and space underscore @ numbers and comma in Manager Email','valid_email'=>'Please Enter Valid Email'));
        
        $this->form_validation->set_rules('branch_contact_number','','min_length[10]|regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in contact number','min_length'=>'Please Enter minimum 10 digit  in contact number'));
        
        $this->form_validation->set_rules('courier_contact_code','','min_length[1]|regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in contact number','min_length'=>'Please Enter minimum 1 digit in country Code'));       
        
        $this->form_validation->set_rules('manager_name','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter Manager Name",'regex_match' => 'Please Enter character and space in Manager Name'));      
        
        $this->form_validation->set_rules('country_id','','required',array('required'=>"Please Select country"));
        
        $this->form_validation->set_rules('state_id','','required',array('required'=>"Please Select state"));
        
        $this->form_validation->set_rules('city_id','','required',array('required'=>"Please Select city"));
        
        $this->form_validation->set_rules('branch_address','','required|regex_match[/^[a-zA-Z0-9, ]+$/]|trim',array('required'=>"Please Enter Branch Address",'regex_match' => 'Please Enter only character number comma and space in Branch Address'));
        
        $this->form_validation->set_rules('pincode','','required|min_length[6]|max_length[6]|regex_match[/^[0-9]+$/]', array('required' => 'Please Enter pincode','max_length'=>'Please Enter 6 digit only in pincode', 'regex_match' => 'Please Enter only number in pincode','min_length'=>'Please Enter minimum 6 number in pincode'));
       
        $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
        if($this->form_validation->run()){      
        $data=array(
            
            'branch_name'=>$branch_name,
            'manager_email'=>$manager_email,
            'country_id_FK'=>$country_id,
            'state_id_FK'=>$state_id,
            'city_id_FK'=>$city_id,
            'branch_address'=>$branch_address,
            'manager_number'=>$branch_contact_number,
            'country_code'=>$branch_contact_code,
            'manage_by'=>$manager_name,
            'pincode'=>$pincode,
            'landline_code'=>$branch_landline_code,
            'landline'=>$branch_landline
            
        );
      
        if($uid ==""){
          $res=$this->Branch_model->insert_branch($data);
       }else{
          $res = $this->Branch_model->update_branch_record($uid, $data);

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

      public function list_branch(){

    $data['currentPage']='master';
    $data['currentSubMenu']='branch';

    $breadcrumb['dashboard']="";

    $breadcrumb=array(
        'Dashboard'=> base_url(),
        'Branch List'=> ""

    );


    $re=$this->Branch_model->get_branch_list();
    $data['ret']=$re;

    $data['breadcrumbArray']=$breadcrumb;
    $data['title']="Branch List";


    $this->load->view('assests/header');
    $this->load->view('assests/main_content',$data);
    $this->load->view('assests/sidebar',$data);

     
    $this->load->view('branch/branch_view',$data);
}

public function get_update_branch_list(){

    $uid = $this->uri->segment(3);
    $uid=base64_decode($uid);
    $resp = $this->Branch_model->get_branchlist_for_edit($uid);
    $data['resultSet'] = $resp[0];
    $re=$this->Common_model->get_country();
    $data['country_list']=$re;
    //$data['branchId']=$uid;
    $data['type']="";
    $data['uid']=$uid;

    $breadcrumb=array(
        'Dashboard'=> base_url().'dashboard',
        '/Branch list'=> base_url()."BranchController",
        '/Update Branch'=> ""

    );


    $data['breadcrumbArray']=$breadcrumb;
    $data['title']="Update Branch";

    $data['currentPage']='master';
    $data['currentSubMenu']='branch';
    
    
    $this->load->view('assests/header') ;
    $this->load->view('assests/sidebar',$data);
    $this->load->view('assests/mainContent',$data);
    $this->load->view('branch/branchForm',$data);
}

public function GetUpdateBranchDetail(){
    $uid = $this->input->post('uid');
    //$data['branchId']=$uid;
    $resp = $this->Branch_model->get_branchlist_for_edit($uid);
    $data['resultSet'] = $resp[0];
    $re=$this->Common_model->get_country();
    $data['country_list']=$re;
    $data['uid']=$uid;
    echo json_encode($data);
  
}
 

}
