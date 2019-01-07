<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CompanyController extends CI_Controller {

    private $_user;

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->model('Addoperator_model');
        $this->load->model('Company_model');
        $this->load->model('Branch_model');
        $this->load->model('Common_model');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }
    }

    public function index() {
            $data['currentPage'] = "company";
            $this->load->view('company/companyList',$data);
    }


    public function companyListwebAPI(){

        $start = $_GET['start'];
        $length = $_GET['length'];
        $search = $_GET['search']["value"];

         $data = $this->db->query("SELECT company_id_PK as id, operator_id_FK,branch_id_FK,company_name,company_address,company_owner,owner_number,country_id_FK,state_id_FK,city_id_FK,owner_email,created_date,isActive FROM `tbl_company`as user WHERE company_name LIKE '%".$search."%' OR company_address LIKE '%".$search."%' OR company_owner LIKE '%".$search."%' order by id Desc limit ".$start.",".$length."");

        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT company_id_PK as id, operator_id_FK,branch_id_FK,company_name,company_address,company_owner,owner_number,country_id_FK,state_id_FK,city_id_FK,owner_email,created_date,isActive FROM `tbl_company`");
        $result1 = $data12->result();
        $data1['recordsFiltered'] = $data12->num_rows();

        echo json_encode($data1);

 }


    public function addCompany() {

        try {
            $data['currentPage']= 'company';

          $breadcrumb=array(
            'Dashboard'=> base_url().'dashboard',
            '/Add Company'=> ""

            );
          $data['breadcrumbArray']=$breadcrumb;
          $data['title']="Add Company";

          $data['currentPage']='master';
          $data['currentSubMenu']='company';

          $data['uid']='';
          $data['type']='';
          $country_list=$this->Addoperator_model->get_country();
          $data['country_list']=$country_list;
             
          $this->load->view('assests/header');
          $this->load->view('assests/sidebar',$data);
          $this->load->view('assests/mainContent',$data);

          $this->load->view('company/companyForm',$data);

        } catch (Exception $ex) {
            echo $ex->getMessage() . '-' . $ex->getLine();
            die;
        }
    }


     function Branchfetch($query=""){
        $data = '';

       
        $data = $this->Branch_model->fetch_data($query);
        echo json_encode($data);
    }
    public function addBranchInPopUp(){
        $groupName = $this->uri->segment(3);
        $groupName=base64_decode($groupName);
        $re=$this->Common_model->get_country();
         $data['country_list']=$re;

         $data['previous_selected_countryID']="101";
         $data['previous_selected_stateID']="";
         $data['previous_selected_cityID']="";

         
         $data['title']="Add Branch";
        $data['groupName']=$groupName;
        $data['type']="popUp";

        $string = $this->load->view('branch/branchForm', $data, true);

        echo json_encode($string);

    }

public function GetUpdateCompanyList(){
    $uid = $this->uri->segment(3);
    $uid=base64_decode($uid);
    $resp = $this->Company_model->get_companylist_for_edit($uid);
    // $data['resultSet'] = $resp[0];
    $re=$this->Common_model->get_country();
    $data['country_list']=$re;
    
    $data['companyID']=$uid;
    $data['currentPage']='master';
    $data['currentSubMenu']='company';

    $this->load->view('assests/header');
    $this->load->view('assests/sidebar',$data);

    $breadcrumb=array(
        'Dashboard'=> base_url().'dashboard',
        'Company Detail'=> ""

    );

    $data['breadcrumbArray']=$breadcrumb;
    $data['title']="Company List";

    $this->load->view('assests/mainContent',$data);

    $this->load->view('company/companyForm',$data);
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

    public function Add_Company(){
        $uid = $this->input->post('uid');
        $data['uid']=$uid;
        $company_name = $this->input->post('company_name');
        $company_owner = $this->input->post('company_owner');
        $owner_email = $this->input->post('owner_email');
        $country_id = $this->input->post('country_id');
        $state_id = $this->input->post('state_id');
        $city_id = $this->input->post('city_id');
        $company_address = $this->input->post('company_address');
        $owner_number = $this->input->post('owner_number');
      
        $pincode = $this->input->post('pincode');
        $landline = $this->input->post('landline');
        $gst = $this->input->post('gst');
        $tan_number = $this->input->post('tan_number');
        

        $company_type_id = $this->input->post('company_type_id');
        $branch_id = $this->input->post('branch_id');

        $stdlandline = $this->input->post('stdlandline');
        $owner_number_code = $this->input->post('owner_number_code');
        

        $this->form_validation->set_rules('company_name','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter Company Name",'regex_match' => 'Please Enter character and space in Company Name')); 

        $this->form_validation->set_rules('company_owner','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter Company Owner Name",'regex_match' => 'Please Enter character and space in Company Owner Name'));   

        $this->form_validation->set_rules('landline','','required|max_length[11]|regex_match[/^[0-9]+$/]', array('required' => 'Please Enter Company landline Number', 'regex_match' => 'Please Enter only number in company landline number','max_length'=>'Please Enter minimum 11 number in company landline number'));

        $this->form_validation->set_rules('owner_email','','required|trim|regex_match[/^[a-zA-Z@.0-9_]+$/]',array('required'=>"Please Enter Owner Email",'regex_match' => 'Please Enter only character and space underscore @ numbers and comma in Owner Email'));

        $this->form_validation->set_rules('owner_number','','required|min_length[10]|max_length[10]|regex_match[/^[0-9]+$/]', array('required' => 'Please Enter Owner Number', 'regex_match' => 'Please Enter only number in Owner  Number','max_length'=>'Please Enter maximum 10 number in Owner Number','min_length'=>'Please Enter minimum 10 digit only in Owner number'));  

        $this->form_validation->set_rules('gst','','required|exact_length[15]|alpha_numeric|max_length[15]|regex_match[/^[a-zA-Z0-9]+$/]', array('required' => 'Please Enter Company Gst Number', 'exact_length'=>'Please enter 15 digit in Company GST','alpha_numeric'=>'Please Enter alphanumeric in Company GST','regex_match' => 'Please Enter only character or number in Company GST','max_length'=>'Please Enter minimum 15 character or number in Company GST'));

        $this->form_validation->set_rules('tan_number','','required|exact_length[10]|alpha_numeric|max_length[10]|regex_match[/^[a-zA-Z0-9]+$/]', array('required' => 'Please Enter Company TAN Number', 'exact_length'=>'Please enter 10 digit in Company TAN Number','alpha_numeric'=>'Please Enter alphanumeric in Company TAN Number','regex_match' => 'Please Enter only character or number in Company TAN Number','max_length'=>'Please Enter minimum 10 character or number in Company TAN Number'));

        // $this->form_validation->set_rules('branch_id','','required',array('required'=>"Please Select Branch"));

        $this->form_validation->set_rules('company_type_id','','required',array('required'=>"Please Select Company Type"));   

        $this->form_validation->set_rules('country_id','','required',array('required'=>"Please Select country"));

        $this->form_validation->set_rules('state_id','','required',array('required'=>"Please Select state"));

        $this->form_validation->set_rules('city_id','','required',array('required'=>"Please Select city"));

        $this->form_validation->set_rules('company_address','','required|regex_match[/^[a-zA-Z0-9, ]+$/]|trim',array('required'=>"Please Enter Company Address",'regex_match' => 'Please Enter only character number comma and space in Companys Address'));

        $this->form_validation->set_rules('pincode','','required|min_length[6]|max_length[6]|regex_match[/^[0-9]+$/]', array('required' => 'Please Enter pincode','max_length'=>'Please Enter 6 digit only in pincode', 'regex_match' => 'Please Enter only number in pincode','min_length'=>'Please Enter minimum 6 number in pincode'));
       
        $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
        if($this->form_validation->run()){      
        $data=array(
            
            'company_name'=>$company_name,
            'owner_email'=>$owner_email,
            'country_id_FK'=>$country_id,
            'state_id_FK'=>$state_id,
            'city_id_FK'=>$city_id,
            'company_address'=>$company_address,
            'owner_number'=>$owner_number,
            'company_owner'=>$company_owner,
            'pincode'=>$pincode,
            'landline'=>$landline,
            'company_GST'=>$gst,
            'tan'=>$tan_number,
            'company_type_id_FK'=>$company_type_id,
            'branch_id_FK'=>$branch_id,
            'landline_code' => $stdlandline,
            'owner_number_code' => $owner_number_code,
            'operator_id_FK' => $this->_user,
            
        );

        if($uid ==""){
           $res=$this->Company_model->insert_company($data);
        }else{
           $resp = $this->Company_model->update_company_record($uid, $data);
        }

        $checkDefaultCompanyExist = $this->Company_model->checkDefaultCompanyExist($this->_user);

        if($checkDefaultCompanyExist == 1){
            $filter['operator_id_FK'] = $this->_user;
            $set['company_id_FK'] = $res;
            if($this->General_model->getData('tbl_default_company',$filter)){
                $this->General_model->update('tbl_default_company',$filter,$set);
            }else{
                $set['operator_id_FK'] = $this->_user;
                $this->General_model->insert('tbl_default_company',$set);
            }
        }

       
        if ($res) {
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
