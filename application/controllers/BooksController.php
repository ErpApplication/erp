<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BooksController extends CI_Controller {

    private $_user;

public function __construct() {
    parent::__construct();
    // Load form validation library
    $this->load->library('form_validation');
    $this->load->model('Common_model');
    $this->load->model('Webservice_general_model');
    if (!isset($this->session->userdata['user'])) {
        redirect('login');
    } else {
        $this->_user = $this->session->userdata['user'];
    }
}

public function index() {
    $data['currentPage'] = "Books";
    $data['subCurrentPage'] = "Books";
    $data['title'] = "Books";

    $breadcrumb=array(
     'Dashboard'=> base_url()."dashboard",
     '/Add Books'=> ""
    );
    $data['breadcrumbArray']=$breadcrumb;

    $this->load->view('assests/header');
    $this->load->view('assests/mainContent',$data);
    $this->load->view('assests/sidebar',$data);
    $this->load->view('Books/bookList',$data);
    $this->load->view('assests/footer');
}

public function bookListwebAPI(){

    $start = $_GET['start'];
    $length = $_GET['length'];
    $search = $_GET['search']["value"];
    $where="";

    if($search !=""){
        // $where=" branch_name LIKE '%".$search."%'
        //   OR branch_address LIKE '%".$search."%'
        //    OR manager_email LIKE '%".$search."%' ";
    }

     $data = $this->db->query("SELECT book_id_PK as id, book_number,
        type,purchase_account_code,purchase_account_name,
        sales_account_code,sales_account_name,
        lr_required,bill_type,general_purchase,
        cash_pay_bill,TDS,
        isActive FROM `tbl_book`as book
         ");
         // WHERE ".$where." order by id Desc limit ".$start.",".$length."");

    $result = $data->result();
    foreach ($result as $key => $value) {
      $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
    }

    $data1['data'] = $result;
    $data1['recordsTotal'] = $data->num_rows();

    $data12 = $this->db->query("SELECT book_id_PK as id, book_number,
        type,purchase_account_code,purchase_account_name,
        sales_account_code,sales_account_name,
        lr_required,bill_type,general_purchase,
        cash_pay_bill,TDS,
        isActive FROM `tbl_book`as book");
    $result1 = $data12->result();
    $data1['recordsFiltered'] = $data12->num_rows();
    echo json_encode($data1);

}


public function insertBook(){
    $data['currentPage']='Books';
    $breadcrumb=array(
        'Dashboard'=> base_url().'dashboard',
        '/Add Book'=> ""
    );
    $data['breadcrumbArray']=$breadcrumb;
    $data['title']="Add Book";
    $data['uid']='';
    $this->load->view('assests/header');
    $this->load->view('assests/sidebar',$data);
    $this->load->view('assests/mainContent');
    $this->load->view('Books/add_books_view',$data);
    $this->load->view('assests/footer');
}

public function addBook(){
   // print_r($_POST);die;
    $uid=$this->input->post('uid');
    $data['uid']=$uid;
    $add_books_book_no=$this->input->post('add_books_book_no');
    $add_books_type=$this->input->post('add_books_type');
    $add_books_purchase_account_no=$this->input->post('add_books_purchase_account_no');
    $add_books_purchase_name=$this->input->post('add_books_purchase_name');
    $add_books_sales_account_no=$this->input->post('add_books_sales_account_no');
    $add_books_sales_name=$this->input->post('add_books_sales_name');
    $add_books_lr_required=$this->input->post('add_books_lr_required');
    $add_books_bill_type=$this->input->post('add_books_bill_type');
    $add_books_gen_purchase=$this->input->post('add_books_gen_purchase');
    $add_books_cash_pay_bill=$this->input->post('add_books_cash_pay_bill');
    $add_books_tds=$this->input->post('add_books_tds');

    //$this->form_validation->set_rules('add_books_purchase_name','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter Purchase Account Name",'regex_match' => 'Please Enter character and space in Purchase Account Name'));  
    //$this->form_validation->set_rules('add_books_sales_name','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter Sales Account Name",'regex_match' => 'Please Enter character and space in Sales Account Name'));  
    $this->form_validation->set_rules('add_books_book_no','','required|regex_match[/^[0-9]+$/]', array('required'=>'Please Enter Book Number','regex_match' => 'Please Enter  number in contact number'));
    //$this->form_validation->set_rules('add_books_purchase_account_no','','required|regex_match[/^[0-9]+$/]', array('required'=>'Please Enter Purchase A/c Number','regex_match' => 'Please Enter  Purchase A/c Number'));
    //$this->form_validation->set_rules('add_books_sales_account_no','','required|regex_match[/^[0-9]+$/]', array('required'=>'Please Enter Sales A/c Number','regex_match' => 'Please Enter  Sales A/c Number'));
    $this->form_validation->set_rules('add_books_type','','required',array('required'=>"Please Select Account Type"));
    $this->form_validation->set_rules('add_books_lr_required','','required',array('required'=>"Please Select L R Number"));
    $this->form_validation->set_rules('add_books_bill_type','','required',array('required'=>"Please Select Bill Type"));
    $this->form_validation->set_rules('add_books_gen_purchase','','required',array('required'=>"Please Select General Purchase"));
    $this->form_validation->set_rules('add_books_cash_pay_bill','','required',array('required'=>"Please Select Cash Pay Bill"));
    $this->form_validation->set_rules('add_books_tds','','required',array('required'=>"Please Select TDS"));
    
    $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
     
    if($this->form_validation->run()){
      
      if($add_books_type==1){
        $allData=array(
        'book_number'=>$add_books_book_no,
        'type'=>$add_books_type,
        'sales_account_code'=>$add_books_sales_account_no,
        'sales_account_name'=>$add_books_sales_name,
        'lr_required'=>$add_books_lr_required,
        'bill_type'=>$add_books_bill_type,
        'general_purchase'=>$add_books_gen_purchase,
        'cash_pay_bill'=>$add_books_cash_pay_bill,
        'TDS'=>$add_books_tds,
        'created_date'=>date('Y-m-d H:i:s')
    );
   if($uid ==""){
      $res=$this->Webservice_general_model->insert('tbl_book',$allData);
   }else{
      $setFilterData['book_id_PK']=$uid;
      $res = $this->Webservice_general_model->update('tbl_book',$setFilterData, $allData);
   }

  }elseif($add_books_type==2) {
     
      $allData=array(
        'book_number'=>$add_books_book_no,
        'type'=>$add_books_type,
        'purchase_account_code'=>$add_books_purchase_account_no,
        'purchase_account_name'=>$add_books_purchase_name,
        'lr_required'=>$add_books_lr_required,
        'bill_type'=>$add_books_bill_type,
        'general_purchase'=>$add_books_gen_purchase,
        'cash_pay_bill'=>$add_books_cash_pay_bill,
        'TDS'=>$add_books_tds,
        'created_date'=>date('Y-m-d H:i:s')
    );
   if($uid ==""){
      $res=$this->Webservice_general_model->insert('tbl_book',$allData);
   }else{
      $setFilterData['book_id_PK']=$uid;
      $res = $this->Webservice_general_model->update('tbl_book',$setFilterData, $allData);
   }
}elseif($add_books_type==3) {
     
      $allData=array(
        'book_number'=>$add_books_book_no,
        'type'=>$add_books_type,
        'purchase_account_code'=>$add_books_purchase_account_no,
        'purchase_account_name'=>$add_books_purchase_name,
        //'sales_account_code'=>$add_books_sales_account_no,
        //'sales_account_name'=>$add_books_sales_name,
        'lr_required'=>$add_books_lr_required,
        'bill_type'=>$add_books_bill_type,
        'general_purchase'=>$add_books_gen_purchase,
        'cash_pay_bill'=>$add_books_cash_pay_bill,
        'TDS'=>$add_books_tds,
        'created_date'=>date('Y-m-d H:i:s')
    );
   if($uid ==""){
      $res=$this->Webservice_general_model->insert('tbl_book',$allData);
   }else{
      $setFilterData['book_id_PK']=$uid;
      $res = $this->Webservice_general_model->update('tbl_book',$setFilterData, $allData);
   }
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
