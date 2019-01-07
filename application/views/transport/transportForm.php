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
                 
            <a href="<?= base_url(); ?>transport" class="btn btn-primary">Back</a>

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
           <form id="transportform">
           <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
                        <div class="row">
    
                         <div class="col-md-6 form-group">
                            <label for="exampleInputFile">Transport Name <span class="mandatory"> * </span></label>
                            <input type="text" class="form-control txt_Space" name="transport_name" id="transport_name" placeholder="Enter Transport Name" required pattern="[a-zA-Z ]+" value="<?php echo set_value('transport_name'); ?>"> 
                        </div>
                        <div class="col-md-6 form-group">
                        <label for="exampleInputFile">Contact Person Full Name</label>
                        <input type="text" class="form-control txt_Space" name="contact_person" id="contact_person" placeholder="Enter Contact Person" pattern="[a-zA-Z ]+" value="<?php echo set_value('contact_person'); ?>"> 
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Country <span class="mandatory"> * </span></label>
                            <select id="transport_country_id" name="transport_country_id" class="form-control selectpicker" onchange="countryListSelected(this);" data-live-search="true" required>
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
                        
                            <select id='transport_state_id' name="transport_state_id" class="form-control selectpicker" data-live-search="true" onchange="stateListSelected(this);" required>
                              <option value="" selected>-- Select state --</option>
                            </select>
                            <?php echo form_error('state_id') ?>           
                        </div>

                        <div class="col-md-4 form-group">
                            <label>City <span class="mandatory"> * </span></label>
                            <select id="transport_city_id" name="transport_city_id" class="form-control selectpicker" data-live-search="true" required>
                            <option value="" selected>----select city---</option>
                            </select>  
                            <?php echo form_error('city_id') ?>                 
                        </div>
                        </div>

                        <div class="row">

                        <div class="col-md-6 form-group">
                            <label for="exampleInputFile">Address <span class="mandatory"> * </span></label>
                            <input type="text" class="form-control txt_Space_number" id="transport_address" name="transport_address" placeholder="Enter Transport Address" required pattern="[a-zA-Z0-9 ]+" value="<?php echo set_value('transport_address'); ?>"> <?php echo form_error('transport_address') ?>
                      
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="exampleInputFile">PinCode</label>
                            <input type="text" class="form-control numbersOnly" name="pincode" id="pincode" placeholder="Enter Pincode" minlength="6" maxlength="6" required pattern="[0-9]+" value="<?php echo set_value('pincode'); ?>"> <?php echo form_error('pincode') ?>
                        </div>
                        </div>

                        <div class="row">
 
                           <div class="col-md-6 form-group">
                            <label for="exampleInputFile">GST Number</label>
                            <input type="text" class="form-control alpha_numeric" name="gst" id="gst" style="text-transform:uppercase" placeholder="Enter GST" minlength="15" maxlength="15" pattern="[a-zA-Z0-9]+" value="<?php echo set_value('gst'); ?>">   <?php echo form_error('gst') ?>
                        </div>


                        <div class="col-md-6 form-group">
                        <label>Landline Number</label>
                        <div class="row">
                        <div class="col-md-4 form-group">
                        <input type="text" class="form-control numbersOnly" name="transport_landline_code" id="transport_landline_code" placeholder="STD Code"  minlength="2"  pattern="[0-9]+"> 
                        </div>

                        <div class="col-md-8 form-group">
                        <input type="text" class="form-control numbersOnly" name="landline" id="landline" placeholder="Enter Landline Number"  minlength="6" pattern="[0-9]+"> 
                        </div>
                        </div>
                        </div>
                     
                        </div>

                        <div class="row">

                        <div class="col-md-6 form-group">
                        <label>Contact Number</label>
                        <div class="row">
                        <div class="col-md-4 form-group">
                        <input type="text" class="form-control numbersOnly" name="transport_contact_code" id="transport_contact_code" placeholder="STD Code"  minlength="1" pattern="[0-9]+"> 
                        </div>

                        <div class="col-md-8 form-group">
                        <input type="text" class="form-control numbersOnly" name="contact_number" id="contact_number" placeholder="Enter Contact Number"  minlength="10" pattern="[0-9]+"> 
                        </div>
                        </div>
                        </div>

                        </div>
                
                    </form>
                  
                        <button name="add_transport" id="add_transport" class="btn btn-primary"><?php if($uid==""){echo "Add Transport";}else{echo "update Transport";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>

<?php  $this->load->view('assests/footer'); ?>

  <script type='text/javascript'>
 $(document).ready(function(){
  callStateAPI(101);
 $('#add_transport').on('click', function () {

        $('#transportform').valid();

        if ($('#transportform').valid() == true)
        {
          var uid=$('#uid').val();
          if(uid == ""){
            addTransportToServer();
          }else{
            updateTransportToServer();
          }
        }
    });

   var uid=$('#uid').val();

    // AJAX request
    $.ajax({
      url:'<?=base_url()?>Transport/GetTransportDetail',
      method: 'post',
      data: {uid:uid},
      dataType: 'json',
      success: function(response){
                       if(response){

                          var result=JSON.stringify(response);
                          var resultJsonDecode = jQuery.parseJSON(result);
                          var results=JSON.stringify(resultJsonDecode.resultSet);
                          var resultSet = jQuery.parseJSON(results);
                        //  alert(result);
                          //alert(resultSet.transport_name);
                        //   alert(resultSet.message);

                        $("#transport_name").val(resultSet.transport_name);
                        $("#contact_person").val(resultSet.contact_person);
                        $("#country_id").val(resultSet.country_id_FK);
                        $("#state_id").val(resultSet.state_id_FK);
                        $("#city_id").val(resultSet.city_id_FK);
                        $("#transport_address").val(resultSet.transport_address);
                        $("#pincode").val(resultSet.pincode);
                        $("#gst").val(resultSet.GST);
                        $("#landline").val(resultSet.landline);
                        $("#transport_landline_code").val(resultSet.landline_code);
                        $("#contact_number").val(resultSet.contact_mobile);
                        $("#transport_contact_code").val(resultSet.country_code);

                        callStateAPI(resultSet.country_id_FK,resultSet.state_id_FK);
                        callCityAPI(resultSet.state_id_FK,resultSet.city_id_FK);
                        
                   
                 }


      }
      
   });
    function updateTransportToServer()
    {

    var uid=$('#uid').val();

    var transport_name = $("#transport_name").val();

    var contact_person=$('#contact_person').val();

    var transport_country_id = $("#transport_country_id").val();

    var transport_state_id=$('#transport_state_id').val();

    var transport_city_id = $("#transport_city_id").val();  

    var transport_address=$('#transport_address').val();

    var pincode = $("#pincode").val();

    var gst=$('#gst').val();

    var landline=$('#landline').val();

    var transport_landline_code=$('#transport_landline_code').val();

    var contact_number = $("#contact_number").val();

    var transport_contact_code = $("#transport_contact_code").val();

    
    // AJAX request
    $.ajax({
      url:'<?=base_url()?>Transport/add_transport',
      method: 'post',
      data: {transport_contact_code:transport_contact_code,transport_landline_code:transport_landline_code,uid:uid,transport_name: transport_name,contact_person: contact_person,transport_country_id:transport_country_id,transport_state_id:transport_state_id,transport_city_id:transport_city_id,transport_address:transport_address,pincode:pincode,gst:gst,landline:landline,contact_number:contact_number},
      dataType: 'json',
      success: function(response){
                       if(response){

                          var result=JSON.stringify(response);
                          var resultJsonDecode = jQuery.parseJSON(result);
                           
                        //    $("#msg").html(resultJsonDecode.message);
                             
                     
                        //    alert(resultJsonDecode.status);
                            if(resultJsonDecode.status==1){
                                   dhtmlx.message({
                                    type: "success",
                                    text: "Transport is successfully updated",
                                    expire: 0
                                  });
                                
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


  function addTransportToServer()
  {
          
    var transport_name = $("#transport_name").val();

    var contact_person=$('#contact_person').val();

    var transport_country_id = $("#transport_country_id").val();

    var transport_state_id=$('#transport_state_id').val();

    var transport_city_id = $("#transport_city_id").val();

    var transport_address=$('#transport_address').val();

    var pincode = $("#pincode").val();

    var gst=$('#gst').val();

    var landline=$('#landline').val();

    var transport_landline_code=$('#transport_landline_code').val();

    var contact_number = $("#contact_number").val();

    var transport_contact_code = $("#transport_contact_code").val();

    // AJAX request
    $.ajax({
      url:'<?=base_url()?>Transport/add_transport',
      method: 'post',
      data: {transport_landline_code:transport_landline_code,transport_contact_code:transport_contact_code,transport_name: transport_name,contact_person: contact_person,transport_country_id:transport_country_id,transport_state_id:transport_state_id,transport_city_id:transport_city_id,transport_address:transport_address,pincode:pincode,gst:gst,landline:landline,contact_number:contact_number},
      dataType: 'json',
      success: function(response){
                   if(response){

                      var result=JSON.stringify(response);
                      var resultJsonDecode = jQuery.parseJSON(result);
                     // alert(result);
                      // $("#msg").html(resultJsonDecode.message);
                   //    alert(resultJsonDecode.status);

                       if(resultJsonDecode.status==1){
                             dhtmlx.message({
                                          type: "success",
                                          text: "Transport is successfully created",
                                          expire: 0
                                        });

                                      setTimeout(function () {
                                       window.location.replace("<?php echo base_url(); ?>transport");
                                      }, 1000); 

                       }else{
                                      dhtmlx.message({
                                            type: "error",
                                            text: resultJsonDecode.message,
                                            expire: 0
                                          });
                          
                       }

                      
               
                    //  alert(resultJsonDecode.data);                 
               
             }
  }
  
});
}






});


  $('#transport_country_id').selectpicker('refresh');
$('#transport_city_id').selectpicker('refresh');

        
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
                    $('#transport_state_id').empty();
                    // Add options
                    $.each(response,function(index,data){
                   
                      if (data['id'] == y)
                      {
         
                        $('#transport_state_id').append('<option value="'+data['id']+'" selected>'+data['name']+'</option>');
                        
                      }else
                      {
                        $('#transport_state_id').append('<option value="'+data['id']+'">'+data['name']+'</option>');
                      }

                    });
                 
                    $('#transport_state_id').selectpicker('refresh');

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
         
                        $('#transport_city_id').append('<option value="'+data['id']+'" selected>'+data['name']+'</option>');
                        
                      }else
                      {
                        $('#transport_city_id').append('<option value="'+data['id']+'">'+data['name']+'</option>');
                      }

                    });

                 
                    $('#transport_city_id').selectpicker('refresh');


                  }
                });
         }
    

</script>



 