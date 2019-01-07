<?php
class Branch_model extends CI_Model{
   
    public function insert_branch($pdata){
    
        $result=$this->db->insert('tbl_branch',$pdata);
        return $result;
        
    }

    public function get_branch_list(){
        // Select record
        $this->db->select('branch_id_PK,branch_name,branch_address,manager_number,manager_email');
        $this->db->from('tbl_branch');
        $this->db->order_by("branch_id_PK", "desc");
        $q = $this->db->get();
    
        return $q;
    }
   
    public function get_branchlist_for_edit($userid){
        // Select record
        $this->db->select('*');
        $this->db->from('tbl_branch');
        $this->db->where('branch_id_PK',$userid);
        $q = $this->db->get();
    
        return $q->result();
    }

    public function update_branch_record($uid, $data) {
        $this->db->where('branch_id_PK', $uid);
        $result = $this->db->update('tbl_branch', $data);
        return $result;
    }

    function fetch_data($query){

      $this->db->select('branch_id_PK,branch_name as value,branch_address,manager_number,manager_email');
      $this->db->from("tbl_branch");
      $this->db->like('branch_name', $query);
      $this->db->order_by('branch_id_PK', 'DESC');
      $query=$this->db->get();
      return $query->result();
    }

}

?>