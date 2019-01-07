<?php 
class WorkReceiveMillController extends CI_Controller{
public function __construct(){
	parent::__construct();
	$this->load->model('Webservice_general_model');
    $this->load->library('form_validation');
}

public function index(){
    //$data['subCurrentPage']='workMill';
	$data['currentPage']='receiveMill';
    $this->load->view('assests/header'); 
    $this->load->view('assests/sidebar',$data);
    $this->load->view('assests/mainContent');
    $this->load->view('workReceiveMill/workReceiveMillList');
}

public function workReceiveMillListwebAPI(){

    $start = $_GET['start'];
    $length = $_GET['length'];
    $search = $_GET['search']["value"];
    $where="";

    if($search !=""){
        // $where=" branch_name LIKE '%".$search."%'
        //   OR branch_address LIKE '%".$search."%'
        //    OR manager_email LIKE '%".$search."%' ";
    }

    $data = $this->db->query("SELECT issue_mill.work_receive_mill_id_PK as id, m.name as millPartyName,b.broker_name,t.transport_name,issue_mill.gross_amount,issue_mill.created_date FROM tbl_work_receive_mill as issue_mill
       INNER JOIN tbl_account_master as m on m.accountMaster_id_PK=issue_mill.mill_party_id_FK
       INNER JOIN tbl_broker as b on b.broker_id_PK=issue_mill.broker_id_FK
       INNER JOIN tbl_transport as t on t.transport_id_PK=issue_mill.transport_id_FK
         ");
         // WHERE ".$where." order by id Desc limit ".$start.",".$length."");

    $result = $data->result();
    foreach ($result as $key => $value) {
    $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
    }

    $data1['data'] = $result;
    $data1['recordsTotal'] = $data->num_rows();

    $data12 = $this->db->query("SELECT issue_mill.work_receive_mill_id_PK as id, m.name as millPartyName,b.broker_name,t.transport_name,issue_mill.gross_amount,issue_mill.created_date FROM tbl_work_receive_mill as issue_mill
       INNER JOIN tbl_account_master as m on m.accountMaster_id_PK=issue_mill.mill_party_id_FK
       INNER JOIN tbl_broker as b on b.broker_id_PK=issue_mill.broker_id_FK
       INNER JOIN tbl_transport as t on t.transport_id_PK=issue_mill.transport_id_FK");
    $result1 = $data12->result();
    $data1['recordsFiltered'] = $data12->num_rows();
    echo json_encode($data1);

}

public function addWorkReceiveMill(){
	$data['currentPage']='receiveMill';
	$breadcrumb=array(
	    'Dashboard'=> base_url().'dashboard',
	    '/Add Work Issue Receive Mill'=> ""
	);
	$data['breadcrumbArray']=$breadcrumb;
	$data['title']="Add Work Issue Receive Mill";

	$data['uid']='';
	$this->load->view('assests/header');
	$this->load->view('assests/sidebar',$data);
	$this->load->view('assests/mainContent');
    $this->load->view('workReceiveMill/addWorkReceiveMillView',$data);
	}

public function insertWorkReceiveMill(){
   extract($_POST);

    $uid=$this->input->post('uid');
    $data['uid']=$uid;

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

   $this->form_validation->set_rules('workReceiveMill_issue_book','','required|regex_match[/^[0-9]+$/]', array('regex_match'=>'Please Select Book'));
       
    $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
     
    if($this->form_validation->run()){      
        $allData=array(
        	'book_id_FK'=>$workReceiveMill_issue_book,
            'balance'=>$workReceiveMill_balance,
            'receive_challan_no'=>$workReceiveMill_ReceiveChallan,
            'gp_bill_no'=>$workReceiveMill_gp_bill,
            'challan_no'=>$workReceiveMill_chalan_number,
            'mill_party_code'=>$workReceiveMill_party_code,
            'mill_party_id_FK'=>$workReceiveMill_party_name, 
            'receive_date'=>$workReceiveMill_receive_date, 
            'broker_id_FK'=>$workReceiveMill_boker, 
            'cr_days'=>$workReceiveMill_cr_days, 
            'lr_no'=>$workReceiveMill_lr_no_,
            'tempo_no'=>$workReceiveMill_tempo_no,
            'transport_id_FK'=>$workReceiveMill_transport,
            'our_check_no'=>$workReceiveMill_our_ch_no,
            'lot_no'=>$workReceiveMill_our_lot_no,
            'issue_quality'=>$workReceiveMill_our_issue_quality,
            'finish_quality'=>$workReceiveMill_our_finish_quality,
            'rate'=>$workReceiveMill_our_rate,
            'receive_desc'=>$workReceiveMill_desc,
            'gross_amount'=>$workReceiveMill_gross_amount,
            'percentage_code'=>$workReceiveMill_desc_percentage_code,
            'percentage_desc'=>$workReceiveMill_desc_percentage,
            'created_date'=>date('Y-m-d H:i:s')
        );
         //print_r($allData);die;
        if($uid ==""){
          $res=$this->Webservice_general_model->insert('tbl_work_receive_mill',$allData);
        }else{
          $setFilterData['work_receive_mill_id_PK']=$uid;
          $res = $this->Webservice_general_model->update('tbl_work_receive_mill',$setFilterData, $allData);
        }


        for($i=0;$i<count($workReceiveMill_taka_no);$i++){
          $allWorkMillReceiveDetailData=array(
               'work_receive_mill_id_FK'=>$res,
               'taka_number'=>$workReceiveMill_taka_no[$i],
               'grey_meter'=>$workReceiveMill_grey_meter[$i],
               'finish_meter'=>$workReceiveMill_finish_meter[$i],
               'short_long'=>$workReceiveMill_short_long[$i],
               'percentage'=>$workReceiveMill_percentage[$i],
               'finish'=>$workReceiveMill_finish[$i],
               'amount'=>$workReceiveMill_amount[$i],
               'created_date'=>date('Y-m-d H:i:s')
            );
        $this->Webservice_general_model->insert('tbl_work_receive_mill_detail',$allWorkMillReceiveDetailData);
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