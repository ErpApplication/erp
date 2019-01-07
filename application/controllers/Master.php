<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

    private $_user;

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation', 'upload');
        $this->load->model('webservice_general_model');
        $this->load->model('general_model'); 
        $this->load->model('product_model'); 


        // Load database
        $this->load->model('master_model');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }
    }


  public function loadGlobalVariationPopup($isglobal = NULL){

   $data['isglobal']="1";
   $variationPopup=$this->load->view('product/addVariationPopup',$data,true);
   echo json_encode($variationPopup);

  }

     public function subCategoryListwebAPI(){

        $start = $_GET['start'];
        $length = $_GET['length'];
        $search = $_GET['search']["value"];

         $data = $this->db->query("SELECT category_id_PK as id, name,parent_id,isHome,isActive FROM `tbl_category` as ca 
          WHERE name LIKE '%".$search."%' order by id Desc limit ".$start.",".$length."");
         
        $result = $data->result();
        // if($result->parent_id==0){
        //   $data1['parent_id'] = $result->parent_id;
        // }
        // foreach ($result as $key => $value) {
        //   $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
        //   $result[$key]->ad_video = base_url()."".$result[$key]->ad_video;
        // }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT category_id_PK as id, name,parent_id,isHome,isActive FROM `tbl_category` ");
        $result1 = $data12->result();
        $data1['recordsFiltered'] = $data12->num_rows();

        echo json_encode($data1);

 }

    public function getCategory() {
        try {
            $id = trim($this->input->post('ID'));  
            $filter['category_id_PK'] =  $id;
            $category_id = $this->webservice_general_model->getData('tbl_category',$filter);
            echo  $category_id->name;
        } catch (Exception $ex) {
            echo $ex->getMessage() . '-' . $ex->getLine();
            die;
        }
    }

    public function category() {
        try {
            $user_id = $this->_user['id'];
            $data['cat_list'] = $this->master_model->get_cat_list($user_id);
            $data['currentPage'] = "category";
            //$this->load->view('dish/superadmin-dish-list');
            $this->load->view('master/categoryList', $data);
        } catch (Exception $ex) {
            echo $ex->getMessage() . '-' . $ex->getLine();
            die;
        }
    }

    public function subcategory() {
        try {
            $user_id = $this->_user['id'];
            $data['subcat_list'] = $this->master_model->get_subcat_list($user_id);
            $data['cat_list'] = $this->master_model->get_cat_list($user_id);
            $data['currentPage'] = "subcategory";
            //$this->load->view('dish/superadmin-dish-list');
            $this->load->view('master/subcategoryList', $data);
        } catch (Exception $ex) {
            echo $ex->getMessage() . '-' . $ex->getLine();
            die;
        }
    }



     public function getVariation() {
        try {
            $id = trim($this->input->post('ID'));  
            $filter['variation_id_PK'] =  $id;
            $variation_id = $this->webservice_general_model->getData('tbl_variation',$filter);
            echo  $variation_id->variation_name;
        } catch (Exception $ex) {
            echo $ex->getMessage() . '-' . $ex->getLine();
            die;
        }
    }



        public function variation() {
        try {
            $user_id = $this->_user['id'];
            $data['variation_list'] = $this->master_model->get_variation_list($user_id);
            //$data['cat_list'] = $this->master_model->get_cat_list($user_id);
            $data['currentPage'] = "variation";
            //$this->load->view('dish/superadmin-dish-list');
            $this->load->view('master/variationList', $data);
        } catch (Exception $ex) {
            echo $ex->getMessage() . '-' . $ex->getLine();
            die;
        }
    }

    public function ggPart() {
        try {
            $user_id = $this->_user['id'];
            $data['oe_list'] = $this->master_model->get_gg_list($user_id);
            //$this->load->view('dish/superadmin-dish-list');
            $this->load->view('master/ggpart', $data);
        } catch (Exception $ex) {
            echo $ex->getMessage() . '-' . $ex->getLine();
            die;
        }
    }

    public function companyList() {
        try {
            $user_id = $this->_user['id'];
            $data['c_list'] = $this->master_model->get_company_list($user_id);
            //$this->load->view('dish/superadmin-dish-list');
            $this->load->view('master/company', $data);
        } catch (Exception $ex) {
            echo $ex->getMessage() . '-' . $ex->getLine();
            die;
        }
    }

    public function addcompany() {
        try {
            $user_id = $this->_user['id'];
            $company = trim($this->input->post('name'));
            $type = trim($this->input->post('type'));

            $image_name = "";
            $image_name_thumb = "placeholder.png";

            if (isset($_FILES['logo']) && is_uploaded_file($_FILES['logo']['tmp_name']) ) {
                // Upload job picture
                $random = time();
                $config['upload_path'] = 'uploads/company/';
                $config['allowed_types'] = 'jpg|png|jpeg|bmp';
                $config['file_name'] = $random;
                $config['encrypt_name'] = TRUE;
                //$this->load->library('image_lib');
                //$this->image_lib->clear();
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                ini_set('upload_max_filesize', '10M');
                ini_set('memory_limit', '-1');
                if ($this->upload->do_upload('logo')) {
                    $imageArray = $this->upload->data();
                    $image_name = $imageArray['raw_name'] . '' . $imageArray['file_ext']; // Job Attachment
                    $config1['image_library'] = 'gd2';
                    $config1['source_image'] = './uploads/company/' . $image_name;
                    $config1['create_thumb'] = TRUE;
                    $config1['maintain_ratio'] = TRUE;
                    $config1['width'] = 300;
                    $config1['height'] = 377;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->initialize($config1);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $image_name_thumb = $imageArray['raw_name'] . '_thumb' . $imageArray['file_ext'];

                } else {
                    $msg = strip_tags($this->upload->display_errors());
                    $this->session->set_flashdata('err_message', $msg);
                    redirect('master/companyList');
                    die;
                }

            }

            $set['name'] = $company;
            $set['type'] = $type;
            $set['logo'] = $image_name_thumb;
            $this->webservice_general_model->insert('tbl_company', $set);

            $this->session->set_flashdata('success_msg', "Company has been added");
            redirect('master/companyList');

            
            
        } catch (Exception $ex) {
            echo $ex->getMessage() . '-' . $ex->getLine();
            $this->session->set_flashdata('err_message', "Something went wrong");
            redirect('master/companyList');
            die;
        }
    }

    public function getCategories() {
          if($getCat = $this->master_model->get_cat_list()){
              $select = "<select name='catId' id='catDrop'>";
              $select .= "<option value=''>---Select Category---";
              foreach ($getCat as $key) {
                  $select.= "<option class='form-control' value=".$key->category_id_PK.">".$key->name."</option>";
              }
              $select .= "</select>";
          }
          echo $select;
    }

   public function addOEPart(){
         $this->load->model('general_model'); 
         if($this->input->is_ajax_request()){   
          $Name = $this->input->post('cName',TRUE);
          if($Name != ''){
            //$transactionId = $this->encryption->decode($transactionId);
            $setData['OE_part']  = $Name;
            if($this->general_model->getData('tbl_OE_part',$setData)){
                  echo 2; die;
            }else{
              $id = $this->general_model->insert('tbl_OE_part',$setData);
              if($id){
              echo 1; die;
            }else{
              echo 0; die;
            }
          }
        }else{
          echo 0; die;
        }      
      }else{
         echo 0; die;
      } 
  }


  public function oedeactivate(){
         $this->load->model('webservice_general_model');
         if($this->input->is_ajax_request()){
            $OEId = $this->input->post('OEId',TRUE);
            $isActive = $this->input->post('isActive',TRUE);
            if($OEId != ''){
            //$transactionId = $this->encryption->decode($transactionId);
            $OEId = $OEId;

           $filter['OE_id_PK']  = $OEId;
           $setData['isActive']  = $isActive;
           $id = $this->webservice_general_model->update('tbl_OE_part',$filter,$setData);
            if($id){
              echo 1; die;
          }else{
              echo 0; die;
          }
        }else{
          echo 0; die;
        }
        }else{
         echo 0; die;
        }
  }


  public function comdeactivate(){
         $this->load->model('webservice_general_model');
         if($this->input->is_ajax_request()){
            $ID = $this->input->post('ID',TRUE);
            $isActive = $this->input->post('isActive',TRUE);
            if($ID != ''){
            //$transactionId = $this->encryption->decode($transactionId);
           $filter['company_id_PK']  = $ID;
           $setData['isActive']  = $isActive;
           $id = $this->webservice_general_model->update('tbl_company',$filter,$setData);
            if($id){
              echo 1; die;
          }else{
              echo 0; die;
          }
        }else{
          echo 0; die;
        }
        }else{
         echo 0; die;
        }
  }



  public function addGGPart(){
         $this->load->model('general_model'); 
         if($this->input->is_ajax_request()){   
          $Name = $this->input->post('cName',TRUE);
          if($Name != ''){
            //$transactionId = $this->encryption->decode($transactionId);
            $setData['GG_part']  = $Name;
            if($this->general_model->getData('tbl_GG_part',$setData)){
                  echo 2; die;
            }else{
              $id = $this->general_model->insert('tbl_GG_part',$setData);
              if($id){
              echo 1; die;
            }else{
              echo 0; die;
            }
          }
        }else{
          echo 0; die;
        }      
      }else{
         echo 0; die;
      } 
  }


  public function ggdeactivate(){
         $this->load->model('webservice_general_model');
         if($this->input->is_ajax_request()){
            $GGId = $this->input->post('GGId',TRUE);
            $isActive = $this->input->post('isActive',TRUE);
            if($GGId != ''){
            //$transactionId = $this->encryption->decode($transactionId);
            $GGId = $GGId;

           $filter['GG_part_id_PK']  = $GGId;
           $setData['isActive']  = $isActive;
           $id = $this->webservice_general_model->update('tbl_GG_part',$filter,$setData);
            if($id){
              echo 1; die;
          }else{
              echo 0; die;
          }
        }else{
          echo 0; die;
        }
        }else{
         echo 0; die;
        }
  }

  



     public function edit($id) {
        try {

          if($id){

            $user_id = $this->_user['id'];

            $select = " id,   cuisine_name as name";

            $filter['isActive'] = 1;

            $data['cuisineData'] = $this->webservice_general_model->getData('cuisine', $filter,'array',$select,'rows');

            $select = " id,  name,startTime,endTime";


            $Slotfilter['createdBy'] = $user_id;
            $Slotfilter['isActive'] = 1;
            $data['slot_list'] =   $this->webservice_general_model->getData('tbl_slots', $Slotfilter,'array',$select,'rows');


            $select = "id,category_name as name";

            $data['category_list'] =   $this->webservice_general_model->getData('categories', "",'array',$select,'rows');
            
            $select = "*";
             $filterDish['id'] = $id;
             $filterDish['created_by'] = $user_id;

            $data['dish_detail'] =   $this->webservice_general_model->getData('dishes', $filterDish,'array',$select,'rows');
           $data['dishID'] = $id;
           $data['base_image_url'] = base_url()."uploads/dishes/";
            $this->load->view('dish/dish-form',$data);

          }else{

            redirect('listing');

          }

          

        } catch (Exception $ex) {
            echo $ex->getMessage() . '-' . $ex->getLine();
            die;
        }
    }


     public function geSubCategory() {
        try {
            $id = trim($this->input->post('ID'));  
            $filter['category_id_PK'] =  $id;
            $category_id = $this->webservice_general_model->getData('tbl_category',$filter);
            echo  trim($category_id->name)."~".$category_id->parent_id;
        } catch (Exception $ex) {
            echo $ex->getMessage() . '-' . $ex->getLine();
            die;
        }
    }

   public function addCategory(){
         $this->load->model('general_model'); 
         if($this->input->is_ajax_request()){   
          $Name = $this->input->post('cName',TRUE);
          $cat_id = $this->input->post('cat_id',TRUE);
          if($Name != ''){
            //$transactionId = $this->encryption->decode($transactionId);
            $filter['category_id_PK']  = $cat_id;
            $setData['name']  = $Name;
            $setData['parent_id']  = 0;
            if($this->general_model->getData('tbl_category',$filter)){

                   $id = $this->general_model->update('tbl_category',$filter,$setData);
                  echo 1; die;
            }else{
              if($this->general_model->getData('tbl_category',$setData)){
                echo 2; die;
              }else{
                  $id = $this->general_model->insert('tbl_category',$setData);
                  if($id){
                    echo 1; die;
                  }else{
                     echo 0; die;
                  }
              }
          }
        }else{
          echo 0; die;
        }      
      }else{
         echo 0; die;
      } 
  }




public function createVariation(){

   /*echo "<pre>";
   print_r($_POST); die;*/
$data=array();
    $Name = $this->input->post('name',TRUE);

    $names=$this->input->post('names');
    $modifier=$this->input->post('additional_price');
   
    $status=$this->input->post('status');

    $name=$this->product_model->CheckVariationName($Name);

    if($name==$Name){

      $data["status"] = 0;
      $data['msg']="It is Already exists";
      echo json_encode($data);die;
       
      } else{ 

    if($Name != ''){
        $filter['variation_name']  = $Name;
        $setData['variation_name']  = $Name;
    
        $setData['isglobal']=1;
        
        //$setData['parent_id']  = 0;
        if($this->general_model->getData('tbl_variation',$filter)){
            //redirect('master/variation','refresh');   
              $dataResponse["status"] = 1;
              echo json_encode($dataResponse);

        }else{
            $lastinsert_id = $this->general_model->insert('tbl_variation',$setData);
              $data['lastinsert_id']=$lastinsert_id;

            for($i=0; $i < count($modifier); $i++){  
                $alldata = array(
                
                 'Name'=>$names[$i],
                 'variation_FK_ID'=>$lastinsert_id,
                 'modifier'=>$modifier[$i],
               
                 'status'=>$status[$i]
                 );

                  if($alldata['Name']==''){
                   // redirect('master/variation','refresh');
                    //echo "Name is Empty";

                     $dataResponse["status"] = 1;
                    echo json_encode($dataResponse);
                  }else{
                   $resultSet=$this->master_model->insertVariation('tbl_general_variation',$alldata);
                   //redirect('master/variation','refresh');
                    $dataResponse["status"] = 1;
                    echo json_encode($dataResponse);
                   
                  }
            }
        }
    }else{
      //redirect('master/variation','refresh');
    } 

    }

  }



  public function catdeactivate(){
         $this->load->model('webservice_general_model');
         if($this->input->is_ajax_request()){
            $ID = $this->input->post('ID',TRUE);
            $isActive = $this->input->post('isActive',TRUE);
            if($ID != ''){

           $filter['category_id_PK']  = $ID;
           $setData['isActive']  = $isActive;
           $id = $this->webservice_general_model->update('tbl_category',$filter,$setData);


            if($id){
              if($isActive==0){
                $filterC['parent_id']  = $ID;
                $setDataC['isActive']  = $isActive;
                $id = $this->webservice_general_model->update('tbl_category',$filterC,$setDataC);
              }
              echo 1; die;
          }else{
              echo 0; die;
          }
        }else{
          echo 0; die;
        }
        }else{
         echo 0; die;
        }
  }



   public function addSubCategory(){
         $this->load->model('general_model'); 
         if($this->input->is_ajax_request()){   
          $Name = $this->input->post('cName',TRUE);
          $catID = $this->input->post('catID',TRUE);
          $sub_cat_id = $this->input->post('sub_cat_id',TRUE);
          if($Name != ''){
            //$transactionId = $this->encryption->decode($transactionId);
            $setData['name']  = $Name;
            $setData['parent_id']  = $catID;
            $filter['category_id_PK']  = $sub_cat_id;

            if($this->general_model->getData('tbl_category',$filter)){

                   $id = $this->general_model->update('tbl_category',$filter,$setData);
                  echo 1; die;
            }else{
              if($this->general_model->getData('tbl_category',$setData)){
                echo 2; die;
              }else{
                  $id = $this->general_model->insert('tbl_category',$setData);
                  if($id){
                    echo 1; die;
                  }else{
                     echo 0; die;
                  }
              }
          }
        }else{
          echo 0; die;
        }      
      }else{
         echo 0; die;
      } 
  }


  public function subcatdeactivate(){
         $this->load->model('webservice_general_model');
         if($this->input->is_ajax_request()){
            $ID = $this->input->post('ID',TRUE);
            $isActive = $this->input->post('isActive',TRUE);
            if($ID != ''){

           $filter['category_id_PK']  = $ID;
           $setData['isActive']  = $isActive;
           $id = $this->webservice_general_model->update('tbl_category',$filter,$setData);
            if($id){
              echo 1; die;
          }else{
              echo 0; die;
          }
        }else{
          echo 0; die;
        }
        }else{
         echo 0; die;
        }
  }



public function editGlobalOptionList(){
   $id=$this->input->post('mid');
   
   $globalvariationData=$this->product_model->globalSingleIdOptionVariationList($id);
   $data['globalvariationData']=$globalvariationData;
   $data['getOptionVariationData']=$this->product_model->getOptionVariationData($id);;
   $data['variation_id']= $id;
   $data['productID']= "";

   $resultSet=$this->load->view('master/updateGlobalMasterVariationPopup',$data,true);
   echo json_encode($resultSet);

}

public function updateVariationData(){
 
        /*echo "<pre>";
        print_r($_POST); die;*/
      
        $product_id = $this->input->post('get_product_id',TRUE);
        $variation_id = $this->input->post('variation_id',TRUE);
        
        $Name = $this->input->post('name',TRUE);
    

      
        $names=$this->input->post('names');
        $modifier=$this->input->post('additional_price');
       
        $status=$this->input->post('status');

        if($Name != ''){
            $setData['variation_name']  = $Name;
          
            $setData['isglobal']=1;
            //$setData['parent_id']  = 0;
                $filterVariation['variation_id_PK'] = $variation_id;
                $updateVariation = $this->webservice_general_model->update('tbl_variation',$filterVariation,$setData);

                $filterVarOption['variation_FK_ID'] = $variation_id;
                $this->webservice_general_model->delete('tbl_general_variation',$filterVarOption);

                for($i=0; $i < count($modifier); $i++){  
                    $alldata = array(
                     
                     'Name'=>$names[$i],
                     'variation_FK_ID'=>$variation_id,
                     'modifier'=>$modifier[$i],
                    
                     'status'=>$status[$i]
                     );

                       if($alldata['Name']==''){
                        redirect('product/VariationList/'.$product_id,'refresh');
                        //echo "Name is Empty";
                      }else{
                       $resultSet=$this->master_model->insertVariation('tbl_general_variation',$alldata);
                      }
                }

                // redirect('product/VariationList/'.$product_id,'refresh');
            
        }else{
          redirect('product/VariationList/'.$product_id,'refresh');
        } 
      }


   public function deleteCategory(){ 
     $pID =  $this->input->post('pID'); 
     $isActive =  $this->input->post('isActive'); 
    if($pID != ""){
        $filter['banner_id'] = $pID; 
        if($this->webservice_general_model->getData('tbl_banner',$filter)){
            $set['isActive'] = $isActive; 
            $this->webservice_general_model->update('tbl_banner',$filter,$set);
             echo "1";
             die;
         }
    }
    echo "0";
  }


}
