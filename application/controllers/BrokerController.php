<?php 

class BrokerController extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
        $this->load->model('Webservice_general_model');
        $this->load->library('form_validation');

	}

public function index(){
	$data['currentPage']='broker';
    $this->load->view('broker/brokerList_view',$data);
}

public function brokerListwebAPI(){

        $start = $_GET['start'];
        $length = $_GET['length'];
        $search = $_GET['search']["value"];
        $where="";

        if($search !=""){
            // $where=" branch_name LIKE '%".$search."%'
            //   OR branch_address LIKE '%".$search."%'
            //    OR manager_email LIKE '%".$search."%' ";
        }

         $data = $this->db->query("SELECT broker_id_PK as id, broker_name,
            state_id_FK,city_id_FK,address,taluka,phone_number,
            broker_gst,broker_pan,broker_tan,email,pincode,
            created_date,isActive FROM `tbl_broker`as broker
             ");
             // WHERE ".$where." order by id Desc limit ".$start.",".$length."");

        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT broker_id_PK as id, broker_name,
            state_id_FK,city_id_FK,address,taluka,phone_number,
            broker_gst,broker_pan,broker_tan,email,pincode,
            created_date,isActive FROM `tbl_broker`as broker");
        $result1 = $data12->result();
        $data1['recordsFiltered'] = $data12->num_rows();

        echo json_encode($data1);

}


public function insertBroker(){
	$data['currentPage']='broker';

	$breadcrumb=array(
        'Dashboard'=> base_url().'dashboard',
        '/Add Brokers'=> ""
     );
    $data['breadcrumbArray']=$breadcrumb;
    $data['title']="Add Brokers ";

    $data['uid']='';

	$this->load->view('assests/header');
	$this->load->view('assests/sidebar',$data);
	$this->load->view('assests/mainContent',$data);
    $this->load->view('broker/brokers',$data);
    $this->load->view('assests/footer');

}

public function addBroker(){
    $uid=$this->input->post('uid');
    $data['uid']=$uid;
	$broker_name=$this->input->post('broker_name');
	$broker_State_Id=$this->input->post('broker_State_Id');
	$broker_City_Id=$this->input->post('broker_City_Id');
	$broker_Taluka=$this->input->post('broker_Taluka');
	$broker_Phone=$this->input->post('broker_Phone');
	$broker_Address=$this->input->post('broker_Address');
	$broker_Gst=$this->input->post('broker_Gst');
	$broker_Pan=$this->input->post('broker_Pan');
	$broker_Tan=$this->input->post('broker_Tan');
	$broker_Email=$this->input->post('broker_Email');
	$broker_Pincode=$this->input->post('broker_Pincode');

    $this->form_validation->set_rules('broker_name','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter Broker Name",'regex_match' => 'Please Enter character and space in Broker Name'));  
    $this->form_validation->set_rules('broker_Email','','required|trim|valid_email|regex_match[/^[a-zA-Z@.0-9_]+$/]',array('required'=>"Please Enter Broker Email", 'regex_match' => 'Please Enter only character and space underscore @ numbers and comma in Broker Email','valid_email'=>'Please Enter Valid Email'));
    
    $this->form_validation->set_rules('broker_Phone','','required|min_length[10]|regex_match[/^[0-9]+$/]', array('required'=>"Please Enter Broker GST Number", 'regex_match' => 'Please Enter  number in contact number','min_length'=>'Please Enter minimum 10 digit  in contact number'));
   
    $this->form_validation->set_rules('broker_Gst','','required|min_length[15]|max_length[15]|regex_match[/^[0-9A-Za-z]+$/]', array('required'=>"Please Enter Broker GST Number", 'regex_match' => 'Please Enter  number and alphabates in GST Number','min_length'=>'Please Enter 15 Digits in GST','max_length'=>'Please Enter 15 Digits in GST'));
    $this->form_validation->set_rules('broker_Pan','','required|min_length[10]|max_length[10]|regex_match[/^[0-9A-Za-z]+$/]', array('required'=>"Please Enter Broker PAN Number", 'regex_match' => 'Please Enter  number and alphabates in PAN Number','min_length'=>'Please Enter 10 Digits in PAN','max_length'=>'Please Enter 10 Digits in PAN'));
    $this->form_validation->set_rules('broker_Tan','','required|min_length[10]|max_length[10]|regex_match[/^[0-9A-Za-z]+$/]', array('required'=>"Please Enter Broker TAN Number", 'regex_match' => 'Please Enter  number and alphabates in PAN Number','min_length'=>'Please Enter 10 Digits in PAN','max_length'=>'Please Enter 10 Digits in PAN'));
    
    $this->form_validation->set_rules('broker_State_Id','','required',array('required'=>"Please Select state"));
    $this->form_validation->set_rules('broker_City_Id','','required',array('required'=>"Please Select city"));
    
    $this->form_validation->set_rules('broker_Taluka','','required',array('required'=>"Please Enter Broker Taluka"));
    $this->form_validation->set_rules('broker_Address','','required',array('required'=>"Please Enter Broker Address "));
    
    $this->form_validation->set_rules('broker_Pincode','','required|min_length[6]|max_length[6]|regex_match[/^[0-9]+$/]', array('required'=>"Please Enter Broker Pincode", 'max_length'=>'Please Enter 6 digit only in pincode', 'regex_match' => 'Please Enter only number in pincode','min_length'=>'Please Enter minimum 6 number in pincode'));
   
    $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
     
    if($this->form_validation->run()){      
        $allData=array(
            'broker_name'=>$broker_name,
            'state_id_FK'=>$broker_State_Id,
            'city_id_FK'=>$broker_City_Id,
            'taluka'=>$broker_Taluka,
            'phone_number'=>$broker_Phone,
            'address'=>$broker_Address,
            'broker_gst'=>$broker_Gst,
            'broker_pan'=>$broker_Pan,
            'broker_tan'=>$broker_Tan,
            'email'=>$broker_Email,
            'pincode'=>$broker_Pincode,
            'created_date'=>date('Y-m-d H:i:s')
        );
       if($uid ==""){
          $res=$this->Webservice_general_model->insert('tbl_broker',$allData);
       }else{
          $setFilterData['broker_id_PK']=$uid;
          $res = $this->Webservice_general_model->update('tbl_broker',$setFilterData, $allData);
       }
        if($res)
        {
          $data["status"] = 1;
          echo json_encode($data);  
        }else{
          $data["status"] = 0;
          echo json_encode($data);
        }}else{
	      $data['message']=validation_errors();
	      $data["status"] = 0;
	      echo json_encode($data);
    }
}


}
 ?>