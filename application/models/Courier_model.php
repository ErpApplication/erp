<?php
class Courier_model extends CI_Model{

    public function insert_courier($pdata){
    
        $result=$this->db->insert('tbl_courier',$pdata);
        return $result;
        
    }

    public function get_courier_list(){
        // Select record
        $this->db->select('courier_id_PK,courier_name,courier_address,contact_person,landline,contact_number');
        $this->db->from('tbl_courier');
        $this->db->order_by("courier_id_PK", "desc");
        $q = $this->db->get();
    
        return $q;
    }
   
    public function get_list_for_edit($userid){
        // Select record
        $this->db->select('*');
        $this->db->from('tbl_courier');
        $this->db->where('courier_id_PK',$userid);
        $q = $this->db->get();
    
        return $q->result();
    }

    public function update_courier_record($uid, $data) {
        $this->db->where('courier_id_PK', $uid);
        $result = $this->db->update('tbl_courier', $data);
        return $result;
    }

}

?>