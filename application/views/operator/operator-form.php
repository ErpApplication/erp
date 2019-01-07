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
                            <label>Username <span class="mandatory"> * </span></label>
                            <input type="text" class="form-control txt_Space" name="username" id="username" placeholder="Enter User Name" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('username') ?>
                        </div>

                          <div class="col-md-6 form-group">
                            <label>Password <span class="mandatory"> * </span> </label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" autocomplete="off" required> <?php echo form_error('password') ?>
                          </div>
                     
                        </div>

                        <div class="row">
                           <div class="col-md-6 form-group">
                            <label>Firstname <span class="mandatory"> * </span></label>
                            <input type="text" class="form-control txt_Space" name="firstname" id="firstname" placeholder="Enter First Name" required pattern="[a-zA-Z]+"> <?php echo form_error('firstname') ?>
                             </div>

                          <div class="col-md-6 form-group">
                            <label>Lastname <span class="mandatory"> * </span></label>
                            <input type="text" class="form-control txt_Space" name="lastname" id="lastname" placeholder="Enter Lastname" required pattern="[a-zA-Z]+"> <?php echo form_error('lastname') ?>
                        </div>
                     
                        </div>

                        <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Branch <span class="mandatory"> * </span></label>
                            <select id="branch_id" name="branch_id" class="form-control selectpicker" data-live-search="true" required>
                            </select> 
                            <input type="hidden" id="selectedBranchID">
                            <?php echo form_error('branch_id_FK') ?>
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

 $('#add_operator').on('click', function () {

        $('#operatorform').valid();

        if ($('#operatorform').valid() == true)
        {
          var uid=$('#uid').val();
          if(uid == ""){
            addOperatorToServer();
          }else{
            updateOperatorToServer();
          }
        }
    });



// AJAX request
$.ajax({
          url:'<?=base_url()?>Api/BranchList',
          method: 'post',       
          dataType: 'json',
          success: function(response){
            var selectedBranchID = $("#selectedBranchID").val();
            var result=JSON.stringify(response);
            //alert(result);                   
            // alert(selectedBranchID);
                        
            $.each(response.branch_list ,function(index,data){
              
              if (data['branch_id_PK'] == selectedBranchID)
              {
                $('#branch_id').append('<option value="'+data['branch_id_PK']+'" selected>'+data['branch_name']+'</option>');
                
              }else
              {
                $('#branch_id').append('<option value="'+data['branch_id_PK']+'">'+data['branch_name']+'</option>');
              }
    
                 });

             $('#branch_id').selectpicker('refresh');

          }
        });

 var uid=$('#uid').val();

    // AJAX request
    $.ajax({
      url:'<?=base_url()?>Operator/GetOperatorDetail',
      method: 'post',
      data: {uid:uid},
      dataType: 'json',
      success: function(response){
                       if(response){

                          var result=JSON.stringify(response);
                          var resultJsonDecode = jQuery.parseJSON(result);
                          var results=JSON.stringify(resultJsonDecode.resultSet);
                          var resultSet = jQuery.parseJSON(results);

                        $("#username").val(resultSet.username);
                        $("#password").val(resultSet.password);
                        $("#firstname").val(resultSet.firstname);
                        $("#lastname").val(resultSet.lastname);
                        $("#branch_id").val(resultSet.branch_id_FK);  
                        $("#selectedBranchID").val(resultSet.branch_id_FK);  
                        var selectedBranchID = $("#selectedBranchID").val();
                        $('#branch_id').val(selectedBranchID).trigger('change');  
                   
                 }


      }
      
   });

        function updateOperatorToServer()
    {

      var uid=$("#uid").val();
      var username = $("#username").val();
      var password=$('#password').val();
      var firstname = $("#firstname").val();
      var lastname=$('#lastname').val();
      var branch_id = $("#branch_id").val();

    // AJAX request
    $.ajax({
      url:'<?=base_url()?>Operator/add_operator',
      method: 'post',
      data: {uid:uid,username: username,password: password,firstname:firstname,lastname:lastname,branch_id:branch_id},
      dataType: 'json',
      success: function(response){
                   if(response){

                      var result=JSON.stringify(response);
                      var resultJsonDecode = jQuery.parseJSON(result);
                    
                       $("#msg").html(resultJsonDecode.message);
                   

                       if(resultJsonDecode.status==1){
                              dhtmlx.message({
                                    type: "success",
                                    text: "Operator is successfully updated",
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

    function addOperatorToServer()
    {

    var username = $("#username").val();
    var password=$('#password').val();
    var firstname = $("#firstname").val();
    var lastname=$('#lastname').val();
    var branch_id = $("#branch_id").val();


// AJAX request
$.ajax({
  url:'<?=base_url()?>Operator/add_operator',
  method: 'post',
  data: {username: username,password: password,firstname:firstname,lastname:lastname,branch_id:branch_id},
  dataType: 'json',
  success: function(response){
                   if(response){

                      var result=JSON.stringify(response);
                      var resultJsonDecode = jQuery.parseJSON(result);
                       $("#msg").html(resultJsonDecode.message);
                   

                       if(resultJsonDecode.status==1){
                            dhtmlx.message({
                                          type: "success",
                                          text: "Operator is successfully created",
                                          expire: 0
                                        });


                              setTimeout(function () {
                                         window.location.replace("<?php echo base_url(); ?>Operator");
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



 