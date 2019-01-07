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
                 
            <a href="<?= base_url(); ?>checkerController" class="btn btn-primary">Back</a>

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
           <form id="checkerform">
                    <div class="row">
    <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
                        </div>

                        <div class="row">
                           <div class="col-md-6 form-group">
                            <label>Firstname <span class="mandatory"> * </span></label>
                            <input type="text" class="form-control txt_Space" name="checkerfirstname" id="checkerfirstname" placeholder="Enter First Name" required pattern="[a-zA-Z]+"> <?php echo form_error('checkerfirstname') ?>
                             </div>

                          <div class="col-md-6 form-group">
                            <label>Lastname <span class="mandatory"> * </span></label>
                            <input type="text" class="form-control txt_Space" name="checkerlastname" id="checkerlastname" placeholder="Enter Lastname" required pattern="[a-zA-Z]+"> <?php echo form_error('checkerlastname') ?>
                        </div>
                     
                        </div>

                        <div class="row">
                          <div class="col-md-6 form-group">
                           <div class="row">
                            <div class="col-4">
                             <label>Country Code <span class="mandatory">  </span></label>
                            <input type="text" class="form-control numbersOnly" name="checkerCountryCode" id="checkerCountryCode" placeholder="Enter Checker Mobile Number" required pattern="[0-9]+" minlength="2"> <?php echo form_error('checkerCountryCode') ?>
                            </div>
                            <div class="col-8">
                            <label>Mobile Number <span class="mandatory"> </span></label>
                            <input type="text" class="form-control numbersOnly" name="checkerMobileNumber" id="checkerMobileNumber" placeholder="Enter Checker Mobile Number" required pattern="[0-9]+" minlength="10"> <?php echo form_error('checkerMobileNumber') ?>
                             </div>
                              </div>
                           </div>

                          <div class="col-md-6 form-group">
                            <label>Email Address <span class="mandatory"> * </span></label>
                            <input type="text" class="form-control emailOnly" name="checkerEmail" id="checkerEmail" placeholder="Enter Checker Email Address" required pattern="[a-zA-Z]+"> <?php echo form_error('checkerEmail') ?>
                        </div>
                     
                        </div>

                       
                
                    </form>
                  
                        <button name="add_checker" id="add_checker" class="btn btn-primary"><?php if($uid==""){echo "Add Checker";}else{echo "update Checker";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>

<?php  $this->load->view('assests/footer'); ?>

  <script type='text/javascript'>
 $(document).ready(function(){

 $('#add_checker').on('click', function () {

        $('#checkerform').valid();

        if ($('#checkerform').valid() == true)
        {
          var uid=$('#uid').val();
          if(uid == ""){
            addcheckerToServer();
          }else{
            updateCheckerToServer();
          }
        }
    });

 var uid=$('#uid').val();

    // AJAX request
    $.ajax({
      url:'<?=base_url()?>checkerController/GetCheckerDetail',
      method: 'post',
      data: {uid:uid},
      dataType: 'json',
      success: function(response){
                       if(response){

                          var result=JSON.stringify(response);
                          var resultJsonDecode = jQuery.parseJSON(result);
                          var results=JSON.stringify(resultJsonDecode.resultSet);
                          var resultSet = jQuery.parseJSON(results);

                        $("#checkerfirstname").val(resultSet.firstName);
                        $("#checkerlastname").val(resultSet.lastName);
                        $("#checkerMobileNumber").val(resultSet.mobile_number);
                        $("#checkerEmail").val(resultSet.email);
                        $("#checkerCountryCode").val(resultSet.country_code);  
                       
                   
                 }


      }
      
   });

        function updateCheckerToServer()
    {

      var uid=$("#uid").val();
      var checkerfirstname = $("#checkerfirstname").val();
      var checkerlastname=$('#checkerlastname').val();
      var checkerMobileNumber = $("#checkerMobileNumber").val();
      var checkerEmail=$('#checkerEmail').val();
      var checkerCountryCode=$('#checkerCountryCode').val();

    // AJAX request
    $.ajax({
      url:'<?=base_url()?>checkerController/add_ckecker',
      method: 'post',
      data: {uid:uid,checkerCountryCode:checkerCountryCode,checkerfirstname: checkerfirstname,checkerlastname: checkerlastname,checkerMobileNumber:checkerMobileNumber,checkerEmail:checkerEmail},
      dataType: 'json',
      success: function(response){
                   if(response){

                      var result=JSON.stringify(response);
                      var resultJsonDecode = jQuery.parseJSON(result);
                    
                       $("#msg").html(resultJsonDecode.message);
                   

                       if(resultJsonDecode.status==1){
                              dhtmlx.message({
                                    type: "success",
                                    text: "Checker is successfully updated",
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

    function addcheckerToServer()
    {

    var checkerfirstname = $("#checkerfirstname").val();
    var checkerlastname=$('#checkerlastname').val();
    var checkerMobileNumber = $("#checkerMobileNumber").val();
    var checkerEmail=$('#checkerEmail').val();
    var checkerCountryCode=$('#checkerCountryCode').val();


// AJAX request
$.ajax({
  url:'<?=base_url()?>checkerController/add_ckecker',
  method: 'post',
  data: {checkerCountryCode:checkerCountryCode,checkerfirstname: checkerfirstname,checkerlastname: checkerlastname,checkerMobileNumber:checkerMobileNumber,checkerEmail:checkerEmail},
  dataType: 'json',
  success: function(response){
                   if(response){

                      var result=JSON.stringify(response);
                      var resultJsonDecode = jQuery.parseJSON(result);
                       $("#msg").html(resultJsonDecode.message);
                   

                       if(resultJsonDecode.status==1){
                            dhtmlx.message({
                                          type: "success",
                                          text: "checker is successfully created",
                                          expire: 0
                                        });


                              setTimeout(function () {
                                         window.location.replace("<?php echo base_url(); ?>checkerController");
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


      

</script>



 