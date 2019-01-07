
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                 
            <a href="<?= base_url(); ?>WorkIssueMillController" class="btn btn-primary">Back</a>

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
           <form id="workIssueMillform" method="post">

    <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
          <div class="row">
            <div class="col-md-6 form-group">
            <div class="row">
            <div class="col-md-7 form-group">
             <label >Book <span class="mandatory"> * </span></label>
             <select id="workIssueMill_issue_book" name="workIssueMill_issue_book" class="form-control selectpicker" data-live-search="true" required>
              <option value="">--Select--</option>
              </select> 
            </div>

            <div class="col-md-2 form-group">
                <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BooksController/insertBook">Add</a>
            </div>
            <div class="col-md-3 form-group">
                <a class="now-ui-icons arrows-1_refresh-69" onclick="bookReferesh();">Referesh</a>
            </div>

            </div>
            </div>
            
            <div class="col-md-5 form-group">
            <label> Balance <span class="mandatory">*</span></label>
                <input type="text" class="form-control numbersOnly" name="workIssueMill_balance" id="workIssueMill_balance" placeholder="Enter Balance" autocomplete="off" required pattern="[0-9]+"> 
            </div>
                      
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <div class="row">
              <div class="col-md-6 form-group">
              <label>Mill Issue Number<span class="mandatory"> * </span> </label>
              <input type="text" class="form-control numbersOnly" name="workIssueMill_issue_number" id="workIssueMill_issue_number" placeholder="Enter Mill Issue Number" autocomplete="off" required pattern="[0-9]+">
            </div>
            <div class="col-md-6 form-group">
            <label>Issue Date<span class="mandatory"> * </span> </label>  
            <div class="card-body ">
            <input type="text" class="form-control datepicker" name="workIssueMill_issue_date" id="workIssueMill_issue_date" placeholder="Select Date" autocomplete="off" required pattern="[a-zA-Z ]+">
            </div>
            </div>
            </div>

            </div>

            <div class="col-md-6 form-group">
            <div class="row">
            <div class="col-md-7 form-group">
            <label>Job Process<span class="mandatory"> * </span> </label>
             <select id="workIssueMill_issue_job_process" name="workIssueMill_issue_job_process" class="form-control selectpicker" data-live-search="true" required>
              <option value="">--Select--</option>
              </select> 
            </div>

            <div class="col-md-2 form-group">
            <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>JobprocessmasterController">Add</a>
            </div>
            <div class="col-md-3 form-group">
                <a class="now-ui-icons arrows-1_refresh-69" onclick="jobProcessReferesh();">Referesh</a>
            </div>

            </div>
            </div>

          </div>

         <div class="row">
            <div class="col-md-6 form-group">
              <div class="row">
                <div class="col-md-4 form-group">
                <label>Code <span class="mandatory"> * </span></label>
                <input type="text" class="form-control numbersOnly" name="workIssueMill_issue_code" id="workIssueMill_issue_code" placeholder="Enter code" autocomplete="off" required pattern="[0-9]+">
                           
            </div>

            <div class="col-md-8 form-group">
            <div class="row">
            <div class="col-md-10 form-group">
                <label>Mill Party <span class="mandatory"> * </span></label>
                <input type="text" class="form-control" name="workIssueMill_issue_mill_party" id="workIssueMill_issue_mill_party" placeholder="Enter Mill Party " autocomplete="off" required pattern="[a-zA-Z]+">
            </div>
              <div class="col-md-2 form-group">
              <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>AccountMasterController/insertAccountMaster">Add</a>
              </div>
              </div>
              </div>

            </div>
            </div>

            <div class="col-md-6 form-group">
              <div class="row">
                <div class="col-md-4 form-group">
                  <label>Code <span class="mandatory"> * </span></label>
                  <input type="text" class="form-control numbersOnly" name="workIssueMill_issue_mill_purchase_code" id="workIssueMill_issue_mill_purchase_code" placeholder="Enter Purchase Code" autocomplete="off" required pattern="[0-9]+">            
                </div>

                <div cl ass="col-md-8 form-group">
                <div class="row">
                  <div class="col-md-10 form-group">
                  <label>Purchase Party <span class="mandatory"> * </span></label>
                  <input type="text" class="form-control txt_Space" name="workIssueMill_issue_mill_purchase_party" id="workIssueMill_issue_mill_purchase_party" placeholder="Enter Purchase Party" autocomplete="off" required pattern="[a-zA-Z]+">            
                </div>
                 <div class="col-md-2 form-group">
                  <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>AccountMasterController/insertAccountMaster">Add</a>
                  </div>
                  </div>
                  </div>

              </div>
            </div>

          </div>

        <div class="row">
          <div class="col-md-6 form-group">
          <div class="row">
          <div class="col-md-10 form-group">
            <label>Broker <span class="mandatory"> * </span></label>
            <input type="text" class="form-control" name="workIssueMill_issue_mill_broker" id="workIssueMill_issue_mill_broker" placeholder=" Enter Broker" autocomplete="off" required pattern="[]+">
          </div> 
           <div class="col-md-2 form-group">
          <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BrokerController/insertBroker">Add</a>
          </div>
          </div>
          </div>

          <div class="col-md-6 form-group">
            <div class="row">
              <div class="col-md-5 form-group">
                <label>Purchase Bill Number <span class="mandatory"> * </span></label>
                <input type="text" class="form-control numbersOnly" name="workIssueMill_issue_mill_purchsae_bill_number" id="workIssueMill_issue_mill_purchsae_bill_number" placeholder="Enter Purchase Bill Number" autocomplete="off" required pattern="[0-9]+">            
              </div>

              <div class="col-md-7 form-group">
                <label>Purchase Bill Date <span class="mandatory"> * </span></label>
                <input type="text" class="form-control" name="workIssueMill_issue_mill_purchase_bill_date" id="workIssueMill_issue_mill_purchase_bill_date" placeholder="Enter Purchase Bill Date" autocomplete="off" required pattern="[]+" readonly>            
              </div>

            </div>
            </div>
                
          </div>

        <div class="row">
          <div class="col-md-6 form-group">
            <div class="row">
              <div class="col-md-4 form-group">
                <label>Lot Number <span class="mandatory">  </span></label>
                <input type="text" class="form-control numbersOnly" name="workIssueMill_issue_mill_purchsae_lot_number" id="workIssueMill_issue_mill_purchsae_lot_number" placeholder="Enter Purchase Lot Number" autocomplete="off" pattern="[0-9]+">            
              </div>

              <div class="col-md-4 form-group">
                <label>Party Check Number <span class="mandatory"> * </span></label>
                <input type="text" class="form-control numbersOnly" name="workIssueMill_issue_mill_purchase_check_number" id="workIssueMill_issue_mill_purchase_check_number" placeholder="Enter Party Check Number" autocomplete="off" required pattern="[0-9]+">            
              </div>

              <div class="col-md-4 form-group">
                <label>Rate <span class="mandatory"> * </span></label>
                <input type="text" class="form-control numbersOnly" name="workIssueMill_issue_mill_purchase_rate" id="workIssueMill_issue_mill_purchase_rate" placeholder="Enter Rate" autocomplete="off" required pattern="[0-9]+">            
              </div>

            </div>
            </div>

          <div class="col-md-6 form-group">
            <label>Quantity <span class="mandatory"> * </span></label>
            <input type="text" class="form-control numbersOnly" name="workIssueMill_issue_mill_quantity" id="workIssueMill_issue_mill_quantity" placeholder=" Enter Quantity" autocomplete="off" required pattern="[0-9]+">
          </div> 
                
          </div>



           <div class="row solid">


                    <div class="col-md-1 form-group">
                          <label >S.No. <span class="mandatory"> *  
                               </span> 
                            </label>
                          <input type="text" class="form-control" name="serialNumber" id="serialNumber" autocomplete="off" required readonly> 
                      </div>

                      <div class="col-md-2 form-group">
                          <label >Taka Number <span class="mandatory"> *  
                               </span> 
                            </label>
                          <input type="text" class="form-control numbersOnly" name="work_mill_takaNumber" id="work_mill_takaNumber" autocomplete="off" required pattern="[0-9]+"> 
                      </div>


                      <div class="col-md-2 form-group">
                          <label >Meters<span class="mandatory"> *  
                               </span> 
                            </label>
                          <input type="text" class="form-control numbersOnly" name="work_mill_meter" id="work_mill_meter" autocomplete="off" required pattern="[0-9]+">
                      </div>


                      <div class="col-md-2 form-group">
                          <label >Remark<span class="mandatory">   
                               </span> 
                            </label>
                          <input type="text" class="form-control" name="work_mill_remark" id="work_mill_remark" autocomplete="off" >
                      </div>


                       <div class="col-md-1 form-group">
                          <a name="add_Detail"  id="add_Detail" class="btn btn-primary">Add</a>
                      </div>
                  </div>

                  <table id="tbl_inventoryIssue" class="display responsive" >
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Taka Number</th>
                            <th>Meters</th>
                            <th>Remark</th>
                        </tr>
                      
                    </thead>
                </table>



        <div class="row">

        <div class="col-md-6 form-group">
            <label>(F9) Desc. <span class="mandatory">  </span></label>
            <input type="text" class="form-control" name="workIssueMill_issue_mill_desc" id="workIssueMill_issue_mill_desc" placeholder=" Enter Desc" autocomplete="off" required pattern="[]+">
          </div>

          <div class="col-md-6 form-group">
            <div class="row">
              <div class="col-md-6 form-group">
                <label>Total Meters <span class="mandatory">  </span></label>
                <input type="text" class="form-control numbersOnly" name="workIssueMill_issue_mill_Total_meter" id="workIssueMill_issue_mill_Total_meter" placeholder="Enter Total Meter" autocomplete="off" pattern="[0-9]+" readonly>            
              </div>

              <div class="col-md-6 form-group">
                <label>Total Taka <span class="mandatory">  </span></label>
                <input type="text" class="form-control numbersOnly" name="workIssueMill_issue_mill_total_taka" id="workIssueMill_issue_mill_total_taka" placeholder="Enter Total Taka" autocomplete="off" required pattern="[0-9]+" readonly>            
              </div>

            </div>
            </div>
   
          </div>

        <div class="row">
          <div class="col-md-8 form-group">
            <div class="row">
              <div class="col-md-4 form-group">
                <label>L.R.No. <span class="mandatory">  </span></label>
                <input type="text" class="form-control numbersOnly" name="workIssueMill_issue_mill_lr_number" id="workIssueMill_issue_mill_lr_number" placeholder=" Enter L R Number" autocomplete="off" required pattern="[0-9]+">
              </div>

              <div class="col-md-4 form-group">
                <label>Tempo Number <span class="mandatory">  </span></label>
                <input type="text" class="form-control numbersOnly" name="workIssueMill_issue_mill_tempo_number" id="workIssueMill_issue_mill_tempo_number" placeholder="Enter Tempo Number" autocomplete="off" required pattern="[0-9]+">            
              </div>

               <div class="col-md-4 form-group">
                <label>Transport <span class="mandatory">  </span></label>
                <input type="text" class="form-control numbersOnly" name="workIssueMill_issue_mill_transport" id="workIssueMill_issue_mill_transport" placeholder="Enter Transport" autocomplete="off" required pattern="[0-9]+">            
              </div>

            </div>
            </div>


          <div class="col-md-4 form-group">
            <label>Bill Amount <span class="mandatory">  </span></label>
            <input type="text" class="form-control numbersOnly" name="workIssueMill_issue_mill_bill_amount" id="workIssueMill_issue_mill_bill_amount" placeholder=" Enter Bill Amount" autocomplete="off" required pattern="[0-9]+" readonly>
          </div>
   
          </div>



          </form>                
          <button name="add_work_mill" id="add_work_mill" class="btn btn-primary"><?php if($uid==""){echo "Add Work Mill";}else{echo "update Work Mill";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>

<?php  $this->load->view('assests/footer'); ?>
 <script type='text/javascript'>

    var issueMillDataBroker = $("#workIssueMill_issue_mill_broker").tautocomplete({
        width: "500px",
        columns: ['Broker Name', 'City Name', 'Phone Name'],
        placeholder: "Search Broker",
        id: "broker_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getBroker/",
            type: "POST",
            data: function()
             {
                var x = {BrokerName: $('#broker_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + issueMillDataBroker.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = issueMillDataBroker.searchdata();
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

 var issueMillDataMillParty = $("#workIssueMill_issue_mill_party").tautocomplete({
        
        width: "500px",
        columns: ['Acount Master Name', 'City Name', 'Contact Number'],
        placeholder: "Search Mill Party",
        id: "millParty_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getAccountMaster",
            type: "POST",
            data: function()
             {
                var x = {millPartyName: $('#millParty_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + issueMillDataMillParty.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = issueMillDataMillParty.searchdata();
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

var issueMillDataPurchaseParty = $("#workIssueMill_issue_mill_purchase_party").tautocomplete({
        
        width: "500px",
        columns: ['Acount Master Name', 'City Name', 'Contact Number'],
        placeholder: "Search Purchase Party",
        id: "purchaseParty_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getAccountMaster",
            type: "POST",
            data: function()
             {
                var x = {purchasePartyName: $('#purchaseParty_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + issueMillDataPurchaseParty.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = issueMillDataPurchaseParty.searchdata();
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



 var issueMillDataBillNo = $("#workIssueMill_issue_mill_purchsae_bill_number").tautocomplete({
        
        width: "500px",
        columns: ['Purchase Bill Number', 'Party Name', 'Broker Name'],
        placeholder: "Search Bill Number",
        id: "purchaseBillNo_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/get_purchasebillNo",
            type: "POST",
            data: function()
             {         
                var x = {billNo: $('#purchaseBillNo_row_id').val(),partyId: issueMillDataPurchaseParty.id,brokerId: issueMillDataBroker.id};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + issueMillDataBillNo.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = issueMillDataBillNo.searchdata();
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
            issueMillDataBillNo.all();
            $('#workIssueMill_issue_mill_purchase_bill_date').val(issueMillDataBillNo.all().bill_date);
            // AJAX request
            return;
        }  

    } 
    });

var workIssueMillDataTransport = $("#workIssueMill_issue_mill_transport").tautocomplete({
        width: "500px",
        columns: ['Transport Name', 'City Name', 'Phone Number'],
        placeholder: "Search Transport",
        id: "workIssueMillTransport_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getTransport/",
            type: "POST",
            data: function()
             {
                var x = {TransportName: $('#workIssueMillTransport_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + workIssueMillDataTransport.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = workIssueMillDataTransport.searchdata();
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
    var x = $('#workIssueMill_issue_book').val();
    var jobProcess = $('#workIssueMill_issue_job_process').val();
    jobProcessList();
    bookList(x);

   $('#add_work_mill').on('click', function () {

         removeValidationIssueMillWork();

        if ($('#workIssueMillform').valid())
        {
            addWorkIssueMillToServer();
        }
    });

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
              $('#workIssueMill_issue_job_process').append('<option value="'+data['job_process_id_PK']+'" selected>'+data['job_process_name']+'</option>');
          }else{
              $('#workIssueMill_issue_job_process').append('<option value="'+data['job_process_id_PK']+'">'+data['job_process_name']+'</option>');
          }
        });
                 
       $('#workIssueMill_issue_job_process').selectpicker('refresh');

      }
  });
}

$('#workIssueMill_issue_book').selectpicker('refresh');
$('#workIssueMill_issue_job_process').selectpicker('refresh');

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
              $('#workIssueMill_issue_book').append('<option value="'+data['book_id_PK']+'" selected>'+data['sales_account_name']+'</option>');
          }else{
              $('#workIssueMill_issue_book').append('<option value="'+data['book_id_PK']+'">'+data['sales_account_name']+'</option>');
          }
        });
                 
       $('#workIssueMill_issue_book').selectpicker('refresh');

      }
  });
}

function addWorkIssueMillToServer(){

  var IssueMillToServerdata = new FormData(document.getElementById("workIssueMillform"));
   IssueMillToServerdata.append('workIssueMill_issue_mill_broker', issueMillDataBroker.id());
   IssueMillToServerdata.append('workIssueMill_issue_mill_party', issueMillDataMillParty.id());
   IssueMillToServerdata.append('workIssueMill_issue_mill_purchase_party', issueMillDataPurchaseParty.id());
   IssueMillToServerdata.append('workIssueMill_issue_mill_purchsae_bill_number', issueMillDataBillNo.id());
   IssueMillToServerdata.append('workIssueMill_issue_mill_transport', workIssueMillDataTransport.id());

      // AJAX request
    $.ajax({
      url:'<?=base_url()?>WorkIssueMillController/insertWorkMill',
      method: 'post',
      data: IssueMillToServerdata,
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
                              text: "Work Issue Mill is successfully added",
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




var tbl_inventoryIssue;
$(document).ready(function() {


 tbl_inventoryIssue = $('#tbl_inventoryIssue').DataTable({
      paging:false,
      searching:false,
      "drawCallback": function( settings ) {

        if (tbl_inventoryIssue !== undefined)
        {
          $('#serialNumber').val(tbl_inventoryIssue.rows().count() + 1); 
        }
    }
  });


 $('#serialNumber').val(tbl_inventoryIssue.rows().count() + 1); 
  
  $('#add_Detail').on( 'click', function () {
     
     addValidationIssueMillWork();
    
    if ($("#workIssueMillform").validate().element('#work_mill_takaNumber') == false || $("#workIssueMillform").validate().element('#work_mill_meter') == false || $("#workIssueMillform").validate().element('#work_mill_remark') == false)
    {

    }else
    {
          
      var nextid = $("#serialNumber").val();
         if(nextid>12){
           alert('please do not exceed more than 12');
         }else{
            tbl_inventoryIssue.row.add( [
           '<input type="text" id="'+nextid+'" name="sno[]" value="'+$("#serialNumber").val()+'">',
           '<input type="text" id="'+nextid+'" name="work_mill_takaNumber[]" class="work_mill_takaNumber" value="'+$("#work_mill_takaNumber").val()+'">',
           '<input type="text" id="'+nextid+'" name="work_mill_meter[]" class="work_mill_meter" value="'+$("#work_mill_meter").val()+'">',
           '<input type="text" id="'+nextid+'" name="work_mill_remark[]" value="'+$("#work_mill_remark").val()+'">',
        ] ).node().id = nextid;
         }
    
      
    tbl_inventoryIssue.draw( false );

      $('#work_mill_takaNumber').val("");
      $('#work_mill_meter').val("");
      $('#work_mill_remark').val("");
      // $('#cut').val("");
      // $('#quantity').val("");
    }
       workIssueMillTotalTakaAddation(); 
       workIssueMillTotalMeterAddation();
       workIssuemillTotalBilAmount();
 
    } );
} );

function bookReferesh(){
 bookList();
 $('#workIssueMill_issue_book').empty();
}

function jobProcessReferesh(){
  jobProcessList();
  $('#workIssueMill_issue_job_process').empty();

}

function workIssueMillTotalTakaAddation(){
  var totalNetAmount = 0;
  $('.work_mill_takaNumber').each(function(){
           var tempVal = this.value;
           if(tempVal == 0){
             //invalid = true;
           }else
           {
            totalNetAmount = parseFloat(totalNetAmount) + parseFloat(tempVal);
           }
  });

   $('#workIssueMill_issue_mill_total_taka').val(totalNetAmount);
             //console.log("totalNetAmount : " + totalNetAmount);
}


function workIssuemillTotalBilAmount(){
  var rate=$('#workIssueMill_issue_mill_purchase_rate').val();
  var meter=$('#workIssueMill_issue_mill_Total_meter').val();

 if(rate=="" || meter==""){
    $('#workIssueMill_issue_mill_bill_amount').val("");

 }else{
  var result=parseFloat(rate)*parseFloat(meter);
  $('#workIssueMill_issue_mill_bill_amount').val(result);
 }
}

function workIssueMillTotalMeterAddation(){
  var totalNetAmount = 0;
  $('.work_mill_meter').each(function(){
           var tempVal = this.value;
           if(tempVal == 0){
             //invalid = true;
           }else
           {
            totalNetAmount = parseFloat(totalNetAmount) + parseFloat(tempVal);
           }
  });

   $('#workIssueMill_issue_mill_Total_meter').val(totalNetAmount);
}

$("#workIssueMill_issue_mill_purchase_rate").keyup(function(){
   workIssuemillTotalBilAmount();
});



   //var uid=$('#uid').val();

    // AJAX request
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


function addValidationIssueMillWork(){
  $("#work_mill_takaNumber").prop('required',true);
  $("#work_mill_meter").prop('required',true);
}

function removeValidationIssueMillWork(){
    $('#work_mill_takaNumber').removeAttr('required');
    $('#work_mill_meter').removeAttr('required');
}

</script>



