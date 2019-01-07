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
                 
            <a href="<?= base_url(); ?>BranchController" class="btn btn-primary">Back</a>

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
           <form id="branchform">
           <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
                        <div class="row">
    
                        <div class="col-md-6 form-group">
                            <label>Branch Name<span class="mandatory"> * </span></label>
                            <input type="text" class="form-control txt_Space" name="branch_name" id="branch_name" placeholder="Enter Branch Name" value="<?php if($type == 'popUp'){ echo $groupName; }else{echo set_value('branch_name'); } ?>" required pattern="[a-zA-Z ]+"> <?php echo form_error('branch_name') ?>
                        </div>

                        <div class="col-md-6 form-group">
                        <label>Landline Number</label>
                        <div class="row">
                        <div class="col-md-4 form-group">
                        <input type="text" class="form-control numbersOnly" name="branch_landline_code" id="branch_landline_code" placeholder="STD Code"  minlength="2" pattern="[0-9]+"> 
                        </div>

                        <div class="col-md-8 form-group">
                        <input type="text" class="form-control numbersOnly" name="branch_landline" id="branch_landline" placeholder="Enter Landline Number"  minlength="5" pattern="[0-9]+"> 
                        </div>
                        </div>
                        </div>
                        
                        </div>
                     
                        <div class="row">
                        <div class="col-md-3 form-group">
                        <label>Manager Name<span class="mandatory"> * </span></label>
                        <input type="text" class="form-control txt_Space" name="manager_name" id="manager_name" placeholder="Enter Manager Name"  value="<?php echo set_value('manage_by'); ?>" required pattern="[a-zA-Z ]+"> <?php echo form_error('manage_by') ?>
                        </div>
                        <div class="col-md-3 form-group">
                        <label>Manager Email<span class="mandatory"> * </span></label>
                        <input type="email" class="form-control emailOnly" name="manager_email" id="manager_email" placeholder="Enter Manager Email"value="<?php echo set_value('manager_email'); ?>" required> <?php echo form_error('manager_email') ?>
                        </div>

                        <div class="col-md-6 form-group">
                        <label>Contact Number</label>
                        <div class="row">
                        <div class="col-md-4 form-group">
                        <input type="text" class="form-control numbersOnly" name="branch_contact_code" id="branch_contact_code" placeholder="STD Code"  minlength="1" pattern="[0-9]+"> 
                        </div>

                        <div class="col-md-8 form-group">
                        <input type="text" class="form-control numbersOnly" name="branch_contact_number" id="branch_contact_number" placeholder="Enter Contact Number"  minlength="10" pattern="[0-9]+"> 
                        </div>
                        </div>
                        </div>

                        </div>

                         <div class="row">
                       
                            <div class="col-md-4 form-group">
                                <label>Country</label>
                                <select id="branch_country_id" name="branch_country_id" class="form-control selectpicker" onchange="countryListSelected(this);" data-live-search="true" required>
                                 <?php

                                foreach($country_list as $country)
                                {
                                    if ($country['id'] == 101)
                                    {
                                        echo "<option value='".$country['id']."' selected>".$country['name']."</option>";

                                    }else
                                    {
                                        echo "<option value='".$country['id']."' >".$country['name']."</option>";

                                    }
                                }
                                ?>
                                </select>   
                                <input type="hidden" id= "selectedCountryID" >
                                <input type="hidden" id= "selectedStateID" >
                                <input type="hidden" id= "selectedCityID" >

                                <?php echo form_error('country') ?>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>State</label>
                            
                                <select id='branch_state_id' name="branch_state_id" class="form-control selectpicker" data-live-search="true" onchange="stateListSelected(this);" required>

                                <option value="" selected>----select state---</option>

                                </select>
                                <?php echo form_error('state') ?>           
                            </div>

                            <div class="col-md-4 form-group">
                                <label>City</label>
                                <select id="branch_city_id" name="branch_city_id" class="form-control selectpicker" data-live-search="true" required>
                                <option value="" selected>----select city---</option>
                                </select>  
                                <?php echo form_error('city') ?>                 
                            </div>
                        </div>

                        <div class="row">
                        
                        <div class="col-md-6 form-group">
                            <label>Branch Address<span class="mandatory"> * </span></label>
                            <input type="text" class="form-control txt_Space_number" id="branch_address" name="branch_address" placeholder="Enter Branch Address" value="<?php echo set_value('branch_address'); ?>" required pattern="[a-zA-Z0-9, ]+"> <?php echo form_error('branch_address') ?>
                      
                        </div>                
                        <div class="col-md-6 form-group">
                            <label>PinCode<span class="mandatory"> * </span></label>
                            <input type="text" class="form-control numbersOnly" name="branchPincode" id="branchPincode" placeholder="Enter Pincode" value="<?php echo set_value('pincode'); ?>" minlength="6" maxlength="6" required pattern="[0-9]+"> <?php echo form_error('pincode') ?>
                        </div>
                 
               

                        </div>
                    </form>
                  
                        <button name="add_branch" id="add_branch" class="btn btn-primary"><?php if($uid==""){echo "Add Branch";}else{echo "update Branch";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>

<?php  $this->load->view('assests/footer'); ?>

  <script type='text/javascript'>
 $(document).ready(function(){
  callStateAPI(101);
 $('#add_branch').on('click', function () {

        $('#branchform').valid();

        if ($('#branchform').valid() == true)
        {
          var uid=$('#uid').val();
          if(uid == ""){
            addBranchToServer();
          }else{
            updateBranchToServer();
          }
        }
    });

    var uid=$('#uid').val();
    
    // AJAX request
    $.ajax({
      url:'<?=base_url()?>BranchController/GetUpdateBranchDetail',
      method: 'post',
      data: {uid:uid},
      dataType: 'json',
      success: function(response){
                       if(response){

                        var result=JSON.stringify(response);
                        var resultJsonDecode = jQuery.parseJSON(result);
                        var results=JSON.stringify(resultJsonDecode.resultSet);
                        var resultSet = jQuery.parseJSON(results);
                        
                        $("#branch_name").val(resultSet.branch_name);
                        
                        $("#manager_email").val(resultSet.manager_email);
                        
                        $("#branch_address").val(resultSet.branch_address);
                        
                        $("#branch_contact_code").val(resultSet.country_code);
                        
                        $("#branch_contact_number").val(resultSet.manager_number);
                        
                        $("#manager_name").val(resultSet.manage_by);
                        
                        $("#branchPincode").val(resultSet.pincode);

                        $("#branch_landline").val(resultSet.landline);
                        
                        $("#branch_landline_code").val(resultSet.landline_code);

                         $.each(response.country_list,function(index,data){
                   
                              if (data['id'] == 101)
                              {
                 
                                $('#branch_country_id').append('<option value="'+data['id']+'" selected>'+data['name']+'</option>');
                                
                              }else
                              {
                                $('#branch_country_id').append('<option value="'+data['id']+'">'+data['name']+'</option>');
                              }
                        });

                        $('#branch_country_id').selectpicker('refresh');
                        callStateAPI(resultSet.country_id_FK,resultSet.state_id_FK);
                        callCityAPI(resultSet.state_id_FK,resultSet.city_id_FK);

                 }
      }
   });

     function updateBranchToServer()
    {
            var uid=$('#uid').val();

            var branch_name = $("#branch_name").val();

            var manager_email=$('#manager_email').val();
            
            var country_id = $("#branch_country_id").val();

            var state_id=$('#branch_state_id').val();

            var city_id = $("#branch_city_id").val();

            var branch_address=$('#branch_address').val();

            var branch_contact_code = $("#branch_contact_code").val();
            
            var branch_contact_number = $("#branch_contact_number").val();

            var manager_name=$('#manager_name').val();

            var pincode=$('#branchPincode').val();

            var branch_landline=$('#branch_landline').val();
            
            var branch_landline_code=$('#branch_landline_code').val();

            
            // AJAX request
            $.ajax({
              url:'<?=base_url()?>BranchController/BranchAdd',
              method: 'post',
              data: {branch_contact_number:branch_contact_number,branch_contact_code:branch_contact_code,branch_landline_code:branch_landline_code,uid:uid,branch_name: branch_name,manager_name:manager_name,pincode:pincode,branch_landline:branch_landline,manager_email: manager_email,country_id:country_id,state_id:state_id,city_id:city_id,branch_address:branch_address},
              dataType: 'json',
              success: function(response){
                               if(response){

                                  var result=JSON.stringify(response);
                                  var resultJsonDecode = jQuery.parseJSON(result);

                                if(resultJsonDecode.status==1)
                                {

                                   dhtmlx.message({
                                    type: "success",
                                    text: "Branch is successfully updated",
                                    expire: 0
                                  });

                                       var type = '<?php echo $type ?>';

                                       if (type == 'popUp')
                                       {
                                          $('#OpenBranchDialog').modal('hide');

                                       }else
                                       {
                                          
                                       } 

                                      
                                }else
                                {



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


  function addBranchToServer()
    {
            var branch_name = $("#branch_name").val();

            var manager_email=$('#manager_email').val();

            var country_id = $("#branch_country_id").val();

            var state_id=$('#branch_state_id').val();

            var city_id = $("#branch_city_id").val();

            var branch_address=$('#branch_address').val();

            var branch_contact_code = $("#branch_contact_code").val();
            
            var branch_contact_number = $("#branch_contact_number").val();

            var manager_name=$('#manager_name').val();

            var pincode=$('#branchPincode').val();

            var branch_landline=$('#branch_landline').val();
            
            var branch_landline_code=$('#branch_landline_code').val();

            // AJAX request
            $.ajax({
              url:'<?=base_url()?>BranchController/BranchAdd',
              method: 'post',
              data: {branch_contact_number:branch_contact_number,branch_contact_code:branch_contact_code,branch_landline_code:branch_landline_code,branch_name: branch_name,branch_landline:branch_landline,manager_name:manager_name,pincode:pincode,manager_email: manager_email,country_id:country_id,state_id:state_id,city_id:city_id,branch_address:branch_address},
              dataType: 'json',
              success: function(response){
                               if(response){

                                  var result=JSON.stringify(response);
                                  var resultJsonDecode = jQuery.parseJSON(result);
                                      
                                   $("#msg").html(resultJsonDecode.message);
                                   //alert(resultJsonDecode.status);

                                   if(resultJsonDecode.status==1){

                                     dhtmlx.message({
                                          type: "success",
                                          text: "Branch is successfully created",
                                          expire: 0
                                        });

                                    

                                        var type = '<?php echo $type ?>';

                                       if (type == 'popUp')
                                       {
                                          $('#OpenBranchDialog').modal('hide');

                                       }else
                                       {


                                         setTimeout(function () {
                                                   window.location.replace("<?php echo base_url(); ?>BranchController");
                                                }, 1000);




                                          
                                       }  


                                        

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


$('#branch_country_id').selectpicker('refresh');
$('#branch_city_id').selectpicker('refresh');

        
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
                    $('#branch_state_id').empty();
                    // Add options
                    $.each(response,function(index,data){
                   
                      if (data['id'] == y)
                      {
         
                        $('#branch_state_id').append('<option value="'+data['id']+'" selected>'+data['name']+'</option>');
                        
                      }else
                      {
                        $('#branch_state_id').append('<option value="'+data['id']+'">'+data['name']+'</option>');
                      }

                    });
                 
                    $('#branch_state_id').selectpicker('refresh');

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

                    $('#branch_city_id').empty();
                    // Add options
                    $.each(response,function(index,data){
                   
                      if (data['id'] == selectedVaue)
                      {
         
                        $('#branch_city_id').append('<option value="'+data['id']+'" selected>'+data['name']+'</option>');
                        
                      }else
                      {
                        $('#branch_city_id').append('<option value="'+data['id']+'">'+data['name']+'</option>');
                      }

                    });
                 
                    $('#branch_city_id').selectpicker('refresh');

                  }
                });
         }
    

</script>



 