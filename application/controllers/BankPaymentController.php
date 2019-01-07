<?php 

class BankPaymentController extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('Webservice_general_model');
        $this->load->library('form_validation');
	}

public function index(){
		$data['currentPage']='bankPayment';
		$this->load->view('assests/header');
		$this->load->view('assests/sidebar',$data);
		$this->load->view('assests/mainContent',$data);
	    $this->load->view('bankPayment/bankPaymentList',$data);
	    $this->load->view('assests/footer');
}

public function addBankPayment(){
		$data['currentPage']='bankPayment';
		$breadcrumb=array(
        'Dashboard'=> base_url().'dashboard',
        '/Add Bank Payment'=> ""
        );
        $data['breadcrumbArray']=$breadcrumb;
        $data['title']="Add Bank Payment ";
        $data['uid']='';
		$this->load->view('assests/header');
		$this->load->view('assests/sidebar',$data);
		$this->load->view('assests/mainContent',$data);
	    $this->load->view('bankPayment/addbankPaymentView',$data);
	    $this->load->view('assests/footer');
	}

public function bankPaymentListwebAPI(){

    $start = $_GET['start'];
    $length = $_GET['length'];
    $search = $_GET['search']["value"];
    $where="";

    if($search !=""){
        // $where=" branch_name LIKE '%".$search."%'
        //   OR branch_address LIKE '%".$search."%'
        //    OR manager_email LIKE '%".$search."%' ";
    }

    $data = $this->db->query("SELECT bankPayment_id_PK as id,
        voucher_no
        FROM `tbl_bankpayment`as bankpayment
         ");
         // WHERE ".$where." order by id Desc limit ".$start.",".$length."");

    $result = $data->result();
    foreach ($result as $key => $value) {
    $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
    }

    $data1['data'] = $result;
    $data1['recordsTotal'] = $data->num_rows();

    $data12 = $this->db->query("SELECT bankPayment_id_PK as id,
        voucher_no
        FROM `tbl_bankpayment`as bankpayment");
    $result1 = $data12->result();
    $data1['recordsFiltered'] = $data12->num_rows();
    echo json_encode($data1);

}

public function insertBankPayment(){
	//print_r($_POST);die;
	extract($_POST);
    $uid=$this->input->post('uid');
    $data['uid']=$uid;

	// $workIssueMill_issue_book=$this->input->post('workIssueMill_issue_book');
	// $workIssueMill_balance=$this->input->post('workIssueMill_balance');
	// $workIssueMill_issue_number=$this->input->post('workIssueMill_issue_number');
	// $date=$this->input->post('workIssueMill_issue_date');
 //    $workIssueMill_issue_dates = str_replace('/', '-', $date);
 //    $workIssueMill_issue_date=date('Y-m-d',strtotime($workIssueMill_issue_dates)); 

	// $workIssueMill_issue_job_process=$this->input->post('workIssueMill_issue_job_process');
	// $workIssueMill_issue_code=$this->input->post('workIssueMill_issue_code');
	// $workIssueMill_issue_mill_party=$this->input->post('workIssueMill_issue_mill_party');
	// $workIssueMill_issue_mill_purchase_code=$this->input->post('workIssueMill_issue_mill_purchase_code');
	// $workIssueMill_issue_mill_purchase_party=$this->input->post('workIssueMill_issue_mill_purchase_party');
	// $workIssueMill_issue_mill_brocker=$this->input->post('workIssueMill_issue_mill_brocker');
	// $workIssueMill_issue_mill_purchsae_bill_number=$this->input->post('workIssueMill_issue_mill_purchsae_bill_number');
	// $date=$this->input->post('workIssueMill_issue_mill_purchase_bill_date');
 //    $workIssueMill_issue_mill_purchase_bill_dates = str_replace('/', '-', $date);
 //    $workIssueMill_issue_mill_purchase_bill_date=date('Y-m-d',strtotime($workIssueMill_issue_mill_purchase_bill_dates)); 

	// $workIssueMill_issue_mill_purchsae_lot_number=$this->input->post('workIssueMill_issue_mill_purchsae_lot_number');
	// $workIssueMill_issue_mill_purchase_check_number=$this->input->post('workIssueMill_issue_mill_purchase_check_number');
	// $workIssueMill_issue_mill_purchase_rate=$this->input->post('workIssueMill_issue_mill_purchase_rate');
	// $workIssueMill_issue_mill_quantity=$this->input->post('workIssueMill_issue_mill_quantity');
	
 //    $work_mill_takaNumber=$this->input->post('work_mill_takaNumber');
 //    $work_mill_meter=$this->input->post('work_mill_meter');
 //    $work_mill_remark=$this->input->post('work_mill_remark');
    
 //    $workIssueMill_issue_mill_desc=$this->input->post('workIssueMill_issue_mill_desc');
 //    $workIssueMill_issue_mill_Total_meter=$this->input->post('workIssueMill_issue_mill_Total_meter');
 //    $workIssueMill_issue_mill_total_taka=$this->input->post('workIssueMill_issue_mill_total_taka');
    
 //    $workIssueMill_issue_mill_lr_number=$this->input->post('workIssueMill_issue_mill_lr_number');
 //    $workIssueMill_issue_mill_tempo_number=$this->input->post('workIssueMill_issue_mill_tempo_number');
 //    $workIssueMill_issue_mill_transport=$this->input->post('workIssueMill_issue_mill_transport');
 //    $workIssueMill_issue_mill_bill_amount=$this->input->post('workIssueMill_issue_mill_bill_amount');
 //    // $this->form_validation->set_rules('iteamMaster_Item_Name','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter Item Name",'regex_match' => 'Please Enter character and space in Item Name'));  
    // $this->form_validation->set_rules('iteamMaster_Group','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter Item Group Name",'regex_match' => 'Please Enter character and space in Item Group Name'));  
    
    // $this->form_validation->set_rules('iteamMaster_Item_Code','','regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in Item Code'));
    // $this->form_validation->set_rules('iteamMaster_Box','','regex_match[/^[0-9A-Za-z]+$/]', array('regex_match' => 'Please Enter  number and alphabates in Box Pack'));

    // $this->form_validation->set_rules('iteamMaster_Stock','','required',array('required'=>"Please Select Stock Type"));
    // $this->form_validation->set_rules('iteamMaster_Hsn_desc','','required',array('required'=>"Please Select IteamMaster Hsn Desc"));
    // $this->form_validation->set_rules('iteamMaster_active','','required',array('required'=>"Please Select IteamMaster Active"));
    // $this->form_validation->set_rules('iteamMaster_calculate_number','','required',array('required'=>"Please Select IteamMaster Calculate Number"));
    // $this->form_validation->set_rules('iteamMaster_gst_calculate','','required',array('required'=>"Please Select IteamMaster Gst Calculate"));
    // $this->form_validation->set_rules('iteamMaster_stock_report','','required',array('required'=>"Please Select Stick Report"));
    
    // $this->form_validation->set_rules('iteamMaster_Unit','','regex_match[/^[0-9]+$/]', array('regex_match'=>'Please Enter Unit Of Measure'));
    // $this->form_validation->set_rules('iteamMaster_Hsn','','regex_match[/^[0-9]+$/]', array('regex_match'=>'Please Enter HSN Number'));
    // $this->form_validation->set_rules('iteamMaster_Dealer','','regex_match[/^[0-9]+$/]', array('required'=>"Please Enter Item Cut", 'regex_match'=>'Please Enter Dealer Rate'));
    // $this->form_validation->set_rules('iteamMaster_stock_quantity','','regex_match[/^[0-9]+$/]', array('required'=>"Please Enter IteamMaster Stock Quantity", 'regex_match'=>'Please Enter Only Number IteamMaster Stock Quantity'));
    // $this->form_validation->set_rules('iteamMaster_open_stock_number','','regex_match[/^[0-9]+$/]', array('required'=>"Please Enter IteamMaster Open Stock Number", 'regex_match'=>'Please Enter Only Number IteamMaster Open Stock Number'));
    
    // $this->form_validation->set_rules('iteamMaster_Cut','','required|regex_match[/^[0-9]+$/]', array('regex_match'=>'Please Enter Item Cut'));
    // $this->form_validation->set_rules('iteamMaster_mrp','','required|regex_match[/^[0-9]+$/]', array('regex_match'=>'Please Enter Mrp'));
    // $this->form_validation->set_rules('iteamMaster_sgst','','required|regex_match[/^[0-9]+$/]', array('regex_match'=>'Please Enter SGST'));
    // $this->form_validation->set_rules('iteamMaster_cgst','','required|regex_match[/^[0-9]+$/]', array('regex_match'=>'Please Enter CGST'));
    $this->form_validation->set_rules('bank_Payment_Book_Id','','required', array('required'=>'Please Select Book'));
       
    $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
     
    if($this->form_validation->run()){      
        $allData=array(
        	'voucher_no'=>$bank_Payment_Voucher_No_Id,
            'date'=>$bank_Payment_Date_Id,
            'created_date'=>date('Y-m-d H:i:s')
        );
        if($uid ==""){
          $res=$this->Webservice_general_model->insert('tbl_bankpayment',$allData);
        }else{
          $setFilterData['bankPayment_id_PK']=$uid;
          $res = $this->Webservice_general_model->update('tbl_bankpayment',$setFilterData, $allData);
        }


        for($i=0;$i<count($bank_Payment_Party_Balance_Id);$i++){
          $allBankPaymentDetailData=array(
               'bankPayment_id_FK'=>$res,
               'party_balance'=>$bank_Payment_Party_Balance_Id[$i],
               'party_id_FK'=>$bank_Payment_Party_Value_Id[$i],
               'amount'=>$bank_Payment_Amount_Id[$i],
               'cheque_no'=>$bank_Payment_Cheque_No_Id[$i],
               'narration'=>$bank_Payment_Narration_Id[$i],
               'balance'=>$bank_Payment_Bal_Id[$i],
               'bank'=>$bank_Payment_Bank_Id[$i],
               'bank_balance'=>$bank_Payment_Balance_Id[$i],
               'book_id_FK'=>$bank_Payment_Book_Id[$i],
               'narration2'=>$bank_Payment_Narration_Two_Id[$i],
               'created_date'=>date('Y-m-d H:i:s')
            );
        $this->Webservice_general_model->insert('tbl_bankpaymentdetail',$allBankPaymentDetailData);
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