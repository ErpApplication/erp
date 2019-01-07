<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dashboard_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function userCount() {
        $qry = "
                SELECT COUNT(*) AS count
                FROM tbl_user
               
               ";
        $query = $this->db->query($qry);
        //Check old user Details exist or not
        if($query->num_rows()>0) {
            $result =  $query->row();
            return $result;
        } else {
            return false;
        }
    }

    public function offerCOunt() {
        $qry = "
                SELECT COUNT(*) AS count
                FROM tbl_offer
               ";
        $query = $this->db->query($qry);
        //Check old user Details exist or not
        if($query->num_rows()>0) {
            $result =  $query->row();
            return $result;
        } else {
            return false;
        }
    }

    public function orderCount() {
        $qry = "
                SELECT COUNT(*) AS count
                FROM   tbl_order
               ";
        $query = $this->db->query($qry);
        //Check old user Details exist or not
        if($query->num_rows()>0) {
            $result =  $query->row();
            return $result;
        } else {
            return false;
        }
    }


    public function productCount() {
        $qry = "
                SELECT COUNT(*) AS count
                FROM tbl_product
               ";
        $query = $this->db->query($qry);
        //Check old user Details exist or not
        if($query->num_rows()>0) {
            $result =  $query->row();
            return $result;
        } else {
            return false;
        }
    }

    public function cookDishCount($user_id) {
        $qry = "
                SELECT COUNT(*) AS count
                FROM dishes WHERE created_by =  ".$user_id."
               ";
        $query = $this->db->query($qry);
        //Check old user Details exist or not
        if($query->num_rows()>0) {
            $result =  $query->row();
            return $result;
        } else {
            return false;
        }
    }


    public function cookOrderCount($user_id) {
        $qry = "
                SELECT COUNT(*) AS count
                FROM  tbl_order WHERE cook_id_FK = ".$user_id."
               ";
        $query = $this->db->query($qry);
        //Check old user Details exist or not
        if($query->num_rows()>0) {
            $result =  $query->row();
            return $result;
        } else {
            return false;
        }
    }


}
?>