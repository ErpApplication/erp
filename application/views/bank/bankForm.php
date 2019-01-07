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
                 
            <a href="<?= base_url(); ?>bank" class="btn btn-primary">Back</a>

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
           <form id="bankform">
           <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">

           <div class="row">  
              <div class="col-md-6 form-group">
              <label>Bank Name<span class="mandatory"> * </span></label>
              <input type="text" class="form-control txt_Space" name="bank_name" id="bank_name" placeholder="Enter Bank Name" required pattern="[a-zA-Z ]+"> 
              </div>

              <div class="col-md-6 form-group">
              <label>Landline Number</label>
              <div class="row">
              <div class="col-md-4 form-group">
              <input type="text" class="form-control numbersOnly" name="landline_code" id="landline_code" placeholder="STD Code"  minlength="4" maxlength="4" pattern="[0-9]+"> 
              </div>

              <div class="col-md-8 form-group">
              <input type="text" class="form-control numbersOnly" name="landline" id="landline" placeholder="Enter Landline Number"  minlength="6" maxlength="6" pattern="[0-9]+"> 
              </div>
              </div>
              </div>

              
                           
          </div>
           
             <div class="row">
                  <div class="col-md-4 form-group">
                  <label>Country<span class="mandatory"> * </span></label>
                  <select id="bank_country_id" name="bank_country_id" class="form-control selectpicker" onchange="countryListSelected(this);" data-live-search="true" required>
                  <option value="101" selected>India</option>
                  <?php
                  foreach($country_list as $country){
                      echo "<option value='".$country['id']."' >".$country['name']."</option>";
                  }
                  ?>
                  </select>   
                  <?php echo form_error('country_id') ?>
                  </div>


                  <div class="col-md-4 form-group">
                      <label>State<span class="mandatory"> * </span></label>
                  
                      <select id='bank_state_id' name="bank_state_id" class="form-control selectpicker" data-live-search="true" onchange="stateListSelected(this);" required>
                      <option value="" selected>-- Select state --</option>
                      </select>
                      <?php echo form_error('state_id') ?>           
                  </div>

                  <div class="col-md-4 form-group">
                      <label>City<span class="mandatory"> * </span></label>
                      <select id="bank_city_id" name="bank_city_id" class="form-control selectpicker" data-live-search="true" required>
                      <option value="" selected>----select city---</option>
                      </select>  
                      <?php echo form_error('city_id') ?>                 
                  </div>
              </div>



               <div class="row">          
                  <div class="col-md-6 form-group">
                  <label>Address</label>
                  <input type="text" class="form-control txt_Space_number" id="address" name="address" placeholder="Enter Address" pattern="[a-zA-Z0-9, ]+">
                  </div> 
                  <div class="col-md-6 form-group">
                  <label>PinCode</label>
                  <input type="text" class="form-control numbersOnly" name="pincode" id="pincode" placeholder="Enter Pincode" minlength="6" maxlength="6" pattern="[0-9]+">
                  </div>                                                          
              </div>
   
                
                    </form>
                  
                        <button name="add_bank" id="add_bank" class="btn btn-primary"><?php if($uid==""){echo "Add Bank";}else{echo "update Bank";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>

<?php  $this->load->view('assests/footer'); ?>

  <script type='text/javascript'>
 $(document).ready(function(){
  callStateAPI(101);
 $('#add_bank').on('click', function () {

        $('#bankform').valid();

        if ($('#bankform').valid() == true)
        {
          var uid=$('#uid').val();
          if(uid == ""){
            addBankToServer();
          }else{
            updateBankToServer();
          }
        }
    });


    var uid=$('#uid').val();

    // AJAX request
    $.ajax({
      url:'<?=base_url()?>Bank/GetBankDetail',
      method: 'post',
      data: {uid:uid},
      dataType: 'json',
      success: function(response){
                       if(response){

                          var result=JSON.stringify(response);
                          var resultJsonDecode = jQuery.parseJSON(result);
                          var results=JSON.stringify(resultJsonDecode.resultSet);
                          var resultSet = jQuery.parseJSON(results);
                    
                          // alert(resultSet.branch_id_FK);
                        //   alert(resultSet.message);

                        $("#bank_name").val(resultSet.bank_name);
                        $("#landline").val(resultSet.landline);

                        $("#country_id").val(resultSet.country_id_FK);
                        $("#state_id").val(resultSet.state_id_FK);
                        $("#city_id").val(resultSet.city_id_FK);

                        $("#address").val(resultSet.address);
                        $("#pincode").val(resultSet.pincode);
                        $("#landline_code").val(resultSet.landline_code);

                        $("#selectedCountryID").val(resultSet.country_id_FK);
                        $("#selectedStateID").val(resultSet.state_id_FK);
                        $("#selectedCityID").val(resultSet.city_id_FK);

                        callStateAPI(resultSet.country_id_FK,resultSet.state_id_FK);
                        callCityAPI(resultSet.state_id_FK,resultSet.city_id_FK);
                 }


      }
      
   });


 function updateBankToServer()
    {

    var uid=$('#uid').val();

    var bank_name = $("#bank_name").val();

    var landline=$('#landline').val();

    var landline_code=$('#landline_code').val();

    var bank_country_id = $("#bank_country_id").val();

    var bank_state_id=$('#bank_state_id').val();

    var bank_city_id = $("#bank_city_id").val();

    var address = $("#address").val();

    var pincode = $("#pincode").val();
    
    // AJAX request
    $.ajax({
      url:'<?=base_url()?>Bank/add_bank',
      method: 'post',
      data: {landline_code:landline_code,uid:uid,bank_name:bank_name,landline:landline,pincode:pincode,bank_country_id:bank_country_id,bank_state_id:bank_state_id,bank_city_id:bank_city_id,address:address},
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
                                    text: "Bank is successfully updated",
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


    function  addBankToServer()
    {
        var bank_name = $("#bank_name").val();

        var landline=$('#landline').val();
        
        var landline_code=$('#landline_code').val();

        var bank_country_id = $("#bank_country_id").val();
       
        var bank_state_id=$('#bank_state_id').val();
       
        var bank_city_id = $("#bank_city_id").val();

        var address = $("#address").val();
       
        var pincode = $("#pincode").val();
       

        $.ajax({
        url:'<?=base_url()?>Bank/add_bank',
        method: 'post',
        data: {landline_code:landline_code,bank_name:bank_name,landline:landline,pincode:pincode,bank_country_id:bank_country_id,bank_state_id:bank_state_id,bank_city_id:bank_city_id,address:address},
        dataType: 'json',
        success: function(response){
                   if(response){

                      var result=JSON.stringify(response);
                      var resultJsonDecode = jQuery.parseJSON(result);

                       $("#msg").html(resultJsonDecode.message);
                       //alert(resultJsonDecode.status);

                       if(resultJsonDecode.status == 1){
                                 dhtmlx.message({
                                          type: "success",
                                          text: "Bank is successfully created",
                                          expire: 0
                                        });

                                  setTimeout(function () {
                                                   window.location.replace("<?php echo base_url(); ?>bank");
                                                }, 1000);
                            
                           
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






});


  $('#bank_country_id').selectpicker('refresh');
  $('#bank_city_id').selectpicker('refresh');

        
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
                    $('#bank_state_id').empty();
                    // Add options
                    $.each(response,function(index,data){
                   
                      if (data['id'] == y)
                      {
         
                        $('#bank_state_id').append('<option value="'+data['id']+'" selected>'+data['name']+'</option>');
                        
                      }else
                      {
                        $('#bank_state_id').append('<option value="'+data['id']+'">'+data['name']+'</option>');
                      }

                    });
                 
                    $('#bank_state_id').selectpicker('refresh');

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

                    $('#bank_city_id').empty();
                    // Add options
                    $.each(response,function(index,data){
                   
                      if (data['id'] == selectedVaue)
                      {
         
                        $('#cbank_city_id').append('<option value="'+data['id']+'" selected>'+data['name']+'</option>');
                        
                      }else
                      {
                        $('#bank_city_id').append('<option value="'+data['id']+'">'+data['name']+'</option>');
                      }

                    });

                 
                    $('#bank_city_id').selectpicker('refresh');


                  }
                });
         }
    

</script>



 