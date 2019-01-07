<?php 

class Purchasegeneral_expencesController extends CI_Controller
{
	
	public function __construct()
	{
	  parent::__construct();
    $this->load->model('Webservice_general_model');
    $this->load->library('form_validation');
	}

	public function index(){
	  $data['currentPage']='generalExpence_purchase';
	  $this->load->view('assests/header');
		$this->load->view('assests/sidebar',$data);
		$this->load->view('assests/mainContent',$data);
	 	$this->load->view('purchase_general_expensences/purchaseGeneral_ExpenseList',$data);
	    $this->load->view('assests/footer');
	}

public function purchaseExpencesListwebAPI(){

    $start = $_GET['start'];
    $length = $_GET['length'];
    $search = $_GET['search']["value"];
    $where="";

    if($search !=""){
        // $where=" branch_name LIKE '%".$search."%'
        //   OR branch_address LIKE '%".$search."%'
        //    OR manager_email LIKE '%".$search."%' ";
    }

    $data = $this->db->query("SELECT general_expences_id_PK as id,
        cr_days,purchase_billno,total_rcm_amt 
        FROM `tbl_generalexpences`as expences
         ");
         // WHERE ".$where." order by id Desc limit ".$start.",".$length."");

    $result = $data->result();
    foreach ($result as $key => $value) {
    $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
    }

    $data1['data'] = $result;
    $data1['recordsTotal'] = $data->num_rows();

    $data12 = $this->db->query("SELECT general_expences_id_PK as id,
        cr_days,purchase_billno,total_rcm_amt 
        FROM `tbl_generalexpences`as expences");
    $result1 = $data12->result();
    $data1['recordsFiltered'] = $data12->num_rows();
    echo json_encode($data1);

}

	public function addGeneralExpense(){
		$data['currentPage']='generalExpence_purchase';

		$breadcrumb=array(
      'Dashboard'=> base_url().'dashboard',
      '/Add General Expences/Purchase'=> ""
    );
    $data['breadcrumbArray']=$breadcrumb;
    $data['title']="General Expences/Purchase";
    $data['uid']='';
		$this->load->view('assests/header');
		$this->load->view('assests/sidebar',$data);
		$this->load->view('assests/mainContent',$data);
	  $this->load->view('purchase_general_expensences/add_purchase_general_expense_view',$data);
	  $this->load->view('assests/footer');
	}

public function insertPurchaseExpences(){
    extract($_POST);
    $uid=$this->input->post('uid');
    $data['uid']=$uid;
    
    $this->form_validation->set_rules('GeneralExpencePurchase_skip_gstr','','required',array('required'=>"Please Select Skip GSTR"));  
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
        'party_id_FK'=>$GeneralExpencePurchase_Party_name,
        'purchase_billno'=>$GeneralExpencePurchase_billNo,
        'bill_date'=>$GeneralExpencePurchase_billDate,
        'cr_days'=>$GeneralExpencePurchase_crDays,
        'inventry_type'=>$GeneralExpencePurchase_inventryType,
        'ac_name'=>$GeneralExpencePurchase_acName,
        'skip_gstr'=>$GeneralExpencePurchase_skip_gstr,
        'total_rcm_amt'=>$addExpencespurchase_rcm_Amt,
        'non_rcm_amt'=>$addExpencespurchase_nonrcm_Amt,
        'basic_amount'=>$addExpencespurchase_Basic_Amt_Id,
        'sgst'=>$addExpencespurchase_Sgst_Id,
        'cgst'=>$addExpencespurchase_Cgst_Id,
        'expences_desc'=>$addExpencespurchase_Desc_Id,
        'other'=>$addExpencespurchase_F9_Other,
        'eway_billNo'=>$expencesPurchase_Eway_Bill,
        'randoff'=>$expencesPurchase_Rnd_Off,
        'bill_amount'=>$expencesPurchase_Bill_Amount_Id,
        'created_date'=>date('Y-m-d H:i:s')
    );
   if($uid ==""){
      $res=$this->Webservice_general_model->insert('tbl_generalexpences',$allData);
   }else{
      $setFilterData['general_expences_id_PK']=$uid;
      $res = $this->Webservice_general_model->update('tbl_generalexpences',$setFilterData, $allData);
   }


      for($i=0;$i<count($GeneralExpencePurchase_Quantity_Id);$i++){
          $allExpencesPurchaseDetailData=array(
               'generalExpences_id_FK'=>$res,
               'discepration'=>$GeneralExpencePurchase_Description_Id[$i],
               'quantity'=>$GeneralExpencePurchase_Quantity_Id[$i],
               'rate'=>$GeneralExpencePurchase_Rate_Id[$i],
               'decount_percentage'=>$GeneralExpencePurchase_Disc_Id[$i],
               'amount'=>$GeneralExpencePurchase_Amount_Id[$i],
               'sgst'=>$GeneralExpencePurchase_Sgst_Id[$i],
               'cgst'=>$GeneralExpencePurchase_Cgst_Id[$i],
               'net_amount'=>$GeneralExpencePurchase_Net_Amt_Id[$i],
               'net_rate'=>$GeneralExpencePurchase_Net_Rate_Id[$i],
               'frieght'=>$GeneralExpencePurchase_Freight_Id[$i],
               'gst'=>$GeneralExpencePurchase_Gst_Id[$i],
               'created_date'=>date('Y-m-d H:i:s')
            );
        $this->Webservice_general_model->insert('tbl_generalexpencesdetail',$allExpencesPurchaseDetailData);
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