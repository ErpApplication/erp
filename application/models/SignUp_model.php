<?php

/**
* 
*/
class SignUp_model extends CI_Model
{
	
	public function __construct(){
		parent::__construct();
	}

	public function insert($pdata){
		$this->db->insert('tbl_agency',$pdata);
	}
}

?>