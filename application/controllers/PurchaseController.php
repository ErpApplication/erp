<?php 

class PurchaseController extends CI_Controller
{
public function __construct()
{
	  parent::__construct();
    $this->load->model('Webservice_general_model');
    $this->load->library('form_validation');
}

	public function index(){
	  $data['currentPage']='purchase';
	  $this->load->view('assests/header');
		$this->load->view('assests/sidebar',$data);
		$this->load->view('assests/mainContent',$data);
	 	$this->load->view('purchase/purchaseList',$data);
	  $this->load->view('assests/footer');
	}

	public function purchaseListwebAPI(){

    $start = $_GET['start'];
    $length = $_GET['length'];
    $search = $_GET['search']["value"];
    $where="";

    if($search !=""){
        // $where=" branch_name LIKE '%".$search."%'
        //   OR branch_address LIKE '%".$search."%'
        //    OR manager_email LIKE '%".$search."%' ";
    }

    $data = $this->db->query("SELECT purchase.purchase_master_id_PK as id,
        purchase.bill_amount, m.name as millPartyName,b.broker_name FROM tbl_purchasemaster as purchase
     INNER JOIN tbl_account_master as m on m.accountMaster_id_PK=purchase.purchase_party_id_FK
       INNER JOIN tbl_broker as b on b.broker_id_PK=purchase.broker_id_FK
         ");
         // WHERE ".$where." order by id Desc limit ".$start.",".$length."");

    $result = $data->result();
    foreach ($result as $key => $value) {
    $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
    }

    $data1['data'] = $result;
    $data1['recordsTotal'] = $data->num_rows();

    $data12 = $this->db->query("SELECT purchase.purchase_master_id_PK as id,
        purchase.bill_amount, m.name as millPartyName,b.broker_name FROM tbl_purchasemaster as purchase
     INNER JOIN tbl_account_master as m on m.accountMaster_id_PK=purchase.purchase_party_id_FK
       INNER JOIN tbl_broker as b on b.broker_id_PK=purchase.broker_id_FK");
    $result1 = $data12->result();
    $data1['recordsFiltered'] = $data12->num_rows();
    echo json_encode($data1);

}

	public function addPurchase(){
		$data['currentPage']='purchase';
		$breadcrumb=array(
      'Dashboard'=> base_url().'dashboard',
      '/Add Purchase'=> ""
    );
    $data['breadcrumbArray']=$breadcrumb;
    $data['title']="Add Purchase";
    $data['currentPage']='master';
    $data['uid']='';
		$this->load->view('assests/header');
		$this->load->view('assests/sidebar',$data);
		$this->load->view('assests/mainContent',$data);
	  $this->load->view('purchase/add_purchase_view',$data);
	  $this->load->view('assests/footer');
	}

public function insertPurchase(){
    extract($_POST);
    $uid=$this->input->post('uid');
    $data['uid']=$uid;
    $this->form_validation->set_rules('add_Purchase_Bal_Id','','required|trim|regex_match[/^[0-9]+$/]',array('required'=>"Please Enter Purchase Balance",'regex_match' => 'Please Enter only Number in Purchase Balance'));  
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
        'book_id_FK'=>$add_Purchase_Book_Id,
        'balance'=>$add_Purchase_Bal_Id,
        'purchase_bill_no'=>$add_Purchase_Pur_Bill_No_Id,
        'purchase_party_code'=>$add_Purchase_Party_Code_Id,
        'purchase_party_id_FK'=>$add_Purchase_Party_Value_Id,
        'inventry_type'=>$add_Purchase_Inv_Type_Id,
        'bill_date'=>$add_Purchase_Bill_Date_Id,
        'broker_id_FK'=>$add_Purchase_Broker_Id,
        'cr_days'=>$add_Purchase_Cr_Days_Id,
        'lr_no'=>$add_Purchase_L_R_No_Id,
        'lr_date'=>$add_Purchase_L_R_Dt_Id,
        'case_no'=>$add_Purchase_Case_No_Id,
        'transport_id_FK'=>$add_Purchase_Transport_Id,
        'SGST'=>$purchase_Sgst_Id,
        'CGST'=>$purchase_Cgst_Id,
        'purchase_desc'=>$add_Purchase_Desc_Id,
        'other'=>$add_Purchase_F9_Other_Id,
        'eway_bill_no'=>$add_Purchase_Eway_Bill_Id,
        'rand_off'=>$add_Purchase_Rnd_Off_Code_Id,
        'bill_amount'=>$add_Purchase_Bill_Amount_Id,
        'created_date'=>date('Y-m-d H:i:s')
    );
   if($uid ==""){
      $res=$this->Webservice_general_model->insert('tbl_purchasemaster',$allData);
   }else{
      $setFilterData['purchase_master_id_PK']=$uid;
      $res = $this->Webservice_general_model->update('tbl_purchasemaster',$setFilterData, $allData);
   }


      for($i=0;$i<count($add_Purchase_Nos_Id);$i++){
          $allPurchaseDetailData=array(
               'purchase_master_id_FK'=>$res,
               'description_id_FK'=>$add_Purchase_Description_Id[$i],
               'nos'=>$add_Purchase_Nos_Id[$i],
               'cut'=>$add_Purchase_Cut_Id[$i],
               'quantity'=>$add_Purchase_Quantity_Id[$i],
               'pm'=>$add_Purchase_PM_Id[$i],
               'rate'=>$add_Purchase_Rate_Id[$i],
               'disc_percentage'=>$add_Purchase_Disc_Id[$i],
               'amount'=>$add_Purchase_Amount_Id[$i],
               'SGST'=>$add_Purchase_Sgst_Id[$i],
               'CGST'=>$add_Purchase_Cgst_Id[$i],
               'net_amount'=>$add_Purchase_Net_Amt_Id[$i],
               'net_rate'=>$add_Purchase_Net_Rate_Id[$i],
               'freight'=>$add_Purchase_Freight_Id[$i],
               'gst'=>$add_Purchase_Gst_Id[$i],
               'created_date'=>date('Y-m-d H:i:s')
            );
        $this->Webservice_general_model->insert('tbl_purchasemaster_detail',$allPurchaseDetailData);
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