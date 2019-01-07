<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Operator extends CI_Controller {

    private $_user;

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->model('Addoperator_model');
        $this->load->model('Common_model');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }
    }

    public function index() {
            $data['currentPage'] = "operator";
            $this->load->view('operator/operator-list',$data);
    }


    public function operatorListwebAPI(){

        $start = $_GET['start'];
        $length = $_GET['length'];
        $search = $_GET['search']["value"];

         $data = $this->db->query("SELECT user_id_PK as id, firstname,lastname,username,role_id_FK,admin_id_FK,branch_id_FK,created_date,isActive FROM `tbl_operator` as user 
          WHERE username LIKE '%".$search."%' OR firstname LIKE '%".$search."%' OR lastname LIKE '%".$search."%' order by id Desc limit ".$start.",".$length."");

        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT user_id_PK as id, firstname,lastname,username,role_id_FK,admin_id_FK,branch_id_FK,created_date,isActive FROM `tbl_operator`");
        $result1 = $data12->result();
        $data1['recordsFiltered'] = $data12->num_rows();

        echo json_encode($data1);

 }


    public function manage() {

        try {
            $data['currentPage']= 'operator';

          $breadcrumb=array(
            'Dashboard'=> base_url().'dashboard',
            '/Add Operator'=> ""

            );
          $data['breadcrumbArray']=$breadcrumb;
          $data['title']="Add Operator";

          $data['currentPage']='master';
          $data['currentSubMenu']='operator';

          $data['uid']='';
             
          $this->load->view('assests/header');
          $this->load->view('assests/sidebar',$data);
          $this->load->view('assests/mainContent',$data);

          $this->load->view('operator/operator-form',$data);

        } catch (Exception $ex) {
            echo $ex->getMessage() . '-' . $ex->getLine();
            die;
        }
    }


 public function get_update_operator_list(){
    $uid = $this->uri->segment(3);
    $uid= base64_decode($uid);
  
    $resp = $this->Addoperator_model->get_list_for_edit($uid); 
    $data['resultSet'] = $resp[0];
    $data['uid']=$uid;

     $breadcrumb=array(
        'Dashboard'=> base_url().'dashboard',
        '/Operator List'=> base_url()."operator",
        '/Update Operator'=> ""

    );


    $data['breadcrumbArray']=$breadcrumb;
    $data['title']="Update Operator";

    $data['currentPage']='master';
    $data['currentSubMenu']='operator';
    

    $this->load->view('assests/header');
    $this->load->view('assests/mainContent',$data);
    $this->load->view('assests/sidebar',$data);
     
    $this->load->view('operator/operator-form',$data);
}

public function GetOperatorDetail(){
    $uid = $this->input->post('uid');
   
    $data['uid']=$uid;
    $resp = $this->Addoperator_model->get_list_for_edit($uid);
    $data['resultSet'] = $resp[0];
   
    echo json_encode($data);
  
}


    public function deleteUser()
    {
         $this->load->model('webservice_general_model'); 
         $this->load->model('webservice_model');
         
          //$this->webservice_model->sendEmail_withFrom($user_data[0]->email, $message, "Your Breezymeal Account is approved", "Breezymeal - Account is Approved");exit;

         if($this->input->is_ajax_request()){   
            $userId = $this->input->post('userId',TRUE);
            $isActive = $this->input->post('isActive',TRUE);
            if($userId != ''){
                //$transactionId = $this->encryption->decode($transactionId);
                $filter['user_id_PK']  = $userId;
                $setData['isActive']  = $isActive;
                $id = $this->webservice_general_model->update('tbl_user',$filter,$setData);
                echo 1; die;
           
            }else{
              echo 0; die;
            }      
        }else{
         echo 0; die;
        } 
  }
  

       public function add_operator(){
         $uid = $this->input->post('uid');
         $data['uid']=$uid;
       
        $username = $this->input->post('username');
        
        $password = $this->input->post('password');
        
        $firstname = $this->input->post('firstname');
        
        $lastname = $this->input->post('lastname');
        
        $branch_id = $this->input->post('branch_id');
        
      
        $this->form_validation->set_rules('username','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter User Name",'regex_match' => 'Please Enter Character And Space In User Name'));

        $this->form_validation->set_rules('password','','required',array('required'=>"Please Enter Password"));
         
        $this->form_validation->set_rules('firstname','','required|trim|regex_match[/^[a-zA-Z]+$/]',array('required'=>"Please Enter First Name",'regex_match' => 'Please Enter Only Character In User Name'));

        $this->form_validation->set_rules('lastname','','required|trim|regex_match[/^[a-zA-Z]+$/]',array('required'=>"Please Enter Last Name",'regex_match' => 'Please Enter Only Character In Last Name'));

        $this->form_validation->set_rules('branch_id','','required|trim',array('required'=>"Please Select Branch"));        

        $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');



        if($this->form_validation->run())
        {      
        $data=array(
            
            'username'=>$username,
            'password'=>md5($password),
            'firstname'=>$firstname,
            'lastname'=>$lastname,
            'branch_id_FK'=>$branch_id
        
        );
          
          if($uid ==""){
            $res=$this->Addoperator_model->insert_operator($data);
          }else{
            $res=$this->Addoperator_model->update_operator_record($uid,$data);
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

  public function getUserData(){
         $this->load->model('webservice_general_model'); 
         if($this->input->is_ajax_request()){   
            $userId = $this->input->post('userId',TRUE);
            if($userId != ''){
            //$transactionId = $this->encryption->decode($transactionId);
            $userId = $userId; 
            
            $filter['id']  = $userId;
            $id = $this->webservice_general_model->getData('users',$filter);
            
            if($id){
              echo json_encode($id); die;
          }else{
              echo 0; die;
          }
        }else{
          echo 0; die;
        }      
        }else{
         echo 0; die;
        } 
  }


}
