<?php 

class AccountMasterController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('AccountTypeModel');
        $this->load->model('Webservice_general_model');
        $this->load->library('form_validation');
    }

public function index(){
	$data['currentPage']='AccountType';
	$this->load->view('accountType/accountMasterList',$data);
}

public function accountMasterListwebAPI(){

        $start = $_GET['start'];
        $length = $_GET['length'];
        $search = $_GET['search']["value"];
        $where="";

        if($search !=""){
            // $where=" branch_name LIKE '%".$search."%'
            //   OR branch_address LIKE '%".$search."%'
            //    OR manager_email LIKE '%".$search."%' ";
        }

         $data = $this->db->query("SELECT account.accountMaster_id_PK as id, account.name as account_master_name,b.broker_name,account.account_type,account.address1,account.areaName,account.contactNumber,account.contactPerson,account.partyGroup
             FROM tbl_account_master as account
             INNER JOIN tbl_broker as b ON b.broker_id_PK=account.broker_id_FK
             ");
             // WHERE ".$where." order by id Desc limit ".$start.",".$length."");

        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT account.accountMaster_id_PK as id, account.name as account_master_name,b.broker_name,account.account_type,account.address1,account.areaName,account.contactNumber,account.contactPerson,account.partyGroup
       FROM tbl_account_master as account
        INNER JOIN tbl_broker as b ON b.broker_id_PK=account.broker_id_FK");
        $result1 = $data12->result();
        $data1['recordsFiltered'] = $data12->num_rows();

        echo json_encode($data1);

}

	
public function insertAccountMaster()
{
    $data['currentPage']='AccountType';
    
	$accountmaster_list=$this->AccountTypeModel->get_account();
	$data['accountmaster_list']=$accountmaster_list;

		 $breadcrumb=array(
            'Dashboard'=> base_url().'dashboard',
            '/Add Account Master'=> ""

          );
          $data['breadcrumbArray']=$breadcrumb;
          $data['title']="Add Account Master";

          $data['currentPage']='master';

          $data['uid']='';


		$this->load->view('assests/header');
		$this->load->view('assests/sidebar',$data);
		$this->load->view('assests/mainContent');
	    $this->load->view('accountType/addAccountMaster',$data);
}

public function addAccountMaster(){
    $uid=$this->input->post('uid');
    $data['uid']=$uid;
	$add_AccountMaster_name=$this->input->post('add_AccountMaster_name');
	$add_AccountMaster_Id=$this->input->post('add_AccountMaster_Id');
	$add_AccountMaster_Address1=$this->input->post('add_AccountMaster_Address1');
	$add_AccountMaster_Address2=$this->input->post('add_AccountMaster_Address2');
	$add_AccountMaster_Address3=$this->input->post('add_AccountMaster_Address3');
	$add_AccountMaster_State_Id=$this->input->post('add_AccountMaster_State_Id');
	$add_AccountMaster_City_Id=$this->input->post('add_AccountMaster_City_Id');
	$add_AccountMaster_pincode=$this->input->post('add_AccountMaster_pincode');
	$add_AccountMaster_KiloMeter=$this->input->post('add_AccountMaster_KiloMeter');
	$add_AccountMaster_PhoneMobile=$this->input->post('add_AccountMaster_PhoneMobile');
	$add_AccountMaster_area_name=$this->input->post('add_AccountMaster_area_name');
	$add_AccountMaster_Rate_With_Gst=$this->input->post('add_AccountMaster_Rate_With_Gst');
	$add_AccountMaster_Contactperson=$this->input->post('add_AccountMaster_Contactperson');
	$add_AccountMaster_partyGroup=$this->input->post('add_AccountMaster_partyGroup');
	$add_AccountMaster_Broker=$this->input->post('add_AccountMaster_Broker');
	$add_AccountMaster_Email=$this->input->post('add_AccountMaster_Email');
	$add_AccountMaster_Igst=$this->input->post('add_AccountMaster_Igst');
	$add_AccountMaster_Crdays=$this->input->post('add_AccountMaster_Crdays');
	$add_AccountMaster_Crlimit=$this->input->post('add_AccountMaster_Crlimit');
	$add_AccountMaster_Intrate=$this->input->post('add_AccountMaster_Intrate');
	$add_AccountMaster_Disc=$this->input->post('add_AccountMaster_Disc');
	$add_AccountMaster_Tds=$this->input->post('add_AccountMaster_Tds');
	$add_AccountMaster_Gstno=$this->input->post('add_AccountMaster_Gstno');
	$add_AccountMaster_Panno=$this->input->post('add_AccountMaster_Panno');
	$add_AccountMaster_Transportno=$this->input->post('add_AccountMaster_Transportno');
	$add_AccountMaster_Transport_Id=$this->input->post('add_AccountMaster_Transport_Id');
	$add_AccountMaster_Taxable_Amt=$this->input->post('add_AccountMaster_Taxable_Amt');
	$add_AccountMaster_Composit_Tax=$this->input->post('add_AccountMaster_Composit_Tax');
	$add_AccountMaster_Rev_Ch=$this->input->post('add_AccountMaster_Rev_Ch');
	$add_account_master_remark=$this->input->post('add_account_master_remark');
    

    $this->form_validation->set_rules('add_AccountMaster_name','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter Account Type Name",'regex_match' => 'Please Enter character and space in Account Type Name'));  
    //$this->form_validation->set_rules('add_AccountMaster_area_name','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter Area Name",'regex_match' => 'Please Enter character and space in Area Name'));  
    $this->form_validation->set_rules('add_AccountMaster_Contactperson','','trim|regex_match[/^[a-zA-Z ]+$/]',array('regex_match' => 'Please Enter character and space in Contact Name'));  
    $this->form_validation->set_rules('add_AccountMaster_partyGroup','','trim|regex_match[/^[a-zA-Z ]+$/]',array('regex_match' => 'Please Enter character and space in Pary Group Name'));  
    //$this->form_validation->set_rules('add_AccountMaster_Broker','','trim|regex_match[/^[a-zA-Z ]+$/]',array('regex_match' => 'Please Enter character and space in Broker Name'));  
        
    //$this->form_validation->set_rules('add_AccountMaster_Rate_With_Gst','','regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter Only number in Rate With Gst'));

    
    // $this->form_validation->set_rules('add_AccountMaster_Email','','trim|valid_email|regex_match[/^[a-zA-Z@.0-9_]+$/]',array('regex_match' => 'Please Enter only character and space underscore @ numbers and comma in Manager Email','valid_email'=>'Please Enter Valid Email'));
    
    $this->form_validation->set_rules('add_AccountMaster_PhoneMobile','','min_length[10]|regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in contact number','min_length'=>'Please Enter minimum 10 digit  in contact number'));
    $this->form_validation->set_rules('add_AccountMaster_Crdays','','regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in CR Days'));
    $this->form_validation->set_rules('add_AccountMaster_Crlimit','','regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in CR Limit'));
    $this->form_validation->set_rules('add_AccountMaster_Intrate','','regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in Interest rate'));
    $this->form_validation->set_rules('add_AccountMaster_Disc','','regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in Discount percentage'));
    //$this->form_validation->set_rules('add_AccountMaster_Tds','','regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in TDS percentage'));
    $this->form_validation->set_rules('add_AccountMaster_Gstno','','min_length[15]|max_length[15]|regex_match[/^[0-9A-Za-z]+$/]', array('regex_match' => 'Please Enter  number and alphabates in GST Number','min_length'=>'Please Enter 15 Digits in GST','max_length'=>'Please Enter 15 Digits in GST'));
    $this->form_validation->set_rules('add_AccountMaster_Panno','','min_length[10]|max_length[10]|regex_match[/^[0-9A-Za-z]+$/]', array('regex_match' => 'Please Enter  number and alphabates in PAN Number','min_length'=>'Please Enter 10 Digits in PAN','max_length'=>'Please Enter 10 Digits in PAN'));
    $this->form_validation->set_rules('add_AccountMaster_Transportno','','regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in Transport Number'));
    $this->form_validation->set_rules('add_AccountMaster_Transport_Id','','regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in Transport ID'));
    $this->form_validation->set_rules('add_AccountMaster_Taxable_Amt','','regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in Taxable Amount'));
    $this->form_validation->set_rules('add_AccountMaster_Composit_Tax','','regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in Composit Tax'));
    
    $this->form_validation->set_rules('add_AccountMaster_Id','','required',array('required'=>"Please Select Account Type"));
    $this->form_validation->set_rules('add_AccountMaster_State_Id','','required',array('required'=>"Please Select state"));
    $this->form_validation->set_rules('add_AccountMaster_City_Id','','required',array('required'=>"Please Select city"));
    
    $this->form_validation->set_rules('add_AccountMaster_Address1','','required',array('required'=>"Please Enter Account Type Address1"));
    $this->form_validation->set_rules('add_AccountMaster_Address2','','required',array('required'=>"Please Enter Account Type Address2"));
    $this->form_validation->set_rules('add_AccountMaster_Address3','','required',array('required'=>"Please Enter Account Type Address3"));
    
    $this->form_validation->set_rules('add_AccountMaster_pincode','','min_length[6]|max_length[6]|regex_match[/^[0-9]+$/]', array('max_length'=>'Please Enter 6 digit only in pincode', 'regex_match' => 'Please Enter only number in pincode','min_length'=>'Please Enter minimum 6 number in pincode'));
    $this->form_validation->set_rules('add_AccountMaster_KiloMeter','','regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter only number in pincode'));
   
    $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
     
    if($this->form_validation->run()){      
        $allData=array(
            'name'=>$add_AccountMaster_name,
            'account_type'=>$add_AccountMaster_Id,
            'address1'=>$add_AccountMaster_Address1,
            'address2'=>$add_AccountMaster_Address2,
            'address3'=>$add_AccountMaster_Address3,
            'state_id_FK'=>$add_AccountMaster_State_Id,
            'city_id_FK'=>$add_AccountMaster_City_Id,
            'pincode'=>$add_AccountMaster_pincode,
            'kilometer'=>$add_AccountMaster_KiloMeter,
            'contactNumber'=>$add_AccountMaster_PhoneMobile,
            'areaName'=>$add_AccountMaster_area_name,
            'contactPerson'=>$add_AccountMaster_Contactperson,
            'partyGroup'=>$add_AccountMaster_partyGroup,
            'broker_id_FK'=>$add_AccountMaster_Broker,
            'email'=>$add_AccountMaster_Email,
            'igst_party'=>$add_AccountMaster_Igst,
            'cr_day'=>$add_AccountMaster_Crdays,
            'cr_limit'=>$add_AccountMaster_Crlimit,
            'interest_rate'=>$add_AccountMaster_Intrate,
            'discount'=>$add_AccountMaster_Disc,
            'tds_percentage'=>$add_AccountMaster_Tds,
            'gst_number'=>$add_AccountMaster_Gstno,
            'pan_number'=>$add_AccountMaster_Panno,
            'transport_number'=>$add_AccountMaster_Transportno,
            'transport_id'=>$add_AccountMaster_Transport_Id,
            'taxableAmount'=>$add_AccountMaster_Taxable_Amt,
            'compisite_tax_party'=>$add_AccountMaster_Composit_Tax,
            'receive_check_party'=>$add_AccountMaster_Rev_Ch,
            'remark'=>$add_account_master_remark,
            'rateGst'=>$add_AccountMaster_Rate_With_Gst
        );
       if($uid ==""){
          $res=$this->Webservice_general_model->insert('tbl_account_master',$allData);
       }else{
          $setFilterData['accountMaster_id_PK']=$uid;
          $res = $this->Webservice_general_model->update('tbl_account_master',$setFilterData, $allData);
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


public function get_update_AccountMaster_list(){
    $uid = $this->uri->segment(3);
    $uid=base64_decode($uid);
    $data['uid']=$uid;

    $breadcrumb=array(
        'Dashboard'=> base_url().'dashboard',
        '/Account Master list'=> base_url()."AccountMasterController",
        '/Update Account Master'=> ""
    );

    $data['breadcrumbArray']=$breadcrumb;
    $data['title']="Update Account Master";
    $data['currentPage']='master';

    $this->load->view('assests/header');
    $this->load->view('assests/sidebar',$data);
    $this->load->view('assests/mainContent');
    $this->load->view('accountType/addAccountMaster',$data);
}

public function GetUpdateAccountMasterDetail(){
    $uid = $this->input->post('uid');
    $setFilterData['accountMaster_id_PK']=$uid;
    $accountMasterList=$this->Webservice_general_model->getData('tbl_account_master',$setFilterData);
    $data['accountMasterList']=$accountMasterList;
    $data['uid']=$uid;
    echo json_encode($data);
  
}


}
 ?>