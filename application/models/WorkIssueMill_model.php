<?php

class WorkIssueMill_model extends CI_Model
{
public function addition(){
	$query = $this->db->select_sum('aka_number', 'TakaNumber');
	$query = $this->db->get('tbl_work_issue_mill_detail');
	$result = $query->result();
	return $result[0]->TakaNumber;
}
}

?>