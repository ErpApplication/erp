 <div class="panel-header panel-header-sm">
  </div>

<div class="content">

     <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <div class="page-heading">
   <!-- 
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
 </div> -->

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
           <form id="manufacture_form">
                        <div class="row">
    
                        <div class="col-md-6 form-group">
                            <label>First Name <span class="mandatory"> * </span></label>
                            <input type="text" class="form-control txt_Space" name="first_name" id="first_name" placeholder="Enter First Name" required pattern="[a-zA-Z ]+">
                        </div>
                        <div class="col-md-6 form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control txt_Space" name="last_name" id="last_name" placeholder="Enter Last Name" pattern="[a-zA-Z ]+">
                        </div>
                        </div>

                      <div class="row">
    
                        <div class="col-md-6 form-group">
                          <label>Email <span class="mandatory"> * </span></label>
                          <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
                        </div>
                        <div class="col-md-6 form-group">
                        <label>Password</label>
                        <input type="password" class="form-control txt_Space" name="password" id="password" placeholder="Enter password" >
                        </div>
                        </div>

                         <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Country <span class="mandatory"> * </span></label>
                            <select id="manufacture_country_id" name="manufacture_country_id" class="form-control selectpicker" onchange="countryListSelected(this);" data-live-search="true" required>
                            <option value="101"selected>India</option>
                            <?php
                            foreach($country_list as $country){
                                echo "<option value='".$country['country_id_PK']."' >".$country['vCountryName']."</option>";
                            }
                            ?>
                            </select>   
                            <?php echo form_error('country_id') ?>
                        </div>

                   

                        <div class="col-md-4 form-group">
                            <label>State <span class="mandatory"> * </span></label>
                        
                            <select id='manufacture_state_id' name="manufacture_state_id" class="form-control selectpicker" data-live-search="true" onchange="stateListSelected(this);" required>
                              <option value="" selected>-- Select state --</option>
                            </select>
                            <?php echo form_error('state_id') ?>           
                        </div>
                        <div class="col-md-4 form-group">
                            <label>City <span class="mandatory"> * </span></label>
                            <select id="manufacture_city_id" name="manufacture_city_id" class="form-control selectpicker" data-live-search="true" required>
                            <option value="" selected>----select city---</option>
                            </select>  
                            <?php echo form_error('city_id') ?>                 
                        </div>
                        </div>

                        <div class="row">

                        <div class="col-md-6 form-group">
                            <label>Address <span class="mandatory"> * </span></label>
                            <input type="text" class="form-control txt_Space_number" id="manufacture_address" name="manufacture_address" placeholder="Enter Manufacture Address" required pattern="[a-zA-Z0-9 ]+">
                      
                        </div>
                        <div class="col-md-6 form-group">
                            <label>PinCode <span class="mandatory"> * </span></label>
                            <input type="text" class="form-control numbersOnly" name="manufacture_pincode" id="manufacture_pincode" placeholder="Enter Pincode" minlength="6" maxlength="6" required pattern="[0-9]+">
                        </div>
                        </div>

                
                
                    </form>
                  
                        <button name="manufacture_register" id="manufacture_register" class="btn btn-primary">SignUp</button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>
<?php $this->load->view('assests/footer'); ?>

  <script type='text/javascript'>
 $(document).ready(function(){
  callStateAPI(101);
 $('#manufacture_register').on('click', function () {

        $('#manufacture_form').valid();

        if ($('#manufacture_form').valid() == true)
        {
        
            manufactureRegisterToServer();
         
        }
    });

    function  manufactureRegisterToServer()
    {
        var first_name = $("#first_name").val();

        var last_name=$('#last_name').val();
        
        var email=$('#email').val();

        var register_country_id = $("#manufacture_country_id").val();
       
        var register_state_id=$('#manufacture_state_id').val();
       
        var register_city_id = $("#manufacture_city_id").val();

        var address = $("#manufacture_address").val();
       
        var password = $("#password").val();
        var register_pincode = $("#manufacture_pincode").val();
       

        $.ajax({
        url:'<?=base_url()?>SignUp/manufactureRegister',
        method: 'post',
        data: {first_name:first_name,last_name:last_name,email:email,register_country_id:register_country_id,register_state_id:register_state_id,register_city_id:register_city_id,password:password,register_pincode:register_pincode,address:address},
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
                                          text: "successfully Manufacture user created",
                                          expire: 0
                                        });

                                  setTimeout(function () {
                                 window.location.replace("<?php echo base_url();?>");
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


  $('#manufacture_country_id').selectpicker('refresh');
$('#manufacture_city_id').selectpicker('refresh');

        
         function countryListSelected(e)
         {
            var x = e.value;

            callStateAPI(x);
         }

         function callStateAPI(x,y=null)
         {
            // AJAX request
                 $.ajax({
                  url:'<?=base_url()?>ApiController/get_state_data',
                  method: 'post',
                  data: {country_id: x},
                  dataType: 'json',
                  success: function(response){
                    $('#manufacture_state_id').empty();
                    // Add options
                    $.each(response,function(index,data){
                   
                      if (data['state_id_PK'] == y)
                      {
         
                        $('#manufacture_state_id').append('<option value="'+data['state_id_PK']+'" selected>'+data['vStateName']+'</option>');
                        
                      }else
                      {
                        $('#manufacture_state_id').append('<option value="'+data['state_id_PK']+'">'+data['vStateName']+'</option>');
                      }

                    });
                 
                    $('#manufacture_state_id').selectpicker('refresh');

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
                  url:'<?=base_url()?>ApiController/get_city_data',
                  method: 'post',
                  data: {state_id: x},
                  dataType: 'json',
                  success: function(response){

                    var selectedVaue = y;

                    console.log("selectedVaue" + y + x);

                    $('#manufacture_city_id').empty();
                    // Add options
                    $.each(response,function(index,data){
                   
                      if (data['state_id_PK'] == selectedVaue)
                      {
         
                        $('#manufacture_city_id').append('<option value="'+data['city_id_PK']+'" selected>'+data['vCity']+'</option>');
                        
                      }else
                      {
                        $('#manufacture_city_id').append('<option value="'+data['city_id_PK']+'">'+data['vCity']+'</option>');
                      }

                    });

                 
                    $('#manufacture_city_id').selectpicker('refresh');


                  }
                });
         }
    

</script>



 