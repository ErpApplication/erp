<?php 
class ItemmasterController extends CI_Controller{
public function __construct(){
	parent::__construct();
	$this->load->model('Webservice_general_model');
    $this->load->library('form_validation');
}

public function index(){
	$data['currentPage']='iteam';
    $this->load->view('Itemmaster/itemMasterList',$data);
}

public function iteamMasterListwebAPI(){

    $start = $_GET['start'];
    $length = $_GET['length'];
    $search = $_GET['search']["value"];
    $where="";

    if($search !=""){
        // $where=" branch_name LIKE '%".$search."%'
        //   OR branch_address LIKE '%".$search."%'
        //    OR manager_email LIKE '%".$search."%' ";
    }

     $data = $this->db->query("SELECT iteam_master_id_PK as id, iteam_code,
        iteam_name,iteam_group,stock_type,unite_measure,dealer_rate,
        HSN,iteam_cut,box_pack,mrp,purchase_reate,
        iteam_gst,sgst,cgst,igst,stock_report,stock_quality,
        stock_number,opening_atm,rate_update,active,calculate_number,
        HSN_UQC,HSN_desc,created_date,isActive 
        FROM `tbl_iteamMaster`as iteam_master
         ");
         // WHERE ".$where." order by id Desc limit ".$start.",".$length."");

    $result = $data->result();
    foreach ($result as $key => $value) {
    $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
    }

    $data1['data'] = $result;
    $data1['recordsTotal'] = $data->num_rows();

    $data12 = $this->db->query("SELECT iteam_master_id_PK as id, iteam_code,
        iteam_name,iteam_group,stock_type,unite_measure,dealer_rate,
        HSN,iteam_cut,box_pack,mrp,purchase_reate,
        iteam_gst,sgst,cgst,igst,stock_report,stock_quality,
        stock_number,opening_atm,rate_update,active,calculate_number,
        HSN_UQC,HSN_desc,created_date,isActive 
        FROM `tbl_iteamMaster`as iteam_master");
    $result1 = $data12->result();
    $data1['recordsFiltered'] = $data12->num_rows();
    echo json_encode($data1);

}

public function addItemMaster(){
	$data['currentPage']='iteam';
	$breadcrumb=array(
	    'Dashboard'=> base_url().'dashboard',
	    '/Add Item Master'=> ""
	);
	$data['breadcrumbArray']=$breadcrumb;
	$data['title']="Add Item Master";

	$data['uid']='';
	$this->load->view('assests/header');
	$this->load->view('assests/sidebar',$data);
	$this->load->view('assests/mainContent');
	$this->load->view('Itemmaster/addItemMaster_view',$data);
	}

public function addAccountMaster(){
    $uid=$this->input->post('uid');
    $data['uid']=$uid;
	$iteamMaster_Item_Code=$this->input->post('iteamMaster_Item_Code');
	$iteamMaster_Item_Name=$this->input->post('iteamMaster_Item_Name');
	$iteamMaster_Group=$this->input->post('iteamMaster_Group');
	$iteamMaster_Stock=$this->input->post('iteamMaster_Stock');
	$iteamMaster_Unit=$this->input->post('iteamMaster_Unit');
	$iteamMaster_Hsn=$this->input->post('iteamMaster_Hsn');
	$iteamMaster_Dealer=$this->input->post('iteamMaster_Dealer');
	$iteamMaster_Cut=$this->input->post('iteamMaster_Cut');
	$iteamMaster_Box=$this->input->post('iteamMaster_Box');
	$iteamMaster_mrp=$this->input->post('iteamMaster_mrp');
	$iteamMaster_purchaseRate=$this->input->post('iteamMaster_purchaseRate');
	$iteamMaster_gst_calculate=$this->input->post('iteamMaster_gst_calculate');
	$iteamMaster_sgst=$this->input->post('iteamMaster_sgst');
	$iteamMaster_cgst=$this->input->post('iteamMaster_cgst');
	$iteamMaster_igst=$this->input->post('iteamMaster_igst');
	$iteamMaster_stock_report=$this->input->post('iteamMaster_stock_report');
	$iteamMaster_stock_quantity=$this->input->post('iteamMaster_stock_quantity');
	$iteamMaster_open_stock_number=$this->input->post('iteamMaster_open_stock_number');
	$iteamMaster_Opening_atm=$this->input->post('iteamMaster_Opening_atm');
	$iteamMaster_rate_update=$this->input->post('iteamMaster_rate_update');
	$iteamMaster_active=$this->input->post('iteamMaster_active');
	$iteamMaster_calculate_number=$this->input->post('iteamMaster_calculate_number');
	$iteamMaster_Hsn_Uqc=$this->input->post('iteamMaster_Hsn_Uqc');
	$iteamMaster_Hsn_desc=$this->input->post('iteamMaster_Hsn_desc');

    $this->form_validation->set_rules('iteamMaster_Item_Name','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter Item Name",'regex_match' => 'Please Enter character and space in Item Name'));  
    $this->form_validation->set_rules('iteamMaster_Group','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter Item Group Name",'regex_match' => 'Please Enter character and space in Item Group Name'));  
    
    $this->form_validation->set_rules('iteamMaster_Item_Code','','regex_match[/^[0-9]+$/]', array('regex_match' => 'Please Enter  number in Item Code'));
    $this->form_validation->set_rules('iteamMaster_Box','','regex_match[/^[0-9A-Za-z]+$/]', array('regex_match' => 'Please Enter  number and alphabates in Box Pack'));

    $this->form_validation->set_rules('iteamMaster_Stock','','required',array('required'=>"Please Select Stock Type"));
    $this->form_validation->set_rules('iteamMaster_Hsn_desc','','required',array('required'=>"Please Select IteamMaster Hsn Desc"));
    $this->form_validation->set_rules('iteamMaster_active','','required',array('required'=>"Please Select IteamMaster Active"));
    $this->form_validation->set_rules('iteamMaster_calculate_number','','required',array('required'=>"Please Select IteamMaster Calculate Number"));
    $this->form_validation->set_rules('iteamMaster_gst_calculate','','required',array('required'=>"Please Select IteamMaster Gst Calculate"));
    $this->form_validation->set_rules('iteamMaster_stock_report','','required',array('required'=>"Please Select Stick Report"));
    
    $this->form_validation->set_rules('iteamMaster_Unit','','regex_match[/^[0-9]+$/]', array('regex_match'=>'Please Enter Unit Of Measure'));
    $this->form_validation->set_rules('iteamMaster_Hsn','','regex_match[/^[0-9]+$/]', array('regex_match'=>'Please Enter HSN Number'));
    $this->form_validation->set_rules('iteamMaster_Dealer','','regex_match[/^[0-9]+$/]', array('required'=>"Please Enter Item Cut", 'regex_match'=>'Please Enter Dealer Rate'));
    $this->form_validation->set_rules('iteamMaster_stock_quantity','','regex_match[/^[0-9]+$/]', array('required'=>"Please Enter IteamMaster Stock Quantity", 'regex_match'=>'Please Enter Only Number IteamMaster Stock Quantity'));
    $this->form_validation->set_rules('iteamMaster_open_stock_number','','regex_match[/^[0-9]+$/]', array('required'=>"Please Enter IteamMaster Open Stock Number", 'regex_match'=>'Please Enter Only Number IteamMaster Open Stock Number'));
    
    $this->form_validation->set_rules('iteamMaster_Cut','','required|regex_match[/^[0-9]+$/]', array('regex_match'=>'Please Enter Item Cut'));
    $this->form_validation->set_rules('iteamMaster_mrp','','required|regex_match[/^[0-9]+$/]', array('regex_match'=>'Please Enter Mrp'));
    $this->form_validation->set_rules('iteamMaster_sgst','','required|regex_match[/^[0-9]+$/]', array('regex_match'=>'Please Enter SGST'));
    $this->form_validation->set_rules('iteamMaster_cgst','','required|regex_match[/^[0-9]+$/]', array('regex_match'=>'Please Enter CGST'));
    $this->form_validation->set_rules('iteamMaster_igst','','required|regex_match[/^[0-9]+$/]', array('regex_match'=>'Please Enter IGST'));
       
    $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
     
    if($this->form_validation->run()){      
        $allData=array(
            'iteam_code'=>$iteamMaster_Item_Code,
            'iteam_name'=>$iteamMaster_Item_Name,
            'iteam_group'=>$iteamMaster_Group,
            'stock_type'=>$iteamMaster_Stock,
            'unite_measure'=>$iteamMaster_Unit,
            'HSN'=>$iteamMaster_Hsn,
            'dealer_rate'=>$iteamMaster_Dealer,
            'iteam_cut'=>$iteamMaster_Cut,
            'box_pack'=>$iteamMaster_Box,
            'mrp'=>$iteamMaster_mrp,
            'purchase_reate'=>$iteamMaster_purchaseRate,
            'iteam_gst'=>$iteamMaster_gst_calculate,
            'sgst'=>$iteamMaster_sgst,
            'cgst'=>$iteamMaster_cgst,
            'igst'=>$iteamMaster_igst,
            'stock_report'=>$iteamMaster_stock_report,
            'stock_quality'=>$iteamMaster_stock_quantity,
            'stock_number'=>$iteamMaster_open_stock_number,
            'opening_atm'=>$iteamMaster_Opening_atm,
            'rate_update'=>$iteamMaster_rate_update,
            'active'=>$iteamMaster_active,
            'calculate_number'=>$iteamMaster_calculate_number,
            'HSN_UQC'=>$iteamMaster_Hsn_Uqc,
            'HSN_desc'=>$iteamMaster_Hsn_desc,
            'created_date'=>date('Y-m-d H:i:s')
        );
        if($uid ==""){
          $res=$this->Webservice_general_model->insert('tbl_iteamMaster',$allData);
        }else{
          $setFilterData['iteam_master_id_PK']=$uid;
          $res = $this->Webservice_general_model->update('tbl_iteamMaster',$setFilterData, $allData);
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