<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller {

    private $_user;

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->model('Addoperator_model');
        $this->load->model('BankMasterModel');
        $this->load->model('Common_model');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }
    }

    public function index() {
            $data['currentPage'] = "bank";
            $this->load->view('bank/bankList',$data);
    }


    public function bankListwebAPI(){

        $start = $_GET['start'];
        $length = $_GET['length'];
        $search = $_GET['search']["value"];

         $data = $this->db->query("SELECT bank_id_PK as id, bank_name,address,country_id_FK,state_id_FK,city_id_FK,isActive FROM `tbl_bank`as user WHERE bank_name LIKE '%".$search."%' OR address LIKE '%".$search."%' order by id Desc limit ".$start.",".$length."");

        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT bank_id_PK as id, bank_name,address,country_id_FK,state_id_FK,city_id_FK,isActive FROM `tbl_bank`");
        $result1 = $data12->result();
        $data1['recordsFiltered'] = $data12->num_rows();

        echo json_encode($data1);

 }


    public function addBank() {

        try {
            $data['currentPage']= 'bank';

          $breadcrumb=array(
            'Dashboard'=> base_url().'dashboard',
            '/Add Bank'=> ""

            );
          $data['breadcrumbArray']=$breadcrumb;
          $data['title']="Add Bank";

          $data['currentPage']='master';
          $data['currentSubMenu']='bank';

          $data['uid']='';
          $country_list=$this->Addoperator_model->get_country();
          $data['country_list']=$country_list;
             
          $this->load->view('assests/header');
          $this->load->view('assests/sidebar',$data);
          $this->load->view('assests/mainContent',$data);

          $this->load->view('bank/bankForm',$data);

        } catch (Exception $ex) {
            echo $ex->getMessage() . '-' . $ex->getLine();
            die;
        }
    }



public function get_update_bank_list(){

    $uid = $this->uri->segment(3);
    $uid=base64_decode($uid);

    $breadcrumb=array(
        'Dashboard'=> base_url()."bank",
        '/Bank list'=> base_url()."bank",
        '/Update Bank'=> ""

    );

    $data['currentPage']='master';
    $data['currentSubMenu']='bank';



    $resp = $this->BankMasterModel->get_banklist_for_edit($uid);
    $data['resultSet'] = $resp[0];
    $country_list=$this->Common_model->get_country();
    $data['country_list']=$country_list;
    $data['uid']=$uid;

    $data['breadcrumbArray']=$breadcrumb;
    $data['title']="Update Bank";

    $this->load->view('assests/header'); 
    $this->load->view('assests/sidebar',$data);
    $this->load->view('assests/mainContent',$data);
   $this->load->view('bank/bankForm',$data);


    
}

public function GetBankDetail(){
    $uid = $this->input->post('uid');
    $data['uid']=$uid;
    $resp = $this->BankMasterModel->get_banklist_for_edit($uid);
    $data['resultSet'] = $resp[0];
    $re=$this->Common_model->get_country();
    $data['country_list']=$re;
    $data['uid']=$uid;
    echo json_encode($data);
  
}
public function add_bank(){
    $uid = $this->input->post('uid');
    $data['uid']=$uid;
    $bank_name = $this->input->post('bank_name');

    $landline = $this->input->post('landline');

    $landline_code = $this->input->post('landline_code');

    $bank_country_id = $this->input->post('bank_country_id');

    $bank_state_id = $this->input->post('bank_state_id');

    $bank_city_id = $this->input->post('bank_city_id');

    $address = $this->input->post('address');

    $pincode = $this->input->post('pincode');


    $this->form_validation->set_rules('bank_name','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter Bank Name",'regex_match' => 'Please Enter character and space in Bank Name'));  

    $this->form_validation->set_rules('landline','','min_length[6]|regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter only number in landline number','min_length'=>'Please Enter minimum 6 digit only in Landline Number'));

    $this->form_validation->set_rules('landline_code','','min_length[4]|regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter only number in STD code number','min_length'=>'Please Enter minimum 4 digit only in STD code'));

    $this->form_validation->set_rules('bank_country_id','','required',array('required'=>"Please Select country"));

    $this->form_validation->set_rules('bank_state_id','','required',array('required'=>"Please Select state"));

    $this->form_validation->set_rules('bank_city_id','','required',array('required'=>"Please Select city"));

    $this->form_validation->set_rules('address','','regex_match[/^[a-zA-Z0-9, ]+$/]|trim',array('regex_match' => 'Please Enter only character number comma and space in Bank Address'));

    $this->form_validation->set_rules('pincode','','min_length[6]|max_length[6]|regex_match[/^[0-9]+$/]', array('max_length'=>'Please Enter 6 digit only in pincode', 'regex_match' => 'Please Enter only number in pincode','min_length'=>'Please Enter minimum 6 number in pincode'));

    $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
    if($this->form_validation->run()){      
    $data=array(
        
        'bank_name'=>$bank_name,
        'landline'=>$landline,
        'country_id_FK'=>$bank_country_id,
        'state_id_FK'=>$bank_state_id,
        'city_id_FK'=>$bank_city_id,
        'address'=>$address,
        'landline_code'=>$landline_code,
        'pincode'=>$pincode

        
    );

        if($uid ==""){
        $res=$this->BankMasterModel->insert_bank($data);
       }else{
        $res = $this->BankMasterModel->update_bank_record($uid, $data);
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
