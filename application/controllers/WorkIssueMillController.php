<?php 
class WorkIssueMillController extends CI_Controller{
public function __construct(){
	parent::__construct();
    $this->load->model('Webservice_general_model');
	$this->load->model('WorkIssueMill_model');
    $this->load->library('form_validation');
}

public function index(){
    //$data['subCurrentPage']='workMill';
	$data['currentPage']='millIssue';
    $this->load->view('assests/header'); 
    $this->load->view('assests/sidebar',$data);
    $this->load->view('assests/mainContent');
    $this->load->view('workIssueMill/workMillList');
}

public function workIssueMillListwebAPI(){

    $start = $_GET['start'];
    $length = $_GET['length'];
    $search = $_GET['search']["value"];
    $where="";

    if($search !=""){
        // $where=" branch_name LIKE '%".$search."%'
        //   OR branch_address LIKE '%".$search."%'
        //    OR manager_email LIKE '%".$search."%' ";
    }

    $data = $this->db->query("SELECT issue_mill.total_meter as TakaNumber, issue_mill.work_issue_mill_id_PK as id, m.name as millPartyName,am.name as purchasePartyName,b.broker_name,issue_mill.created_date FROM tbl_work_issue_mill as issue_mill
     INNER JOIN tbl_account_master as m on m.accountMaster_id_PK=issue_mill.purchase_party_id_FK
      INNER JOIN tbl_account_master as am on am.accountMaster_id_PK=issue_mill.mill_party_id_FK
       INNER JOIN tbl_broker as b on b.broker_id_PK=issue_mill.broker_id_FK
       
         ");
         // WHERE ".$where." order by id Desc limit ".$start.",".$length."");

    $result = $data->result();
    foreach ($result as $key => $value) {
    $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
    }

    $data1['data'] = $result;
    $data1['recordsTotal'] = $data->num_rows();

    $data12 = $this->db->query("SELECT issue_mill.work_issue_mill_id_PK as id, issue_mill.total_meter as TakaNumber, m.name as millPartyName,am.name as purchasePartyName,b.broker_name,issue_mill.created_date FROM tbl_work_issue_mill as issue_mill
     INNER JOIN tbl_account_master as m on m.accountMaster_id_PK=issue_mill.purchase_party_id_FK
      INNER JOIN tbl_account_master as am on am.accountMaster_id_PK=issue_mill.mill_party_id_FK
       INNER JOIN tbl_broker as b on b.broker_id_PK=issue_mill.broker_id_FK
       ");
    $result1 = $data12->result();
    $data1['recordsFiltered'] = $data12->num_rows();
    echo json_encode($data1);



}



public function addWorkMill(){
	$data['currentPage']='millIssue';
	$breadcrumb=array(
	    'Dashboard'=> base_url().'dashboard',
	    '/Add work Issue Mill'=> ""
	);
	$data['breadcrumbArray']=$breadcrumb;
	$data['title']="Add work Issue Mill";

	$data['uid']='';
	$this->load->view('assests/header');
	$this->load->view('assests/sidebar',$data);
	$this->load->view('assests/mainContent');
	$this->load->view('workIssueMill/addWorkIssueMillView',$data);
	}

public function insertWorkMill(){
    //print_r($_POST);die;
    $uid=$this->input->post('uid');
    $data['uid']=$uid;

	$workIssueMill_issue_book=$this->input->post('workIssueMill_issue_book');
	$workIssueMill_balance=$this->input->post('workIssueMill_balance');
	$workIssueMill_issue_number=$this->input->post('workIssueMill_issue_number');
	$date=$this->input->post('workIssueMill_issue_date');
    $workIssueMill_issue_dates = str_replace('/', '-', $date);
    $workIssueMill_issue_date=date('Y-m-d',strtotime($workIssueMill_issue_dates)); 

	$workIssueMill_issue_job_process=$this->input->post('workIssueMill_issue_job_process');
	$workIssueMill_issue_code=$this->input->post('workIssueMill_issue_code');
	$workIssueMill_issue_mill_party=$this->input->post('workIssueMill_issue_mill_party');
	$workIssueMill_issue_mill_purchase_code=$this->input->post('workIssueMill_issue_mill_purchase_code');
	$workIssueMill_issue_mill_purchase_party=$this->input->post('workIssueMill_issue_mill_purchase_party');
	$workIssueMill_issue_mill_broker=$this->input->post('workIssueMill_issue_mill_broker');
	$workIssueMill_issue_mill_purchsae_bill_number=$this->input->post('workIssueMill_issue_mill_purchsae_bill_number');
	$date=$this->input->post('workIssueMill_issue_mill_purchase_bill_date');
    $workIssueMill_issue_mill_purchase_bill_dates = str_replace('/', '-', $date);
    $workIssueMill_issue_mill_purchase_bill_date=date('Y-m-d',strtotime($workIssueMill_issue_mill_purchase_bill_dates)); 

	$workIssueMill_issue_mill_purchsae_lot_number=$this->input->post('workIssueMill_issue_mill_purchsae_lot_number');
	$workIssueMill_issue_mill_purchase_check_number=$this->input->post('workIssueMill_issue_mill_purchase_check_number');
	$workIssueMill_issue_mill_purchase_rate=$this->input->post('workIssueMill_issue_mill_purchase_rate');
	$workIssueMill_issue_mill_quantity=$this->input->post('workIssueMill_issue_mill_quantity');
	
    $work_mill_takaNumber=$this->input->post('work_mill_takaNumber');
    $work_mill_meter=$this->input->post('work_mill_meter');
    $work_mill_remark=$this->input->post('work_mill_remark');
    
    $workIssueMill_issue_mill_desc=$this->input->post('workIssueMill_issue_mill_desc');
    $workIssueMill_issue_mill_Total_meter=$this->input->post('workIssueMill_issue_mill_Total_meter');
    $workIssueMill_issue_mill_total_taka=$this->input->post('workIssueMill_issue_mill_total_taka');
    
    $workIssueMill_issue_mill_lr_number=$this->input->post('workIssueMill_issue_mill_lr_number');
    $workIssueMill_issue_mill_tempo_number=$this->input->post('workIssueMill_issue_mill_tempo_number');
    $workIssueMill_issue_mill_transport=$this->input->post('workIssueMill_issue_mill_transport');
    $workIssueMill_issue_mill_bill_amount=$this->input->post('workIssueMill_issue_mill_bill_amount');
    // $this->form_validation->set_rules('iteamMaster_Item_Name','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter Item Name",'regex_match' => 'Please Enter character and space in Item Name'));  
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
    $this->form_validation->set_rules('workIssueMill_issue_book','','required|regex_match[/^[0-9]+$/]', array('regex_match'=>'Please Select Book'));
       
    $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
     
    if($this->form_validation->run()){      
        $allData=array(
        	'book_id_FK'=>$workIssueMill_issue_book,
            'balance'=>$workIssueMill_balance,
            'issue_number'=>$workIssueMill_issue_number,
            'issue_date'=>$workIssueMill_issue_date,
            'job_process_id_FK'=>$workIssueMill_issue_job_process,
            'mill_party_code'=>$workIssueMill_issue_code,
            'mill_party_id_FK'=>$workIssueMill_issue_mill_party,
            'purchase_party_code'=>$workIssueMill_issue_mill_purchase_code,
            'purchase_party_id_FK'=>$workIssueMill_issue_mill_purchase_party,
            'broker_id_FK'=>$workIssueMill_issue_mill_broker,
            'purchase_bill_number'=>$workIssueMill_issue_mill_purchsae_bill_number,
            'purchase_bill_date'=>$workIssueMill_issue_mill_purchase_bill_date,
            'lot_number'=>$workIssueMill_issue_mill_purchsae_lot_number,
            'party_check_number'=>$workIssueMill_issue_mill_purchase_check_number,
            'rate'=>$workIssueMill_issue_mill_purchase_rate,
            'quantity'=>$workIssueMill_issue_mill_quantity,
            'mill_desc'=>$workIssueMill_issue_mill_desc,
            'total_meter'=>$workIssueMill_issue_mill_Total_meter,
            'total_taka'=>$workIssueMill_issue_mill_total_taka,
            'lr_number'=>$workIssueMill_issue_mill_lr_number,
            'tempo_number'=>$workIssueMill_issue_mill_tempo_number,
            'mill_transport'=>$workIssueMill_issue_mill_transport,
            'mill_bill_amount'=>$workIssueMill_issue_mill_bill_amount,
            'created_date'=>date('Y-m-d H:i:s')
        );
        if($uid ==""){
          $res=$this->Webservice_general_model->insert('tbl_work_issue_mill',$allData);
        }else{
          $setFilterData['work_issue_mill_id_PK']=$uid;
          $res = $this->Webservice_general_model->update('tbl_work_issue_mill',$setFilterData, $allData);
        }


        for($i=0;$i<count($work_mill_takaNumber);$i++){
          $allWorkMillDetailData=array(
               'work_issue_mill_id_FK'=>$res,
               'taka_number'=>$work_mill_takaNumber[$i],
               'meters'=>$work_mill_meter[$i],
               'remark'=>$work_mill_remark[$i],
               'created_date'=>date('Y-m-d H:i:s')
            );
        $this->Webservice_general_model->insert('tbl_work_issue_mill_detail',$allWorkMillDetailData);
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