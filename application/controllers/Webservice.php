<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Twilio\Rest\Client;


class Webservice extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        // Load database
        $this->load->model('authentication');

        $this->load->model('webservice_general_model');
        $this->load->model('webservice_model');
        $this->load->library('email');
        $this->form_validation->set_error_delimiters('', '');
        $config['allowed_types'] = 'jpeg|jpg|png|bmp';
        $this->load->library('upload', $config);
        $this->load->library('session');
        $this->load->library('pagination');
        require_once(APPPATH.'libraries/twilio-php-master/Twilio/autoload.php');

    }


    public function sendSMS($country_code,$mobile){
      $randome = rand(1000,9999);
      // Your Account Sid and Auth Token from twilio.com/user/account
      $sid = "AC26ab0aea5187f459954693cd8f2de5cb";
      $token = "fb5d69b93c882d850562f9a43c48b168";
      try{
      $client = new Client($sid, $token);
      $client->messages->create(
        //"+917974334291",
        $country_code."".$mobile,
        array(
          'from' => "+14702214673",
          'body' => "Your kishk otp will be ".$randome,
        )
      );

      return $randome;

      }catch(Exception $e){
       // print_r($e);
       return "";
      }

      

}


   /* public function sendSMS(){
      
      $this->load->library('twilio');
      $sms_sender =  "14702214673";;
      $sms_reciever = "9907677712";
      $sms_message = "Hello Twillo";
      $from = $sms_sender; //trial account twilio number
      $to = $sms_reciever; //sms recipient number

      $response = $this->twilio->sms($from, $to,$sms_message);
       
       echo "<pre>";
       print_r($response); die;
      if($response->IsError){
       
      echo 'Sms Has been Not sent';
      }
      else{
       
      echo 'Sms Has been sent';
      }

}
     */ 


    public function index() {
        $response = [];
        $response['code'] = 302;
        $response['status'] = false;
        $response['message'] = 'Invalid Access';
        echo str_replace('\/','/',json_encode($response));
    }


    public function login() {
        header('Content-Type: application/json');
        $mobile = (trim($this->input->post('mobile')));
        $country = (trim($this->input->post('country')));
        $country_code = (trim($this->input->post('country_code')));
        
        if ($mobile == "" || $country=="" || $country_code=="" ) {
            $data['status'] = false;
            $data['message'] = "Please entered all the required field";
        } else {
           $filter['mobile'] = $mobile;
            if ($getResult = $this->webservice_general_model->getData('tbl_user',$filter)) {
                    
                    $filterUser['user_id_PK'] = $getResult->user_id_PK;
                    $getOTP = $this->sendSMS($country_code,$mobile);
                    if($getOTP == ""){

                      $data['status'] = false;
                      $data['message'] = "Please enter valid number";

                    }else{

                      $setUser['OTP'] = $getOTP ;;
                      $setUser['country'] = $country;
                      $setUser['country_code'] = $country_code;
                      $this->webservice_general_model->update('tbl_user', $filterUser, $setUser);

                      $data['code'] = 200;
                      $data['status'] = true;
                      $data['message'] = "OTP has been sent to your registered mobile number";

                    }
                    
                   
            } else {
                $getOTP = $this->sendSMS($country_code,$mobile);
                 if($getOTP == ""){
                     $data['status'] = false;
                      $data['message'] = "Please enter valid number";
                 }else{

                    $setUser['mobile'] = $mobile;
                    $setUser['OTP'] = $getOTP;
                    $setUser['role_id_FK'] = '1';
                    $setUser['country'] = $country;
                    $setUser['country_code'] = $country_code;
                    $this->webservice_general_model->insert('tbl_user', $setUser);

                    $data['code'] = 200;
                    $data['status'] = true;
                    $data['message'] = "OTP has been sent to your registered mobile number";

                 }

            }
        }
        echo json_encode($data);
    }


    public function checkOTP() {
        header('Content-Type: application/json');
        $mobile = (trim($this->input->post('mobile')));
        $OTP = (trim($this->input->post('OTP')));
        
        if ($mobile == "" || $OTP == "") {
            $data['status'] = false;
            $data['message'] = "Please entered all the required field";
        } else {
           $filter['mobile'] = $mobile;
           $filter['OTP'] = $OTP;
            if ($getResult = $this->webservice_general_model->getData('tbl_user',$filter)) {
                    
                    $data['user_id'] = $getResult->user_id_PK;
                    $data['code'] = 200;
                    if($getResult->firstname == ""){
                      $data['isSignup'] = 0;
                    }else{
                      $data['isSignup'] = 1;
                    }
                    $data['status'] = true;
                    $data['message'] = "You have successfully login";;

                   
            } else {

                $data['message'] = "Please enter correct OTP";;
                $data['status'] = false;
            }
        }
        echo json_encode($data);
    }



     public function signup() {
        header('Content-Type: application/json');
        $firstname = (trim($this->input->post('firstname')));
        $lastname = (trim($this->input->post('lastname')));
        $email = (trim($this->input->post('email')));
        $user_id = (trim($this->input->post('user_id')));
        
        if ($user_id == "" || $firstname == "" || $email=="" ||  $lastname=="" ) {
            $data['status'] = false;
            $data['message'] = "Please entered all the required field";
        } else {
           $filter['user_id_PK'] = $user_id;
          
            if ($getResult = $this->webservice_general_model->getData('tbl_user',$filter)) {

                $filterEmail['email'] = $email;
                if ($checkEmail = $this->webservice_general_model->getData('tbl_user',$filterEmail)) {
                    $data['status'] = false;
                    $data['message'] = "It look like email address already registered";;
                  
                }else{
                  $set['firstname'] = $firstname;
                    $set['lastname'] = $lastname;
                    $set['email'] = $email;
                    $this->webservice_general_model->update('tbl_user', $filter, $set);

                    $data['user_id'] = $getResult->user_id_PK;
                    $data['code'] = 200;
                    $data['status'] = true;
                    $data['message'] = "You have successfully sign up";;
                   
                }

                    
            } else {

                $data['message'] = "Something went wrong";;
                $data['status'] = false;
            }
        }
        echo json_encode($data);
    }



    

    public function getNotification() {
        //header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *'); 
        $user_id = trim($this->input->post('user_id'));
        if ($user_id == "") {
            $data['status'] = false;
            $data['message'] = "Invalid Credential, Please check and try again later.";
        } else {
                $data['status'] = true;
                $data['code'] = 200;
                $data['notification'] = $this->webservice_model->getNotification($user_id);

        }
        echo str_replace('\/', '/', json_encode($data));
    }




    public function getCountries() {
        //header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
            if ($getCountries = $this->webservice_model->getCountries()) {
                $data['status'] = true;
                $data['result'] = $getCountries;
                $data['code'] = 200;
            } else {
                $data['status'] = false;
                $data['message'] = 'No Record Found';
                $data['code'] = 207;
            }
        echo str_replace('\/', '/', json_encode($data));
    }

    public function getCatCuisine() {
        //header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $user_id = trim($this->input->post('user_id'));
        if ($user_id == "") {
            $data['status'] = false;
            $data['message'] = "Invalid Credential, Please check and try again later.";
        } else {
                $data['status'] = true;
                $data['code'] = 200;
                $data['category'] = $this->webservice_model->getCategories();
                $data['cuisine'] = $this->webservice_model->getCuisine();

        }
        echo str_replace('\/', '/', json_encode($data));
    }

    function base64_to_jpeg($base64_string, $output_file) {

//data:image/jpeg;base64
        $imgReplace = str_replace("data:image/jpeg;base64,","",$base64_string);
        $decoded=base64_decode($imgReplace);
        file_put_contents("uploads/user/".$output_file,$decoded);
        return $output_file;

    }

    public function updateProfilePic() {
        //header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $user_id = trim($this->input->post('user_id'));
        $user_image = trim($this->input->post('user_image'));
        if ($user_id == "" || $user_image == "") {
            $data['status'] = false;
            $data['message'] = "Invalid Credential, Please check and try again later.";
        } else {

            $extension = ".jpg";
            $filename = $user_id.time();

            ini_set('upload_max_filesize', '10M');
            ini_set('memory_limit', '-1');

            $image_name = $this->base64_to_jpeg($user_image,$filename.$extension);
            $image_name_thumb = "";

            $config1['image_library'] = 'gd2';
            $config1['source_image'] = './uploads/user/' . $image_name;
            $config1['create_thumb'] = TRUE;
            $config1['maintain_ratio'] = TRUE;
            $config1['width'] = 500;
            $this->load->library('image_lib', $config1);
            $this->image_lib->initialize($config1);
            $this->image_lib->resize();
            $this->image_lib->clear();

            $image_name_thumb = $filename."_thumb".$extension ;


                $filter['id'] = $user_id;
                $set['profile_picture'] = $image_name_thumb;
                $this->webservice_general_model->update('users', $filter, $set);

                $data['status'] = true;
                $data['user_image'] = base_url()."uploads/user/".$image_name_thumb;


        }
        echo json_encode($data);
    }


     public function getHomeData() {
        header('Content-Type: application/json');
        $user_id = trim($this->input->post('user_id'));
        if ($user_id == "") {
            $data['status'] = false;
            $data['message'] = "Invalid Credential, Please check and try again later.";
        } else {
                $data['status'] = true;
                $data['code'] = 200;
                $data['bannerData'] = $this->webservice_model->getBannerList();
                $data['getHomeProductList'] = $this->webservice_model->getHomeProductList();
                $data['cart_count'] = $this->webservice_model->getCartCount($user_id);

        }
        echo str_replace('\/', '/', json_encode($data));
    }



    public function getProductDetail() {
       header('Content-Type: application/json');
       $user_id = trim($this->input->post('user_id'));
       $product_id = trim($this->input->post('product_id'));

       if ($user_id == "" || $product_id == "") {
           $data['status'] = false;
           $data['message'] = "Invalid Credential, Please check and try again later.";
       } else {
           if ($getProductDetail = $this->webservice_model->getProductDetail($product_id,$user_id)) {
               $data['status'] = true;
               $data['result'] = $getProductDetail;
               $data['code'] = 200;
               //$data['getSimilarProduct'] = 200;
           } else {
               $data['status'] = false;
               $data['message'] = 'No Record Found';
               $data['code'] = 207;
           }
       }
       echo str_replace('\/', '/', json_encode($data));

     }


     public function getUserDetail() {
        //header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $user_id = trim($this->input->post('user_id'));

        if ($user_id == "") {
            $data['status'] = false;
            $data['message'] = "Invalid Credential, Please check and try again later.";
        } else {
            if ($getUserDetail = $this->webservice_model->getUserDetail($user_id)) {
                $data['status'] = true;

                $data['imageBaseurl'] = "http://base5.coretechie.in/breezymeal/uploads/user/";

                if($getUserDetail[0]->profile_picture == ""){
                    $getUserDetail[0]->profile_picture = base_url()."uploads/user/placeholder.jpg";
                }else{
                    $getUserDetail[0]->profile_picture = base_url()."uploads/user/".$getUserDetail[0]->profile_picture;
                }
                $data['result'] = $getUserDetail;

                $data['code'] = 200;
            } else {
                $data['status'] = false;
                $data['message'] = 'No Record Found';
                $data['code'] = 207;
            }
        }
        echo str_replace('\/', '/', json_encode($data));

      }

      public function getCookDetails() {
         //header('Content-Type: application/json');
         header('Access-Control-Allow-Origin: *');
         $user_id = trim($this->input->post('user_id'));
         $cook_id = trim($this->input->post('cook_id'));
         $latitude = trim($this->input->post('latitude'));
         $longitude = trim($this->input->post('longitude'));

         if ($user_id == "") {
             $data['status'] = false;
             $data['message'] = "Invalid Credential, Please check and try again later.";
         } else {

           if ($cook_id == "") {
               $data['status'] = false;
               $data['message'] = "cook_id is missing in request";
           }else
           {
             if ($getDishDetail = $this->webservice_model->getCookDetails($cook_id,$latitude,$longitude)) {
                $data['status'] = true;
                $detail = $getDishDetail;

                $detail->cookRating = $detail->rating;
                $detail->distance = number_format((float)$detail->distance, 2, '.', '');;
                if($getDishDetail->isDeliveryAvailable=="1"){
                    $detail->deliveryOption = "Delivery Available";
                  }else{
                        $detail->deliveryOption = "Pick Up";
                  }
                $detail->recepies = $this->webservice_model->getCookDishList($user_id,$cook_id,$latitude,$longitude);


                $data['result'] = $detail;
                $data['code'] = 200;
            } else {
                $data['status'] = false;
                $data['message'] = 'No Record Found';
                $data['code'] = 207;
            }
          }


         }
         echo str_replace('\/', '/', json_encode($data));
     }


    public function getDishDetails() {
       $final = array();
       //header('Content-Type: application/json');
       header('Access-Control-Allow-Origin: *');
       $user_id = trim($this->input->post('user_id'));
       $dish_id = trim($this->input->post('dish_id'));
       $latitude = trim($this->input->post('latitude'));
         $longitude = trim($this->input->post('longitude'));


       if ($user_id == "") {
           $data['status'] = false;
           $data['message'] = "Invalid Credential, Please check and try again later.";
       } else {

         if ($dish_id == "") {
             $data['status'] = false;
             $data['message'] = "dish_id is missing in request";
         }else
         {
           if ($getDishDetail = $this->webservice_model->getDishDetail($user_id,$dish_id)) {
              $data['status'] = true;
              $detail = $getDishDetail;

              if($detail->image1 != ""){
                $final[] = base_url()."uploads/dishes/".$detail->image1;
              }
              if($detail->image2 != ""){
                $final[] = base_url()."uploads/dishes/".$detail->image2;
              }
              if($detail->image3 != ""){
                $final[] = base_url()."uploads/dishes/".$detail->image3;
              }
              if($detail->image4 != ""){
                $final[] = base_url()."uploads/dishes/".$detail->image4;
              }
              if($detail->image5 != ""){
                $final[] = base_url()."uploads/dishes/".$detail->image5;
              }

              $detail->dishPrice = number_format((float)$detail->dishPrice, 2, '.', ''); ;

              $detail->dishImages = $final;

              $getCookDetails = $this->webservice_model->getCookDetails($detail->Cookid,$latitude,$longitude);

              $detail->cookRating = $getCookDetails->rating;
              $detail->distance = number_format((float)$getCookDetails->distance, 2, '.', '');
              if($getCookDetails->isDeliveryAvailable=="1"){
                $detail->deliveryOption = "Delivery Available";
              }else{
                    $detail->deliveryOption = "Pick Up";
              }
              
              $detail->slots = $this->webservice_model->get_slot_details($detail->slots);
              $getReviews = $this->webservice_model->getCookReviews($detail->Cookid);
             $detail->reviews  = $getReviews;
              $data['result'] = $detail;
              $data['code'] = 200;
          } else {
              $data['status'] = false;
              $data['message'] = 'No Record Found';
              $data['code'] = 207;
          }
        }


       }
       echo str_replace('\/', '/', json_encode($data));
   }

   public function updateLatLong() {

    header('Access-Control-Allow-Origin: *');
    $user_id = trim($this->input->post('user_id'));
    $device_id = trim($this->input->post('device_id'));
    $latitude = trim($this->input->post('latitude'));
    $longitude = trim($this->input->post('longitude'));
    if ($user_id == "" || $device_id == "" || $latitude=="" || $longitude=="") {
        $data['status'] = false;
        $data['message'] = "Invalid Data";
    } else {
        $set['latitude'] = $latitude;
        $set['longitude'] = $longitude;
        $filter['id'] = $user_id;
        $this->webservice_general_model->update('users', $filter, $set);
         $data['status'] = true;
      }
      echo str_replace('\/', '/', json_encode($data));

   }


   public function updateProfile() {
      //header('Content-Type: application/json');
      header('Access-Control-Allow-Origin: *');
      $user_id = trim($this->input->post('user_id'));

      $first_name = trim($this->input->post('firstName'));
      $last_name = trim($this->input->post('lastName'));

      $email = trim($this->input->post('email'));
      $contact = trim($this->input->post('contact'));
      $address = trim($this->input->post('address'));
      $city = trim($this->input->post('city'));
      $country_id = trim($this->input->post('country_id'));


     if ($user_id == "") {
          $data['status'] = false;
          $data['message'] = "user_id not found";

      } else {

        if ($this->webservice_model->checkUserExist($user_id))
        {
          $filteruserInfo['id'] = $user_id;


          $setUserDetail['first_name'] = $first_name;
          $setUserDetail['last_name'] = $last_name;
          $setUserDetail['email'] = $email;
          $setUserDetail['phone'] = $contact;
          $setUserDetail['address'] = $address;
          $setUserDetail['city'] = $city;
          $setUserDetail['country_id_FK'] = $country_id;

          $this->webservice_general_model->update('users', $filteruserInfo, $setUserDetail);
          $data['status'] = true;
          $data['result'] = $setUserDetail;
          $data['code'] = 200;

        }else
        {
          $data['status'] = false;
          $data['message'] = 'No Record Found';
          $data['code'] = 207;
        }
      }
      echo str_replace('\/', '/', json_encode($data));
  }


    public function logout() {
        $this->session->unset_userdata('user');
        $this->session->sess_destroy();
        redirect('login');
    }


     public function changePassword(){
        //header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $user_id = trim($this->input->post('user_id'));
        $old_password = trim($this->input->post('old_password'));
        $new_password = trim($this->input->post('new_password'));

        if($user_id == "" || $old_password == "" || $new_password == ""){
            $data['status'] = false;
            $data['message'] = "Please entered all the required field";
        }else{
            $filter['id'] = $user_id;
            $filter['password'] = md5($old_password);
            if($getData = $this->webservice_general_model->getData('users',$filter)){
                $set['password'] =  md5($new_password);
                $this->webservice_general_model->update('users',$filter,$set);

                $data['status'] = true;
                $data['message'] = "Password has been changed";
            }else{
                $data['status'] = false;
                $data['message'] = "Incorrect Old Password";
            }
        }
        echo json_encode($data);
    }


     public function forgotWS() {
        //header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $email = trim($this->input->post('email'));
        if ($email == "") {
            $data['status'] = false;
            $data['message'] = "Please enter email address";
        } else {

          $filter['email'] = $email;
          if ($this->webservice_general_model->getData('users', $filter))
          {
            $password = rand(100000,999999);

            $this->webservice_model->sendEmail($email,"Your new password is: ".$password,"Change Password Request");

            $setPassword['password'] = md5($password);
            $this->webservice_general_model->update('users', $filter, $setPassword);
            $data['status'] = true;
            $data['message'] = "Your password has been sent to your registered email";
            $data['code'] = 200;

          }
           else {
                $data['status'] = false;
                $data['message'] = 'Entered email is not registered';
                $data['code'] = 207;
            }
        }
        echo str_replace('\/', '/', json_encode($data));
    }


    public function addToCart() {
        //header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $dish_id = trim($this->input->post('dish_id'));
        $isPlus = trim($this->input->post('isPlus'));
        $user_id = trim($this->input->post('user_id'));
        $time_slot_id = trim($this->input->post('time_slot_id'));
        $device_id = trim($this->input->post('device_id'));
        $quantity = trim($this->input->post('quantity'));
        $cook_id = trim($this->input->post('cook_id'));

        if ($user_id == "" || $dish_id == "" || $time_slot_id == "" || $quantity == "" || $device_id == "" ) {
            $data['status'] = false;
            $data['code'] = 202;
            $data['message'] = "Please entered all the required field";
        } else {
            if($user_id == 0){
                $filter['device_id'] = $device_id;
            }else{
                $filter['user_id_FK'] = $user_id;
            }

            $filter['dish_id_FK'] = $dish_id;
            $filter['time_slot_id_FK'] = $time_slot_id;
            if ($getCart = $this->webservice_general_model->getData('tbl_cart', $filter)) {

                if ($quantity == 0) {
                        $this->webservice_general_model->delete('tbl_cart', $filter);
                        $data['status'] = true;
                        $data['code'] = 200;
                        $data['message'] = "Deleted";
                        $data['quantity'] = 0;
                        //$data['cartCount'] = $this->buyerwebservice_model->getCartCountAdded($user_id,"buyer");
                } else {
                    $set['quantity'] = $quantity;
                    $this->webservice_general_model->update('tbl_cart', $filter, $set);
                    $data['status'] = true;
                    $data['code'] = 200;
                    $data['message'] = "Updated";
                    $data['quantity'] = $quantity;
                    //$data['cartCount'] = $this->buyerwebservice_model->getCartCountAdded($user_id,"buyer");
                }

            } else {

             if($this->webservice_model->checkDishAvailability($dish_id)){
                    if($user_id == 0){
                      $filteruser['device_id'] = $device_id;
                    }else{
                      $filteruser['user_id_FK'] = $user_id;
                    }

                     if($getCart = $this->webservice_general_model->getData('tbl_cart', $filteruser)){
                          //if($getCart->cook_id_FK == $cook_id){
                            $set['device_id'] = $device_id;
                            $set['user_id_FK'] = $user_id;
                            $set['dish_id_FK'] = $dish_id;
                            $set['quantity'] = $quantity;
                            $set['cook_id_FK'] = $cook_id;
                            $set['time_slot_id_FK'] = $time_slot_id;
                            $id = $this->webservice_general_model->insert('tbl_cart', $set);
                            $data['status'] = true;
                            $data['code'] = 200;
                            $data['message'] = "Inserted";
                            $data['quantity'] = $quantity;
                          /*}else{
                            $data['status'] = false;
                            $data['message'] = "You cannot add other cook dishes in the same cart";
                          }*/
                      }else{
                          $set['device_id'] = $device_id;
                          $set['user_id_FK'] = $user_id;
                          $set['dish_id_FK'] = $dish_id;
                          $set['quantity'] = $quantity;
                          $set['cook_id_FK'] = $cook_id;
                          $set['time_slot_id_FK'] = $time_slot_id;
                          $id = $this->webservice_general_model->insert('tbl_cart', $set);
                          $data['status'] = true;
                          $data['code'] = 200;
                          $data['message'] = "Inserted";
                          $data['quantity'] = $quantity;
                     }
             }else{
                $data['status'] = false;
                $data['message'] = "Dish is not Available for this day";
             }

        }
    }
        echo json_encode($data);
    }


    public function getCartList() {
       //header('Content-Type: application/json');
       header('Access-Control-Allow-Origin: *');
       $user_id = trim($this->input->post('user_id'));
       $device_id = trim($this->input->post('device_id'));
       $latitude = trim($this->input->post('latitude'));
       $longitude = trim($this->input->post('longitude'));

       if ($user_id=="" || $device_id=="" ) {
           $data['status'] = false;
           $data['message'] = "Invalid Credential, Please check and try again later.";
       } else {

          if ($getCartList = $this->webservice_model->getCartList($user_id,$device_id)) {
              $data['status'] = true;
              $detail = $getCartList;
              $data['result'] = $detail;
              $filter['id'] = $detail[0]->created_by;
              $select = "id as cook_id,first_name,last_name,address,city,profile_picture";
              $getCookDetail =  $this->webservice_general_model->getData('users', $filter,'',$select);
              if($getCookDetail->profile_picture == ""){
                  $getCookDetail->profile_picture = "";
              }else{
                  $getCookDetail->profile_picture = base_url()."uploads/user/".$getCookDetail->profile_picture;
              }


              $getDishDetail = $this->webservice_model->getCookDetails($detail[0]->created_by,$latitude,$longitude);
              $detail = $getDishDetail;
             
              $data['cookDetail'] = $getCookDetail;
              $data['rating'] = $detail->rating;
              $data['code'] = 200;
          } else {
              $data['status'] = false;
              $data['message'] = 'No Record Found';
              $data['code'] = 207;
          }
       }
       echo str_replace('\/', '/', json_encode($data));
   }

   public function getCartCount() {
      //header('Content-Type: application/json');
      header('Access-Control-Allow-Origin: *');
      $user_id = trim($this->input->post('user_id'));
      $device_id = trim($this->input->post('device_id'));


      if ($user_id=="" && $device_id=="" ) {
          $data['status'] = false;
          $data['message'] = "Invalid Credential, Please check and try again later.";
      } else {

         if ($getCartList = $this->webservice_model->getCartCountAdded($user_id,$device_id)) {
             $data['status'] = true;
             $data['cartCount'] = $getCartList;
             $data['code'] = 200;
         } else {
             $data['status'] = false;
             $data['message'] = 'No Record Found';
             $data['code'] = 207;
         }
      }
      echo str_replace('\/', '/', json_encode($data));
  }


  public function removeCart() {
        //header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $cart_id = trim($this->input->post('cart_id'));
        $user_id = trim($this->input->post('user_id'));
        $device_id = trim($this->input->post('device_id'));

        if ($user_id == "" || $cart_id == "" || $device_id == "" ) {
            $data['status'] = false;
            $data['code'] = 202;
            $data['message'] = "Please entered all the required field";
        } else {
            if($user_id == 0){
                $filter['device_id'] = $device_id;
            }else{
                $filter['user_id_FK'] = $user_id;
            }

            $filter['cart_id_PK'] = $cart_id;
            if ($getCart = $this->webservice_general_model->getData('tbl_cart', $filter)) {
                        $this->webservice_general_model->delete('tbl_cart', $filter);
                        $data['status'] = true;
                        $data['code'] = 200;
                        $data['message'] = "Deleted";

            } else {
                $data['status'] = false;
                $data['message'] = "Something went wrong";
           }
        }
        echo json_encode($data);
    }



    public function createOrder() {
        //header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $user_id = trim($this->input->post('user_id'));
        $cook_id = trim($this->input->post('cook_id'));
        $transaction_id = trim($this->input->post('transaction_id'));
        $delivery_address = trim($this->input->post('delivery_address'));
        $latitude = trim($this->input->post('latitude'));
        $longitude = trim($this->input->post('longitude'));

        $token = trim($this->input->post('stripeToken'));
        $name = trim($this->input->post('name'));
        $email = trim($this->input->post('email'));

        if ($user_id == "" || $cook_id == "" || $delivery_address == "") {
            $data['status'] = false;
            $data['code'] = 202;
            $data['message'] = "Please entered all the required field";
        } else {

            //check whether stripe token is not empty
            if(!empty($token))
            {
                //include Stripe PHP library
                require_once APPPATH."third_party/stripe/init.php";

                //set api key
                /*$stripe = array(
                  "secret_key"      => "sk_test_Gv6bU8Lb5lUMIh040OgkmxEp",
                  "publishable_key" => "pk_test_cZt5PlWh34oW3RTIVSNU0wUk"
                );*/

                $stripe = array(
                  "secret_key"      => "sk_live_5nI0ul46t7hzgHbnGqnrodAg",
                  "publishable_key" => "pk_live_yZ93QxaW7GjAOJ8zYxZzJU9O"
                );


                 \Stripe\Stripe::setApiKey($stripe['secret_key']);

                    //add customer to stripe
                    $customer = \Stripe\Customer::create(array(
                        'email' => $email,
                        'source'  => $token
                    ));

                    $calculateTotalAmt = $this->webservice_model->calculateTotalAmount($user_id);
                    if($calculateTotalAmt == 0){
                        $data['status'] = false;
                        $data['message'] = "Total Amount should not zero";
                        echo json_encode($data);
                        die;
                    }

                    $breezyOrderID = "BM".time()."".$user_id;


                    //item information
                    $itemName = "BreezyMeal Order Food";
                    $itemNumber = $breezyOrderID;
                    $itemPrice =  $calculateTotalAmt;
                    $currency = "USD";
                    $orderID = $breezyOrderID;

                try{

                    //charge a credit or a debit card
                    $charge = \Stripe\Charge::create(array(
                        'customer' => $customer->id,
                        'amount'   => $itemPrice,
                        'currency' => $currency,
                        'description' => $itemNumber,
                        'metadata' => array(
                            'item_id' => $itemNumber
                        )
                    ));

                } catch(Stripe_CardError $e) {

                    $data['status'] = false;
                    $data['message'] = "Please enter correct card details";
                    echo json_encode($data);
                    die;

                } catch (Stripe_InvalidRequestError $e) {
                    $data['status'] = false;
                    $data['message'] = "Please enter valid token";
                    echo json_encode($data);
                    die;
                } catch (Stripe_AuthenticationError $e) {
                    $data['status'] = false;
                    $data['message'] = "Authentication Error";
                    echo json_encode($data);
                    die;
                } catch (Stripe_ApiConnectionError $e) {
                    $data['status'] = false;
                    $data['message'] = $e->getMessage();
                    echo json_encode($data);
                    die;
                } catch (Stripe_Error $e) {
                    $data['status'] = false;
                    $data['message'] = $e->getMessage();
                    echo json_encode($data);
                    die;
                } catch (Exception $e) {

                    $data['status'] = false;
                    $data['message'] = $e->getMessage();
                    echo json_encode($data);
                    die;
                }

                //retrieve charge details
                $chargeJson = $charge->jsonSerialize();

                //check whether the charge is successful
                if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1)
                {
                    //order details
                    $amount = $chargeJson['amount'];
                    $balance_transaction = $chargeJson['balance_transaction'];
                    $currency = $chargeJson['currency'];
                    $status = $chargeJson['status'];
                    $date = date("Y-m-d H:i:s");


                    //insert tansaction data into the database
                    $dataDB = array(
                        'name' => $name,
                        'email' => $email,
                        'stripe_customer_id' => $customer->id,
                        'item_name' => $itemName,
                        'item_number' => $itemNumber,
                        'item_price' => $itemPrice,
                        'item_price_currency' => $currency,
                        'paid_amount' => $amount,
                        'paid_amount_currency' => $currency,
                        'txn_id' => $balance_transaction,
                        'payment_status' => $status,
                        'created_date' => $date
                    );

                    if ($this->db->insert('tbl_transaction', $dataDB)) {
                        if($this->db->insert_id() && $status == 'succeeded'){
                            $transaction_id = $this->db->insert_id();

                            if ($createOrder = $this->webservice_model->createOrder($user_id,$cook_id,
                                    $transaction_id,$delivery_address,$latitude,$longitude,$breezyOrderID)) {
                                  $data['status'] = true;
                                  $data['message'] = "Your Order has been Placed with Order Id ".$createOrder;

                            } else {
                                $data['status'] = false;
                                $data['message'] = "No Item Found in Your Cart";
                            }

                        }else{
                            $data['status'] = false;
                            $data['message'] = "Transaction has been failed";
                        }
                    }
                    else
                    {
                        $data['status'] = false;
                        $data['message'] = "Transaction has been failed";
                    }
                }
                else
                {
                    $data['status'] = false;
                    $data['message'] = "Stripe Invalid Token";
                }
            }else{
                $data['status'] = false;
                $data['message'] = "Please enter valid Token";
            }
        }
        echo json_encode($data);
    }



    public function manageOrder() {
        //header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $user_id = trim($this->input->post('user_id'));

        if ($user_id == "") {
            $data['status'] = false;
            $data['code'] = 202;
            $data['message'] = "Please entered all the required field";
        } else {
            if ($manageOrder = $this->webservice_model->manageOrder($user_id)) {
                  $data['status'] = true;
                  $data['orderList'] = $manageOrder ;

            } else {
                $data['status'] = false;
                $data['message'] = "No Order Found";
           }
        }
        echo json_encode($data);
    }


    public function orderDetail() {
        //header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $user_id = trim($this->input->post('user_id'));
        $order_id = trim($this->input->post('order_id'));

        if ($user_id == "" || $order_id == "") {
            $data['status'] = false;
            $data['code'] = 202;
            $data['message'] = "Please entered all the required field";
        } else {
            if ($orderDetail = $this->webservice_model->orderDetail($user_id,$order_id)) {
                  $data['status'] = true;
                  $data['orderDetail'] = $orderDetail;

            } else {
                $data['status'] = false;
                $data['message'] = "Something went wrong";
           }
        }
        echo json_encode($data);
    }


    public function orderDisputes() {
        //header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $user_id = trim($this->input->post('user_id'));
        $order_id = trim($this->input->post('order_id'));
        $dispute_for = trim($this->input->post('dispute_for'));
        $dispute_reason = trim($this->input->post('dispute_reason'));

        if ($user_id == "" || $dispute_for == "" || $dispute_reason == "") {
            $data['status'] = false;
            $data['code'] = 202;
            $data['message'] = "Please entered all the required field";
        } else {
          $orderCheck['order_id_PK'] = $order_id;
          $orderDetail = $this->webservice_general_model->getData('tbl_order', $orderCheck);



          $disputeCheck['order_id_FK'] = $order_id;
          $disputeCheck['user_id_FK'] = $user_id;
          if ($this->webservice_general_model->getData('tbl_order_disputes', $disputeCheck))
          {
            $data['status'] = false;
            $data['message'] = "You have already disputed this order";
          }else {

            if ($orderDetail->order_status_id_FK == 3)
            {
              if ($orderDetail = $this->webservice_model->orderDisputes($user_id,$order_id,
                                $dispute_for,$dispute_reason)) {
                    $data['status'] = true;
                    $data['message'] = "Your disputed has been reported";

              } else {
                  $data['status'] = false;
                  $data['message'] = "Something went wrong";
             }
            }else {
              $data['status'] = false;
              $data['message'] = "You can not dispute as order is not complete";
            }

          }

        }
        echo json_encode($data);
    }


    public function cookRating() {
        //header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $user_id = trim($this->input->post('user_id'));
        $cook_id = trim($this->input->post('cook_id'));
        $rating = trim($this->input->post('rating'));
        $reviews = trim($this->input->post('reviews'));

        if ($user_id == "" || $rating == "" || $reviews == "" || $cook_id == "") {
            $data['status'] = false;
            $data['code'] = 202;
            $data['message'] = "Please entered all the required field";
        } else {
            if ($orderDetail = $this->webservice_model->cookRating($user_id,$cook_id,
                              $rating,$reviews)) {
                  $data['status'] = true;
                  $data['message'] = "Your rating has been saved";

            } else {
                $data['status'] = false;
                $data['message'] = "Something went wrong";
           }
        }
        echo json_encode($data);
    }


    public function payment_success()
    {
        $this->load->view('payment_success');
    }

    public function payment_error()
    {
        $this->load->view('payment_error');
    }

    public function help()
    {
        $this->load->view('help');
    }


    public function getMyKey() {
        //header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
            $data['status'] = true;
            $data['mode'] = "Live";
            $data['publish_key'] = "pk_live_yZ93QxaW7GjAOJ8zYxZzJU9O";
            $data['secret_key'] = "sk_live_5nI0ul46t7hzgHbnGqnrodAg";
           
        echo str_replace('\/', '/', json_encode($data));
    }


     public function sendNotification(){
        
        #API access key from Google API's Console
            if(!defined( 'API_ACCESS_KEY')){
                define( 'API_ACCESS_KEY', 'AIzaSyAkORaKCogT80jjUlmJjQQvFrYPG_c5aBY' );
            }
            #prep the bundle
            $msg = array
                (
                'body'  => 'Btana mat aaye to notification',
                'title' => 'BreezyMeal - Notification',
                'icon'  => 'myicon',/*Default Icon*/
            );

//print_r($msg);
      
            $fields = array
            (
                'to'        => 'fwQjQWqBjcQ:APA91bGZC_CWPOyiTuDsRppGL7neu3VR2AaAWwC8naGU4LaR3GT4ZfMNDnOxmFu81aqkMY8wFSbNoILTSgG6gn5Y6jy09Zphb-5m_kNhL9xZgYwb8fbnXe53rUiMLiNXbvyCXr7ZRksf',
                //'notification'    => $msg,
                'data'  => $msg,
                'priority' => 'high'
            );
            
            $headers = array
            (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
            );
            #Send Reponse To FireBase Server    
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
            echo $result = curl_exec($ch );
            curl_close( $ch );
            
       
        #Echo Result Of FireBase Server
        return true;
    }





}
