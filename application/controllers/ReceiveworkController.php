<?php 

class ReceiveworkController extends CI_Controller
{
	
public function __construct(){
    parent::__construct();
    $this->load->model('Webservice_general_model');
    $this->load->library('form_validation');
}

public function index(){
	$data['currentPage']='receiveWorkMaster';
    $this->load->view('assests/header');
	$this->load->view('assests/sidebar',$data);
	$this->load->view('assests/mainContent',$data);
    $this->load->view('receiveWork/receiveWorkList',$data);
    $this->load->view('assests/footer');
}

public function addReceiveWorkMastertype(){
    $data['currentPage']='receiveWorkMaster';
    $breadcrumb=array(
	    'Dashboard'=> base_url().'dashboard',
	    '/Add Receive Work  Master'=> ""
    );
    $data['breadcrumbArray']=$breadcrumb;
    $data['title']="Add Receive Work Master";
    $data['currentPage']='master';
    $data['uid']='';
	$this->load->view('assests/header');
	$this->load->view('assests/sidebar',$data);
	$this->load->view('assests/mainContent',$data);
    $this->load->view('receiveWork/addReceive_Work_View',$data);
    $this->load->view('assests/footer');
}

public function receiveWorkMasterListwebAPI(){

    $start = $_GET['start'];
    $length = $_GET['length'];
    $search = $_GET['search']["value"];
    $where="";

    if($search !=""){
        // $where=" branch_name LIKE '%".$search."%'
        //   OR branch_address LIKE '%".$search."%'
        //    OR manager_email LIKE '%".$search."%' ";
    }

    $data = $this->db->query("SELECT master.work_receive_master_id_PK as id, m.name as millPartyName,b.broker_name,t.transport_name,master.bill_amount, master.created_date FROM tbl_receiveworkmaster as master 
        INNER JOIN tbl_account_master as m on m.accountMaster_id_PK=master.party_id_FK 
        INNER JOIN tbl_broker as b on b.broker_id_PK=master.broker_id_FK 
        INNER JOIN tbl_transport as t on t.transport_id_PK=master.transport_id_FK
         ");
         // WHERE ".$where." order by id Desc limit ".$start.",".$length."");

    $result = $data->result();
    foreach ($result as $key => $value) {
    $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
    }

    $data1['data'] = $result;
    $data1['recordsTotal'] = $data->num_rows();

    $data12 = $this->db->query("SELECT master.work_receive_master_id_PK as id, m.name as millPartyName,b.broker_name,t.transport_name,master.bill_amount, master.created_date FROM tbl_receiveworkmaster as master 
        INNER JOIN tbl_account_master as m on m.accountMaster_id_PK=master.party_id_FK 
        INNER JOIN tbl_broker as b on b.broker_id_PK=master.broker_id_FK 
        INNER JOIN tbl_transport as t on t.transport_id_PK=master.transport_id_FK");
    $result1 = $data12->result();
    $data1['recordsFiltered'] = $data12->num_rows();
    echo json_encode($data1);

}

public function insertWorkReceiveMaster(){
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
    $this->form_validation->set_rules('receive_Work_Book_Code_Id','','required', array('required'=>'Please Select Book'));
       
    $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
     
    if($this->form_validation->run()){      
        $allData=array(
        	'book_id_FK'=>$receive_Work_Book_Code_Id,
            'balance'=>$add_Receive_Work_Bal_Id,
            'receive_challanNo'=>$add_Receive_Work_Receive_Challan_No_Id,
            'gp_bill_no'=>$add_Receive_Work_G_P_Bill_No_Id,
            'challan_no'=>$add_Receive_Work_Challan_No_Id,
            'party_id_FK'=>$add_Receive_Work_Party_Code_Id,
            'receive_date'=>$add_Receive_Work_Receive_Date_Id,
            'broker_id_FK'=>$add_Receive_Work_Broker_Id,
            'cr_days'=>$add_Receive_work_Cr_Days_Id,
            'lr_no'=>$add_Receive_Work_L_R_No_Id,
            'tempo_no'=>$add_Receive_Work_Tempo_No_Id,
            'transport_id_FK'=>$add_Receive_Work_Transport_Id,
            'our_challan_no'=>$add_Receive_Work_Our_Challan_No_Id,
            'lot_no'=>$add_Receive_Work_Lot_No_Id,
            'issue_quality'=>$add_Receive_Work_Issue_Quality_Id,
            'pcs'=>$add_Receive_Work_Pcs_Id,
            'meter'=>$add_Receive_Work_Mtrs_Id,
            'f_nine'=>$add_Receive_Work_F_Nine_Desc_Id,
            'desc_percentage'=>$add_Receive_Work_Disc_Code_Id,
            'discount_amount'=>$add_Receive_Work_Disc_Value_Id,
            'other_plus'=>$add_Receive_Work_Other_Plus_Id,
            'other_minus'=>$add_Receive_Work_Other_Minus_Id,
            'tds_rate_plus'=>$add_Receive_Work_T_D_S_Rate_Code_Id,
            'tds_rate_minus'=>$add_Receive_Work_T_D_S_Rate_Value_Id,
            'bill_amount'=>$add_Receive_Work_Bill_Amount_Id,
            'created_date'=>date('Y-m-d H:i:s')
        );
        if($uid ==""){
          $res=$this->Webservice_general_model->insert('tbl_receiveWorkMaster',$allData);
        }else{
          $setFilterData['work_receive_master_id_PK']=$uid;
          $res = $this->Webservice_general_model->update('tbl_receiveWorkMaster',$setFilterData, $allData);
        }


        for($i=0;$i<count($add_Receive_Work_Receive_Quality_Id);$i++){
          $allWorkReceiveMasterDetailData=array(
               'receiveWorkReceive_id_FK'=>$res,
               'issue_quality_id_FK'=>$add_Receive_Work_Receive_Quality_Id[$i],
               'pcs_taka'=>$add_Receive_Pcs_Taka_Id[$i],
               'meter'=>$add_Receive_Work_Meters_Id[$i],
               'short_long'=>$add_Receive_Work_Short_Long_Id[$i],
               'pm'=>$add_Receive_Work_Pm_Id[$i],
               'rate'=>$add_Receive_Work_Rate_Id[$i],
               'amount'=>$add_Receive_Work_Amount_Id[$i],
               'design'=>$add_Receive_Work_Design_Id[$i],
               'color'=>$add_Receive_Work_Colour_Id[$i],
               'finish'=>$add_Receive_Work_Fin_Id[$i],
               'created_date'=>date('Y-m-d H:i:s')
            );
        $this->Webservice_general_model->insert('tbl_receiveWorkMasterDeatail',$allWorkReceiveMasterDetailData);
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