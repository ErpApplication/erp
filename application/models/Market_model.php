<?php
class Market_model extends CI_Model{
   
    public function insert_market($pdata){
    
        $result=$this->db->insert('tbl_market',$pdata);
        return $result;
        
    }

    public function insert_market_modal($pdata){

        $this->db->insert('tbl_market',$pdata);
        return $this->db->insert_id();;

    }

    public function get_market_list(){
        // Select record
        $this->db->select('market_id_PK,name,zone_id_FK');
        $this->db->from('tbl_market');
        $this->db->order_by("market_id_PK", "desc");
        $q = $this->db->get();
    
        return $q;
    }
   
    public function get_marketlist_for_edit($userid){
        // Select record
        $this->db->select('*');
        $this->db->from('tbl_market');
        $this->db->where('market_id_PK',$userid);
        $q = $this->db->get();
    
        return $q->result();
    }

    public function update_market_record($uid, $data) {
        $this->db->where('market_id_PK', $uid);
        $result = $this->db->update('tbl_market', $data);
        return $result;
    }

    public function CheckMarketName($checkName,$uid) {
        $this->db->select('name');
        $this->db->from('tbl_market');
        $this->db->where('name',$checkName);
        $this->db->where('market_id_PK',$uid);
        $q = $this->db->get();
        if($q->num_rows() == 0){
            $this->db->select('name');
            $this->db->from('tbl_market');
            $this->db->where('name',$checkName);
            $q1 = $this->db->get();
            return $q1->num_rows();
        }else{
            return  -1;
        }
    }


    public function get_zone_list(){
        // Select record
        $this->db->select('zone_id_PK,name');
        $this->db->from('tbl_zone');
        $q = $this->db->get();
    
        return $q->result();
    }


}

?>