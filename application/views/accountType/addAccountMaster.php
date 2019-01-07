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
                 
            <a href="<?= base_url(); ?>AccountMasterController" class="btn btn-primary">Back</a>

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
           <form id="add_account_Master_form" method="post">
                    <div class="row">

  <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
                        <div class="col-md-6 form-group">
                            <label>Name <span class="mandatory"> * </span></label>
                            <input type="text" class="form-control txt_Space" name="add_AccountMaster_name" id="add_AccountMaster_name" placeholder="Enter Name" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('username') ?>
                        </div>
                        
                      <div class="col-md-6 form-group">
                            <label>A/c Type <span class="mandatory"> * </span></label>
                            <select id="add_AccountMaster_Id" name="add_AccountMaster_Id" class="form-control selectpicker" data-live-search="true" required>
                            
                            </select>   
                          
                        </div>
       </div>
       <div class="row">
                          <div class="col-md-12 form-group">
                            <label>Address-1 <span class="mandatory"> * </span> </label>
                            <input type="text" class="form-control" name="add_AccountMaster_Address1" id="add_AccountMaster_Address1" placeholder="Enter Address 1" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('address-1') ?>
                          </div>
</div>
       <div class="row">
                          <div class="col-md-12 form-group">
                            <label>Address-2 <span class="mandatory"> * </span> </label>
                            <input type="text" class="form-control" name="add_AccountMaster_Address2" id="add_AccountMaster_Address2" placeholder="Enter Address 2" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('address-2') ?>
                          </div>

                          </div>
       <div class="row">
                          <div class="col-md-12 form-group">
                            <label>Address-3 <span class="mandatory"> * </span> </label>
                            <input type="text" class="form-control" name="add_AccountMaster_Address3" id="add_AccountMaster_Address3" placeholder="Enter Address 3" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('address-3') ?>
                          </div>
                 </div>
            <div class="row">
              <div class="col-md-3 form-group">
                            <label>State <span class="mandatory">  </span></label>
                            <select id="add_AccountMaster_State_Id" name="add_AccountMaster_State_Id" onchange="cityListSelected(this);" class="form-control selectpicker" data-live-search="true" required>
                            <option value="101"selected>Andaman and Nicobar Islands</option>
                            </select>   
                            
                        </div>

                              
                        <div class="col-md-3 form-group">
                            <label>City <span class="mandatory"> * </span></label>
                            <select id="add_AccountMaster_City_Id" name="add_AccountMaster_City_Id" class="form-control selectpicker" data-live-search="true" required>
                            <option value=" "selected>Select City</option>
                           
                            </select>   
                            <?php echo form_error('country_id') ?>
                        </div>

                              

                        <div class="col-md-3 form-group">
                            <label>PinCode <span class="mandatory">  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_pincode" id="add_AccountMaster_pincode" placeholder="Enter pincode" autocomplete="off" minlength="6" maxlength="6" pattern="[0-9 ]+"> <?php echo form_error('pincode') ?>
                                       
                        </div>

                        <div class="col-md-3 form-group">
                            <label>Kilo Meter <span class="mandatory">  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_KiloMeter" id="add_AccountMaster_KiloMeter" placeholder="Enter Kilo Meter " autocomplete="off" pattern="[0-9 ]+"> <?php echo form_error('kilo Meter') ?>
                                       
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Phone/Mob. <span class="mandatory">  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_PhoneMobile" id="add_AccountMaster_PhoneMobile" placeholder="Enter Phone/Mobile Number" autocomplete="off"  minlength="2" maxlength="10" pattern="[0-9 ]+"> <?php echo form_error('phoneMobile') ?>
                                      
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Area Name <span class="mandatory"> * </span></label>
                        
                            <input type="textarea" class="form-control" name="add_AccountMaster_area_name" id="add_AccountMaster_area_name" placeholder="Area Name" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('Area Name') ?>
                                       
                        </div>
                        
                        <div class="col-md-4 form-group" align="text-right">
                            <label>Rate With GST In Pur. <span class="mandatory">  </span></label>
                            <select id="add_AccountMaster_Rate_With_Gst" name="add_AccountMaster_Rate_With_Gst" class="form-control selectpicker" data-live-search="true">

                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                            
                        
                            </select>   
                            <?php echo form_error('country_id') ?>
                        </div>
                   </div>                  
                  <div class="row">
                    <div class="col-md-6 form-group">
                            <label>Contact Person <span class="mandatory">  </span> </label>
                            <input type="text" class="form-control txt_Space" name="add_AccountMaster_Contactperson" id="add_AccountMaster_Contactperson" placeholder="Enter Contact Person" autocomplete="off" pattern="[a-zA-Z ]+"> <?php echo form_error('Contact Person') ?>
                          </div>
                       <div class="col-md-6 form-group">
                            <label>Party Group <span class="mandatory">  </span> </label>
                            <input type="text" class="form-control" name="add_AccountMaster_partyGroup" id="add_AccountMaster_partyGroup" placeholder="Enter Contact Person" autocomplete="off" pattern="[a-zA-Z ]+"> <?php echo form_error('Contact Person') ?>
                          </div>
                          <div class="col-md-12 form-group">
                            <div class="row">
                          <div class="col-md-10 form-group">
                            <label>Broker <span class="mandatory">  </span> </label>
                            <input type="text" class="form-control txt_Space" name="add_AccountMaster_Broker" id="add_AccountMaster_Broker" placeholder="Enter Broker" autocomplete="off" pattern="[a-zA-Z ]+"> <?php echo form_error('Broker') ?>
                          </div>
                          <div class="col-md-2 form-group">
                          <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BrokerController/insertBroker">Add</a>
                          </div>
                          </div>
                          </div>

                          <div class="col-md-12 form-group">
                            <label>Email <span class="mandatory">  </span> </label>
                            <input type="email" class="form-control emailOnly" name="add_AccountMaster_Email" id="add_AccountMaster_Email" placeholder="Enter email" autocomplete="off" pattern="[a-zA-Z ]+"> <?php echo form_error('email') ?>
                          </div>

                          <div class="col-md-4 form-group" >
                            <label>IGST Party <span class="mandatory">  </span></label>
                            <select id="add_AccountMaster_Igst" name="add_AccountMaster_Igst" class="form-control selectpicker"  data-live-search="true">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                            <option value="">Select</option>
                           
                            </select>   
                            <?php echo form_error('country_id') ?>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>CR Days. <span class="mandatory">  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_Crdays" id="add_AccountMaster_Crdays" placeholder="Enter CR Days" autocomplete="off" pattern="[0-9 ]+"> <?php echo form_error('cr_days') ?>
                                       
                        </div>
                        <div class="col-md-4 form-group">
                            <label>CR Limit. <span class="mandatory">  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_Crlimit" id="add_AccountMaster_Crlimit" placeholder="Enter CR Limit." autocomplete="off" pattern="[0-9 ]+"> <?php echo form_error('cr_limit') ?>
                                       
                        </div>
                        <div class="col-md-4 form-group">
                            <label>INT Rate % <span class="mandatory">  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_Intrate" id="add_AccountMaster_Intrate" placeholder="Enter INT Rate % " autocomplete="off" pattern="[0-9 ]+"> <?php echo form_error('int_rate') ?>
                                       
                        </div>
                        <div class="col-md-4 form-group">
                            <label>DISC % <span class="mandatory">  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_Disc" id="add_AccountMaster_Disc" placeholder="Enter DISC % " autocomplete="off" pattern="[0-9 ]+"> <?php echo form_error('disc') ?>
                                       
                        </div>
                         <div class="col-md-4 form-group" >
                            <label>TDS % <span class="mandatory">  </span></label>
                            <select id="add_AccountMaster_Tds" name="add_AccountMaster_Tds" class="form-control selectpicker" data-live-search="true">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                            <option value="">Select</option>

                            </select>   
                            <?php echo form_error('country_id') ?>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>GST No. <span class="mandatory">  </span></label>
                        
                            <input type="text" class="form-control alpha_numeric" name="add_AccountMaster_Gstno" id="add_AccountMaster_Gstno" maxlength="15" minlength="15" placeholder="Enter GST No." autocomplete="off" pattern="[0-9 ]+"> <?php echo form_error('gst_no') ?>
                                       
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Pan No. <span class="mandatory"> * </span></label>
                        
                            <input type="text" class="form-control alpha_numeric" name="add_AccountMaster_Panno" id="add_AccountMaster_Panno" placeholder="Enter Pan No." maxlength="10" minlength="10" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('pan_no') ?>
                                       
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Transport No. <span class="mandatory">  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_Transportno" id="add_AccountMaster_Transportno" placeholder="Enter Transport No." autocomplete="off" pattern="[0-9 ]+"> <?php echo form_error('add_AccountMaster_Transportno') ?>
                                       
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Transport Id <span class="mandatory">  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_Transport_Id" id="add_AccountMaster_Transport_Id" placeholder="Enter Transport Id." autocomplete="off" pattern="[0-9 ]+"> <?php echo form_error('add_AccountMaster_Transport_Id') ?>
                                      
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Taxable Amt Rnd Off. <span class="mandatory">  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_Taxable_Amt" id="add_AccountMaster_Taxable_Amt" placeholder="Enter Taxable Amt Rnd Off." autocomplete="off" pattern="[0-9 ]+"> <?php echo form_error('taxable_Amt') ?>
                                       
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Composit Tax Party <span class="mandatory">  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="add_AccountMaster_Composit_Tax" id="add_AccountMaster_Composit_Tax" placeholder="Enter Composit Tax Party." autocomplete="off" pattern="[0-9 ]+"> <?php echo form_error('gst_no') ?>
                                       
                        </div>
                        <div class="col-md-4 form-group" >
                            <label>Rev. Ch. Party <span class="mandatory">  </span></label>
                            <select id="add_AccountMaster_Rev_Ch" name="add_AccountMaster_Rev_Ch" class="form-control selectpicker" data-live-search="true">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                            <option value="">Select</option>
                            
                            </select>   
                            <?php echo form_error('country_id') ?>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Remark </label>
                        
                            <textarea name="add_account_master_remark" id="add_account_master_remark" rows="2" cols="160"></textarea>
                                       
                        </div>
                  </div>

                  </form>   
          <button name="add_accountMaster" id="add_accountMaster" class="btn btn-primary"><?php if($uid==""){echo "Add Account Master";}else{echo "update Account Master";} ?></button>

               
          </div>
        </div>
      </div>
    </div>

    </div>

<?php  $this->load->view('assests/footer'); ?>
 <script type='text/javascript'>

   var accountTypeMasterDataBroker = $("#add_AccountMaster_Broker").tautocomplete({
        width: "500px",
        columns: ['Broker Name', 'City Name', 'Phone Name'],
        placeholder: "Search Broker",
        id: "accountTypebroker_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getBroker/",
            type: "POST",
            data: function()
             {
                var x = {BrokerName: $('#accountTypebroker_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + accountTypeMasterDataBroker.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = accountTypeMasterDataBroker.searchdata();
                if(filterData.length==0)
                { 
                    globlval = srcfild;
                }
                return result;

            }
        },
                
        onchange: function () {
        event.preventDefault();
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var shiftPressed = event.shiftKey;
            // AJAX request
            return;
        }  

    } 
    });

  $(document).ready(function(){
    callStateAPI(1);
   $('#add_accountMaster').on('click', function () {

        if ($('#add_account_Master_form').valid())
        {
            addAccountMasterToServer();
        }
    });

  });



 function addAccountMasterToServer(){
  var accountTypeToServerdata = new FormData(document.getElementById("add_account_Master_form"));
  accountTypeToServerdata.append('add_AccountMaster_Broker', accountTypeMasterDataBroker.id());
      // AJAX request
    $.ajax({
      url:'<?=base_url()?>AccountMasterController/addAccountMaster',
      method: 'post',
      data: accountTypeToServerdata,
      dataType : 'json',
      processData: false,
      contentType: false,
      success: function(response){
         if(response)
         {

            var result=JSON.stringify(response);
            var resultJsonDecode = jQuery.parseJSON(result);
              
                   //alert(result);
              if(resultJsonDecode.status==1)
              {
                       dhtmlx.message({
                        type: "success",
                        text: "Account Master is successfully added",
                        expire: 0
                  });
                    //window.location.replace("<?php echo base_url(); ?>index.php/CompanyController/CompanyList");
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

   $.ajax({
   url:'<?php echo base_url(); ?>/ApiController/get_account',
    method:'get',
    dataType:'json',
   success:function(response){

    //console.log(response.accountmaster);

    var result = JSON.stringify(response);
     $.each(response.accountmaster, function(k,data)   
     {
        $('#add_AccountMaster_Id').append('<option value="' + data['accountType_id_PK'] + '">' + data['account_Type'] + '</option>');
      });

     $('#add_AccountMaster_Id').selectpicker('refresh');
  }

 });


    var uid=$('#uid').val();
    // AJAX request
    $.ajax({
      url:'<?=base_url()?>AccountMasterController/GetUpdateAccountMasterDetail',
      method: 'post',
      data: {uid:uid},
      dataType: 'json',
      success: function(response){
       if(response){

        var result=JSON.stringify(response);
        //var resultJsonDecode = jQuery.parseJSON(result);
        //var results=JSON.stringify(resultJsonDecode.resultSet);
        //var resultSet = jQuery.parseJSON(results);
        //alert(response.accountMasterList.state_id_FK);
        $("#add_AccountMaster_name").val(response.accountMasterList.name);
        
        $("#add_AccountMaster_Id").val(response.accountMasterList.account_type);
        
        $("#add_AccountMaster_Address1").val(response.accountMasterList.address1);
        
        $("#add_AccountMaster_Address2").val(response.accountMasterList.address2);
        
        $("#add_AccountMaster_Address3").val(response.accountMasterList.address3);
        
        $("#add_AccountMaster_State_Id").val(response.accountMasterList.state_id_FK);
        
        $("#add_AccountMaster_City_Id").val(response.accountMasterList.city_id_FK);

        $("#add_AccountMaster_pincode").val(response.accountMasterList.pincode);
        
        $("#add_AccountMaster_KiloMeter").val(response.accountMasterList.kilometer);
        $("#add_AccountMaster_PhoneMobile").val(response.accountMasterList.contactNumber);
        $("#add_AccountMaster_area_name").val(response.accountMasterList.areaName);
        $("#add_AccountMaster_Rate_With_Gst").val(response.accountMasterList.rateGst);
        $("#add_AccountMaster_Contactperson").val(response.accountMasterList.contactPerson);
        $("#add_AccountMaster_partyGroup").val(response.accountMasterList.partyGroup);
        $("#add_AccountMaster_Broker").val(response.accountMasterList.broker);
        $("#add_AccountMaster_Email").val(response.accountMasterList.email);
        $("#add_AccountMaster_Igst").val(response.accountMasterList.igst_party);
        $("#add_AccountMaster_Crdays").val(response.accountMasterList.cr_day);
        $("#add_AccountMaster_Crlimit").val(response.accountMasterList.cr_limit);
        $("#add_AccountMaster_Intrate").val(response.accountMasterList.interest_rate);
        $("#add_AccountMaster_Disc").val(response.accountMasterList.discount);
        $("#add_AccountMaster_Tds").val(response.accountMasterList.tds_percentage);
        $("#add_AccountMaster_Gstno").val(response.accountMasterList.gst_number);
        $("#add_AccountMaster_Panno").val(response.accountMasterList.pan_number);
        $("#add_AccountMaster_Transportno").val(response.accountMasterList.transport_number);
        $("#add_AccountMaster_Transport_Id").val(response.accountMasterList.transport_id);
        $("#add_AccountMaster_Taxable_Amt").val(response.accountMasterList.taxableAmount);
        $("#add_AccountMaster_Composit_Tax").val(response.accountMasterList.compisite_tax_party);
        $("#add_AccountMaster_Rev_Ch").val(response.accountMasterList.receive_check_party);
        $("#add_account_master_remark").val(response.accountMasterList.remark);
        callCityAPI(response.accountMasterList.state_id_FK,response.accountMasterList.city_id_FK);

      // $.each(response.country_list,function(index,data){
   
      //         if (data['id'] == 101)
      //         {
 
      //           $('#branch_country_id').append('<option value="'+data['id']+'" selected>'+data['name']+'</option>');
                
      //         }else
      //         {
      //           $('#branch_country_id').append('<option value="'+data['id']+'">'+data['name']+'</option>');
      //         }
      //   });

        //$('#branch_country_id').selectpicker('refresh');
                        // callStateAPI(resultSet.country_id_FK,resultSet.state_id_FK);
                        // callCityAPI(resultSet.state_id_FK,resultSet.city_id_FK);

                 }
      }
   });

$('#add_AccountMaster_State_Id').selectpicker('refresh');
$('#add_AccountMaster_City_Id').selectpicker('refresh');
    function stateListSelected(e)
      {   
            var x = e.value;
            callStateAPI(x);
      }

   // ---state ----

  function callStateAPI(x,y=null)
  {       
    // alert(x);
    $.ajax({
    url:'<?php echo base_url(); ?>ApiController/get_state',
    method:'get',
    data:{add_AccountMaster_State_Id:x},
    dataType:'json',
   success:function(response){
    var selectedVaue = y;

    console.log("selectedVaue" + y + x);

    var result = JSON.stringify(response);
    //alert(result.statelist);
     $.each(response.statelist, function(k,data)   
     {
        if(data['id'] == selectedVaue){
            $('#add_AccountMaster_State_Id').append('<option value="' + data['id'] + '" selected>' + data['name'] + '</option>');
        }else{
             $('#add_AccountMaster_State_Id').append('<option value="' + data['id'] + '">' + data['name'] + '</option>');
        }
      });

     $('#add_AccountMaster_State_Id').selectpicker('refresh');
  }

 });
  }

  function cityListSelected(e){
            var x = e.value;
            callCityAPI(x);
  }
  function callCityAPI(x,y=null){
    $.ajax({
    url:'<?php echo base_url(); ?>/ApiController/get_city',
    method:'post',
    data:{city: x},
    dataType:'json',
   success:function(response){

    var selectedVaue = y;

      $('#add_AccountMaster_City_Id').empty();
    var result = JSON.stringify(response);
     $('#add_AccountMaster_City_Id').empty();

     $.each(response.citylist, function(k,data)   
     {

      if (data['id'] == selectedVaue){
            $('#add_AccountMaster_City_Id').append('<option value="' + data['id'] + '" selected>' + data['name'] + '</option>');
      }else{
            $('#add_AccountMaster_City_Id').append('<option value="' + data['id'] + '">' + data['name'] + '</option>');
      }

      });

      $('#add_AccountMaster_City_Id').selectpicker('refresh');
  }

 });

}

       //});
    

</script>



 