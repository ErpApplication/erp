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
                 
            <a href="<?= base_url(); ?>operator" class="btn btn-primary">Back</a>

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
           <form id="operatorform">
                    <div class="row">

    <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
                  <div class="col-md-6 form-group">
                      <label >ITEM CODE <span class="mandatory"> *  
                           </span> 
                        </label>
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_Item_Code" id="add_AccountMaster_Item_Code" placeholder="Enter ITEM CODE" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('ITEM CODE') ?>
                        </div>
                      
                       </div>
                      <div class="row">
                          <div class="col-md-6 form-group">
                            <label>ITEM NAME-1 <span class="mandatory">  *</span></label>
                            <input type="text" class="form-control txt_Space" name="add_AccountMaster_Item_Name" id="add_AccountMaster_Item_Name" placeholder="Enter ITEM NAME-1" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('Item_Name') ?>
        
                          
                          </div>
                           </div>
                        <div class="row">
                          <div class="col-md-6 form-group">
                            <label>Group<span class="mandatory"> * </span> </label>
                            <input type="text" class="form-control txt_Space" name="add_AccountMaster_Group" id="add_AccountMaster_Group" placeholder="Enter Group" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('Group') ?>
                          </div>
                        </div>
                       
                      <div class="row">
                              
                        <div class="col-md-12 form-group">
                            <label>Stock Type <span class="mandatory"> * </span></label>
                            <select id="add_AccountMaster_Stock" name="add_AccountMaster_Stock" class="form-control selectpicker" onchange="countryListSelected(this);" data-live-search="true" required>
                            <option value="101"selected>Should have option Stock</option>
                            <option value="F"selected>Finished</option>
                            <option value="R"selected>Raw Material</option>
                            <option value="T"selected>Trading</option>
                            <option value="S"selected>Semi Finished</option>
                            <?php
                            foreach($country_list as $country){
                                echo "<option value='".$country['id']."' >".$country['name']."</option>";
                            }
                            ?>
                            </select>   
                            <?php echo form_error('country_id') ?>
                        </div>
             </div>
                              
                   <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Unit Of Measure <span class="mandatory">  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_Unit" id="add_AccountMaster_Unit" placeholder="Enter Unit Of Measure" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('Unit') ?>
                                       
                        </div>

                        <div class="col-md-4 form-group">
                            <label>Hsn/Sac <span class="mandatory">  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_Hsn" id="add_AccountMaster_Hsn" placeholder="Enter Hsn/Sac " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('Hsn') ?>
                                       
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Dealer Rate <span class="mandatory">  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_Dealer" id="add_AccountMaster_Dealer" placeholder="Enter Dealer Rate" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('Dealer') ?>
                                      
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Cut <span class="mandatory"> * </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_Cut" id="add_AccountMaster_Cut" placeholder=" Enter Cut" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('Cut') ?>
                            </div>           
                        
                        
                    <div class="col-md-4 form-group">
                            <label>Box Pack <span >  </span> </label>
                            <input type="text" class="form-control txt_Space" name="add_AccountMaster_Box" id="add_AccountMaster_Box" placeholder="Enter Box Pack" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('Box Pack') ?>
                          </div>
                         
                    <div class="col-md-4 form-group">
                            <label>MRP <span >  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_Contactperson" id="add_AccountMaster_Contactperson" placeholder="Enter MRP" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('Contact Person') ?>
                          </div>
                        
                         
                    <div class="col-md-4 form-group">
                            <label>Purchase Rate<span >  </span> </label>
                            <input type="text" class="form-control" name="add_AccountMaster_Contactperson" id="add_AccountMaster_Contactperson" placeholder="Enter Purchase Rate" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('Contact Person') ?>
                          </div>
                        <div class="col-md-4 form-group">
                            <label>Gst Calc <span class="mandatory">*  </span></label>
                            <select id="add_AccountMaster_State" name="add_AccountMaster_State" class="form-control selectpicker" onchange="countryListSelected(this);" data-live-search="true" required>
                            <option value="Y"selected>Yes</option>
                            <option value="N"selected>No</option>
                            <?php
                            foreach($country_list as $country){
                                echo "<option value='".$country['id']."' >".$country['name']."</option>";
                            }
                            ?>
                            </select>   
                            <?php echo form_error('country_id') ?>
                        </div>
                           <div class="col-md-4 form-group">
                            <label>SGST % <span class="mandatory">*  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_Crdays" id="add_AccountMaster_Crdays" placeholder="Enter SGST %" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('cr_days') ?>
                                       
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 form-group">
                            <label>CGST % <span class="mandatory">*  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_Crdays" id="add_AccountMaster_Crdays" placeholder="Enter CGST %" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('cr_days') ?>
                                       
                        </div>
                        <div class="col-md-4 form-group">
                            <label>IGST % <span class="mandatory">*  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_Crdays" id="add_AccountMaster_Crdays" placeholder="Enter IGST %" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('cr_days') ?>
                                       
                        </div>
                        <div class="col-md-4 form-group" align="text-right">
                            <label>Show In Stock Report <span class="mandatory"> * </span></label>
                            <select id="add_AccountMaster_Rate_With_Gst" name="add_AccountMaster_Rate_With_Gst" class="form-control selectpicker" onchange="countryListSelected(this);" data-live-search="true" required>
                            <option value="Y"selected>Yes</option><option value="N"selected>No</option>
                      
                            
                            </select>   
                            <?php echo form_error('country_id') ?>
                        </div>
                   </div>                  
                  <div class="row">
                    <div class="col-md-4 form-group">
                            <label>Opening Stock Quality <span>  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_Contactperson" id="add_AccountMaster_Contactperson" placeholder="Enter Opening Stock Quality" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('Contact Person') ?>
                          </div>
                    <div class="col-md-4 form-group">
                            <label>Opening Stock NOS <span>  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_Contactperson" id="add_AccountMaster_Contactperson" placeholder="Enter Opening Stock NOS" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('Contact Person') ?>
                          </div>
                          
                          <div class="col-md-4 form-group">
                            <label>Opening ATM <span>  </span> </label>
                            <input type="text" class="form-control" name="add_AccountMaster_Opening" id="add_AccountMaster_Opening" placeholder="Enter Opening ATM " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('email') ?>
                          </div>
                         </div>
                          <div class="row">
                          <div class="col-md-4 form-group">
                            <label>Rate Updates <span>  </span> </label>
                            <input type="text" class="form-control" name="add_AccountMaster_Email" id="add_AccountMaster_Email" placeholder="Enter Rate Updates" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('email') ?>
                          </div>

                          <div class="col-md-4 form-group" >
                            <label>Active <span class="mandatory"> * </span></label>
                            <select id="add_AccountMaster_Tds" name="add_AccountMaster_Tds" class="form-control selectpicker" onchange="countryListSelected(this);" data-live-search="true" required>
                            <option value="Y"selected>Yes</option><option value="N"selected>No</option>
                           </select>
                         </div>
                        <div class="col-md-4 form-group">
                            <label>Calculate On. <span class="mandatory"> * </span></label>
                        
                            <select id="add_AccountMaster_Tds" name="add_AccountMaster_Tds" class="form-control selectpicker" onchange="countryListSelected(this);" data-live-search="true" required>
                      <option value="M"selected>Mtrs</option>
                      <option value="Q"selected>Qnty</option>
                    </select>
                            </div>           
                        </div>
                         <div class="row">
                        <div class="col-md-4 form-group" >
                            <label>HSN UQC(GSTR-1)<span class="mandatory"> * </span></label>
                            <select id="add_AccountMaster_Tds" name="add_AccountMaster_Tds" class="form-control selectpicker" onchange="countryListSelected(this);" data-live-search="true" required>
                      <option value="N"selected>Numbers</option>
                      <option value="M"selected>Meter</option>
                      <option value="K"selected>Kilogrms</option>
                      <option value="P"selected>Pieces</option>
                      <option value="B"selected>Bags</option>
                      <option value="B"selected>Bale</option>
                      <option value="B"selected>Bundles</option>
                      <option value="B"selected>Box</option>
                      <option value="B"selected>Bunches</option>
                      <option value="C"selected>Cans</option>
                      <option value="P"selected>Packs</option>
                      <option value="C"selected>Cartons</option>
                      <option value="D"selected>Dozens</option>
                      <option value="101"selected>Drums</option>
                      <option value="G"selected>Gross</option>
                      <option value="U"selected>Units</option>
                    </select>
                  </div>
                      <div class="col-md-4 form-group">
                            <label>HSN DESC <span >  </span></label>
                        
                            <input type="number" class="form-control" name="add_AccountMaster_Crlimit" id="add_AccountMaster_Crlimit" placeholder="Enter CR Limit." autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('cr_limit') ?>
                                       
                        </div>                       
                        
                  </div>
                       </form>                  
                        <button name="add_operator" id="add_operator" class="btn btn-primary"><?php if($uid==""){echo "Add Operator";}else{echo "update Operator";} ?></button>
                      
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



