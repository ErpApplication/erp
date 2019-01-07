<?php
class Api extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
        $this->load->model('Common_model');
        $this->load->model('Addoperator_model');
        $this->load->model('Zone_model');
		$this->load->model('Company_model');
	}

    public function BranchList(){
        $branch_list = $this->Common_model->get_branch_list();
        $data['branch_list'] = $branch_list;
        echo json_encode($data);
    }

    public function get_state_data(){ 
        // POST data 
        $postData = $this->input->post('country_id');
    
        // get data 
       $data = $this->Addoperator_model->get_state($postData);
    
        echo json_encode($data); 
    }

    public function get_city_data(){ 
        // POST data 
         $postData = $this->input->post('state_id');
    
        // get data 
          $data = $this->Addoperator_model->get_cities($postData);
    
        echo json_encode($data); 
    }

    public function zoneList(){
        $zone_list = $this->Zone_model->get_zone_list();
        $data['zone_list'] = $zone_list;
        echo json_encode($data);
    }

    public function companyTypeList(){
        $companyType_list = $this->Company_model->companyTypeList();
        $data['companyType_list'] = $companyType_list;
        echo json_encode($data);
    }

        public function get_data_exist_universal()
    {

        $tableName = $this->input->post('tableName');
        $ColumnName = $this->input->post('ColumnName');
        $text = $this->input->post('text');

        if (get_data_exist("tbl_".$tableName,$ColumnName,$text) == "false")

        {
            $data["status"] = "false";
            $data["data"] = "";
            echo json_encode($data);

        }else
        {
            $data["status"] = "true";
            $data["data"] = get_data_exist("tbl_".$tableName,$ColumnName,$text);
            
            echo json_encode($data);


        }

    }



}
?>