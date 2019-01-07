<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Zone extends CI_Controller {

    private $_user;

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->model('Addoperator_model');
        $this->load->model('Zone_model');
        $this->load->model('Common_model');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }
    }

    public function index() {
        $data['currentPage'] = "zone";
        $this->load->view('zone/zoneList',$data);
    }


    public function zoneListwebAPI(){

        $start = $_GET['start'];
        $length = $_GET['length'];
        $search = $_GET['search']["value"];

        $data = $this->db->query("SELECT zone_id_PK as id, name FROM `tbl_zone`as user WHERE name LIKE '%".$search."%' order by id Desc limit ".$start.",".$length."");

        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT zone_id_PK as id, name FROM `tbl_zone`");
        $result1 = $data12->result();
        $data1['recordsFiltered'] = $data12->num_rows();

        echo json_encode($data1);

 }

    public function ZoneAdd(){
       $uid = $this->input->post('uid');
       $data['uid']=$uid;

        $name = $this->input->post('name');
      

        $this->form_validation->set_rules('name','','required|is_unique[tbl_zone.name]|trim|regex_match[/^[a-zA-Z0-9 ]+$/]',array('required'=>"Please Enter Zone Name",'regex_match' => 'Please Enter alphanumeric and space in Zone Name','is_unique'=>'This Zone Name is already exists')); 
      
        $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
        if($this->form_validation->run()){      
        $data=array(
            
            'name'=>$name,
            
        );
      
        if($uid ==""){
            $res=$this->Zone_model->insert_zone($data);
        }else{
            $res = $this->Zone_model->update_zone_record($uid, $data);
        }

        if ($res)
        {
            $data["status"] = 1;
            $data["data"] = $res;
            echo json_encode($data);     
        }
                
        else
        {
            $data["status"] = 0;
           echo json_encode($data);
        }
        }else{

            $data['message']=validation_errors();
        
            $data["status"] = 0;
            echo json_encode($data);
        }
      
   }

}
