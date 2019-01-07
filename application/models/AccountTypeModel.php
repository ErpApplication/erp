<?php 
class AccountTypeModel extends CI_Model
{
	
	 public function get_account(){
        $response = array();
 
        // Select record
        $this->db->select('*');
        $this->db->from('tbl_account_type');
        $q = $this->db->get();
        $response = $q->result();
    
        return $response;
    }

   public function get_state($country_id){
        $response = array();
 
        // Select record
        $this->db->select('*');
        $this->db->from('states');
        $this->db->where('country_id',$country_id);
        $s = $this->db->get('');
        $response = $s->result();
    
        return $response;
    }
}
 ?>