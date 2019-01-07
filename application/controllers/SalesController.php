<?php 

class SalesController extends CI_Controller
{
	public function __construct()
	{
	   parent::__construct();
       $this->load->model('Webservice_general_model');
       $this->load->library('form_validation');
	}

	public function index(){
		$data['currentPage']='salesMaster';
        $this->load->view('assests/header');
		$this->load->view('assests/sidebar',$data);
		$this->load->view('assests/mainContent',$data);
	    $this->load->view('sales/salesList',$data);
	    $this->load->view('assests/footer');

	}

		public function addSalesMaster(){
		$data['currentPage']='salesMaster';
		 $breadcrumb=array(
            'Dashboard'=> base_url().'dashboard',
            '/Add Sales Master'=> ""

          );
          $data['breadcrumbArray']=$breadcrumb;
          $data['title']="Add Sales Master";

          $data['currentPage']='master';

          $data['uid']='';


		$this->load->view('assests/header');
		$this->load->view('assests/sidebar',$data);
		$this->load->view('assests/mainContent',$data);
	    $this->load->view('sales/addSales_View',$data);
	    $this->load->view('assests/footer');
	}

public function salesMasterListwebAPI(){

    $start = $_GET['start'];
    $length = $_GET['length'];
    $search = $_GET['search']["value"];
    $where="";

    if($search !=""){
        // $where=" branch_name LIKE '%".$search."%'
        //   OR branch_address LIKE '%".$search."%'
        //    OR manager_email LIKE '%".$search."%' ";
    }

    $data = $this->db->query("SELECT ch.challan_id_PK as id,ch.challan_no,ch.bill_amount,a.name as partyName,b.broker_name,t.transport_name from tbl_challan as ch 
INNER JOIN tbl_account_master as a ON a.accountMaster_id_PK=ch.party_id_FK
INNER JOIN tbl_broker as b ON b.broker_id_PK=ch.broker_id_FK
INNER JOIN tbl_transport as t ON t.transport_id_PK=ch.transport_id_FK
         ");
         // WHERE ".$where." order by id Desc limit ".$start.",".$length."");

    $result = $data->result();
    foreach ($result as $key => $value) {
    $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
    }

    $data1['data'] = $result;
    $data1['recordsTotal'] = $data->num_rows();

    $data12 = $this->db->query("SELECT ch.challan_id_PK as id,ch.challan_no,ch.bill_amount,a.name as partyName,b.broker_name,t.transport_name from tbl_challan as ch 
INNER JOIN tbl_account_master as a ON a.accountMaster_id_PK=ch.party_id_FK
INNER JOIN tbl_broker as b ON b.broker_id_PK=ch.broker_id_FK
INNER JOIN tbl_transport as t ON t.transport_id_PK=ch.transport_id_FK");
    $result1 = $data12->result();
    $data1['recordsFiltered'] = $data12->num_rows();
    echo json_encode($data1);

}


public function insertSalesMaster(){
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
    $this->form_validation->set_rules('add_Sales_Firm_Bal_Id','','required', array('required'=>'Please Select Book'));
       
    $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
     
    if($this->form_validation->run()){      
        $allData=array(
        	  'book_id_FK'=>$add_Sales_Book_Code_Id,
            'firm_balance'=>$add_Sales_Firm_Bal_Id,
            'party_balance'=>$add_Sales_Party_Bal_Id,
            'bill_number'=>$add_Sales_Bill_No_Id,
            'bill_date'=>$add_Sales_Bill_Date_Id,
            'inventry_type'=>$add_Sales_Inv_Type_Id,
            'challan_number'=>$add_Sales_Chalan_No_Id,
            'party_code'=>$add_Sales_PartyCode_Id,
            'party_id_FK'=>$add_Sales_PartyName_Id,
            'cr_days'=>$add_Sales_Cr_Days_Id,
            'delivery'=>$add_Sales_Deli_Value_Id,
            'broker_id_FK'=>$add_Sales_Broker_Id,
            'vehicle_no'=>$add_Sales_Veh_No_Id,
            'lr_no'=>$add_Sales_L_R_No_Id,
            'lr_date'=>$add_Sales_L_R_Dt_Id,
            'transport_id_FK'=>$add_Sales_Transport_Id,
            'station'=>$add_Sales_Station_Id,
            'transport_id'=>$add_Sales_Trans_Id,
            'packing'=>$add_Sales_Packing_Id,
            'case_no'=>$add_Sales_Case_No_Id,
            'total_piece'=>$add_Sales_Tot_Pcs_Id,
            'meter'=>$add_Sales_Mtrs_Id,
            'cd_rs'=>$add_Sales_Cd_Rs_Id,
            'brk_rs'=>$add_Sales_Brk_Rs_Id,
            'basic_amount'=>$add_Sales_Basic_Amt_Id,
            'SGST'=>$add_Sales_Sgst_Sales_Id,
            'CGST'=>$add_Sales_Cgst_Sales_Id,
            'rate_consigen'=>$add_Sales_Consignee_Code_Id,
            'eway_bill_no'=>$add_Sales_Eway_Bill_Id,
            'other'=>$add_Sales_F9_Other_Id,
            'sales_desc'=>$add_Sales_Desc_Id,
            'tds_rate'=>$add_Sales_T_D_S_Rate_Value_Id,
            'rand_offf'=>$add_Sales_Rnd_Off_Code_Id,
            'bill_amount'=>$add_Sales_Bill_Amout_Id,
            'created_date'=>date('Y-m-d H:i:s')
        );
        if($uid ==""){
          $res=$this->Webservice_general_model->insert('tbl_salesMaster',$allData);
        }else{
          $setFilterData['sales_master_id_PK']=$uid;
          $res = $this->Webservice_general_model->update('tbl_salesMaster',$setFilterData, $allData);
        }


        for($i=0;$i<count($add_Sales_Piece_Id);$i++){
          $allsalesMasterDetailData=array(
               'sales_master_id_FK'=>$res,
               'quality_name_id_FK'=>$add_Sales_Quality_Name_Id[$i],
               'description'=>$add_Sales_Description_Id[$i],
               'piece'=>$add_Sales_Piece_Id[$i],
               'cut'=>$add_Sales_cut_One_Id[$i],
               'quantity'=>$add_Sales_Qty_Id[$i],
               'pm'=>$add_Sales_PM_Id[$i],
               'rate'=>$add_Sales_Rate_Id[$i],
               'discount_percentage'=>$add_Sales_Disc_Id[$i],
               'less_percentage'=>$add_Sales_Less_Id[$i],
               'amount'=>$add_Sales_Amount_Id[$i],
               'SGST'=>$add_Sales_Sgst_Id[$i],
               'CGST'=>$add_Sales_Cgst_Id[$i],
               'net_amount'=>$add_Sales_Net_Amt_Id[$i],
               'net_rate'=>$add_Sales_Net_Rate_Id[$i],
               'rs'=>$add_Sales_Rs_Id[$i],
               'created_date'=>date('Y-m-d H:i:s')
            );
        $this->Webservice_general_model->insert('tbl_salesMaster_detail',$allsalesMasterDetailData);
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