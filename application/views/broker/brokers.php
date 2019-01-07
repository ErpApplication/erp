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
                 
            <a href="<?= base_url(); ?>BrokerController" class="btn btn-primary">Back</a>

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
           <form id="broker_form" method="post">
                    <div class="row">

    <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
                  <div class="col-md-12 form-group">
                      <label >Name <span class="mandatory"> *  
                           </span> 
                        </label>
                            <input type="text" class="form-control txt_Space" name="broker_name" id="broker_name" placeholder="Enter Name" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('username') ?>
                        </div>
                      
                       </div>
                      <div class="row">
                          <div class="col-md-6 form-group">
                            <label>State <span class="mandatory"> * </span></label>
                            <select id="broker_State_Id" name="broker_State_Id" class="form-control selectpicker" onchange="countryListSelected(this);" data-live-search="true" required>
                            
                          <option value="101"selected>--Select State--</option>
                    
                            </select>   
                            
                        </div>

                         <div class="col-md-6 form-group">
                            <label>City. <span class="mandatory"> * </span></label>
                            <select id="broker_City_Id" name="broker_City_Id" class="form-control selectpicker" onchange="countryListSelected(this);" data-live-search="true" required>
                            
                          <option value=""selected>--select City---</option>
                    
                                                 
                            
                            </select>   
                            <?php echo form_error('country_id') ?>
                        </div>
                     </div>
                         <div class="row">
                          <div class="col-md-6 form-group">
                            <label>Taluka(Area/Address)<span class="mandatory"> * </span> </label>
                            <input type="text" class="form-control" name="broker_Taluka" id="broker_Taluka" placeholder="Enter Taluka(Area/Address)" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('Taluka') ?>
                          </div>
                                                                                                                                                                       
                       <div class="col-md-6 form-group">
                            <label>Phone <span class="mandatory">*  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="broker_Phone" id="broker_Phone" maxlength="10" minlength="10" placeholder="Enter Phone" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('Phone') ?>
                                       
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Address <span class="mandatory">  *</span></label>
                        
                            <input type="text" class="form-control" name="broker_Address" id="broker_Address" placeholder="Enter Address " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('Address') ?>
                              </div>         
                        </div>
                        <div class="row">
                        <div class="col-md-4 form-group">
                            <label>GST <span class="mandatory"> * </span></label>
                        
                            <input type="text" class="form-control alpha_numeric" name="broker_Gst" id="broker_Gst" placeholder="Enter GST" maxlength="15" minlength="15" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('GST') ?>
                                      
                        </div>

                            <div class="col-md-4 form-group">
                            <label>Pan <span class="mandatory"> * </span></label>
                        
                            <input type="text" class="form-control alpha_numeric" name="broker_Pan" id="broker_Pan" maxlength="10" minlength="10" placeholder="Enter PAN" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('PAN') ?>
                                      
                        </div>
                      
                        <div class="col-md-4 form-group">
                            <label>Tan<span class="mandatory"> * </span></label>
                        
                            <input type="text" class="form-control alpha_numeric" name="broker_Tan" id="broker_Tan" placeholder=" Enter Tan" maxlength="10" minlength="10" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('Tan') ?>
                            </div>           
                        </div>
                       <div class="row"> 
                        <div class="col-md-6 form-group">
                            <label>Email <span class="mandatory"> *  </span> </label>
                            <input type="email" class="form-control emailOnly" name="broker_Email" id="broker_Email" placeholder="Enter Email" autocomplete="off" required>
                          </div>
                         
                        <div class="col-md-6 form-group">
                            <label>Pincode <span class="mandatory"> * </span> </label>
                            <input type="text" class="form-control numbersOnly" name="broker_Pincode" id="broker_Pincode" placeholder="Enter Pincode" maxlength="6" minlength="6" autocomplete="off" maxlength="6" minlength="6" required pattern="[0-9]+"> <?php echo form_error('Pin') ?>
                          </div>
                        </div>                                                                                  
                                                                                                                                                                                                                                                                                                                                     
                       </form>                  
                        <button name="add_broker" id="add_broker" class="btn btn-primary"><?php if($uid==""){echo "Add Broker";}else{echo "Update Broker";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>

<?php  $this->load->view('assests/footer'); ?>
 <script type='text/javascript'>

   $(document).ready(function(){
    //callStateAPI(1);
   $('#add_broker').on('click', function () {

        if ($('#broker_form').valid())
        {
            addAccountMasterToServer();
        }
    });

  });

function addAccountMasterToServer(){
  var data1 = new FormData(document.getElementById("broker_form"));
    //data1.append('branch_id_FK', branch_id);

      // AJAX request
    $.ajax({
      url:'<?=base_url()?>BrokerController/addBroker',
      method: 'post',
      data: data1,
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
                              text: "Broker is successfully added",
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



 // ---state ----
    $.ajax({
   url:'<?php echo base_url(); ?>/ApiController/get_state',
    method:'get',
    data:{broker_State_Id:"<?php $country_id ?>"},
    dataType:'json',
   success:function(response){

    console.log(response.statelist);

    var result = JSON.stringify(response);
     $.each(response.statelist, function(k,data)   
     {
        $('#broker_State_Id').append('<option value="' + data['id'] + '">' + data['name'] + '</option>');
      });

     $('#broker_State_Id').selectpicker('refresh');
  }

 });


$( "#broker_State_Id" ).change(function() {
  var broker_State_Id=$('#broker_State_Id').val();
    $.ajax({
   url:'<?php echo base_url(); ?>/ApiController/get_city',
    method:'post',
    data:{city: broker_State_Id},
    dataType:'json',
   success:function(response){
    var result = JSON.stringify(response);
     $('#broker_City_Id').empty();

     $.each(response.citylist, function(k,data)   
     {
        $('#broker_City_Id').append('<option value="' + data['id'] + '">' + data['name'] + '</option>');
      });

      $('#broker_City_Id').selectpicker('refresh');
  }

 });



       });

</script>



