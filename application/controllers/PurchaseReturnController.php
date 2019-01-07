<?php 

class PurchaseReturnController extends CI_Controller
{
	
	public function __construct()
	{
	   parent::__construct();
       $this->load->model('Webservice_general_model');
       $this->load->library('form_validation');
	}

	public function index(){
	    $data['currentPage']='purchaseReturn';
	    $this->load->view('assests/header');
		  $this->load->view('assests/sidebar',$data);
		  $this->load->view('assests/mainContent',$data);
	 	  $this->load->view('purchaseReturn/purchaseReturnList',$data);
	    $this->load->view('assests/footer');
	}

	public function purchaseReturnListwebAPI(){

    $start = $_GET['start'];
    $length = $_GET['length'];
    $search = $_GET['search']["value"];
    $where="";

    if($search !=""){
        // $where=" branch_name LIKE '%".$search."%'
        //   OR branch_address LIKE '%".$search."%'
        //    OR manager_email LIKE '%".$search."%' ";
    }

    $data = $this->db->query("SELECT purchasereturn.purchaseReturn_id_PK as id,pd.discription,
        purchasereturn.balance,purchasereturn.purchase_billNo,purchasereturn.cr_days , m.name as millPartyName,b.broker_name FROM tbl_purchasereturn as purchasereturn
     INNER JOIN tbl_account_master as m on m.accountMaster_id_PK=purchasereturn.party_id_FK
       INNER JOIN tbl_broker as b on b.broker_id_PK=purchasereturn.broker_id_FK
       INNER JOIN tbl_transport as t on t.transport_id_PK=purchasereturn.transport_id_FK
       INNER JOIN tbl_purchasereturndetail as pd
         ");
         // WHERE ".$where." order by id Desc limit ".$start.",".$length."");

    $result = $data->result();
    foreach ($result as $key => $value) {
    $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
    }

    $data1['data'] = $result;
    $data1['recordsTotal'] = $data->num_rows();

    $data12 = $this->db->query("SELECT purchasereturn.purchaseReturn_id_PK as id,pd.discription,
        purchasereturn.balance,purchasereturn.purchase_billNo,purchasereturn.cr_days , m.name as millPartyName,b.broker_name FROM tbl_purchasereturn as purchasereturn
     INNER JOIN tbl_account_master as m on m.accountMaster_id_PK=purchasereturn.party_id_FK
       INNER JOIN tbl_broker as b on b.broker_id_PK=purchasereturn.broker_id_FK
       INNER JOIN tbl_transport as t on t.transport_id_PK=purchasereturn.transport_id_FK
       INNER JOIN tbl_purchasereturndetail as pd");
    $result1 = $data12->result();
    $data1['recordsFiltered'] = $data12->num_rows();
    echo json_encode($data1);

}

	public function addPurchaseReturn(){
		  $data['currentPage']='purchaseReturn';
		  $breadcrumb=array(
        'Dashboard'=> base_url().'dashboard',
        '/Add Purchase Return'=> ""
      );
      $data['breadcrumbArray']=$breadcrumb;
      $data['title']="Add Purchase Return";
      $data['uid']='';
		  $this->load->view('assests/header');
		  $this->load->view('assests/sidebar',$data);
		  $this->load->view('assests/mainContent',$data);
	    $this->load->view('purchaseReturn/add_purchaseReturn_view',$data);
	    $this->load->view('assests/footer');
	}

public function insertPurchaseReturn(){
    //print_r($_POST);die;
    extract($_POST);
    $uid=$this->input->post('uid');
    $data['uid']=$uid;
    
    $this->form_validation->set_rules('purchaseReturn_Book_Id','','required',array('required'=>"Please Select Book"));  
    // $this->form_validation->set_rules('add_books_sales_name','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter Sales Account Name",'regex_match' => 'Please Enter character and space in Sales Account Name'));  
    // $this->form_validation->set_rules('add_books_book_no','','required|regex_match[/^[0-9]+$/]', array('required'=>'Please Enter Book Number','regex_match' => 'Please Enter  number in contact number'));
    // $this->form_validation->set_rules('add_books_purchase_account_no','','required|regex_match[/^[0-9]+$/]', array('required'=>'Please Enter Purchase A/c Number','regex_match' => 'Please Enter  Purchase A/c Number'));
    // $this->form_validation->set_rules('add_books_sales_account_no','','required|regex_match[/^[0-9]+$/]', array('required'=>'Please Enter Sales A/c Number','regex_match' => 'Please Enter  Sales A/c Number'));
    // $this->form_validation->set_rules('add_books_type','','required',array('required'=>"Please Select Account Type"));
    // $this->form_validation->set_rules('add_books_lr_required','','required',array('required'=>"Please Select L R Number"));
    // $this->form_validation->set_rules('add_books_bill_type','','required',array('required'=>"Please Select Bill Type"));
    // $this->form_validation->set_rules('add_books_gen_purchase','','required',array('required'=>"Please Select General Purchase"));
    // $this->form_validation->set_rules('add_books_cash_pay_bill','','required',array('required'=>"Please Select Cash Pay Bill"));
    // $this->form_validation->set_rules('add_books_tds','','required',array('required'=>"Please Select TDS"));
    
    $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
     
    if($this->form_validation->run()){      
        $allData=array(
        'book_id_FK'=>$purchaseReturn_Book_Id,
        'balance'=>$purchaseReturn_Bal_Id,
        'purchase_billNo'=>$purchaseReturn_Pur_Bill_No_Id,
        'party_id_FK'=>$purchaseReturn_Party_Value_Id,
        'inventry_type'=>$purchaseReturn_Inv_Type_Id,
        'bill_date'=>$purchaseReturn_Bill_Date_Id,
        'broker_id_FK'=>$purchaseReturn_Broker_Id,
        'cr_days'=>$purchaseReturn_Cr_Days_Id,
        'lr_no'=>$purchaseReturn_L_R_No_Id,
        'lr_date'=>$purchaseReturn_L_R_Dt_Id,
        'case_no'=>$purchaseReturn_Case_No_Id,
        'transport_id_FK'=>$purchaseReturn_Transport_Id,
        'purchse_desc'=>$purchaseReturn_Desc_Id,
        'basic_amount'=>$purchaseReturn_Basic_Amt_Id,
        'SGST'=>$purchase_Sgst_Id,
        'reason'=>$purchaseReturn_reason_id,
        'cgst'=>$return_Cgst_Id,
        'eway_billno'=>$purchaseReturn_Eway_Bill_Id,
        'rcm_bill_no'=>$purchaseReturn_rcm_bil,
        'other'=>$purchaseReturn_F9_Other_Id,
        'purchase_bill_no'=>$purchaseReturn_Purchase_Bill_Id,
        'purchase_bill_date'=>$purchaseReturn_pur_Bill_date,
        'randoff'=>$purchaseReturn_Rnd_Off_Code_Id,
        'bill_amount'=>$purchaseReturn_Bill_Amount_Id,
        'created_date'=>date('Y-m-d H:i:s')
    );
   if($uid ==""){
      $res=$this->Webservice_general_model->insert('tbl_purchasereturn',$allData);
   }else{
      $setFilterData['purchaseReturn_id_PK']=$uid;
      $res = $this->Webservice_general_model->update('tbl_purchasereturn',$setFilterData, $allData);
   }


      for($i=0;$i<count($purchaseReturn_Cut_Id);$i++){
          $allPurchaseDetailData=array(
               'purchase_returnDetail_id_FK'=>$res,
               'discription'=>$purchaseReturn_Description_Id[$i],
               'meter'=>$purchaseReturn_Nos_Id[$i],
               'cut'=>$purchaseReturn_Cut_Id[$i],
               'quantity'=>$purchaseReturn_Quantity_Id[$i],
               'pm'=>$purchaseReturn_PM_Id[$i],
               'rate'=>$purchaseReturn_Rate_Id[$i],
               'disc_percentage'=>$purchaseReturn_Disc_Id[$i],
               'amount'=>$purchaseReturn_Amount_Id[$i],
               'sgst'=>$purchaseReturn_Sgst_Id[$i],
               'cgst'=>$purchaseReturn_Cgst_Id[$i],
               'net_amount'=>$purchaseReturn_Net_Amt_Id[$i],
               'net_rate'=>$purchaseReturn_Net_Rate_Id[$i],
               'freight'=>$purchaseReturn_Freight_Id[$i],
               'gst'=>$purchaseReturn_Gst_Id[$i],
               'created_date'=>date('Y-m-d H:i:s')
            );
        $this->Webservice_general_model->insert('tbl_purchasereturndetail',$allPurchaseDetailData);
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