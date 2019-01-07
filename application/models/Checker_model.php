<?php
class Checker_model extends CI_Model{
   
    public function insert_checker($pdata){
    
        $result=$this->db->insert('tbl_checker',$pdata);
        return $result;
          
    }

    public function get_list_for_edit($checkerid){
        // Select record
        $this->db->select('*');
        $this->db->from('tbl_checker');
        $this->db->where('checker_id_PK',$checkerid);
        $q = $this->db->get();
        return $q->result();

    }

    public function update_checker_record($uid, $data) {
        $this->db->where('checker_id_PK', $uid);
        $result = $this->db->update('tbl_checker', $data);
        return $result;
    }


}

?>