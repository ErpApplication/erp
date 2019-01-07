<?php
class BankMasterModel extends CI_Model{
   
    public function insert_bank($pdata){
    
        $result=$this->db->insert('tbl_bank',$pdata);
        return $result;
        
    }

    public function get_bank_list(){
       
        $this->db->select('bank_id_PK,bank_name,address,bank.country_id_FK,bank.state_id_FK,bank.city_id_FK,pincode,country.name as country,state.name as state,city.name as city');
        $this->db->from('tbl_bank as bank');
        $this->db->join('countries as country','bank.country_id_FK=country.id');
        $this->db->join('states as state','bank.state_id_FK=state.id');
        $this->db->join('cities as city','bank.city_id_FK=city.id');
        $this->db->order_by("bank_id_PK", "desc");
        $q = $this->db->get();  
        return $q;
    }
   
    public function get_banklist_for_edit($userid){
        // Select record
        $this->db->select('*');
        $this->db->from('tbl_bank');
        $this->db->where('bank_id_PK',$userid);
        $q = $this->db->get();
    
        return $q->result();
    }

    public function update_bank_record($uid, $data) {
        $this->db->where('bank_id_PK', $uid);
        $result = $this->db->update('tbl_bank', $data);
        return $result;
    }



}

?>