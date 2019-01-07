<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiController extends CI_Controller {

    public function __construct(){
        parent::__construct();
       $this->load->model('Common_model');
       $this->load->model('General_model');
       $this->load->library('form_validation');
       $this->load->model('Api_model');

       $this->load->helper('date');
           
    }

    public function GetSupplierList(){
      $textKey = $this->input->post('textKey');

        if($groupDetail=$this->Common_model->GetSupplierList("1",$textKey)){
            echo json_encode($groupDetail);
        }else{
            $data = array();
            echo json_encode($data);
        }
    }

public function getBroker(){
  $brokerName=$this->input->post('BrokerName');
  $bokerDetail=$this->Common_model->get_broker($brokerName);
  echo json_encode($bokerDetail);
}

public function getAccountMaster(){
  $accountMasterName=$this->input->post('millPartyName');
  $accountMasterDetail=$this->Common_model->get_accountMaster($accountMasterName);
  echo json_encode($accountMasterDetail);
}

public function getTransport(){
  $transportName=$this->input->post('TransportName');
  $transportDetail=$this->Common_model->get_transport($transportName);
  echo json_encode($transportDetail);
}

public function get_Iteam(){
  $iteamName=$this->input->post('IteamName');
  $iteamDetail=$this->Common_model->get_iteam($iteamName);
  echo json_encode($iteamDetail);
}

public function get_purchasebillNo(){
  
  $billNo=$this->input->post('billNo');
  $partyId=$this->input->post('partyId');
  $brokerId=$this->input->post('brokerId');
  
  $purchaseBillNoDetail=$this->Common_model->get_billPurchaseNo($partyId,$brokerId,$billNo);
  echo json_encode($purchaseBillNoDetail);
}

public function get_receiveChallanNo(){
  
  $challanNo=$this->input->post('challanNo');
  $millId=$this->input->post('millId');
  $brokerId=$this->input->post('brokerId');
  $receiveChallanNoDetail=$this->Common_model->get_receiveChallanNo($millId,$brokerId,$challanNo);
  echo json_encode($receiveChallanNoDetail);
}

public function get_salesDetailByChallanNo(){
  header('Content-Type:application/json');
  $challanNo=$this->input->post('challanNo');
  $salesChallanNoDetail=$this->Common_model->get_salesDetailByChallanNo($challanNo);

  $ChallanValue = array();
  foreach ($salesChallanNoDetail as $key => $value) {
    
    $value->challanDetail = $this->Common_model->get_ChallanNoDetails($value->challan_id_PK);
    $ChallanValue[] = $value;

  }
  echo json_encode($ChallanValue);
}

public function get_sallesBill(){
  
  $accountId=$this->input->post('accountId');
  $salessAccountDetail=$this->Common_model->get_sallesBill($accountId);
  echo json_encode($salessAccountDetail);
}


public function get_workReceiveDispatchChallanNo(){
  
  $challanNo=$this->input->post('challanNo');
  $millId=$this->input->post('millId');
  $brokerId=$this->input->post('brokerId');
  $receiveChallanNoDetail=$this->Common_model->get_workReceiveDispatchChallanNo($millId,$brokerId,$challanNo);
  echo json_encode($receiveChallanNoDetail);
}

public function get_workReceiveDispatchIteam(){
  $challanNo=$this->input->post('ChallanNo');
  $item=$this->input->post('item');
  $receiveIteamDetail=$this->Common_model->get_workReceiveDispatchIteam($challanNo,$item);
  echo json_encode($receiveIteamDetail);
}

public function get_receiveDetail(){
  $issueMillId=$this->input->post('issueBillId');
  $takaId=$this->input->post('takaId');

  $receiveMillDetail=$this->Common_model->get_allDataByChallanNo($issueMillId,$takaId);
  echo json_encode($receiveMillDetail);
}

public function get_workIssueMillDetail(){
  $issueNumber=$this->input->post('issueNumber');
  $workIssueMillDetail=$this->Common_model->get_workIssueMill_record($issueNumber);
  echo json_encode($workIssueMillDetail);
}

public function GetSupplierListWithCommission(){
      $textKey = $this->input->post('textKey');
      $type = $this->input->post('type');
      if(empty($type)){
          $type = 1;
      }

        if($groupDetail=$this->Common_model->GetSupplierListWithCommission($type,$textKey)){
            echo json_encode($groupDetail);
        }else{
            $data = array();
            echo json_encode($data);
        }
    }


   public function CustomerDetail(){
    $textKey = $this->input->post('textKey');
    //  2 for Customer
        if($groupDetail=$this->Common_model->GetSupplierList("2",$textKey)){
            echo json_encode($groupDetail);
        }else{
            $data = array();
            echo json_encode($data);
        }
  }


  public function GroupList(){
    $textKey = $this->input->post('textKey');
    //  2 for Customer
        if($groupDetail=$this->Common_model->GetGroupList($textKey)){
            echo json_encode($groupDetail);
        }else{
            $data = array();
            echo json_encode($data);
        }
  }

  public function CompanyList(){
    //  2 for Customer
    $textKey = $this->input->post('textKey');
    
        if($groupDetail=$this->Common_model->get_company_list($textKey)){
            echo json_encode($groupDetail);
        }else{
            $data = array();
            echo json_encode($data);
        }
  }

  public function GetSupplierGroupByID(){
      $id = $this->input->post('id');

      if($groupDetail=$this->Common_model->GetSupplierGroupByID($id)){
          echo json_encode($groupDetail);
      }else{
          $data = array();
          echo json_encode($data);
      }
  }

  public function getZones(){
        $name = $this->input->get('term');
        $zone_list=$this->Common_model->get_Zone_list_by_name($name);
        $zone_list = json_decode(json_encode($zone_list), True);
        $zone_list = array_map(function($zone_list) {
            return array(
                'label' => $zone_list['name'],
                'value' => $zone_list['zone_id_PK']
            );
        }, $zone_list);
        $data=$zone_list;
        echo json_encode($data);
    }

  // public function get_state_data(){ 
  //   $state=$this->Common_model->get_state();
  //   // POST data 

  //   // $postData = $this->input->post('country_id');
  //   // get data 
  //   $states = $this->Api_model->get_state($postData);
  //    $data['statelist']=$states;
  //   echo json_encode($data); 
  // }

  public function get_city_data(){ 

    // POST data 
       $postData = $this->input->post('state_id');
    // get data 
        $data = $this->Api_model->get_cities($postData);
        echo json_encode($data); 
  }

 
 public function get_account()
  {

    //$add_AccountMaster_Id=$this->input->post('country');
    $accountmaster=$this->Common_model->get_account();
    $data['accountmaster']=$accountmaster;
    $data['message']='successfully';
    echo json_encode($data);
    
  }
  public function get_state(){ 
    $state=$this->Common_model->get_state("101");

    $data['statelist']=$state;
    $data['selected']='101';
     $data['message']='successfully';
    echo json_encode($data); 
  }
  public function get_city()
  {
    $city_Id=$this->input->post('city');
    $citylist=$this->Common_model->get_city($city_Id);
    $data['citylist']=$citylist;
    //$data['selected']='state_id';
    $data['message']='successfully';
    echo json_encode($data);
  }

public function jobProcessList(){
  $jobProcessList=$this->Common_model->jobProcessList();
  $data['jobProcessList']=$jobProcessList;
  echo json_encode($data);
}

public function bookList(){

  $purchaseId=$this->input->post('purchase');

  if(isset($purchaseId) && $purchaseId!=""){
    $bookList=$this->Common_model->bookList($purchaseId);
    $data['bookList']=$bookList;
  }else{
    $bookList=$this->Common_model->bookList();
    $data['bookList']=$bookList;
  }
  echo json_encode($data);
}


}