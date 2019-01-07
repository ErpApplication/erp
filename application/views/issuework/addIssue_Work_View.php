	<style type="text/css">
hr {
    border: none;
    height: 1px;
    /* Set the hr color */
    color: #333; /* old IE */
    background-color: #333; /* Modern Browsers */
}
  </style>

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
                 
            <a href="<?= base_url(); ?>IssueController" class="btn btn-primary">Back</a>

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
           <form id="issueform" method="post">
                <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">

              <div class="row">
               <div class="col-md-6 form-group">
                 <div class="row">
                  <div class="col-md-7 form-group">
                      <label >Book  </label>
                        <select id="dispatchMaster_Book_Code_Id" name="dispatchMaster_Book_Code_Id" class="form-control selectpicker" data-live-search="true" required>
                        <option value="">--Select--</option>
                        </select>  
                  </div>

                   <div class="col-md-2 form-group">
                      <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BooksController/insertBook">Add</a>
                  </div>
                  <div class="col-md-3 form-group">
                      <a class="now-ui-icons arrows-1_refresh-69" onclick="dispatchBookReferesh();">Referesh</a>
                  </div>

                  </div>
                  </div>
                      
                      
                      
                          <div class="col-md-2 form-group">
                             <label ></label>
                        
                            <input type="text" class="form-control" name="add_Issue_Book_Value_Id" id="add_Issue_Book_Value_Id" placeholder="" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Issue_Book_Value_Id') ?>
                          </div>
                          <div class="col-md-4 form-group">
                            <label> Bal.: </span> </label>
                           <input type="text" class="form-control " name="add_Issue_Bal_Id" id="add_Issue_Bal_Id" placeholder="Enter Issue Bal" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Issue_Bal_Id') ?>
                 </div>
             </div>
          <hr>
              <div class="row">
                        <div class="col-md-3 form-group">
                            <label> Issue Challan No</label>
                        
                            <input type="text" class="form-control " name="add_Issue_Challan_No_Id" id="add_Issue_Challan_No_Id" placeholder="Enter Issue Challan No." autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Issue_Challan_No_Id') ?>
                                       
                        </div>

                        <div class="col-md-3 form-group">
                            <label>Challan No </label>
                        
                            <input type="text" class="form-control" name="add_Issue_Work_Challan_No_Id" id="add_Issue_Work_Challan_No_Id" placeholder="Enter Issue Work Challan No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Issue_Work_Challan_No_Id') ?>
                                       
                        </div>
                        
                      
                        <div class="col-md-2 form-group">
                            <label>Party </label>
                        
                            <input type="text" class="form-control " name="add_Issue_Party_Code_Id" id="add_Issue_Party_Code_Id" placeholder=" Enter Issue Party" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Issue_Party_Code_Id') ?>
                         </div>  
                    <div class="col-md-4 form-group">
                      <div class="row">
                     <div class="col-md-10 form-group">
                        <label></label>
                        <input type="text" class="form-control " name="add_Issue_Party_Value_Id" id="add_Issue_Party_Value_Id" placeholder=" Enter Issue Party " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Issue_Party_Value_Id') ?>
                    </div>

                   <div class="col-md-2 form-group">
                    <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>AccountMasterController/insertAccountMaster">Add</a>
                    </div>
                    </div>
                    </div>


                     </div>           
       <div class="row">
          <div class="col-md-3 form-group">
              <label>Issue Date </label>
                 <input type="Date" class="form-control " name="add_Issue_Date_Id" id="add_Issue_Date_Id" placeholder="Enter Issue Date" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('add_Issue_Date_Id') ?>
            </div>
        <div class="col-md-3 form-group">
               <label> Lot No</label>
                 <input type="text" class="form-control " name="add_Issue_Lot_No_Id" id="add_Issue_Lot_No_Id" placeholder="Enter Issue Lot No " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Issue_Lot_No_Id') ?>
            </div>
             <div class="col-md-6 form-group">
              <div class="row">
              <div class="col-md-10 form-group">
             <label>Broker </label>
              <input type="text" class="form-control" name="add_Issue_Broker_Id" id="add_Issue_Broker_Id" placeholder="Enter Issue Broker" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Issue_Broker_Id') ?>
              </div>
                <div class="col-md-2 form-group">
                <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BrokerController/insertBroker">Add</a>
                </div>
                </div>
                </div>

      </div>           
      <div class="row">
      

      </div>
  <div class="row">
      <div class="col-md-2 form-group">
           <label> L.R.No.</label>
               <input type="text" class="form-control " name="add_Issue_L_R_No_Id" id="add_Issue_L_R_No_Id" placeholder="Enter Issue L.R.No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Issue_L_R_No_Id') ?>
         </div>
       <div class="col-md-2 form-group">
               <label> Tempo No </label>
                  <input type="text" class="form-control " name="add_Issue_Tempo_No_Id" id="add_Issue_Tempo_No_Id" placeholder="Enter Issue Tempo No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Issue_Tempo_No_Id') ?>
                                       
         </div>
      <div class="col-md-3 form-group">
             <label>Transport </label>
                   <input type="text" class="form-control " name="add_Issue_Transport_Id" id="add_Issue_Transport_Id" placeholder="Enter Issue Transport" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Issue_Transport_Id') ?>
                                       
      </div>

        <div class="col-md-5 form-group">
        <div class="row">
        <div class="col-md-8 form-group">
        <label>Job Process  </span></label>
          <select id="add_Issue_Job_Process_Id" name="add_Issue_Job_Process_Id" class="form-control selectpicker" data-live-search="true" required>
          <option value="">--Select--</option>
          </select>
        </div>
         <div class="col-md-2 form-group">
        <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>JobprocessmasterController">Add</a>
        </div>
        <div class="col-md-2 form-group">
          <a class="now-ui-icons arrows-1_refresh-69" onclick="dispatchJobProcessReferesh();">Referesh</a>
        </div>
        </div>
        </div>

            </div>
        <div style="border-style: inset; padding: 15px">
<div class="row">
    <div class="col-md-1 form-group">
        <label>S.No </label>
               <input type="text" class="form-control " id="serialNumber" placeholder="Sr No" autocomplete="off" required readonly> <?php echo form_error('serialNumber') ?>
       </div>
    <div class="col-md-3 form-group">
       <label> Issue Quality </label>
            <input type="text" class="form-control " id="add_Issue_Quality_Id" placeholder=" Enter Issue Qty " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Issue_Quality_Id') ?>
      </div>
   <div class="col-md-2 form-group">
        <label>PCS/Mtrs </label>
            <input type="text" class="form-control " id="add_Issue_Pcs_Mtrs_Id" placeholder="PCS/Mtrs" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Issue_Pcs_Mtrs_Id') ?>
     </div>
   <div class="col-md-2 form-group">
        <label>Cut </label>
           <input type="text" class="form-control " id="add_Issue_Cut_Id" placeholder="No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Issue_Cut_Id') ?>
        </div>
     <div class="col-md-2 form-group">
           <label>Meters </label>
                <input type="text" class="form-control " id="add_Issue_Meters_Id" placeholder="Meters" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Issue_Meters_Id') ?>
        </div>
      <div class="col-md-2 form-group">
           <label>Weight </label>
                <input type="text" class="form-control " id="add_Issue_Weight_Id" placeholder="Weight" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Issue_Weight_Id') ?>
        </div>
     </div>
  <div class="row">
      <div class="col-md-1 form-group">
          <label>PM </label>
              <input type="text" class="form-control " id="add_Issue_PM_Id" placeholder="PM" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Issue_PM_Id') ?>
       </div>
    <div class="col-md-2 form-group">
          <label>Rate </label>
              <input type="text" class="form-control " id="add_Issue_Rate_Id" placeholder="Rate" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Issue_Rate_Id') ?>
   </div>
     <div class="col-md-2 form-group">
            <label >Design </label>
                <input type="text" class="form-control " id="add_Issue_Design_Id" placeholder="Design" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Issue_Design_Id') ?>
        </div>
    <div class="col-md-2 form-group">
       <label >Colour </label>
             <input type="text" class="form-control " id="add_Issue_Colour_Id" placeholder="Colour" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Issue_Colour_Id') ?>
       </div>
  <div class="col-md-2 form-group">
      <label >Remarks </label>
         <input type="text" class="form-control " id="add_Issue_Remarks_Id" placeholder="Remarks" autocomplete="off" pattern="[0-9 ]+"> 
      </div>
  <div class="col-md-2 form-group">
        <label >Amount </label>
            <input type="text" class="form-control " id="add_Issue_Amount_Id" placeholder="Amount" autocomplete="off" required pattern="[0-9 ]+" readonly> 
      </div>
   <div class="col-md-1 form-group">
          <a name="add_Detail"  id="add_Detail" class="btn btn-primary">Add</a>
    </div>
  </div>
</div>
  <table id="tbl_inventoryIssue" class="display responsive" >
            <thead>
              <tr bgcolor="silver">
                  <th>S.No.</th>
                  <th> Issue Quality </th>
                  <th>PCS/Mtrs</th>
                  <th>Cut</th>
                  <th>Meters</th>
                  <th>Weight</th>
                  <th>PM</th>
                  <th>Rate</th>
                  <th>Design</th>
                  <th>Colour</th>
                  <th>Remarks</th>
                  <th>Amount</th>
              </tr>
        </thead>
    </table>
<hr size="30">
<div class="row ">
      <div class="col-md-6 form-group">
         <label >(F9) </label>
              <input type="text" class="form-control " name="add_Issue_f_nine" id="add_Issue_f_nine" placeholder="Enter Sales Tot PCS" autocomplete="off" required pattern="[0-9]+"> 
        </div>
  <div class="col-md-6 form-group">
          <label >Bill Amount</label>
                <input type="text" class="form-control " name="add_Issue_bill_amount" id="add_Issue_bill_amount" placeholder="Enter Sales Mtrs" autocomplete="off" required pattern="[0-9]+" readonly> 
        </div>
      </div>
                       
      </form>                  
           <button name="add_dispatch" id="add_dispatch" class="btn btn-primary"><?php if($uid==""){echo "Add Issue Work Dispatch Master";}else{echo "update Issue Work Dispatch Master";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>

<?php  $this->load->view('assests/footer'); ?>
 <script type='text/javascript'>


   var dispatchDataBroker = $("#add_Issue_Broker_Id").tautocomplete({
        width: "500px",
        columns: ['Broker Name', 'City Name', 'Phone Name'],
        placeholder: "Search Broker",
        id: "dispatchBroker_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getBroker/",
            type: "POST",
            data: function()
             {
                var x = {BrokerName: $('#dispatchBroker_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + dispatchDataBroker.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = dispatchDataBroker.searchdata();
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

 var dispatchDataMillParty = $("#add_Issue_Party_Value_Id").tautocomplete({
        
        width: "500px",
        columns: ['Acount Master Name', 'City Name', 'Contact Number'],
        placeholder: "Search Mill Party",
        id: "dispatchMillParty_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getAccountMaster",
            type: "POST",
            data: function()
             {
                var x = {millPartyName: $('#dispatchMillParty_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + dispatchDataMillParty.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = dispatchDataMillParty.searchdata();
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

  var workIssueDispatchDataTransport = $("#add_Issue_Transport_Id").tautocomplete({
        width: "500px",
        columns: ['Transport Name', 'City Name', 'Phone Number'],
        placeholder: "Search Transport",
        id: "workIssueDispatchTransport_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getTransport/",
            type: "POST",
            data: function()
             {
                var x = {TransportName: $('#workIssueDispatchTransport_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + workIssueDispatchDataTransport.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = workIssueDispatchDataTransport.searchdata();
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

  var workIssueDispatchDataQuality = $("#add_Issue_Quality_Id").tautocomplete({
        width: "500px",
        columns: ['Iteam Name', 'MRP', 'cut'],
        placeholder: "Search Iteam",
        id: "workIssueDispatchQuality_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/get_Iteam/",
            type: "POST",
            data: function()
             {
                var x = {IteamName: $('#workIssueDispatchQuality_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + workIssueDispatchDataQuality.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = workIssueDispatchDataQuality.searchdata();
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

 var tbl_inventoryIssue;
$(document).ready(function() {


 tbl_inventoryIssue = $('#tbl_inventoryIssue').DataTable({
      "drawCallback": function( settings ) {

        if (tbl_inventoryIssue !== undefined)
        {
          $('#serialNumber').val(tbl_inventoryIssue.rows().count() + 1); 
        }
    }
  });


 $('#serialNumber').val(tbl_inventoryIssue.rows().count() + 1); 

  $('#add_Detail').on( 'click', function () {

          addValidationIssueWork();

    if ($("#issueform").validate().element('#add_Issue_Quality_Id') == false ||
     $("#issueform").validate().element('#add_Issue_Pcs_Mtrs_Id') == false || 
     $("#issueform").validate().element('#add_Issue_Cut_Id') == false||
      $("#issueform").validate().element('#add_Issue_Meters_Id') == false|| 
      $("#issueform").validate().element('#add_Issue_Weight_Id') == false|| 
      $("#issueform").validate().element('#add_Issue_PM_Id') == false|| 
      $("#issueform").validate().element('#add_Issue_Rate_Id') == false||
       $("#issueform").validate().element('#add_Issue_Design_Id') == false||
        $("#issueform").validate().element('#add_Issue_Colour_Id') == false||
         $("#issueform").validate().element('#add_Issue_Remarks_Id') == false||
          $("#issueform").validate().element('#add_Issue_Amount_Id') == false)
    {

    }else
    {

      var nextid = $("#serialNumber").val();

      tbl_inventoryIssue.row.add( [
       '<input type="text" id="'+nextid+'" name="sno[]" value="'+$("#serialNumber").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" value="'+$("#add_Issue_Quality_Id").val()+'" readonly> <input type="hidden" id="c'+nextid+'" name="add_Issue_Quality_Id[]" value="'+workIssueDispatchDataQuality.id()+'">',
       '<input type="text" id="'+nextid+'" name="add_Issue_Pcs_Mtrs_Id[]" value="'+$("#add_Issue_Pcs_Mtrs_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Issue_Cut_Id[]" value="'+$("#add_Issue_Cut_Id").val()+'" readonly>',
        '<input type="text" id="'+nextid+'" name="add_Issue_Meters_Id[]" value="'+$("#add_Issue_Meters_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Issue_Weight_Id[]" value="'+$("#add_Issue_Weight_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Issue_PM_Id[]" value="'+$("#add_Issue_PM_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Issue_Rate_Id[]" value="'+$("#add_Issue_Rate_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Issue_Design_Id[]" value="'+$("#add_Issue_Design_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Issue_Colour_Id[]" value="'+$("#add_Issue_Colour_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Issue_Remarks_Id[]" value="'+$("#add_Issue_Remarks_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Issue_Amount_Id[]" class="add_Issue_Amount_Id" value="'+$("#add_Issue_Amount_Id").val()+'" readonly>',
        ] ).node().id = nextid;
      

       $("#add_Issue_Quality_Id").val("");
       $("#workIssueDispatchQuality_row_id").val("");
       $("#workIssueDispatchQuality_row_id").attr("data-id", "");
       $("#workIssueDispatchQuality_row_id").attr("data-text", "");
         

    tbl_inventoryIssue.draw( false );

      $('#add_Issue_Quality_Id').val("");
      $('#add_Issue_Pcs_Mtrs_Id').val("");
      $('#add_Issue_Cut_Id').val("");
      $('#add_Issue_Meters_Id').val("");
      $('#add_Issue_Weight_Id').val("");
      $('#add_Issue_PM_Id').val("");
      $('#add_Issue_Rate_Id').val("");
      $('#add_Issue_Design_Id').val("");
      $('#add_Issue_Colour_Id').val("");
      $('#add_Issue_Remarks_Id').val("");
      $('#add_Issue_Amount_Id').val("");
      
    }
        workIssueDispatchTotalAmountAddation();
 
    } );
} );


  $(document).ready(function(){
    var x = $('#dispatchMaster_Book_Code_Id').val();
    var jobProcess = $('#add_Issue_Job_Process_Id').val();
    jobProcessList();
    bookList(x);

   $('#add_dispatch').on('click', function () {
        
       removeValidationIssueWork();

        if ($('#issueform').valid())
        {
            addDispatchMasterToServer();
        }
        
    });


$('#dispatchMaster_Book_Code_Id').selectpicker('refresh');

function bookList(x,y=null){
  $.ajax({
      url:'<?php echo base_url(); ?>ApiController/bookList',
      type:'post',
      data:{},
      dataType:'json',
      success:function(response){
       $.each(response.bookList,function(index,data){  

          if (data['book_id_PK'] == y)
          {  
              $('#dispatchMaster_Book_Code_Id').append('<option value="'+data['book_id_PK']+'" selected>'+data['book_number']+'</option>');
          }else{
              $('#dispatchMaster_Book_Code_Id').append('<option value="'+data['book_id_PK']+'">'+data['book_number']+'</option>');
          }
        });
                 
       $('#dispatchMaster_Book_Code_Id').selectpicker('refresh');

      }
  });
}

  });

  function jobProcessList(jobProcess,y=null){
  $.ajax({
      url:'<?php echo base_url(); ?>ApiController/jobProcessList',
      type:'post',
      data:{},
      dataType:'json',
      success:function(response){
       $.each(response.jobProcessList,function(index,data){    
          
          if (data['job_process_id_PK'] == y)
          {  
              $('#add_Issue_Job_Process_Id').append('<option value="'+data['job_process_id_PK']+'" selected>'+data['job_process_name']+'</option>');
          }else{
              $('#add_Issue_Job_Process_Id').append('<option value="'+data['job_process_id_PK']+'">'+data['job_process_name']+'</option>');
          }
        });
                 
       $('#add_Issue_Job_Process_Id').selectpicker('refresh');

      }
  });
}
$('#add_Issue_Job_Process_Id').selectpicker('refresh');

function addDispatchMasterToServer(){
  var dispatchToServerdata = new FormData(document.getElementById("issueform"));
   dispatchToServerdata.append('add_Issue_Broker_Id', dispatchDataBroker.id());
   dispatchToServerdata.append('add_Issue_Party_Value_Id', dispatchDataMillParty.id());
   dispatchToServerdata.append('add_Issue_Transport_Id', workIssueDispatchDataTransport.id());

      // AJAX request
    $.ajax({
      url:'<?=base_url()?>IssueController/insertDispatchMaster',
      method: 'post',
      data: dispatchToServerdata,
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
                              text: "Dispatch Master is successfully added",
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
function dispatchBookReferesh(){
  bookList();
}
function dispatchJobProcessReferesh(){
  jobProcessList();
}



function workIssueDispatchTotalBilAmount(){
  var piece=$('#add_Issue_Pcs_Mtrs_Id').val();
  var rate=$('#add_Issue_Rate_Id').val();

 if(rate=="" || piece==""){
    $('#add_Issue_Amount_Id').val("");
 }else{
  var result=parseFloat(rate)*parseFloat(piece);
  $('#add_Issue_Amount_Id').val(result);
 }
}

function workIssueDispatchTotalAmountAddation(){
  var totalNetAmount = 0;
  $('.add_Issue_Amount_Id').each(function(){
           var tempVal = this.value;
           if(tempVal == 0){
             //invalid = true;
           }else
           {
            totalNetAmount = parseFloat(totalNetAmount) + parseFloat(tempVal);
           }
  });

   $('#add_Issue_bill_amount').val(totalNetAmount);
}

$("#add_Issue_Pcs_Mtrs_Id").keyup(function(){
   workIssueDispatchTotalBilAmount();
});

$("#add_Issue_Rate_Id").keyup(function(){
   workIssueDispatchTotalBilAmount();
});

function addValidationIssueWork(){
  $("#add_Issue_Quality_Id").prop('required',true);
    $("#add_Issue_Pcs_Mtrs_Id").prop('required',true);
    $("#add_Issue_Cut_Id").prop('required',true);
    $("#add_Issue_Meters_Id").prop('required',true);
    $("#add_Issue_Weight_Id").prop('required',true);
    $("#add_Issue_PM_Id").prop('required',true);
    $("#add_Issue_Rate_Id").prop('required',true);
    $("#add_Issue_Design_Id").prop('required',true);
    $("#add_Issue_Colour_Id").prop('required',true);
    $("#add_Issue_Remarks_Id").prop('required',true);
    $("#add_Issue_Amount_Id").prop('required',true);
}

function removeValidationIssueWork(){
    $('#add_Issue_Quality_Id').removeAttr('required');
    $('#add_Issue_Pcs_Mtrs_Id').removeAttr('required');
    $('#add_Issue_Cut_Id').removeAttr('required');
    $('#add_Issue_Meters_Id').removeAttr('required');
    $('#add_Issue_Weight_Id').removeAttr('required');
    $('#add_Issue_PM_Id').removeAttr('required');
    $('#add_Issue_Rate_Id').removeAttr('required');
    $('#add_Issue_Design_Id').removeAttr('required');
    $('#add_Issue_Colour_Id').removeAttr('required');
    $('#add_Issue_Remarks_Id').removeAttr('required');
    $('#add_Issue_Amount_Id').removeAttr('required');     
}

</script>



