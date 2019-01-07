<?php

class SignUp extends CI_Controller
{
	
   public function __construct() {

        parent::__construct();
        //$this->load->model('Login_model');
        $this->load->model('Common_model');
        //$this->load->model('SignUp_model');
        $this->load->model('Api_model');
        $this->load->model('SignUp_model');
        $this->load->library('form_validation');

        /*if (!isset($this->session->userdata['user_id'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user_id'];
        }*/
    }
  public function index(){
    $countryList=$this->Api_model->get_country();
    $data['country_list']=$countryList;
    $this->load->view('assests/header');
    $this->load->view('signUp_view',$data);
 
  }

      public function manufactureRegister(){
       
        $first_name = $this->input->post('first_name');

        $last_name = $this->input->post('last_name');
        
        $email = $this->input->post('email');
        
        $register_country_id = $this->input->post('register_country_id');

        $register_state_id = $this->input->post('register_state_id');

        $register_city_id = $this->input->post('register_city_id');

        $address = $this->input->post('address');

        $password = $this->input->post('password');
        $register_pincode = $this->input->post('register_pincode');


       $this->form_validation->set_rules('first_name','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter User First Name",'regex_match' => 'Please Enter character and space in User First Name'));  
       $this->form_validation->set_rules('last_name','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter User Last Name",'regex_match' => 'Please Enter character and space in User Last Name'));  
       $this->form_validation->set_rules('email','','required|trim|valid_email',array('required'=>"Please Enter User Last Name",'valid_email' => 'Please Enter Valid Email'));  
        
        //$this->form_validation->set_rules('landline','','min_length[6]|regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter only number in landline number','min_length'=>'Please Enter minimum 6 digit only in Landline Number'));
        
        //$this->form_validation->set_rules('landline_code','','min_length[4]|regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter only number in STD code number','min_length'=>'Please Enter minimum 4 digit only in STD code'));
       
        $this->form_validation->set_rules('register_country_id','','required',array('required'=>"Please Select country"));
        
        $this->form_validation->set_rules('register_state_id','','required',array('required'=>"Please Select state"));
        
        $this->form_validation->set_rules('register_city_id','','required',array('required'=>"Please Select city"));

        $this->form_validation->set_rules('address','','regex_match[/^[a-zA-Z0-9, ]+$/]|trim',array('regex_match' => 'Please Enter only character number comma and space in Register Address'));
        
        $this->form_validation->set_rules('register_pincode','','min_length[6]|max_length[6]|regex_match[/^[0-9]+$/]', array('max_length'=>'Please Enter 6 digit only in pincode', 'regex_match' => 'Please Enter only number in pincode','min_length'=>'Please Enter minimum 6 number in pincode'));
       
        $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
        if($this->form_validation->run()){      
        $data=array(
            
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'country_id_FK'=>$register_country_id,
            'state_id_FK'=>$register_state_id,
            'city_id_FK'=>$register_city_id,
            'email'=>$email,
            'address'=>$address,
            'pincode'=>$register_pincode,
            'type'=>1,
            'password'=>$password
        );
    
        $res=$this->SignUp_model->insert($data);
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




?>