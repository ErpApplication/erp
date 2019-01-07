<?php 

class IssueController extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Webservice_general_model');
        $this->load->library('form_validation');

	}

public function index(){
    //$data['currentPage']='dispatch';
		$data['currentPage']='Issue';
		$this->load->view('assests/header');
		$this->load->view('assests/sidebar',$data);
		$this->load->view('assests/mainContent',$data);
	    $this->load->view('issuework/issueWorkDispatchList.php',$data);
	    $this->load->view('assests/footer');

	}
public function dispatchMasterListwebAPI(){
        $start = $_GET['start'];
        $length = $_GET['length'];
        $search = $_GET['search']["value"];
        $where="";

        if($search !=""){
            // $where=" branch_name LIKE '%".$search."%'
            //   OR branch_address LIKE '%".$search."%'
            //    OR manager_email LIKE '%".$search."%' ";
        }

         $data = $this->db->query("SELECT issuedispatch.dispatchMaster_id_PK as id, m.name as millPartyName,b.broker_name,t.transport_name,j.job_process_name,issuedispatch.bill_amount, issuedispatch.created_date FROM tbl_dispatchmaster as issuedispatch 
          INNER JOIN tbl_account_master as m on m.accountMaster_id_PK=issuedispatch.party_id_FK 
          INNER JOIN tbl_broker as b on b.broker_id_PK=issuedispatch.broker_id_FK
           INNER JOIN tbl_transport as t on t.transport_id_PK=issuedispatch.transport_id_FK 
           INNER JOIN tbl_job_process as j on j.job_process_id_PK=issuedispatch.job_process_id_FK
             ");
             // WHERE ".$where." order by id Desc limit ".$start.",".$length."");

        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT issuedispatch.dispatchMaster_id_PK as id, m.name as millPartyName,b.broker_name,t.transport_name,j.job_process_name,issuedispatch.bill_amount, issuedispatch.created_date FROM tbl_dispatchmaster as issuedispatch INNER JOIN tbl_account_master as m on m.accountMaster_id_PK=issuedispatch.party_id_FK INNER JOIN tbl_broker as b on b.broker_id_PK=issuedispatch.broker_id_FK INNER JOIN tbl_transport as t on t.transport_id_PK=issuedispatch.transport_id_FK INNER JOIN tbl_job_process as j on j.job_process_id_PK=issuedispatch.job_process_id_FK");
        $result1 = $data12->result();
        $data1['recordsFiltered'] = $data12->num_rows();

        echo json_encode($data1);

}

public function addDispatchMaster(){
    $data['subCurrentPage']='dispatch';
        $data['currentPage']='Issue';
		$breadcrumb=array(
           'Dashboard'=> base_url().'dashboard',
           '/Add Issue Work Dispatch Master'=> ""
        );
        $data['breadcrumbArray']=$breadcrumb;
        $data['title']="Add Issue Work Dispatch Master";
        $data['uid']='';
		$this->load->view('assests/header');
		$this->load->view('assests/sidebar',$data);
		$this->load->view('assests/mainContent',$data);
	    $this->load->view('issuework/addIssue_Work_View',$data);
	    $this->load->view('assests/footer');
	}
public function insertDispatchMaster(){
  extract($_POST);
    $uid=$this->input->post('uid');
    $data['uid']=$uid;
	
    $this->form_validation->set_rules('dispatchMaster_Book_Code_Id','','required',array('required'=>"Please Enter Job Process Name"));  
    $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
     
    if($this->form_validation->run()){      
        $allData=array(
            'book_id_FK'=>$dispatchMaster_Book_Code_Id,
            'balance'=>$add_Issue_Bal_Id,
            'challanNo'=>$add_Issue_Work_Challan_No_Id,
            'party_id_FK'=>$add_Issue_Party_Value_Id,
            'issue_date'=>$add_Issue_Date_Id,
            'lot_no'=>$add_Issue_Lot_No_Id,
            'broker_id_FK'=>$add_Issue_Broker_Id,
            'job_process_id_FK'=>$add_Issue_Job_Process_Id,
            'lr_number'=>$add_Issue_L_R_No_Id,
            'tempo_no'=>$add_Issue_Tempo_No_Id,
            'transport_id_FK'=>$add_Issue_Transport_Id,
            'f_nine'=>$add_Issue_f_nine,
            'bill_amount'=>$add_Issue_bill_amount,
            'created_date'=>date('Y-m-d H:i:s')
        );
       if($uid ==""){
          $res=$this->Webservice_general_model->insert('tbl_dispatchMaster',$allData);
       }else{
          $setFilterData['dispatchMaster_id_PK']=$uid;
          $res = $this->Webservice_general_model->update('tbl_dispatchMaster',$setFilterData, $allData);
       }
         
         for($i=0;$i<count($add_Issue_Pcs_Mtrs_Id);$i++){
          $allDispatchDetailData=array(
               'dispatchMaster_id_FK'=>$res,
               'issue_quality_id_FK'=>$add_Issue_Quality_Id[$i],
               'pcs'=>$add_Issue_Pcs_Mtrs_Id[$i],
               'cut'=>$add_Issue_Cut_Id[$i],
               'meter'=>$add_Issue_Meters_Id[$i],
               'weight'=>$add_Issue_Weight_Id[$i],
               'pm'=>$add_Issue_PM_Id[$i],
               'rate'=>$add_Issue_Rate_Id[$i],
               'design'=>$add_Issue_Design_Id[$i],
               'color'=>$add_Issue_Colour_Id[$i],
               'remark'=>$add_Issue_Remarks_Id[$i],
               'amount'=>$add_Issue_Amount_Id[$i],
               'created_date'=>date('Y-m-d H:i:s')
            );
        $this->Webservice_general_model->insert('tbl_dispatchMaster_detail',$allDispatchDetailData);
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