<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User_model extends CI_Model {

     public function __construct() {
        $this->load->database();
    }


    

    /**
     * 
     * @param type $user_id
     * @return type
     */
    public function get_dish_list_by_user($user_id) {
        $this->db->select(['id', 'dish_name', 'slots', 'category', 'cuisine', 'dish_price', 'created_at', 'status', 'is_approved', 'approved_at']);
        $this->db->from('dishes');
        $this->db->where('created_by', $user_id);
        $query = $this->db->get();
        return $query->result();
    }
    
     /**
     * 
     * @param type $user_id
     * @return type
     */
    
    public function get_user_detail_by_id($user_id) {
        $this->db->select('t1.first_name, t1.last_name, t1.email, t1.password_at_reg');
        $this->db->from('users AS t1');
        $this->db->where('t1.id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }

    
    

    public function user_list_by_role(){
        $this->db->select(['user_id_PK as id', 'name', 'email', 'mobile', 'profile','created_date','isActive']);
        $this->db->from('tbl_user');
        $query = $this->db->get();
        return $query->result();
    }
}
