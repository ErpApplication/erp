<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Master_model extends CI_Model {

     public function __construct() {
        $this->load->database();
        
    }

    public function insertVariation($tdata,$pdata){
        $this->db->insert($tdata,$pdata);
        return $this->db->insert_id();
    }


    public function get_company_list(){
        $this->db->select('company_id_PK,name,type,logo,isActive');
        $this->db->from('tbl_company');
        $query = $this->db->get();
        return $query->result();
    } 

    public function get_cat_list(){
        $this->db->select('category_id_PK,name,parent_id,isActive');
        $this->db->from('tbl_category');
        $this->db->order_by('category_id_PK','desc');
        $this->db->where('parent_id','0');
        $query = $this->db->get();
        return $query->result();
    } 

    public function get_subcat_list(){
        $this->db->select('sc.category_id_PK,sc.name,sc.parent_id,sc.isActive,c.name as catName');
        $this->db->from('tbl_category as sc');
         $this->db->order_by('category_id_PK','desc');
        $this->db->where('sc.parent_id != ','0');
        $this->db->join('tbl_category as c', 'c.category_id_PK = sc.parent_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_variation_list(){
        $this->db->select('variation_id_PK,variation_name');
        $this->db->from('tbl_variation');
        $this->db->order_by('variation_id_PK','desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_oe_list(){
        $this->db->select('OE_id_PK,OE_part,isActive');
        $this->db->from('tbl_OE_part');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_gg_list(){
        $this->db->select('GG_part_id_PK,GG_part,isActive');
        $this->db->from('tbl_GG_part');
        $query = $this->db->get();
        return $query->result();
    }

    


}
