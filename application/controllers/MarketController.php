<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MarketController extends CI_Controller {

    private $_user;

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->model('Addoperator_model');
        $this->load->model('Zone_model');
        $this->load->model('Market_model');
        $this->load->model('Common_model');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }
    }

    public function index() {
        $data['currentPage'] = "market";
        $this->load->view('market/marketList',$data);
    }


    public function marketListwebAPI(){

        $start = $_GET['start'];
        $length = $_GET['length'];
        $search = $_GET['search']["value"];

        $data = $this->db->query("SELECT market_id_PK as id, name,zone_id_FK FROM `tbl_market`as user WHERE name LIKE '%".$search."%' order by id Desc limit ".$start.",".$length."");

        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT market_id_PK as id, name,zone_id_FK FROM `tbl_market`");
        $result1 = $data12->result();
        $data1['recordsFiltered'] = $data12->num_rows();

        echo json_encode($data1);

 }


    public function MarketAdd(){
       $uid = $this->input->post('uid');
       $data['uid']=$uid;
        //echo json_encode($this->input->post());die;
        $name = $this->input->post('name');
        $zone_id = $this->input->post('zone_id');
      

        $this->form_validation->set_rules('name','','required|is_unique[tbl_market.name]|trim|regex_match[/^[a-zA-Z0-9 ]+$/]',array('required'=>"Please Enter Market Name",'regex_match' => 'Please Enter alphanumeric and space in Market Name','is_unique'=>'This Market Name is already exists')); 
        $this->form_validation->set_rules('zone_id','','required',array('required'=>"Please Select Zone")); 
      
        $this->form_validation->set_error_delimiters('<li class="err">', '</li></br>');
        if($this->form_validation->run()){      
        $data=array(
            
            'name'=>$name,
            'zone_id_FK'=>$zone_id
            
        );
      
        if($uid ==""){
          $res=$this->Market_model->insert_market($data);
        }else{
          $res = $this->Market_model->update_market_record($uid, $data);
        }

        if ($res)
        {
            $data["status"] = 1;
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
