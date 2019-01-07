<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class InventryStockReceiveController extends CI_Controller {

    private $_user;

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('Webservice_general_model');
        $this->load->model('Common_model');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }
    }

public function index() {
    //$data['subCurrentPage']="inventory";
    $data['currentPage'] = "stockIssue";
    //$data['currentPages'] = "operator";

    $this->load->view('assests/header');
    $this->load->view('assests/mainContent',$data);
    $this->load->view('assests/sidebar',$data);
    $this->load->view('inventryStockReceive/inventoryStockReceiveList',$data);
    $this->load->view('assests/footer');
}

public function inventryStockReceiveListwebAPI(){

        $start = $_GET['start'];
        $length = $_GET['length'];
        $search = $_GET['search']["value"];
        $where="";

        if($search !=""){
            // $where=" branch_name LIKE '%".$search."%'
            //   OR branch_address LIKE '%".$search."%'
            //    OR manager_email LIKE '%".$search."%' ";
        }

         $data = $this->db->query("SELECT inventry_stock_receive_id_PK as id,
            voucher_number,lot_no FROM `tbl_inventry_stock_receive`as stock_receive
             ");
             // WHERE ".$where." order by id Desc limit ".$start.",".$length."");

        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT inventry_stock_receive_id_PK as id,
            voucher_number,lot_no FROM `tbl_inventry_stock_receive`as stock_receive");
        $result1 = $data12->result();
        $data1['recordsFiltered'] = $data12->num_rows();

        echo json_encode($data1);

}

public function addStockReceive() {
    $data['currentPage'] = "stockIssue";
    $data['subcurrentPage'] = "inventory";
    $data['title'] = "Add Inventory Stock Receive";
    $breadcrumb=array(
     'Dashboard'=> base_url()."dashboard",
     '/Add Inventory Stock Receive'=> ""
    );
    $data['breadcrumbArray']=$breadcrumb;
    $data['uid']="";
    $this->load->view('assests/header');
    $this->load->view('assests/mainContent',$data);
    $this->load->view('assests/sidebar',$data);
    $this->load->view('inventryStockReceive/addInventoryStockReceive_view',$data);
    $this->load->view('assests/footer');
} 

public function insertStockReceive(){
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
    $this->form_validation->set_rules('stockReceive_Book_id','','required', array('required'=>'Please Select Book'));
       
    $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
     
    if($this->form_validation->run()){      
        $allData=array(
            'book_id_FK'=>$stockReceive_Book_id,
            'voucher_number'=>$stockReceive_voucher_no_Id,
            'voucher_date'=>$stockReceive_voucher_date_Id,
            'lot_no'=>$stockReceive_lot_No_Id,
            'job_process_id_FK'=>$stockReceive_job_process_Id,
            'party'=>$stockReceive_party_value_Id,
            'remark'=>$stockReceive_remark,
            'created_date'=>date('Y-m-d H:i:s')
        );
        if($uid ==""){
          $res=$this->Webservice_general_model->insert('tbl_inventry_stock_receive',$allData);
        }else{
          $setFilterData['inventry_stock_receive_id_PK']=$uid;
          $res = $this->Webservice_general_model->update('tbl_inventry_stock_receive',$setFilterData, $allData);
        }


        for($i=0;$i<count($stockReceive_groupName);$i++){
          $allStockReceiveDetailData=array(
               'inventry_stock_Receive_id_FK'=>$res,
               'inventry_stock_Receive_group'=>$stockReceive_groupName[$i],
               'quality_name'=>$stockReceive_qualityName[$i],
               'pcs'=>$stockReceive_pcs[$i],
               'cut'=>$stockReceive_cut[$i],
               'quantity'=>$stockReceive_quantity[$i],
               'created_date'=>date('Y-m-d H:i:s')
            );
        $this->Webservice_general_model->insert('tbl_inventry_stock_Receivedetail',$allStockReceiveDetailData);
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
