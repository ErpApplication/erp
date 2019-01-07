<?php 

class JobprocessmasterController extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Webservice_general_model');
    $this->load->library('form_validation');

	}

	public function index(){
		$data['currentPage']='jobProcess';
		$breadcrumb=array(
      'Dashboard'=> base_url().'dashboard',
      '/Add Job Process'=> ""
    );
    $data['breadcrumbArray']=$breadcrumb;
    $data['title']="Add Job Process";
    $data['uid']='';

		$this->load->view('assests/header');
		$this->load->view('assests/sidebar',$data);
		$this->load->view('assests/mainContent',$data);
	  $this->load->view('jobprocessmaster/job_Process_Master',$data);
	  $this->load->view('assests/footer');
}

public function jobProcessListwebAPI(){

        $start = $_GET['start'];
        $length = $_GET['length'];
        $search = $_GET['search']["value"];
        $where="";

        if($search !=""){
            // $where=" branch_name LIKE '%".$search."%'
            //   OR branch_address LIKE '%".$search."%'
            //    OR manager_email LIKE '%".$search."%' ";
        }

        $data = $this->db->query("SELECT job_process_id_PK as id, job_process_name,
            created_date,isActive FROM `tbl_job_process`as jobProcess
             ");
             // WHERE ".$where." order by id Desc limit ".$start.",".$length."");

        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT job_process_id_PK as id, job_process_name,
            created_date,isActive FROM `tbl_job_process`as jobProcess
             ");
        $result1 = $data12->result();
        $data1['recordsFiltered'] = $data12->num_rows();

        echo json_encode($data1);

}

		public function addJobProcess(){
		$data['currentPage']='jobProcess';
		 $breadcrumb=array(
            'Dashboard'=> base_url().'dashboard',
            '/Add Job Process'=> ""

          );
          $data['breadcrumbArray']=$breadcrumb;
          $data['title']="Add Job Process";
          $data['uid']='';

	  $this->load->view('assests/header');
		$this->load->view('assests/sidebar',$data);
		$this->load->view('assests/mainContent');
	  $this->load->view('jobprocessmaster/job_Process_Master',$data);
	}


public function insertJobProcess(){
    $uid=$this->input->post('uid');
    $data['uid']=$uid;
	$Job_Process_name=$this->input->post('Job_Process_name');
	
    $this->form_validation->set_rules('Job_Process_name','','required|trim|regex_match[/^[a-zA-Z ]+$/]',array('required'=>"Please Enter Job Process Name",'regex_match' => 'Please Enter character and space in Job Process Name'));  
    $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
     
    if($this->form_validation->run()){      
        $allData=array(
            'job_process_name'=>$Job_Process_name,
            'created_date'=>date('Y-m-d H:i:s')
        );
       if($uid ==""){
          $res=$this->Webservice_general_model->insert('tbl_job_process',$allData);
       }else{
          $setFilterData['job_process_id_PK']=$uid;
          $res = $this->Webservice_general_model->update('tbl_job_process',$setFilterData, $allData);
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