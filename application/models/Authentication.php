<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Model {

    /**
     * Read data using username and password
     * @param type $data
     * @return boolean
     */
    public function login($data) {
        $condition = "username =" . "'" . $data['email'] . "' AND " . "password =" . "'" . $data['password']. "'";
        $this->db->select('*');
        $this->db->from('tbl_operator');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            $session_data = array(
                'id' => $result[0]->user_id_PK,
                'username' => $result[0]->username
            );
            // Add user data in session
            $this->session->set_userdata('user', $session_data);
            return true;
        } else {
            return false;
        }
    }

}
