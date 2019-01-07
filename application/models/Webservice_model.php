<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Webservice_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }


public function login($password, $fb_id, $gplus_id, $email, $first_name, $last_name, $latitude, $longitude) {

        if ($fb_id != "") {
            $query = $this->db->query("SELECT id,profile_picture,first_name,last_name,email,
                phone,latitude,longitude FROM
                users WHERE (facebook_id='" . $fb_id . "') AND fk_role_id = 3");
            if ($query->num_rows() == 0) {
                $set['first_name'] = $first_name;
                $set['last_name'] = $last_name;
                $set['latitude'] = $latitude;
                $set['longitude'] = $longitude;
                $set['facebook_id'] = $fb_id;
                $set['fk_role_id'] = 3;
                $set['created_at'] = date("Y-m-d H:i:s");
                $id = $this->webservice_general_model->insert('users', $set);

                $setNotifiaction['user_id_FK'] = $id;
                $setNotifiaction['notification'] = "Welcome to BreezyMeal";
                $this->webservice_general_model->insert('tbl_notification', $setNotifiaction);

                $query2 = $this->db->query("SELECT id,profile_picture,first_name,last_name,email
                    ,phone,latitude,longitude FROM users  WHERE (facebook_id='" . $fb_id . "') AND fk_role_id= 3 ");
                return $query2->row();
            } else {
                return $query->row();
            }
        } else if ($gplus_id != "") {
            $query = $this->db->query("SELECT id,profile_picture,first_name,last_name,email
                    ,phone,latitude,longitude FROM users WHERE (gplus_id='" . $gplus_id . "') AND fk_role_id = 3 ");
            if ($query->num_rows() == 0) {
                
                 $set['email'] = $email;
                    $set['first_name'] = $first_name;
                    $set['last_name'] = $last_name;
                    $set['latitude'] = $latitude;
                    $set['longitude'] = $longitude;
                    $set['fk_role_id'] = 3;
                    $set['gplus_id'] = $gplus_id;
                    $set['created_at'] = date("Y-m-d H:i:s");
                    $id = $this->webservice_general_model->insert('users', $set);

                    $setNotifiaction['user_id_FK'] = $id;
                    $setNotifiaction['notification'] = "Welcome to BreezyMeal";
                    $this->webservice_general_model->insert('tbl_notification', $setNotifiaction);
                    
                $query2 = $this->db->query("SELECT id,profile_picture,first_name,last_name,email
                    ,phone,latitude,longitude FROM users  WHERE (gplus_id='" . $gplus_id . "') AND fk_role_id = 3 ");
                return $query2->row();
            } else {
                return $query->row();
            }
        } else {
            $query = $this->db->query("SELECT id,profile_picture,first_name,last_name,email
                    ,phone,latitude,longitude FROM users  WHERE (email='" . $email . "')
                    AND (password='" . $password . "') AND fk_role_id = 3 ");
            if ($query->num_rows() > 0)
                return $query->row();
            else
                return false;
        }
    }

    public function getCountries() {
        $final = array();
        $query = $this->db->query("SELECT id,sortname,name,phonecode FROM countries
             ORDER BY sortname DESC ");
        $total = $query->num_rows();
        if ($total == 0)
            return $final;
        else {
            foreach ($query->result() as $row) {
                $data['id'] = $row->id;
                $data['sortname'] = $row->sortname;
                $data['name'] = $row->name;
                $data['phonecode'] = $row->phonecode;
                $final[] = $data;
            }
            return $final;
        }
    }


    public function checkDishAvailability($dishId) {

        $days = date('D', strtotime(date("Y-m-d")));

        $query = $this->db->query("SELECT activedays FROM dishes WHERE
          activedays LIKE '%$days%' ");
        $total = $query->num_rows();
        if ($total == 0)
            return false;
        else {
            return true;;
        }
    }


    public function getCountryName($id) {

        $query = $this->db->query("SELECT id,sortname,name,phonecode FROM countries
             WHERE id = ".$id."  ");
        $total = $query->num_rows();
        if ($total == 0)
            return "";
        else {
            return $query->row()->name;
        }
    }



     public function getNotification($id) {
      $final  = array();

        $query = $this->db->query("SELECT notification,timestamp FROM tbl_notification
             WHERE user_id_FK = ".$id."  ");
        $total = $query->num_rows();
        if ($total == 0){
          return $final ;
        }
        else {
            return $query->result();
        }
    }





    public function getCategories() {
        $final = array();
        $query = $this->db->query("SELECT id,category_name FROM categories WHERE isActive=1
             ORDER BY category_name DESC ");
        $total = $query->num_rows();
        if ($total == 0)
            return $final;
        else {
            foreach ($query->result() as $row) {
                $data['id'] = $row->id;
                $data['category_name'] = $row->category_name;
                $final[] = $data;
            }
            return $final;
        }
    }

    public function getProductDetail($product_id,$user_id) {
        $final = array();
        $query = $this->db->query("SELECT unit_value,user_id_FK,title,description,image1,image2,image3,image4,
          image5,image6,price,stock,discount_price
         FROM tbl_product WHERE isActive=2 AND product_id_PK='".$product_id."' ");
        $total = $query->num_rows();
        if ($total == 0)
            return false;
        else {
            $result = $query->row();
            if($result->image1 !=""){
                $result->image1 = base_url()."".$result->image1;
            }
            if($result->image2 !=""){
                $result->image2 = base_url()."".$result->image2;
            }
            if($result->image3 !=""){
                $result->image3 = base_url()."".$result->image3;
            }
            if($result->image4 !=""){
                $result->image4 = base_url()."".$result->image4;
            }
            if($result->image5 !=""){
                $result->image5 = base_url()."".$result->image5;
            }
            if($result->image6 !=""){
                $result->image6 = base_url()."".$result->image6;
            } 

            $result->colorVariation = $this->getColorVariation($product_id,1);
            $result->imageVariation = $this->getColorVariation($product_id,2);
            $result->textVariation = $this->getColorVariation($product_id,3);
            
           return $result;
        }
    }

    public function getColorVariation($product_id,$type){
          $this->db->select('variation_id_PK,variation_name');
          $this->db->from('tbl_variation');
          $this->db->where('product_id_FK', $product_id);
          $this->db->where('option_type', $type);
          $query = $this->db->get();
          $final = array();

          if($query->num_rows() == 0){
              return $final;
          }else{
            $result = $query->result();
            foreach ($result as $key => $row) {
                $result[$key]->variationList = $this->getVariationList($result[$key]->variation_id_PK,$type);
             }
             return $result;
          }
    }

     public function getVariationList($variation_id,$type) {

      $this->db->select('Name,modifier as additionalCost,status');

      $this->db->from('tbl_general_variation');
      $this->db->where('variation_FK_ID', $variation_id);
      $this->db->where('status', 1);
      $query = $this->db->get();
      $final = array();
      if($query->num_rows() == 0){
          return $final;
      }else{
        
         $result = $query->result();
         if($type == 2){
            foreach ($result as $key => $row) {
              $result[$key]->Name = base_url()."".$result[$key]->Name;
            }
         }
         
        return $result;
      }
      

    }

    public function getBannerList() {
        $final = array();
        $query = $this->db->query("SELECT * FROM tbl_banner WHERE banner_image != '' ORDER BY banner_id DESC ");
        $total = $query->num_rows();
        if ($total == 0)
            return $final; 
        else {
            if ($query->num_rows() > 0) {
              $result = $query->result();
              foreach ($result as $key => $row) {
                  if($result[$key]->banner_image == ""){
                      $result[$key]->banner_image = "";
                  }else{
                      $result[$key]->banner_image = base_url()."".$result[$key]->banner_image;
                  }      
              }
               return $result;
            }
           return false;
        }
    }


    public function getHomeProductList() {
        $final = array();
        $query = $this->db->query("SELECT `category`, catname FROM (SELECT `category_id_FK` as category,c.name as catname
          ,COUNT(category_id_FK) as head from `tbl_product` as p 
          INNER JOIN tbl_category as c ON c.category_id_PK=p.category_id_FK
          GROUP BY category_id_FK) AS pp where head > 3 ");
        $total = $query->num_rows();
        if ($total == 0)
            return $final; 
        else {
            if ($query->num_rows() > 0) {
              $result = $query->result();
              foreach ($result as $key => $row) {
                  $result[$key]->catname = $result[$key]->catname;
                        
              }
               return $result;
            }
           return false;
        }
    }


     public function getCatWiseProduct() {
        $final  = array();
        $query = $this->db->query("SELECT product_id_PK,title,description,unit,unit_value,unit_id_FK,image1,image2,image3,
          image4,image5,price,stock,discount_price FROM tbl_product as p LEFT JOIN tbl_unit as u ON p.unit_id_FK = u.unit_id_PK
          WHERE p.isActive = 1 ORDER BY product_id_PK DESC LIMIT 10");
        $total = $query->num_rows();
        if ($total == 0)
            return  $final;
        else {
           if ($query->num_rows() > 0) {
              $result = $query->result();
              foreach ($result as $key => $row) {
                  if($result[$key]->image1 == ""){
                      $result[$key]->image1 = "";
                  }else{
                      $result[$key]->image1 = base_url()."".$result[$key]->image1;
                  } 

                   if($result[$key]->image2 == ""){
                      $result[$key]->image2 = "";
                  }else{
                      $result[$key]->image2 = base_url()."".$result[$key]->image2;
                  } 

                   if($result[$key]->image3 == ""){
                      $result[$key]->image3 = "";
                  }else{
                      $result[$key]->image3 = base_url()."".$result[$key]->image3;
                  } 

                   if($result[$key]->image4 == ""){
                      $result[$key]->image4 = "";
                  }else{
                      $result[$key]->image4 = base_url()."".$result[$key]->image4;
                  } 

                   if($result[$key]->image5 == ""){
                      $result[$key]->image5 = "";
                  }else{
                      $result[$key]->image5 = base_url()."".$result[$key]->image5;
                  } 

              }
               return $result;
            }
           return false;
        }
    }


    public function getDishDetail($user_id,$dish_id) {

    //  CONCAT ('http://base5.coretechie.in/breezymeal/uploads/user/',t1.profile_picture)
      $this->db->select('
        IFNULL( t2.image_thumb_1,"") as image1,
        IFNULL( t2.image_thumb_2,"") as image2,
        IFNULL( t2.image_thumb_3,"") as image3,
        IFNULL( t2.image_thumb_4,"") as image4,
        IFNULL( t2.image_thumb_5,"") as image5,
       t1.first_name as CookfirstName,
      t1.last_name as CooklastName,
        CONCAT ("https://breezymeal.com/uploads/user/",t1.profile_picture) as cookProfilePic,
      t1.id as Cookid,
      t1.address,
      t3.cuisine_name as cuisine,
      t2.dish_name as dishName,
      t2.dish_description as dishDescription,
      t2.dish_price as dishPrice,
      t2.slots');

      $this->db->from('dishes AS t2');
      $this->db->join('users AS t1', 't2.created_by = t1.id', 'INNER');
      $this->db->where('t2.id', $dish_id);
      $this->db->join('cuisine AS t3', 't2.cuisine = t3.id', 'INNER');
      $query = $this->db->get();
      return $query->row();

    }


    public function getCookReviews($id)
    {
      $final = array();
      $this->db->select('review as description,rating,created_date as date,
        first_name as userName,last_name');

      $this->db->from('tbl_rating');
      $this->db->where('cook_id_FK', $id);
       $this->db->join('users AS t1', 't1.id = tbl_rating.user_id_FK', 'INNER');
       $this->db->limit(10);
      $query = $this->db->get();
      if($query->num_rows() == 0){
          return $final;
      }else{
        $result = $query->result();
        foreach ($result as $key => $row) {
          $result[$key]->date = date('d, M Y H:i',strtotime($result[$key]->date));
        }
        return $result;
      }


    }



    public function getCookDetails($cook_id,$latitude,$longitude) {
      $this->db->select('id,first_name, last_name,
        address,Biography,profile_picture as cookProfilePic,email,first_name,last_name,
        phone,isDeliveryAvailable,
        ( 3959 * acos( cos( radians('. $latitude . ') )
      * cos( radians( latitude ) ) *
cos( radians( longitude ) - radians(' . $longitude . ') )
+ sin( radians('. $latitude .') ) *
sin( radians( latitude ) ) ) ) AS distance');
      $this->db->where('id',$cook_id);
      $this->db->from('users');
      $query = $this->db->get();
      if($query->row()->cookProfilePic == ""){
        $query->row()->cookProfilePic = "";
      }else{
        $query->row()->cookProfilePic = base_url()."uploads/user/".$query->row()->cookProfilePic;
      }

      $rateQuery = $this->db->query("SELECT AVG(rating) as rating FROM tbl_rating
        WHERE cook_id_FK = ".$cook_id." ");

      if($rateQuery->row()->rating != NULL){
          $query->row()->rating = floatval($rateQuery->row()->rating);
      }else{
          $query->row()->rating = "0";
      }


      return $query->row();

    }


    public function getCookDishList($user_id,$cook_id,$latitude,$longitude) {

      $dishes = $this->getHomeData($user_id,"","",0,4,$cook_id,1000,$latitude,$longitude);
      $final = array();


      foreach ($dishes as  $dishesDetails) {
        //$dishDetails
        $dishesDetails["slots"] = $this->webservice_model->get_slot_details($dishesDetails["slots"]);

        $final[] = $dishesDetails;

      }

      return  $final;

    }


    public function getAllCuisine()
    {
      $this->db->select('id,cuisine_name as cuisineName');

      $this->db->from('cuisine');
      $this->db->where('isActive', 1);

      $query = $this->db->get();

      return $query->result();
    }

    public function get_slot_details($slot_ids) {
      
        $query = $this->db->query("SELECT `id`, `name`, `startTime`, `endTime`
          FROM `tbl_slots`
          WHERE (`isActive` = 1 ) AND  find_in_set(id,'".$slot_ids."') ");

        return $query->result();
    }


    public function checkUserExist($user_id)
    {
      $this->db->select('*');
      $this->db->from('users');
      $this->db->where('isdeleted', 0);

      $query = $this->db->get();

      return $query->result();
    }

    public function getUserDetail($user_id)
    {
      $this->db->select("first_name,last_name,email,phone,address, city,country_id_FK,
        IF(name IS NULL, '', name) as country_name, profile_picture");
      $this->db->from('users as t2');
      $this->db->where('t2.id', $user_id);
      $this->db->join('countries AS t3', 't2.country_id_FK = t3.id', 'LEFT');
      $query = $this->db->get();

      return $query->result();
    }


    public function sendEmail($email,$msg,$subject) {
        header('Content-Type: application/json');
            $this->load->library('email');
            $config['protocol']='smtp';
            $config['smtp_host']='ssl://smtp.googlemail.com';
            $config['smtp_port']='465';
            $config['smtp_timeout']='30';
            $config['smtp_user']='teameporwal@gmail.com';
            $config['smtp_pass']='sipl@1234';
            $config['charset']='utf-8';
            $config['newline']="\r\n";
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->from('teameporwal@gmail.com', 'Breezymeal - Change Password Request');
            $this->email->to($email);
            //$this->email->cc("jainshubham090@gmail.com");
            $this->email->subject($subject);
            $this->email->message($msg);
            $this->email->send();
            return true;
            //echo $this->email->print_debugger(); die;
    }

    public function sendEmail_withFrom($email,$msg,$subject,$from) {
        header('Content-Type: application/json');
            $this->load->library('email');
            $config['protocol']='smtp';
            $config['smtp_host']='ssl://smtp.googlemail.com';
            $config['smtp_port']='465';
            $config['smtp_timeout']='30';
            $config['smtp_user']='teameporwal@gmail.com';
            $config['smtp_pass']='eporwal@1234';
            $config['charset']='utf-8';
            $config['newline']="\r\n";
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->from('teameporwal@gmail.com', $from);
            $this->email->to($email);
            $this->email->subject($subject);
            $this->email->message($msg);
            $this->email->send();
            return true;
           // echo $this->email->print_debugger(); die;
    }

    public function getCartList($user_id,$device_id)
    {

      $this->db->select("cart_id_PK");
      $this->db->from('tbl_cart');
      if($user_id == 0 || $user_id == ""){
        $this->db->where('device_id', $device_id);
      }else{
        $this->db->where('user_id_FK', $user_id);
      }
      $query = $this->db->get();
      if($query->num_rows() == 0){
          return false;
      }else{
          $this->db->select("cart_id_PK,t1.quantity,dish_id_FK,time_slot_id_FK,t2.name as slotName,
            startTime,endTime,cuisine_name,dish_name,dish_price,image_1,created_by");
          $this->db->from('tbl_cart as t1');
          $this->db->join('tbl_slots AS t2', 't2.id = t1.time_slot_id_FK', 'LEFT');
          $this->db->join('dishes AS t3', 't3.id = t1.dish_id_FK', 'LEFT');
          $this->db->join('cuisine AS t4', 't4.id = t3.cuisine', 'LEFT');
          if($user_id == 0 || $user_id == ""){
            $this->db->where('device_id', $device_id);
          }else{
            $this->db->where('user_id_FK', $user_id);
          }
          $query1 = $this->db->get();
          $result = $query1->result() ;
           foreach ($result as $key => $row) {
                if($result[$key]->image_1 != ""){
                  $result[$key]->dish_image = base_url()."uploads/dishes/".$result[$key]->image_1;
                }else if($result[$key]->image_2 != ""){
                  $result[$key]->dish_image = base_url()."uploads/dishes/".$result[$key]->image_2;
                }else if($result[$key]->image_3 != ""){
                  $result[$key]->dish_image = base_url()."uploads/dishes/".$result[$key]->image_3;
                }else if($result[$key]->image_4 != ""){
                  $result[$key]->dish_image = base_url()."uploads/dishes/".$result[$key]->image_4;
                }else if($result[$key]->image_5 != ""){
                  $result[$key]->dish_image = base_url()."uploads/dishes/".$result[$key]->image_5;
                }
                $result[$key]->dish_price = number_format((float)$result[$key]->dish_price, 2, '.', ''); ;

          }

      }
      return $result;
    }


    public function getCartCount($user_id) {
        $final = array();
        $query = $this->db->query("SELECT user_id_FK FROM tbl_cart WHERE user_id_FK=".$user_id." ");
        return $query->num_rows();
    }


    public function checkSameCookDishAddedAlready($user_id,$dish_id) {

      $this->db->select('t1.*');

      $this->db->from('dishes AS t2');
      $this->db->join('tbl_cart AS t1', 't2.created_by = t1.id', 'INNER');
      $this->db->where('t2.id', $dish_id);
      $this->db->join('cuisine AS t3', 't2.cuisine = t3.id', 'INNER');
      $query = $this->db->get();
      return $query->row();

    }


    public function createOrder($user_id,$cook_id,$transaction_id,
                              $delivery_address,$latitude,$longitude,$breezyOrderID)
    {

      $this->db->select("cart_id_PK,t1.quantity,dish_id_FK,time_slot_id_FK,dish_price");
      $this->db->from('tbl_cart as t1');
      $this->db->where('t1.user_id_FK', $user_id);
      $this->db->join('dishes AS t3', 't3.id = t1.dish_id_FK', 'LEFT');
      $query1 = $this->db->get();
      if($query1->num_rows() == 0){
        return false;
      }else{
        $set['user_id_FK'] = $user_id;
        $set['cook_id_FK'] = $cook_id;
        $set['total_amount'] = $this->calculateTotalAmount($user_id);
        $set['transaction_id_FK'] = $transaction_id;
        $set['order_number'] = $breezyOrderID;
        $set['delivery_address'] = $delivery_address;
        $set['latitude'] = $latitude;
        $set['longitude'] = $longitude;
        $set['discount_amount'] = 0;
        $set['order_status_id_FK'] = 1; // Pending
        $set['created_date'] = date('Y-m-d H:i:s');
        $createOrderId = $this->webservice_general_model->insert('tbl_order', $set);

        $result = $query1->result() ;
        $calculateTotalAmount = 0;
        foreach ($result as $key => $row) {
          $setOrder['user_id_FK'] = $user_id;
          $setOrder['dish_id_FK'] = $result[$key]->dish_id_FK;
          $setOrder['order_id_FK'] = $createOrderId;
          $setOrder['time_slot_id_FK'] = $result[$key]->time_slot_id_FK;
          $setOrder['dish_price'] = $result[$key]->dish_price;
          $setOrder['quantity'] = $result[$key]->quantity;
          $setOrder['created_date'] = date('Y-m-d H:i:s');
          $OrderGeneration = $this->webservice_general_model->insert('tbl_order_dish', $setOrder);

          // Delete From Cart
          $filterDelete['cart_id_PK'] = $result[$key]->cart_id_PK;
          $OrderGeneration = $this->webservice_general_model->delete('tbl_cart', $filterDelete);
        }

      }
      return $breezyOrderID;
    }



    public function calculateTotalAmount($user_id)
    {
      $calculateTotalAmount = 0;
      $this->db->select("cart_id_PK,t1.quantity,dish_id_FK,time_slot_id_FK,dish_price");
      $this->db->from('tbl_cart as t1');
      $this->db->where('t1.user_id_FK', $user_id);
      $this->db->join('dishes AS t3', 't3.id = t1.dish_id_FK', 'LEFT');
      $query1 = $this->db->get();
      if($query1->num_rows() == 0){
        return 0;
      }else{
        $result = $query1->result() ;

        foreach ($result as $key => $row) {
          $calculateTotalAmount = $calculateTotalAmount+
                                  ($result[$key]->dish_price*$result[$key]->quantity);
        }
      }
      return $calculateTotalAmount;
    }


    public function manageOrder($user_id)
    {
      $this->db->select("order_id_PK,total_amount,order_number,order_status,
        DATE_FORMAT(created_date, '%d-%M-%Y') as date_of_order,
        DATE_FORMAT(created_date, '%r') as time_of_order,
        cancel_order_number");
      $this->db->from('tbl_order as t2');
      $this->db->where('t2.user_id_FK', $user_id);
      $this->db->join('tbl_order_status AS t3', 't2.order_status_id_FK = t3.order_status_id_PK', 'LEFT');
      $this->db->order_by('order_id_PK', 'DESC');

      $query = $this->db->get();

      return $query->result();
    }


    public function orderDetail($user_id,$order_id)
    {
      $this->db->select("order_id_PK,total_amount,order_number,order_status,
        DATE_FORMAT(created_date, '%d-%M-%Y') as date_of_order,
        DATE_FORMAT(created_date, '%r') as time_of_order,cook_id_FK,
        order_status_id_FK as order_status_id,
        cancel_order_number,delivery_address,latitude,longitude");
      $this->db->from('tbl_order as t2');
      $this->db->where('t2.user_id_FK', $user_id);
      $this->db->where('t2.order_id_PK', $order_id);
      $this->db->join('tbl_order_status AS t3', 't2.order_status_id_FK = t3.order_status_id_PK', 'LEFT');
      $query = $this->db->get();

      if($query->num_rows() == 0){
        return false;
      }else{

        $checkIsDIspute = $this->db->query("SELECT  user_id_FK FROM tbl_order_disputes
           WHERE order_id_FK = ".$order_id." AND user_id_FK = ".$user_id." " );


        $query->row()->isDisputed = $checkIsDIspute->num_rows();

        $data['orderDetail'] = $query->row();
        $data['cookDetail'] = $this->getCookDetails($query->row()->cook_id_FK,-37.85355011179007,145.012688);
        $data['orderDishList'] = $this->getorderDishList($query->row()->order_id_PK);
        return $data;
      }
  }


  public function getorderDishList($order_id)
    {
      $this->db->select("dish_id_FK,t2.quantity,t2.dish_price,dish_name");
      $this->db->from('tbl_order_dish as t2');
      $this->db->where('t2.order_id_FK', $order_id);
      $this->db->join('dishes AS t3', 't2.dish_id_FK = t3.id', 'LEFT');
      $query = $this->db->get();

      return $query->result();
    }

    public function orderDisputes($user_id,$order_id,$dispute_for,$dispute_reason)
    {
      $this->db->select("user_id_FK");
      $this->db->from('tbl_order_disputes');
      $this->db->where('user_id_FK', $user_id);
      $this->db->where('order_id_FK', $order_id);


      $query = $this->db->get();
      if($query->num_rows() == 0){
        $set['user_id_FK'] = $user_id;
        $set['order_id_FK'] = $order_id;
        $set['dispute_for'] = $dispute_for;
        $set['dispute_reason'] = $dispute_reason;
        $set['created_date'] = date('Y-m-d H:i:s');
        $orderDisputes = $this->webservice_general_model->insert('tbl_order_disputes', $set);
        return true;
      }else{

        $filter['user_id_FK'] = $user_id;
        $filter['order_id_FK'] = $order_id;
        $set['dispute_for'] = $dispute_for;
        $set['dispute_reason'] = $dispute_reason;
        $set['created_date'] = date('Y-m-d H:i:s');
        $orderDisputes = $this->webservice_general_model->update('tbl_order_disputes',$filter,$set);
        return true;

      }

    }



    public function cookRating($user_id,$cook_id,$rating,$reviews)
    {
      $this->db->select("user_id_FK");
      $this->db->from('tbl_rating');
      $this->db->where('user_id_FK', $user_id);
      $this->db->where('cook_id_FK', $cook_id);


      $query = $this->db->get();
      if($query->num_rows() == 0){
        $set['user_id_FK'] = $user_id;
        $set['cook_id_FK'] = $cook_id;
        $set['rating'] = $rating;
        $set['review'] = $reviews;
        $set['created_date'] = date('Y-m-d H:i:s');
        $orderDisputes = $this->webservice_general_model->insert('tbl_rating', $set);
        return true;
      }else{

        $filter['user_id_FK'] = $user_id;
        $filter['cook_id_FK'] = $cook_id;
        $set['rating'] = $rating;
        $set['review'] = $reviews;
        $set['created_date'] = date('Y-m-d H:i:s');
        $orderDisputes = $this->webservice_general_model->update('tbl_rating',$filter,$set);
        return true;

      }

    }



}




?>
