<?php
class Transport_model extends CI_Model{
   
    public function insert_transport($pdata){
    
        $result=$this->db->insert('tbl_transport',$pdata);
           return $result;
         
    }

    public function get_transport_list(){
        // Select record
        $this->db->select('transport_id_PK,transport_name,transport_address,contact_person,landline,contact_mobile');
        $this->db->from('tbl_transport');
        $this->db->order_by("transport_id_PK", "desc");
        $q = $this->db->get();
    
        return $q;
    }
   
    public function get_list_for_transport_edit($userid){
        // Select record
        $this->db->select('*');
        $this->db->from('tbl_transport');
        $this->db->where('transport_id_PK',$userid);
        $q = $this->db->get();
    
        return $q->result();
    }

    public function update_transport_record($uid, $data) {
        $this->db->where('transport_id_PK', $uid);
        $result = $this->db->update('tbl_transport', $data);
        return $result;
    }

}

?>