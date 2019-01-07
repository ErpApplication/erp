  <div class="panel-header panel-header-sm">
  </div>
<style type="text/css">
  div.solid {
    border-style: solid;
    padding: 10px;
  }

</style>
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
                 
            <a href="<?= base_url(); ?>InventoryJobIssueController" class="btn btn-primary">Back</a>

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
           <form id="receiveform" method="post">
            <input type="hidden" id="uid" name="uid" value="<?php echo $uid; ?>">
                  
            <div class="col-md-12 form-group">
            <div class="row">
            <div class="col-md-7 form-group">
            <label >Book</label>
            <select id="stockIssue_Book_id" name="stockIssue_Book_id" class="form-control selectpicker" data-live-search="true" required>
              <option value="">--Select--</option>
            </select> 
            </div>
            <div class="col-md-2 form-group">
              <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BooksController/insertBook">Add</a>
            </div>
            <div class="col-md-3 form-group">
              <a class="now-ui-icons arrows-1_refresh-69" onclick="stockIssueBookReferesh();">Referesh</a>
            </div>

            </div>
            </div>
            <div class="row">
              <div class="col-md-2 form-group">
                <label >Voucher Number  <span class="mandatory"> * </span> </label>
                <input type="text" class="form-control" name="stockIssue_voucher_no_Id" id="stockIssue_voucher_no_Id" placeholder="Enter Job Process Name" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('Job Process') ?>
              </div>

              <div class="col-md-3 form-group">
                <label >Voucher Date  <span class="mandatory"> * </span> </label>
                <input type="date" class="form-control" name="stockIssue_voucher_date_Id" id="stockIssue_voucher_date_Id" placeholder="Enter Job Process Name" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('Job Process') ?>
              </div>

              <div class="col-md-2 form-group">
                <label >Lot Number  <span class="mandatory"> * </span> </label>
                <input type="text" class="form-control" name="stockIssue_lot_No_Id" id="stockIssue_lot_No_Id" placeholder="Enter Job Process Name" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('Job Process') ?>
              </div>

            <div class="col-md-5 form-group">
            <div class="row">
            <div class="col-md-7 form-group">
            <label>Job Process<span class="mandatory"> * </span> </label>
             <select id="stockIssue_job_process_Id" name="stockIssue_job_process_Id" class="form-control selectpicker" data-live-search="true" required>
              <option value="">--Select--</option>
              </select> 
            </div>

            <div class="col-md-2 form-group">
            <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>JobprocessmasterController">Add</a>
            </div>
            <div class="col-md-3 form-group">
                <a class="now-ui-icons arrows-1_refresh-69" onclick="stockIssueJobProcessReferesh();">Referesh</a>
            </div>

            </div>
            </div>

            </div>
            <div class="row">

            <div class="col-md-12 form-group">
            <div class="row">
            <div class="col-md-3 form-group">
            <label>Party code<span class="mandatory"> * </span></label>
            <input type="text" class="form-control" name="stockIssue_party_code_Id" id="stockIssue_party_code_Id" placeholder="Enter Mill Party " autocomplete="off" required pattern="[a-zA-Z]+">
            </div>
            <div class="col-md-7 form-group">
                <label>Party <span class="mandatory"> * </span></label>
                <input type="text" class="form-control" name="stockIssue_party_value_Id" id="stockIssue_party_value_Id" placeholder="Enter Mill Party " autocomplete="off" required pattern="[a-zA-Z]+">
            </div>
              <div class="col-md-2 form-group">
              <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>AccountMasterController/insertAccountMaster">Add</a>
              </div>
              </div>
              </div>
            </div>
                          
            <div class="row solid">
              <div class="col-md-1 form-group">
                <label >S.No. <span class="mandatory"> *  
                     </span> 
                  </label>
                <input type="text" class="form-control txt_Space" name="serialNumber" id="serialNumber" autocomplete="off" required readonly> 
              </div>

                <div class="col-md-2 form-group">
                    <label >Group <span class="mandatory"> *  
                         </span> 
                      </label>
                    <input type="text" class="form-control txt_Space" name="stockIssue_groupName" id="stockIssue_groupName" autocomplete="off" required> 
                </div>


                      <div class="col-md-2 form-group">
                          <label >Quality Name<span class="mandatory"> *  
                               </span> 
                            </label>
                          <input type="text" class="form-control txt_Space" name="stockIssue_qualityName" id="stockIssue_qualityName" autocomplete="off" required>
                      </div>


                      <div class="col-md-2 form-group">
                          <label >PCS<span class="mandatory"> *  
                               </span> 
                            </label>
                          <input type="text" class="form-control " name="stockIssue_pcs" id="stockIssue_pcs" autocomplete="off" required >
                      </div>


                      <div class="col-md-2 form-group">
                          <label >Cut<span class="mandatory"> *  
                               </span> 
                            </label>
                          <input type="text" class="form-control " name="stockIssue_cut" id="stockIssue_cut" autocomplete="off" required >
                      </div>


                      <div class="col-md-2 form-group">
                          <label >Quantity<span class="mandatory"> *  
                               </span> 
                            </label>
                          <input type="text" class="form-control " name="stockIssue_quantity" id="stockIssue_quantity" autocomplete="off" required >
                      </div>

                       <div class="col-md-1 form-group">
                          <a name="add_stockIssueDetail"  id="add_stockIssueDetail" class="btn btn-primary">Add</a>
                      </div>
                  </div>

                  <table id="tbl_inventoryIssue" class="display" >
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Group</th>
                            <th>Quality Name</th>
                            <th>PCS</th>
                            <th>Cut</th>
                            <th>Quality</th>
                        </tr>
                      
                    </thead>
                </table>

                <div class="row">
                <label >Remark(F9)<span class="mandatory"> * </span> </label>
                <div class="col-md-12 form-group">
                <textarea rows="3" cols="100" name="stockIssue_remark" id="stockIssue_remark"></textarea>
                </div>
                </div>

            </form>   

          <button name="add_stock_issue" id="add_stock_issue" class="btn btn-primary"><?php if($uid==""){echo "Add Stock Issue";}else{echo "update Stock Issue";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>


 <script type='text/javascript'>


 var stockIssueDataMillParty = $("#stockIssue_party_value_Id").tautocomplete({
        
        width: "500px",
        columns: ['Acount Master Name', 'City Name', 'Contact Number'],
        placeholder: "Search Mill Party",
        id: "stockIssuemillParty_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getAccountMaster",
            type: "POST",
            data: function()
             {
                var x = {millPartyName: $('#stockIssuemillParty_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + stockIssueDataMillParty.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = stockIssueDataMillParty.searchdata();
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

  $('#add_stockIssueDetail').on( 'click', function () {

    addValidationStockIssue();

    if ($("#receiveform").validate().element('#stockIssue_groupName') == false ||
     $("#receiveform").validate().element('#stockIssue_qualityName') == false || 
     $("#receiveform").validate().element('#stockIssue_pcs') == false|| 
     $("#receiveform").validate().element('#stockIssue_cut') == false||
     $("#receiveform").validate().element('#stockIssue_quantity') == false)
    {

    }else
    {

      var nextid = $("#serialNumber").val();

      tbl_inventoryIssue.row.add( [
       '<input type="text" id="'+nextid+'" name="sno[]" value="'+$("#serialNumber").val()+'">',
       '<input type="text" id="'+nextid+'" name="stockIssue_groupName[]" value="'+$("#stockIssue_groupName").val()+'">',
       '<input type="text" id="'+nextid+'" name="stockIssue_qualityName[]" value="'+$("#stockIssue_qualityName").val()+'">',
       '<input type="text" id="'+nextid+'" name="stockIssue_pcs[]" value="'+$("#stockIssue_pcs").val()+'">',
        '<input type="text" id="'+nextid+'" name="stockIssue_cut[]" value="'+$("#stockIssue_cut").val()+'">',
       '<input type="text" id="'+nextid+'" name="stockIssue_quantity[]" value="'+$("#stockIssue_quantity").val()+'">',
      
        ] ).node().id = nextid;
      
    tbl_inventoryIssue.draw( false );

      $('#stockIssue_groupName').val("");
      $('#stockIssue_qualityName').val("");
      $('#stockIssue_pcs').val("");
      $('#stockIssue_cut').val("");
      $('#stockIssue_quantity').val("");
    }
        
 
    } );
} );


 $(document).ready(function(){
    var x = $('#stockIssue_Book_id').val();
    var jobProcess = $('#stockIssue_job_process_Id').val();
    jobProcessList();
    bookList(x);

   $('#add_stock_issue').on('click', function () {

        removeValidationStockIssue();

        if ($('#receiveform').valid())
        {
            addStockIssueToServer();
        }
    });

});
$('#stockIssue_Book_id').selectpicker('refresh');
$('#stockIssue_job_process_Id').selectpicker('refresh');
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
              $('#stockIssue_job_process_Id').append('<option value="'+data['job_process_id_PK']+'" selected>'+data['job_process_name']+'</option>');
          }else{
              $('#stockIssue_job_process_Id').append('<option value="'+data['job_process_id_PK']+'">'+data['job_process_name']+'</option>');
          }
        });
                 
       $('#stockIssue_job_process_Id').selectpicker('refresh');

      }
  });
}
function bookList(x,y=null){
  $.ajax({
      url:'<?php echo base_url(); ?>ApiController/bookList',
      type:'post',
      data:{},
      dataType:'json',
      success:function(response){
        //alert(response.bookList);
       $.each(response.bookList,function(index,data){  

          if (data['book_id_PK'] == y)
          {  
              $('#stockIssue_Book_id').append('<option value="'+data['book_id_PK']+'" selected>'+data['book_number']+'</option>');
          }else{
              $('#stockIssue_Book_id').append('<option value="'+data['book_id_PK']+'">'+data['book_number']+'</option>');
          }
        });
                 
       $('#stockIssue_Book_id').selectpicker('refresh');

      }
  });
}

function addStockIssueToServer(){

  var addStockIssueToServerdata = new FormData(document.getElementById("receiveform"));
  addStockIssueToServerdata.append('stockIssue_party_value_Id', stockIssueDataMillParty.id());

      // AJAX request
    $.ajax({
      url:'<?=base_url()?>InventoryJobIssueController/insertStockIssue',
      method: 'post',
      data: addStockIssueToServerdata,
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
                              text: " Stock Issue is successfully added",
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

function stockIssueBookReferesh(){
 bookList();
}

function stockIssueJobProcessReferesh(){
  jobProcessList();
}


function addValidationStockIssue(){
  $("#stockIssue_groupName").prop('required',true);
  $("#stockIssue_qualityName").prop('required',true);
  $("#stockIssue_pcs").prop('required',true);
  $("#stockIssue_cut").prop('required',true);
  $("#stockIssue_quantity").prop('required',true);
}

function removeValidationStockIssue(){
    $('#stockIssue_groupName').removeAttr('required');
    $('#stockIssue_qualityName').removeAttr('required');
    $('#stockIssue_pcs').removeAttr('required');
    $('#stockIssue_cut').removeAttr('required');
    $('#stockIssue_quantity').removeAttr('required');
}


// $(document).ready(function() {

//  var counter = 1;
 
//  var t = $('#tbl_inventoryIssue').DataTable({
//       "drawCallback": function( settings ) {
//        $('#serialNumber').val(t.data().count()); 
//     }
//   });

//   $('#add_Detail').on( 'click', function () {
//         t.row.add( [
//             counter +'.1',
//             counter +'.2',
//             counter +'.3',
//             counter +'.4',
//             counter +'.5',
//             counter +'.6'
//         ] ).draw( false );
 
//         counter++;
//     } );


  

// } );


</script>



