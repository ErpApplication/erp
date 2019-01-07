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
                 
<!--             <a href="<?= base_url(); ?>JobprocessmasterController" class="btn btn-primary">Back</a>
 -->
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
           <form id="jobProcess_form" method="post">
                    <div class="row">

     <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
        <div class="col-md-12 form-group">
            <label >Job Process  <span class="mandatory"> *  
                 </span> 
              </label>
                  <input type="text" class="form-control txt_Space" name="Job_Process_name" id="Job_Process_name" placeholder="Enter Job Process Name" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('Job Process') ?>
              </div>
            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
             </form>                  
              <button name="add_job_process" id="add_job_process" class="btn btn-primary"><?php if($uid==""){echo "Add Job Process";}else{echo "Update Job Process";} ?></button>
                
           <div class="card">
              <div class="card-header">
<!--                 <a class="btn btn-primary pull-right" href="<?php echo base_url(); ?>JobprocessmasterController/addJobProcess">Add Job Process</a>
 -->                <h4 class="card-title">Job Process List</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl_jobProcessList" class="table" style="width:100%">
                    
                    <thead>
                              <tr>
                                <th>Job Process Name</th>
                                <th>Edit</th>
                              </tr>
                            </thead>

                    <tbody>
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
         

          </div>

        </div>
      </div>
    </div>

    </div>


 <div id="myModal" class="modal fade" role="dialog"> 
  

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
       <div class="modal-body">
        Are you sure?
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>


    </div>

  </div>
</div>


 <script type='text/javascript'>

 var tbl_jobProcessList;

$(document).ready(function() {
      tbl_jobProcessList = $('#tbl_jobProcessList').DataTable(
      {
       
      "processing": false,
               "serverSide": true,
               paging:true,
               pageLength:10,
              "processing": true,
              "pagingType": "full_numbers",
              "scrollX": true,
               ajax: {
                  url: "<?php echo base_url() ?>JobprocessmasterController/jobProcessListwebAPI", // The service URL
                  type: "get",       // The type of request (post or get)
                  allInOne: false,            // Set to true to load all your data in one AJAX call
                  refresh: false  ,
                  dataSrc: function (json)
                  {


                      var cars = [];

                      for (var i = 0; i < json.data.length; i++) 
                      {
                        var object =  json.data[i];
                        object.edit = "<a href='#'><i class='fa fa-edit fa-lg'></i></a>";
                      }



                      return json.data;
                  },
                                      
          },

            "columns": [
            { "data": "job_process_name"},
            { "data": "edit"}
           
            
        
        ]
    

    } );

 } );


  $(document).ready(function(){

   $('#add_job_process').on('click', function () {
        if ($('#jobProcess_form').valid())
        {
            addJobProcessToServer();
        }
    });

  });

 function addJobProcessToServer(){
    var data1 = new FormData(document.getElementById("jobProcess_form"));
    //data1.append('branch_id_FK', branch_id);

      // AJAX request
    $.ajax({
      url:'<?=base_url()?>JobprocessmasterController/insertJobProcess',
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
                     tbl_jobProcessList.ajax.reload();
                         dhtmlx.message({
                          type: "success",
                          text: "Job Process is successfully added",
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

   // var uid=$('#uid').val();

   //  // AJAX request
   //  $.ajax({
   //    url:'<?=base_url()?>Transport/GetTransportDetail',
   //    method: 'post',
   //    data: {uid:uid},
   //    dataType: 'json',
   //    success: function(response){
   //                     if(response){

   //                        var result=JSON.stringify(response);
   //                        var resultJsonDecode = jQuery.parseJSON(result);
   //                        var results=JSON.stringify(resultJsonDecode.resultSet);
   //                        var resultSet = jQuery.parseJSON(results);
   //                      //  alert(result);
   //                        //alert(resultSet.transport_name);
   //                      //   alert(resultSet.message);

   //                      $("#transport_name").val(resultSet.transport_name);
   //                      $("#contact_person").val(resultSet.contact_person);
   //                      $("#country_id").val(resultSet.country_id_FK);
   //                      $("#state_id").val(resultSet.state_id_FK);
   //                      $("#city_id").val(resultSet.city_id_FK);
   //                      $("#transport_address").val(resultSet.transport_address);
   //                      $("#pincode").val(resultSet.pincode);
   //                      $("#gst").val(resultSet.GST);
   //                      $("#landline").val(resultSet.landline);
   //                      $("#transport_landline_code").val(resultSet.landline_code);
   //                      $("#contact_number").val(resultSet.contact_mobile);
   //                      $("#transport_contact_code").val(resultSet.country_code);

   //                      callStateAPI(resultSet.country_id_FK,resultSet.state_id_FK);
   //                      callCityAPI(resultSet.state_id_FK,resultSet.city_id_FK);
                        
                   
   //               }


   //    }
      
   // });

//});
  

</script>



