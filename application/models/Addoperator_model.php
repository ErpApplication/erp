<?php
class Addoperator_model extends CI_Model{
   
    public function get_country(){
        $response = array();
 
        // Select record
        $this->db->select('*');
        $q = $this->db->get('countries');
        $response = $q->result_array();
    
        return $response;
    }
    function get_state($postData)
    {
        $this->db->select('*');
        $this->db->from('states');
        $this->db->where('country_id', $postData);
        $q = $this->db->get();
        $response = $q->result_array();
    
        return $response;
    }
    public function get_cities($pdata){
        $this->db->select('*');
        $this->db->from('cities');
        $this->db->where('state_id', $pdata);
        $q = $this->db->get();
        $response = $q->result_array();
        return $response;
    }

    public function insert_operator($pdata){
    
        $result=$this->db->insert('tbl_operator',$pdata);
        return $result;
          
    }

    public function get_operator_list(){
        // Select record
        $this->db->select('user_id_PK,username,firstname,lastname');
        $this->db->from('tbl_operator');
        $q = $this->db->get();
    
        return $q;
    }


      public function get_list_for_edit($userid){
        // Select record
        $this->db->select('*');
        $this->db->from('tbl_operator');
        $this->db->where('user_id_PK',$userid);
        $q = $this->db->get();
        return $q->result();

    }

    public function update_operator_record($uid, $data) {
        $this->db->where('user_id_PK', $uid);
        $result = $this->db->update('tbl_operator', $data);
        return $result;
    }


}

?>