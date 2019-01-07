<?php
class Company_model extends CI_Model{
   
    public function insert_company($pdata){
        $result=$this->db->insert('tbl_company',$pdata);
        return $this->db->insert_id();
    }

    public function checkDefaultCompanyExist($user_id){
        $this->db->select('company_id_PK');
        $this->db->from('tbl_company');
        $this->db->where('operator_id_FK', $user_id);
        $query = $this->db->get();
        return $query->num_rows();
    }


      public function getDefaultCompany($user_id){
        // Select record
        $this->db->select('company_id_PK,company_name,company_address,company_owner,owner_number');
        $this->db->from('tbl_company as c');
        $this->db->where('d.operator_id_FK', $user_id);
        $this->db->join(' tbl_default_company as d', 'd.company_id_FK = c.company_id_PK');
        $query = $this->db->get();
        $result = $query->row();  
        return $result;
    }


    public function get_company_list(){
        // Select record
        $this->db->select('company_id_PK,company_name,company_address,company_owner,owner_number');
        $this->db->from('tbl_company');
        $branch_id = $this->session->userdata('loggedin_branch_id');
        
        if(!is_null($branch_id)){
            $this->db->where('branch_id_FK', $branch_id);
        }
        $this->db->order_by("company_id_PK", "desc");

        $query = $this->db->get();

        $result = $query->result();  
        foreach ($result as $key => $row) {

            $this->db->select('company_id_FK');
            $this->db->from('tbl_default_company');
            $this->db->where('company_id_FK', $result[$key]->company_id_PK);
            $this->db->where('operator_id_FK', $this->session->userdata['user_id']);
            $checkCompanyExist = $this->db->get();
            if($checkCompanyExist->num_rows() ==0){
                $result[$key]->isSetDefault = 0;
            }else{
                $result[$key]->isSetDefault = 1;
            }  
        }
    
        return $result;
    }
   
    public function get_companylist_for_edit($userid){
        // Select record
        $this->db->select('company.*,branch.branch_name');
        $this->db->from('tbl_company as company');
        $this->db->where('company_id_PK',$userid);
        $this->db->join(' tbl_branch as branch', 'branch.branch_id_PK = company.branch_id_FK');

        $q = $this->db->get();
    
        return $q->result();
    }

    public function update_company_record($uid, $data) {
        $this->db->where('company_id_PK', $uid);
        $result = $this->db->update('tbl_company', $data);
        return $result;
    }

    public function companyTypeList(){
        $this->db->select('compnay_type_id_PK,company_type');
        $this->db->from('tbl_company_type');
        $q=$this->db->get();
        return $q->result();
    }

 

}

?>