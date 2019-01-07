 <div class="panel-header panel-header-sm">
  </div>

<div class="content">

     <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <div class="page-heading">
   
              <h3>
                <?php echo $title;?>
                <div class="loader"></div>                        

            </h3>
            <ul class="breadcrumb">

            <?php 
             foreach($breadcrumbArray as $key => $val)
             {
                 if ($val == "")
                {
                    ?>
                   <li class="active">
                     <?php echo $key;?>
                      </li>
                  <!--     <li> / My Dashboard </li> -->
                     <?php 
                }else
                {
                    ?>
                   <li>
                     <a href=<?php echo $val;?>><?php echo $key;?></a>
                                          </li>
                  <!-- <li class="active">  My Dashboard </li> -->
                    <?php 
                }
             }
            
            ?>
            </ul>


          <div class="card-footer text-right">
                 
            <a href="<?= base_url(); ?>courier" class="btn btn-primary">Back</a>

          </div>
 </div>

    <?php

        if($this->session->flashdata('item')) {
           $message = $this->session->flashdata('item');
        ?>
           <div class="<?php echo $message['class'] ?>"><?php echo $message['message']; ?>

           </div>
           <?php
         }

          ?>

       <div class="box-header">
                <?php if($this->session->flashdata('success_msg')) { ?>
                <p class="alert alert-success alert-dismissible" >
                  <label style="color:#ffffff"><?php echo $this->session->flashdata('success_msg'); ?>
                  </label></p><?php } ?>

                </div>

                <div class="box-header">
                <?php if($this->session->flashdata('err_message')) { ?>
                    <p class="alert alert-error alert-dismissible" >
                      <label class="has-success"><?php echo $this->session->flashdata('err_message'); ?>
                      </label> 
                      </p><?php
                    } ?>

                 </div>

            <div class="col-md-12">
           <form id="courierform">
           <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
                        <div class="row">
    
                        <div class="col-md-6 form-group">
                            <label>Courier Name <span class="mandatory"> * </span></label>
                            <input type="text" class="form-control txt_Space" name="courier_name" id="courier_name" placeholder="Enter Courier Name" required pattern="[a-zA-Z ]+">
                        </div>
                        <div class="col-md-6 form-group">
                        <label>Contact Person Full Name</label>
                        <input type="text" class="form-control txt_Space" name="contact_person" id="contact_person" placeholder="Enter Contact Person" pattern="[a-zA-Z ]+">
                        </div>
                        </div>

                         <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Country <span class="mandatory"> * </span></label>
                            <select id="courier_country_id" name="courier_country_id" class="form-control selectpicker" onchange="countryListSelected(this);" data-live-search="true" required>
                            <option value="101"selected>India</option>
                            <?php
                            foreach($country_list as $country){
                                echo "<option value='".$country['id']."' >".$country['name']."</option>";
                            }
                            ?>
                            </select>   
                            <?php echo form_error('country_id') ?>
                        </div>

                   

                        <div class="col-md-4 form-group">
                            <label>State <span class="mandatory"> * </span></label>
                        
                            <select id='courier_state_id' name="courier_state_id" class="form-control selectpicker" data-live-search="true" onchange="stateListSelected(this);" required>
                              <option value="" selected>-- Select state --</option>
                            </select>
                            <?php echo form_error('state_id') ?>           
                        </div>
                        <div class="col-md-4 form-group">
                            <label>City <span class="mandatory"> * </span></label>
                            <select id="courier_city_id" name="courier_city_id" class="form-control selectpicker" data-live-search="true" required>
                            <option value="" selected>----select city---</option>
                            </select>  
                            <?php echo form_error('city_id') ?>                 
                        </div>
                        </div>

                        <div class="row">

                        <div class="col-md-6 form-group">
                            <label>Address <span class="mandatory"> * </span></label>
                            <input type="text" class="form-control txt_Space_number" id="courier_address" name="courier_address" placeholder="Enter Courier Address" required pattern="[a-zA-Z0-9 ]+">
                      
                        </div>
                        <div class="col-md-6 form-group">
                            <label>PinCode <span class="mandatory"> * </span></label>
                            <input type="text" class="form-control numbersOnly" name="pincode" id="pincode" placeholder="Enter Pincode" minlength="6" maxlength="6" required pattern="[0-9]+">
                        </div>
                        </div>

                        <div class="row">
 
                          <div class="col-md-6 form-group">
                            <label>GST Number</label>
                            <input type="text" class="form-control alpha_numeric" name="gst" id="gst" style="text-transform:uppercase" placeholder="Enter GST" minlength="15" maxlength="15" pattern="[a-zA-Z0-9]+">
                           </div>

                        <div class="col-md-6 form-group">
                        <label>Landline Number</label>
                        <div class="row">
                        <div class="col-md-4 form-group">
                        <input type="text" class="form-control numbersOnly" name="landline_code" id="landline_code" placeholder="STD Code"  minlength="2" pattern="[0-9]+"> 
                        </div>

                        <div class="col-md-8 form-group">
                        <input type="text" class="form-control numbersOnly" name="landline" id="landline" placeholder="Enter Landline Number"  minlength="5" pattern="[0-9]+"> 
                        </div>
                        </div>
                        </div>
                     

                        <div class="col-md-6 form-group">
                        <label>Contact Number</label>
                        <div class="row">
                        <div class="col-md-4 form-group">
                        <input type="text" class="form-control numbersOnly" name="courier_contact_code" id="courier_contact_code" placeholder="STD Code"  minlength="2" pattern="[0-9]+"> 
                        </div>

                        <div class="col-md-8 form-group">
                        <input type="text" class="form-control numbersOnly" name="contact_number" id="contact_number" placeholder="Enter Contact Number"  minlength="10" pattern="[0-9]+"> 
                        </div>
                        </div>
                        </div>

                    
                    </div>   
                
                    </form>
                  
                        <button name="add_courier" id="add_courier" class="btn btn-primary"><?php if($uid==""){echo "Add Courier";}else{echo "update Courier";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>

<?php  $this->load->view('assests/footer'); ?>

  <script type='text/javascript'>
 $(document).ready(function(){
  callStateAPI(101);
 $('#add_courier').on('click', function () {

        $('#courierform').valid();

        if ($('#courierform').valid() == true)
        {
          var uid=$('#uid').val();
          if(uid == ""){
            addCourierToServer();
          }else{
            updateCourierToServer();
          }
        }
    });

    var uid=$('#uid').val();
    
    // AJAX request
    $.ajax({
      url:'<?=base_url()?>Courier/GetCourierDetail',
      method: 'post',
      data: {uid:"<?php echo $uid; ?>"},
      dataType: 'json',
      success: function(response){
                       if(response){

                          var result=JSON.stringify(response);
                          var resultJsonDecode = jQuery.parseJSON(result);
                          var results=JSON.stringify(resultJsonDecode.resultSet);
                          var resultSet = jQuery.parseJSON(results);
                        
                        //   alert(resultSet.courier_name);
                        //   alert(resultSet.message);

                        $("#courier_name").val(resultSet.courier_name);
                        $("#contact_person").val(resultSet.contact_person);
                        $("#country_id").val(resultSet.country_id_FK);
                        $("#state_id").val(resultSet.state_id_FK);
                        $("#city_id").val(resultSet.city_id_FK);
                        $("#courier_address").val(resultSet.courier_address);
                        $("#pincode").val(resultSet.pincode);
                        $("#gst").val(resultSet.GST);
                        $("#landline").val(resultSet.landline);
                        $("#landline_code").val(resultSet.landline_code);
                        $("#contact_number").val(resultSet.contact_number);
                        $("#courier_contact_code").val(resultSet.country_code);

                        callStateAPI(resultSet.country_id_FK,resultSet.state_id_FK);
                        callCityAPI(resultSet.state_id_FK,resultSet.city_id_FK);
                        
                   
                 }


      }
      
   });

   function updateCourierToServer()
    {

    var uid=$('#uid').val();

    var courier_name = $("#courier_name").val();

    var contact_person=$('#contact_person').val();

   var courier_country_id = $("#courier_country_id").val();

   var courier_state_id=$('#courier_state_id').val();

    var courier_city_id = $("#courier_city_id").val();

    var courier_address=$('#courier_address').val();

    var pincode = $("#pincode").val();

    var gst=$('#gst').val();

    var landline=$('#landline').val();

    var landline_code=$('#landline_code').val();

    var contact_number = $("#contact_number").val();

    var courier_contact_code=$('#courier_contact_code').val();
    
    // AJAX request
    $.ajax({
      url:'<?=base_url()?>Courier/add_courier',
      method: 'post',
      data: {courier_contact_code:courier_contact_code,landline_code:landline_code,uid:uid,courier_name: courier_name,contact_person: contact_person,courier_country_id:courier_country_id,courier_state_id:courier_state_id,courier_city_id:courier_city_id,courier_address:courier_address,pincode:pincode,gst:gst,landline:landline,contact_number:contact_number},
      dataType: 'json',
      success: function(response){
                       if(response){

                          var result=JSON.stringify(response);
                          //alert(result);
                          var resultJsonDecode = jQuery.parseJSON(result);
                          $("#msg").html(resultJsonDecode.message);
                            //alert(resultJsonDecode.status);
                            if(resultJsonDecode.status==1){
                                  dhtmlx.message({
                                    type: "success",
                                    text: "Courier is successfully updated",
                                    expire: 0
                                  });
                              
                            }else{
                                
                                     dhtmlx.message({
                                    type: "error",
                                    text: resultJsonDecode.message,
                                    expire: 0
                                  });
                            }                
                   
                 }
      }
      
   });
}


  function addCourierToServer()
  {
    var courier_name = $("#courier_name").val();

    var contact_person=$('#contact_person').val();

    var courier_country_id = $("#courier_country_id").val();

    var courier_state_id=$('#courier_state_id').val();

    var courier_city_id = $("#courier_city_id").val();

    var courier_address=$('#courier_address').val();

    var pincode = $("#pincode").val();

    var gst=$('#gst').val();

    var landline=$('#landline').val();

    var landline_code=$('#landline_code').val();

    var courier_contact_code=$('#courier_contact_code').val();

    var contact_number = $("#contact_number").val();

    // AJAX request
    $.ajax({
      url:'<?=base_url()?>Courier/add_courier',
      method: 'post',
      data: {courier_contact_code:courier_contact_code,landline_code:landline_code,courier_name:courier_name,contact_person: contact_person,courier_country_id:courier_country_id,courier_state_id:courier_state_id,courier_city_id:courier_city_id,courier_address:courier_address,pincode:pincode,gst:gst,landline:landline,contact_number:contact_number},
      dataType: 'json',
      success: function(response){
                   if(response){

                      var result=JSON.stringify(response);
                      var resultJsonDecode = jQuery.parseJSON(result);

                       $("#msg").html(resultJsonDecode.message);
                    //    alert(resultJsonDecode.status);

                       if(resultJsonDecode.status==1){
                              dhtmlx.message({
                                          type: "success",
                                          text: "Courier is successfully created",
                                          expire: 0
                                        });

                             setTimeout(function () {
                                     window.location.replace("<?php echo base_url(); ?>Courier");
                                  }, 1000);
                            

                       }else{
                            dhtmlx.message({
                                            type: "error",
                                            text: resultJsonDecode.message,
                                            expire: 0
                                          });
                          
                       }

                    //   alert(resultJsonDecode.message);
               
                    //  alert(resultJsonDecode.data);                 
               
             }
  }
  
});
}






});


  $('#courier_country_id').selectpicker('refresh');
$('#courier_city_id').selectpicker('refresh');

        
         function countryListSelected(e)
         {
            var x = e.value;

            callStateAPI(x);
         }

         function callStateAPI(x,y=null)
         {
            // AJAX request
                 $.ajax({
                  url:'<?=base_url()?>Api/get_state_data',
                  method: 'post',
                  data: {country_id: x},
                  dataType: 'json',
                  success: function(response){
                    $('#courier_state_id').empty();
                    // Add options
                    $.each(response,function(index,data){
                   
                      if (data['id'] == y)
                      {
         
                        $('#courier_state_id').append('<option value="'+data['id']+'" selected>'+data['name']+'</option>');
                        
                      }else
                      {
                        $('#courier_state_id').append('<option value="'+data['id']+'">'+data['name']+'</option>');
                      }

                    });
                 
                    $('#courier_state_id').selectpicker('refresh');

                  }
                });
         }


         function stateListSelected(e)
        {
            var x = e.value;

            callCityAPI(x);
        }

         function callCityAPI(x,y=null)
         {
         // AJAX request
                 $.ajax({
                  url:'<?=base_url()?>Api/get_city_data',
                  method: 'post',
                  data: {state_id: x},
                  dataType: 'json',
                  success: function(response){

                    var selectedVaue = y;

                    console.log("selectedVaue" + y + x);

                    $('#courier_city_id').empty();
                    // Add options
                    $.each(response,function(index,data){
                   
                      if (data['id'] == selectedVaue)
                      {
         
                        $('#courier_city_id').append('<option value="'+data['id']+'" selected>'+data['name']+'</option>');
                        
                      }else
                      {
                        $('#courier_city_id').append('<option value="'+data['id']+'">'+data['name']+'</option>');
                      }

                    });

                 
                    $('#courier_city_id').selectpicker('refresh');


                  }
                });
         }
    

</script>



 