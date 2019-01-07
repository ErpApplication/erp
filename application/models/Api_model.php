<?php

class Api_model extends CI_model
{
	
    public function get_country(){
        $response = array();
 
        // Select record
        $this->db->select('*');
        $q = $this->db->get('tbl_country');
        $response = $q->result_array();
        return $response;
    }
    function get_state($postData)
    {
        $this->db->select('*');
        $this->db->from('tbl_state');
        $this->db->where('country_id_FK', $postData);
        $q = $this->db->get();
        $response = $q->result_array();
    
        return $response;
    }
    public function get_cities($pdata){
        $this->db->select('*');
        $this->db->from('tbl_city');
        $this->db->where('state_id_FK', $pdata);
        $q = $this->db->get();
        $response = $q->result_array();
        return $response;
    }
}

?>