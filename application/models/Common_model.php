<?php
class Common_model extends CI_Model{
   
    public function get_country(){
        $response = array();
 
        // Select record
        $this->db->select('id,name');
        $q = $this->db->get('countries');
        $response = $q->result_array();
    
        return $response;
    }

public function jobProcessList(){
    $this->db->select('job_process_id_PK,job_process_name');
    $this->db->from('tbl_job_process');
    $response = $this->db->get();
    return $response->result();
}

public function bookList($purchaseId=NULL){
    $this->db->select('book_id_PK,purchase_account_name,book_number,sales_account_name');
    $this->db->from('tbl_book');
        if($purchaseId!=NULL){
          $this->db->where('type',$purchaseId);
        }
    $response = $this->db->get();
    return $response->result();
}

    public function get_cities($pdata){
        $this->db->select('id,name');
        $this->db->from('cities');
        $this->db->where('state_id', $pdata);
        $q = $this->db->get();
        $response = $q->result_array();
        return $response;
    }

    public function get_billentry_record($billEntryID){
        $this->db->select('*');
        $this->db->from('tbl_bill_entry');
        $this->db->where('bill_entry_id_PK', $billEntryID);
        $q = $this->db->get();
        $response = $q->result_array();
        return $response;   
    }

public function get_workIssueMill_record($issue_number){
        $this->db->select('*');
        $this->db->from('tbl_work_issue_mill');
        $this->db->where('issue_number', $issue_number);
        $q = $this->db->get();
        $response = $q->result();
        return $response;   
}

public function get_billentry_by_id($billEntryID){
        $this->db->select('b.*,c.name as cityName,company_name,company_id_PK,
            su.party_name as supplierName,su.supplier_id_PK as supplier_id,
            cus.party_name as customerName ,cus.supplier_id_PK as customer_id,
            suGro.group_name as supplierGroup,cusGro.group_name as customerGroup');
        $this->db->from('tbl_bill_entry as b');
        $this->db->where('bill_entry_id_PK', $billEntryID);
        $this->db->join('cities as c', 'c.id = b.city_id_FK');
        $this->db->join('tbl_company as com', 'com.company_id_PK = b.company_id_FK');
        $this->db->join('tbl_account as su', 'su.supplier_id_PK = b.supplier_id_FK');
        $this->db->join('tbl_account as cus', 'cus.supplier_id_PK = b.customer');

        $this->db->join('tbl_group as suGro', 'suGro.group_id_PK = su.group_id_FK');
        $this->db->join('tbl_group as cusGro', 'cusGro.group_id_PK = su.group_id_FK');


        $q = $this->db->get();
        $response = $q->result_array();
        return $response;   
    }

    public function get_branch_list(){
        $response = array();
 
        // Select record
        $this->db->select('branch_id_PK,branch_name');

        $q = $this->db->get('tbl_branch');
        $response = $q->result_array();
    
        return $response;
    }



    public function get_company_list($textKey=NULL){
         
        
        $response = array();
 
        // Select record
        $this->db->select('company_id_PK,company_name,c.name as companyCityName,branch_name');
        $this->db->join('tbl_branch as b', 'b.branch_id_PK = tbl_company.branch_id_FK');
        $this->db->join('cities as c', 'c.id = tbl_company.city_id_FK');
        if($textKey != NULL && $textKey != ""){
             $this->db->like('company_name', $textKey);
            $this->db->limit(20);
        }
        $branch_id = $this->session->userdata('loggedin_branch_id');
        
        if(!is_null($branch_id)){
            $this->db->where('branch_id_FK', $branch_id);
        }

        $q = $this->db->get('tbl_company');
        $response = $q->result_array();
    
        return $response;
    }
    public function get_transport_list(){
        $response = array();
 
        // Select record
        $this->db->select('transport_id_PK,transport_name');
        $q = $this->db->get('tbl_transport');
        $response = $q->result_array();
    
        return $response;
    }
    public function get_grade_list(){
        $response = array();
 
        // Select record
        $this->db->select('grade_id_PK,grade');
        $q = $this->db->get('tbl_grade');
        $response = $q->result_array();
    
        return $response;
    }
    public function get_accounttype_list(){
        $response = array();
 
        // Select record
        $this->db->select('account_type_id_PK,name');
        $q = $this->db->get('tbl_account_type');
        $response = $q->result_array();
    
        return $response;
    }
    public function get_customertype_list(){
        $response = array();
 
        // Select record
        $this->db->select('customer_type_id_PK,customer_type');
        $q = $this->db->get('tbl_customer_type');
        $response = $q->result_array();
    
        return $response;
    }

    public function get_companytype_list(){
        $response = array();
 
        // Select record
        $this->db->select('compnay_type_id_PK,company_type');
        $q = $this->db->get('tbl_company_type');
        $response = $q->result_array();
    
        return $response;
    }

    public function get_payments_record($PaymentID){
        $this->db->select('*');
        $this->db->from('tbl_payment_entry');
        $this->db->where('payment_entry_id_PK', $PaymentID);
        $q = $this->db->get();
        $response = $q->result_array();
        return $response;   
    }

    public function get_goods_record($billEntryID){
        $this->db->select('*');
        $this->db->from('tbl_GoodsReturn');
        $this->db->where('goodreturn_id_PK', $billEntryID);
        $q = $this->db->get();
        $response = $q->result_array();
        return $response;        
    }


    public function GetSupplierList($type,$textKey=NULL){

        $this->db->select('supplier.supplier_id_PK,supplier.party_name,group.group_name,city.name as city,
            owner_mobile,account.name');
        $this->db->from('tbl_account as supplier');
        if($type != ""){
            $this->db->where('account_type_id_FK',$type);
        }
        $this->db->join('tbl_group as group', 'group.group_id_PK = supplier.group_id_FK');
        
        $this->db->join('tbl_account_type as account', 'group.account_type_id_FK = account.account_type_id_PK');
        $this->db->join('cities as city', 'group.city_id_FK = city.id');

        if($textKey != NULL && $textKey != ""){
            $this->db->like('party_name', $textKey);
            $this->db->limit(20);
        }
       
        $q = $this->db->get();
        //echo $this->db->last_query();exit();
        
        return $q->result();

   }


   public function GetSupplierListWithCommission($type,$textKey=NULL){
        $this->db->select('supplier.supplier_id_PK,supplier.party_name,group.group_name,city.name as city,
            commission,owner_mobile,account.name,grade_id_FK,grade,month');
        $this->db->from('tbl_account as supplier');
        if($type != ""){
            $this->db->where('account_type_id_FK',$type);
        }
        $this->db->join('tbl_group as group', 'group.group_id_PK = supplier.group_id_FK');
        
        $this->db->join('tbl_account_type as account', 'group.account_type_id_FK = account.account_type_id_PK');
        $this->db->join('cities as city', 'group.city_id_FK = city.id');
        $this->db->join('tbl_grade as g', 'g.grade_id_PK = group.grade_id_FK');

        if($textKey != NULL && $textKey != ""){
            $this->db->like('party_name', $textKey);
            $this->db->limit(20);
        }
       
        $q = $this->db->get();
        //echo $this->db->last_query();exit();
        
        return $q->result();

   }


   public function GetGroupList($textKey=NULL){

        $this->db->select('group_id_PK,group.group_name,city.name as city,accountType.name');
        $this->db->from('tbl_group as group');
        $this->db->join('cities as city', 'group.city_id_FK = city.id');
        $this->db->join('tbl_account_type as accountType', 'group.account_type_id_FK = accountType.account_type_id_PK');

        if($textKey != NULL && $textKey != ""){
            $this->db->like('group.group_name', $textKey);
            $this->db->limit(20);
        }
        $q = $this->db->get();
        // echo $this->db->last_query();exit();
        
        return $q->result();

   }


    public function GetSupplierGroupByID($id){

        $this->db->select('group.group_name,c.name as cityName');
        $this->db->from('tbl_account as supplier');
        $this->db->join('tbl_group as group', 'group.group_id_PK = supplier.group_id_FK');
        $this->db->join('cities as c', 'c.id = group.city_id_FK');
        
         $this->db->where('supplier_id_PK', $id);
       
        $q = $this->db->get();
        //echo $this->db->last_query();exit();
        
        return $q->row();

   }

   public function getCompanyDetails($id){
    $this->db->select('*');
    $this->db->from('tbl_company');
    $this->db->where('company_id_PK',$id);
    $q = $this->db->get();
    return $q->row();
   }

    public function getSupplierDetails($id){
        $this->db->select('*');
        $this->db->from('tbl_account');
        $this->db->where('supplier_id_PK',$id);
        $q = $this->db->get();
        return $q->row();
    }

    public function getGoodsReturnBills($id){
        $this->db->select('*,c.total_bill_amount');
        $this->db->from('tbl_goods_return_bills as grb');
        $this->db->where('goods_return_id_FK',$id);
        $this->db->join('tbl_bill_entry as c', 'grb.bill_entry_id_fk = c.bill_entry_id_PK');
        $q = $this->db->get();
        return $q->result_array();
    }


    public function get_Zone_list_by_name($name)
    {
        // Select record
        $this->db->select('*');
        $this->db->from('tbl_zone');
        $this->db->like('name', $name, 'both');
        $q = $this->db->get();

        return $q->result();
    }

    public function getSupplierNameAndGroup($id){
        $this->db->select('party_name,group_name,c.name as cityName');
        $this->db->from('tbl_account as s');
        $this->db->join('tbl_group as g', 'g.group_id_PK = s.group_id_FK');
        $this->db->join('cities as c', 'c.id = s.city_id_FK');
        $this->db->where('supplier_id_PK',$id);
        $q = $this->db->get();
        return $q->row();
    }
    
     public function get_account(){
        $response = array();
 
        // Select record
        $this->db->select('*');
        $this->db->from('tbl_account_type');
        $acc = $this->db->get('');
        $response = $acc->result();
    
        return $response;
    }
   public function get_state($country_id){
        $response = array();
 
        // Select record
        $this->db->select('*');
        $this->db->from('states');
        $this->db->where('country_id',$country_id);
        $s = $this->db->get('');
        $response = $s->result();
    
        return $response;
    }

    public function get_city($state_id){
        
        $response = array();
 
        // Select record
        $this->db->select('*');
        $this->db->from('cities');
        $this->db->where('state_id',$state_id);
        $c = $this->db->get();
        $response = $c->result();
    
        return $response;
    }


public function get_broker($brokerName){  
        $this->db->select('broker_id_PK,broker_name as name,city_id_FK,phone_number');
        $this->db->from('tbl_broker');
        $this->db->like('broker_name', $brokerName, 'both');
        $c = $this->db->get();
        $response = $c->result();
        return $response;
}

public function get_accountMaster($accountMasterName){  
        $this->db->select('accountMaster_id_PK,name,city_id_FK,contactNumber');
        $this->db->from('tbl_account_master');
        $this->db->like('name', $accountMasterName, 'both');
        $c = $this->db->get();
        $response = $c->result();
        return $response;
}

public function get_transport($transportName){  
        $this->db->select('transport_id_PK,transport_name as name,city_id_FK,contact_mobile');
        $this->db->from('tbl_transport');
        $this->db->like('transport_name', $transportName, 'both');
        $c = $this->db->get();
        $response = $c->result();
        return $response;
}

public function get_iteam($iteamName){  
        $this->db->select('iteam_master_id_PK,iteam_name as name,mrp,iteam_cut');
        $this->db->from('tbl_iteammaster');
        $this->db->like('iteam_name', $iteamName, 'both');
        $c = $this->db->get();
        $response = $c->result();
        return $response;
}

public function get_billPurchaseNo($party_id,$broker_id,$bill_no){  
    $this->db->select('wm.purchase_master_id_PK,wm.purchase_bill_no,wm.bill_date,p.name,b.broker_name');
    $this->db->from('tbl_purchasemaster as wm');
    $this->db->where('wm.purchase_party_id_FK',$party_id);
    $this->db->where('wm.broker_id_FK',$broker_id);
    $this->db->join('tbl_account_master as p','p.accountMaster_id_PK=wm.purchase_party_id_FK');
    $this->db->join('tbl_broker as b','b.broker_id_PK=wm.broker_id_FK');
    $this->db->like('wm.purchase_bill_no', $bill_no,'both');
    $c = $this->db->get();
    $response = $c->result();
    return $response;
}

public function get_receiveChallanNo($mill_id,$broker_id,$challanNo){  
    $this->db->select('wm.work_issue_mill_id_PK,wm.issue_number,wm.rate,p.name,b.broker_name');
    $this->db->from('tbl_work_issue_mill as wm');
    $this->db->where('wm.mill_party_id_FK',$mill_id);
    $this->db->where('wm.broker_id_FK',$broker_id);
    $this->db->join('tbl_account_master as p','p.accountMaster_id_PK=wm.mill_party_id_FK');
    $this->db->join('tbl_broker as b','b.broker_id_PK=wm.broker_id_FK');
    $this->db->like('wm.issue_number', $challanNo,'both');
    $c = $this->db->get();
    $response = $c->result();
    return $response;
}

public function get_workReceiveDispatchChallanNo($mill_id,$broker_id,$challanNo){  
    $this->db->select('wm.dispatchMaster_id_PK,wm.challanNo,p.name,b.broker_name');
    $this->db->from('tbl_dispatchmaster as wm');
    $this->db->where('wm.party_id_FK',$mill_id);
    $this->db->where('wm.broker_id_FK',$broker_id);
    $this->db->join('tbl_account_master as p','p.accountMaster_id_PK=wm.party_id_FK');
    $this->db->join('tbl_broker as b','b.broker_id_PK=wm.broker_id_FK');
    $this->db->like('wm.challanNo', $challanNo,'both');
    $c = $this->db->get();
    $response = $c->result();
    return $response;
}

public function get_workReceiveDispatchIteam($dispatch_id,$iteam){  
    $this->db->select('wm.dispatchMasterDetail_id_PK,p.iteam_name');
    $this->db->from('tbl_dispatchmaster_detail as wm');
    $this->db->where('wm.dispatchMaster_id_FK',$dispatch_id);
    $this->db->join('tbl_iteammaster as p','p.iteam_master_id_PK=wm.issue_quality_id_FK');
    $this->db->join('tbl_dispatchmaster as dm','dm.dispatchMaster_id_PK=wm.dispatchMaster_id_FK');
    $this->db->like('p.iteam_name',$iteam,'both');
    $c = $this->db->get();
    $response = $c->result();
    return $response;
}

public function get_allDataByChallanNo($issueBillId,$taka_number){  
    $this->db->select('wm.work_issue_mill_detail_id_PK,wm.taka_number,wm.meters,wm.remark');
    $this->db->from('tbl_work_issue_mill_detail as wm');
    $this->db->join('tbl_work_issue_mill as w','w.work_issue_mill_id_PK=wm.work_issue_mill_id_FK');
    $this->db->where('w.work_issue_mill_id_PK',$issueBillId);
    $this->db->like('wm.taka_number', $taka_number,'both');

    $c = $this->db->get();
    $response = $c->result();
     return $response;
}

public function get_salesDetailByChallanNo($challan_number){
    $this->db->select('c.challan_id_PK,
        c.challan_no,b.broker_name, a.name as partyName,
        t.transport_name,t.transport_id_PK,
        c.vehicle_no,c.lr_no,c.lr_date,c.station,
        c.trans_id,c.delivery,c.packing,c.bill_amount,
        c.case_no,a.accountMaster_id_PK,
        b.broker_id_PK
        ');

    $this->db->from('tbl_challan as c');
    $this->db->join('tbl_account_master as a','a.accountMaster_id_PK=c.party_id_FK');
    $this->db->join('tbl_broker as b','b.broker_id_PK=c.broker_id_FK');
    $this->db->join('tbl_transport as t','t.transport_id_PK=c.transport_id_FK');
    $this->db->like('c.challan_no', $challan_number,'both');
    $q = $this->db->get();
    $response = $q->result();
    return $response;   
}

public function get_ChallanNoDetails($challan_number){
    $this->db->select('c.challanDetail_id_PK,c.discription,c.piece,c.cut,c.quantity,c.pm,c.rate,c.amount,i.iteam_master_id_PK,i.iteam_name,i.sgst,i.cgst');
    $this->db->from('tbl_challandetail as c');
    $this->db->join('tbl_iteammaster as i','iteam_master_id_PK=quality_name_id_FK','both');
    $this->db->where('challan_id_FK',$challan_number);
    $q = $this->db->get();
    $response = $q->result();
    return $response;   
}

public function get_sallesBill($accountId){
    $this->db->select('c.sales_master_id_PK,c.bill_number');
    $this->db->from('tbl_salesmaster as c');
    $this->db->where('party_id_FK',$accountId);
    $q = $this->db->get();
    $response = $q->result();
    return $response;   
}

}
?>