<?php
class Zone_model extends CI_Model{
   
    public function insert_zone($pdata){
    
        $result=$this->db->insert('tbl_zone',$pdata);
        return $result;
        
    }

    public function get_zone_list(){
        // Select record
        $this->db->select('zone_id_PK,name');
        $this->db->from('tbl_zone');
        $this->db->order_by("zone_id_PK", "desc");
        $q = $this->db->get();
        return $q->result();
    }
   
    public function get_zonelist_for_edit($userid){
        // Select record
        $this->db->select('*');
        $this->db->from('tbl_zone');
        $this->db->where('zone_id_PK',$userid);
        $q = $this->db->get();
    
        return $q->result();
    }

    public function update_zone_record($uid, $data) {
        $this->db->where('zone_id_PK', $uid);
        $result = $this->db->update('tbl_zone', $data);
        return $result;
    }

    public function CheckZoneName($checkName) {
        $this->db->select('name');
        $this->db->from('tbl_zone');
        $this->db->where('name',$checkName);

        $q = $this->db->get();
        $count=$q->num_rows();
        return $count;
    
        
    }


}

?>