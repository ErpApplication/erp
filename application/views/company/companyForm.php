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
                 
            <a href="<?= base_url(); ?>CompanyController" class="btn btn-primary">Back</a>

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
           <form id="companyform">
           <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
                        <div class="row">
    
                         <div class="col-md-6 form-group">
                                <label for="exampleInputFile">Company Name</label><span class="mandatory"> * </span>
                                <input type="text" class="form-control txt_Space" name="company_name" id="company_name" placeholder="Enter Company Name" value="<?php if($type == 'popUp'){ echo $companyName; }else{echo set_value('branch_name'); } ?>" required pattern="[a-zA-Z ]+"> <?php echo form_error('company_name') ?>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Company Type</label><span class="mandatory"> * </span>
                                <select id="company_company_type_id" name="company_company_type_id" class="form-control selectpicker" data-live-search="true" required>
                                </select>   
                                <?php echo form_error('company_type') ?>
                            </div>
                            <input type="hidden" id="selectedCompanyTypeID">
                        </div>

                        <div class="row ">
                            <div class="col-md-4 form-group">
                                <label>Branch</label><span class="mandatory"> * </span>
                                <input class="string required form-control "  
                                type="text" name="branch_search_field" id="branch_search_field" required/>
                                <?php echo form_error('branch_id_FK') ?>
                            </div>

                             <div class="col-md-4 form-group">
                                <label for="exampleInputFile">GST</label><span class="mandatory"> * </span>
                                <input type="text" class="form-control alpha_numeric" name="create_company_gst" id="create_company_gst" placeholder="Enter Company GST"  value="<?php echo set_value('company_GST'); ?>" required minlength="15" maxlength="15" pattern="[a-zA-Z0-9]+"> <?php echo form_error('company_GST') ?>
                            </div>

                             <div class="col-md-4 form-group">
                                <label for="exampleInputFile">TAN</label><span class="mandatory"> * </span>
                                <input type="text" class="form-control alpha_numeric" name="tan_number" id="tan_number" placeholder="Enter Company TAN" required minlength="10" maxlength="10" pattern="[a-zA-Z0-9]+"> <?php echo form_error('tan') ?>
                            </div>
                        </div>
                    </div>

                    <div class="w3-card">

                        <label>Company Address</label>
                       
                    <div class="row">

                        <div class="col-md-4 form-group">
                            <label>Country</label><span class="mandatory"> * </span>
                            <select  id="company_country_id" name="company_country_id" onchange="CreateCompanyCountryListSelected(this);" class="form-control selectpicker" data-live-search="true" required>
                            <?php
                                foreach($country_list as $country){
                                    echo "<option value='".$country['id']."' >".$country['name']."</option>";
                                }
                            ?>
                            </select>   
                            <?php echo form_error('company_country_id') ?>
                        </div>

        

                        <div class="col-md-4 form-group">
                            <label>State</label><span class="mandatory"> * </span>
                            <select id='company_state_id' name="company_state_id" onchange="CreateCompanyStateListSelected(this);" data-live-search-placeholder="Search state" class="form-control selectpicker" data-live-search="true" required>
                            </select>
                            <?php echo form_error('state_id') ?>           
                        </div>
                        
                        <div class="col-md-4 form-group">
                            <label>City</label><span class="mandatory"> * </span>
                            <select id="company_create_city_id" name="company_create_city_id" data-live-search-placeholder="Search city" class="form-control selectpicker" data-live-search="true" required>
                            </select>  
                            <?php echo form_error('city_id') ?>                 
                        </div>

                         <div class="col-md-6 form-group">
                            <label for="exampleInputFile">Address</label><span class="mandatory"> * </span>
                            <input type="text" class="form-control txt_Space_number" id="company_address" name="company_address" placeholder="Enter Company Address" value="<?php echo set_value('branch_address'); ?>" required pattern="[a-zA-Z0-9, ]+"> <?php echo form_error('company_address') ?>
                        </div>    

                        <div class="col-md-6 form-group">
                            <label for="exampleInputFile">PinCode</label><span class="mandatory"> * </span>
                            <input type="text" class="form-control numbersOnly" name="pincode" id="pincode" placeholder="Enter Pincode" value="<?php echo set_value('pincode'); ?>" minlength="6" maxlength="6" required pattern="[0-9]+"> <?php echo form_error('pincode') ?>
                        </div>

                        </div>


                         <div class="row">

                         <div class="col-md-6 form-group">
                            <label for="exampleInputFile">Landline Number</label><span class="mandatory"> * </span>
                              <div class="row">
                                <div class="col-md-4 form-group">
                                     <input type="numeric" class="form-control numbersOnly" name="stdlandline" id="stdlandline" placeholder="STD Code" minlength="4" maxlength="4" pattern="[0-9]+" required>  <?php echo form_error('landline') ?>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="numeric" class="form-control numbersOnly" name="landline" id="landline" placeholder="Enter Landline Number" minlength="6" maxlength="7" value="<?php echo set_value('landline'); ?>" required pattern="[0-9]+">  <?php echo form_error('landline') ?>
                                </div>
                              </div>

                        </div>

                        <div class="col-md-6 form-group">
                            <label for="exampleInputFile">Company Email</label>
                            <input type="text" class="form-control emailOnly" name="owner_email" id="owner_email" placeholder="Enter Owner Email"value="<?php echo set_value('owner_email'); ?>" required> <?php echo form_error('owner_email') ?>
                        </div> 
                    </div>

                    </div>

                        
                        <div class="w3-card">
                            <label>Contact Detail</label>
                        <div class="row ">
                        
                       <div class="col-md-6 form-group">
                            <label for="exampleInputFile">Proprietor Name</label><span class="mandatory"> * </span>
                            <input type="numeric" class="form-control txt_Space" name="company_owner" id="company_owner" placeholder="Enter Company Owner Name" value="<?php echo set_value('company_owner'); ?>" required pattern="[a-zA-Z ]+">  <?php echo form_error('company_owner') ?>
                        </div>

                         <div class="col-md-6 form-group">
                            <label for="exampleInputFile">Owner Mobile Number</label><span class="mandatory"> * </span>
                            <div class="row">

                                <div class="col-md-4 form-group">
                                     <input type="numeric" class="form-control" name="owner_number_code" id="owner_number_code" placeholder="Code" minlength="1" maxlength="4" pattern="[0-9]+">  <?php echo form_error('landline') ?>
                                </div>

                                <div class="col-md-8 form-group">
                                    <input type="numeric" class="form-control numbersOnly" name="owner_number" id="owner_number" placeholder="Enter Owner Number" minlength="10" maxlength="10" pattern="[0-9]+" value="<?php echo set_value('owner_number'); ?>" required pattern="[0-9]+"> <?php echo form_error('owner_number') ?>
                                </div>

                              </div>

                            
                        </div>

                        </div>
                           
                
                    </form>
                  
                        <button name="add_company" id="add_company" class="btn btn-primary"><?php if($uid==""){echo "Add Company";}else{echo "update Company";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>

<?php  $this->load->view('assests/footer'); ?>

  <script type='text/javascript'>



    var autoCompleteBranchInAddCompany = $("#branch_search_field").tautocomplete({
                width: "500px",
                columns: ['Branch Name', 'Branch Address', 'Contact'],
                placeholder: "Search Branch",
                theme: "white",
                id: "branch_search_field",

                ajax: {
                    url: "<?php echo base_url();?>CompanyController/Branchfetch/",
                    type: "GET",
                    success: function (result) {

                        $("#branch_search_field").attr("branch_id","");

                        var filterData = [];

                        var searchData = eval("/" + autoCompleteBranchInAddCompany.searchdata() + "/gi");

                        $.each(result, function (i, v) {
                            if (v.value.search(new RegExp(searchData)) != -1) {
                                filterData.push(v);
                            }
                        });
                        var srcfild = autoCompleteBranchInAddCompany.searchdata();
                        if(filterData.length==0)
                        { 
                            globlval = srcfild;
                        }
                        return filterData;
                    }
                },
                

        onchange: function () {

        var keycode = (event.keyCode ? event.keyCode : event.which);
        
        if(keycode == '13')
        {

            var shiftPressed = event.shiftKey;
            var value = autoCompleteBranchInAddCompany.id();

            console.log(value);

            // AJAX request
            $.ajax({
              url:'<?=base_url()?>Api/get_data_exist_universal',
              method: 'post',
              data: {"tableName":"branch","ColumnName":"branch_id_PK","text":value},
              dataType: 'json',
              success: function(response){
                    if(response)
                    {
                          if(response.status == "false")
                            {   
                                    var encodedString = btoa( $('#branch_search_field').val());

                                    $.ajax({
                                             method: 'POST',
                                             url : "<?=base_url()?>CompanyController/addBranchInPopUp/"+encodedString,
                                             dataType:'json', //json,html you will echo on the php file
                                             success : function(data)
                                             {

                                        $("#OpenBranchDialogModalBody").html(data);
                                        $("#OpenBranchDialog").modal("show");
                                    }
                                });
                                   
                              
                            }else
                            {    

                    $("#branch_search_field").attr("branch_id",response.data);

                        if (shiftPressed)
                        {

                        var encodedString = btoa(autoCompleteBranchInAddCompany.id());


                                $.ajax({
                                             method: 'POST',
                                             url : "<?=base_url()?>index.php/Branch_controller/updateBranchInPopUp/"+encodedString,
                                             dataType:'json', //json,html you will echo on the php file
                                             success : function(data)
                                             {

                                        $("#OpenBranchDialogModalBody").html(data);
                                        $("#OpenBranchDialog").modal("show");
                                    }
                                });

      
                                }
                            }

                    }
              }
              
            });

            
            return;
        }  

    } 
    });



 $(document).on('click', '#OpenBranchDialogBack', function(e) {

         var type = '<?php echo $type ?>';

         if (type == 'popUp')
         {
            $('#OpenBranchDialog').modal('hide');

         }else
         {
            window.location.replace('<?php echo base_url(); ?>BranchController/list_branch');
         } 
      });

 $(document).ready(function(){
 $('#add_company').on('click', function () {

        $('#companyform').valid();

        if ($('#companyform').valid() == true)
        {
          var uid=$('#uid').val();
          if(uid == ""){
            addCompanyToServer();
          }else{
            updateCourierToServer();
          }
        }
    });


 // AJAX request
$.ajax({
          url:'<?=base_url()?>Api/companyTypeList',
          method: 'post',       
          dataType: 'json',
          success: function(response){
            var selectedCompanyTypeID = $("#selectedCompanyTypeID").val();
            var result=JSON.stringify(response);
           // alert(result);                   
            // alert(selectedBranchID);
                        
            $.each(response.companyType_list ,function(index,data){
              
              if (data['compnay_type_id_PK'] == selectedCompanyTypeID)
              {
                $('#company_company_type_id').append('<option value="'+data['compnay_type_id_PK']+'" selected>'+data['company_type']+'</option>');
                
              }else
              {
                $('#company_company_type_id').append('<option value="'+data['compnay_type_id_PK']+'">'+data['company_type']+'</option>');
              }
    
                 });

             $('#company_company_type_id').selectpicker('refresh');

          }
        });


    var uid=$('#uid').val();
    

    function addCompanyToServer()
    {
        var company_name = $("#company_name").val();
        var company_owner=$('#company_owner').val();

        var country_id = $("#company_country_id").val();
        var state_id=$('#company_state_id').val();
        var city_id = $("#company_create_city_id").val();

        var owner_email=$('#owner_email').val();
        var owner_number = $("#owner_number").val();
        var gst=$('#create_company_gst').val();
        var tan_number=$('#tan_number').val();
        var pincode=$('#pincode').val();
        var landline=$('#landline').val();
        var company_address=$('#company_address').val();

        var company_type_id=$('#company_company_type_id').val();

        var branch_id= autoCompleteBranchInAddCompany.id();
        
       
        if (branch_id == 0 || typeof branch_id === 'undefined')
        {
          dhtmlx.message({
                                        type: "error",
                                        text: "Please select branch",
                                        expire: 0
                                      });

          return;
        }

        var stdlandline=$('#stdlandline').val();
        var owner_number_code=$('#owner_number_code').val();

        // AJAX request
        $.ajax({
          url:'<?=base_url()?>CompanyController/Add_Company',
          method: 'post',
          data: {tan_number:tan_number,branch_id:branch_id,company_type_id:company_type_id,company_name: company_name,landline:landline,gst:gst,pincode:pincode,owner_email: owner_email,country_id:country_id,state_id:state_id,city_id:city_id,company_address:company_address,owner_number:owner_number,company_owner:company_owner,stdlandline:stdlandline,owner_number_code:owner_number_code},
          dataType: 'json',
          success: function(response){
                           if(response){

                              var result=JSON.stringify(response);
                              var resultJsonDecode = jQuery.parseJSON(result);

                               $("#msg").html(resultJsonDecode.message);

                               if(resultJsonDecode.status==1){

                                 dhtmlx.message({
                                        type: "success",
                                        text: "Company is successfully created",
                                        expire: 0
                                  });


                                var type = '<?php echo $type ?>';

                                       if (type == 'popUp')
                                       {
                                          $('#OpenCompanyDialog').modal('hide');

                                       }else
                                       {
                                           setTimeout(function () {
                                                   window.location.replace("<?php echo base_url(); ?>index.php/CompanyController/CompanyList");
                                                }, 1000);
                                        
                                        
                                       } 




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


      $(document).on('click', '#OpenCreateCompanyDialogBack', function(e) {

            var type = '<?php echo $type ?>';

             if (type == 'popUp')
             {
                $('#OpenCompanyDialog').modal('hide');

             }else
             {
                window.location.replace('<?php echo base_url(); ?>CompanyController/CompanyList');
             }
      });
        function CreateCompanyStateListSelected(e)
        {
            var x = e.value;
            CreateCompanyCallCityAPI(x);
        }

         function CreateCompanyCallCityAPI(x,y=null)
         {
         // AJAX request
                 $.ajax({
                  url:'<?=base_url()?>Api/get_city_data',
                  method: 'post',
                  data: {state_id: x},
                  dataType: 'json',
                  success: function(response){

                    var selectedVaue = y;

                    console.log("Create Company Value : " + y + x);

                    $('#company_create_city_id').empty();
                    // Add options

                    $.each(response,function(index,data){
                      
                      if (data['id'] == selectedVaue)
                      {
         
                        $('#company_create_city_id').append('<option value="'+data['id']+'" selected>'+data['name']+'</option>');
                        
                      }else
                      {
                        $('#company_create_city_id').append('<option value="'+data['id']+'">'+data['name']+'</option>');
                      }

                    });

                 
                     $('#company_create_city_id').selectpicker('refresh');


                      }
                });
         }

         function CreateCompanyCountryListSelected(e)
         {
            var x = e.value;

            CreateCompanyCallStateAPI(x);


         }

         function CreateCompanyCallStateAPI(x,y=null)
         {
            // AJAX request
                 $.ajax({
                  url:'<?=base_url()?>Api/get_state_data',
                  method: 'post',
                  data: {country_id: x},
                  dataType: 'json',
                  success: function(response){
                    $('#company_state_id').empty();
                    // Add options
                    $.each(response,function(index,data){
                   
                      if (data['id'] == y)
                      {
         
                        $('#company_state_id').append('<option value="'+data['id']+'" selected>'+data['name']+'</option>');
                        
                      }else
                      {
                        $('#company_state_id').append('<option value="'+data['id']+'">'+data['name']+'</option>');
                      }

                    });
                 
                    $('#company_state_id').selectpicker('refresh');

                  }
                });
         }
    

</script>



 