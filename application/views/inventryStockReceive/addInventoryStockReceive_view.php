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
                 
            <a href="<?= base_url(); ?>InventryStockReceiveController" class="btn btn-primary">Back</a>

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
           <form id="stockReceiveform" method="post">
            <input type="hidden" id="uid" name="uid" value="<?php echo $uid; ?>">
                  
            <div class="col-md-12 form-group">
            <div class="row">
            <div class="col-md-7 form-group">
            <label >Book</label>
            <select id="stockReceive_Book_id" name="stockReceive_Book_id" class="form-control selectpicker" data-live-search="true" required>
              <option value="">--Select--</option>
            </select> 
            </div>
            <div class="col-md-2 form-group">
              <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BooksController/insertBook">Add</a>
            </div>
            <div class="col-md-3 form-group">
              <a class="now-ui-icons arrows-1_refresh-69" onclick="stockReceiveBookReferesh();">Referesh</a>
            </div>

            </div>
            </div>
            <div class="row">
              <div class="col-md-2 form-group">
                <label >Voucher Number  <span class="mandatory"> * </span> </label>
                <input type="text" class="form-control" name="stockReceive_voucher_no_Id" id="stockReceive_voucher_no_Id" placeholder="Enter Job Process Name" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('Job Process') ?>
              </div>

              <div class="col-md-3 form-group">
                <label >Voucher Date  <span class="mandatory"> * </span> </label>
                <input type="date" class="form-control" name="stockReceive_voucher_date_Id" id="stockReceive_voucher_date_Id" placeholder="Enter Job Process Name" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('Job Process') ?>
              </div>

              <div class="col-md-2 form-group">
                <label >Lot Number  <span class="mandatory"> * </span> </label>
                <input type="text" class="form-control" name="stockReceive_lot_No_Id" id="stockReceive_lot_No_Id" placeholder="Enter Job Process Name" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('Job Process') ?>
              </div>

            <div class="col-md-5 form-group">
            <div class="row">
            <div class="col-md-7 form-group">
            <label>Job Process<span class="mandatory"> * </span> </label>
             <select id="stockReceive_job_process_Id" name="stockReceive_job_process_Id" class="form-control selectpicker" data-live-search="true" required>
              <option value="">--Select--</option>
              </select> 
            </div>

            <div class="col-md-2 form-group">
            <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>JobprocessmasterController">Add</a>
            </div>
            <div class="col-md-3 form-group">
                <a class="now-ui-icons arrows-1_refresh-69" onclick="stockReceiveJobProcessReferesh();">Referesh</a>
            </div>

            </div>
            </div>

            </div>
            <div class="row">

            <div class="col-md-12 form-group">
            <div class="row">
            <div class="col-md-3 form-group">
            <label>Party code<span class="mandatory"> * </span></label>
            <input type="text" class="form-control" name="stockReceive_party_code_Id" id="stockReceive_party_code_Id" placeholder="Enter Mill Party " autocomplete="off" required pattern="[a-zA-Z]+">
            </div>
            <div class="col-md-7 form-group">
                <label>Party <span class="mandatory"> * </span></label>
                <input type="text" class="form-control" name="stockReceive_party_value_Id" id="stockReceive_party_value_Id" placeholder="Enter Mill Party " autocomplete="off" required pattern="[a-zA-Z]+">
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
                    <input type="text" class="form-control txt_Space" name="stockReceive_groupName" id="stockReceive_groupName" autocomplete="off" required> 
                </div>


                      <div class="col-md-2 form-group">
                          <label >Quality Name<span class="mandatory"> *  
                               </span> 
                            </label>
                          <input type="text" class="form-control txt_Space" name="stockReceive_qualityName" id="stockReceive_qualityName" autocomplete="off" required>
                      </div>


                      <div class="col-md-2 form-group">
                          <label >PCS<span class="mandatory"> *  
                               </span> 
                            </label>
                          <input type="text" class="form-control " name="stockReceive_pcs" id="stockReceive_pcs" autocomplete="off" required >
                      </div>


                      <div class="col-md-2 form-group">
                          <label >Cut<span class="mandatory"> *  
                               </span> 
                            </label>
                          <input type="text" class="form-control " name="stockReceive_cut" id="stockReceive_cut" autocomplete="off" required >
                      </div>


                      <div class="col-md-2 form-group">
                          <label >Quantity<span class="mandatory"> *  
                               </span> 
                            </label>
                          <input type="text" class="form-control " name="stockReceive_quantity" id="stockReceive_quantity" autocomplete="off" required >
                      </div>

                       <div class="col-md-1 form-group">
                          <a name="add_stockReceiveDetail"  id="add_stockReceiveDetail" class="btn btn-primary">Add</a>
                      </div>
                  </div>

                  <table id="tbl_inventoryReceive" class="display" >
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
                <textarea rows="3" cols="100" name="stockReceive_remark" id="stockReceive_remark"></textarea>
                </div>
                </div>

            </form>   

          <button name="add_stock_Receive" id="add_stock_Receive" class="btn btn-primary"><?php if($uid==""){echo "Add Stock Receive";}else{echo "update Stock Receive";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>


 <script type='text/javascript'>


 var stockReceiveDataMillParty = $("#stockReceive_party_value_Id").tautocomplete({
        
        width: "500px",
        columns: ['Acount Master Name', 'City Name', 'Contact Number'],
        placeholder: "Search Mill Party",
        id: "stockReceivemillParty_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getAccountMaster",
            type: "POST",
            data: function()
             {
                var x = {millPartyName: $('#stockReceivemillParty_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + stockReceiveDataMillParty.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = stockReceiveDataMillParty.searchdata();
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


 var tbl_inventoryReceive;
$(document).ready(function() {
 tbl_inventoryReceive = $('#tbl_inventoryReceive').DataTable({
      "drawCallback": function( settings ) {

        if (tbl_inventoryReceive !== undefined)
        {
          $('#serialNumber').val(tbl_inventoryReceive.rows().count() + 1); 
        }
    }
  });


 $('#serialNumber').val(tbl_inventoryReceive.rows().count() + 1); 

  $('#add_stockReceiveDetail').on( 'click', function () {

    addValidationStockReceive();

    if ($("#stockReceiveform").validate().element('#stockReceive_groupName') == false ||
     $("#stockReceiveform").validate().element('#stockReceive_qualityName') == false || 
     $("#stockReceiveform").validate().element('#stockReceive_pcs') == false|| 
     $("#stockReceiveform").validate().element('#stockReceive_cut') == false||
     $("#stockReceiveform").validate().element('#stockReceive_quantity') == false)
    {

    }else
    {

      var nextid = $("#serialNumber").val();

      tbl_inventoryReceive.row.add( [
       '<input type="text" id="'+nextid+'" name="sno[]" value="'+$("#serialNumber").val()+'">',
       '<input type="text" id="'+nextid+'" name="stockReceive_groupName[]" value="'+$("#stockReceive_groupName").val()+'">',
       '<input type="text" id="'+nextid+'" name="stockReceive_qualityName[]" value="'+$("#stockReceive_qualityName").val()+'">',
       '<input type="text" id="'+nextid+'" name="stockReceive_pcs[]" value="'+$("#stockReceive_pcs").val()+'">',
        '<input type="text" id="'+nextid+'" name="stockReceive_cut[]" value="'+$("#stockReceive_cut").val()+'">',
       '<input type="text" id="'+nextid+'" name="stockReceive_quantity[]" value="'+$("#stockReceive_quantity").val()+'">',
      
        ] ).node().id = nextid;
      
    tbl_inventoryReceive.draw( false );

      $('#stockReceive_groupName').val("");
      $('#stockReceive_qualityName').val("");
      $('#stockReceive_pcs').val("");
      $('#stockReceive_cut').val("");
      $('#stockReceive_quantity').val("");
    }
        
 
    } );
} );


 $(document).ready(function(){
    var x = $('#stockReceive_Book_id').val();
    var jobProcess = $('#stockReceive_job_process_Id').val();
    jobProcessList();
    bookList(x);

   $('#add_stock_Receive').on('click', function () {

      removeValidationStockReceive();

        if ($('#stockReceiveform').valid())
        {
            addStockReceiveToServer();
        }
    });

});
$('#stockReceive_Book_id').selectpicker('refresh');
$('#stockReceive_job_process_Id').selectpicker('refresh');
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
              $('#stockReceive_job_process_Id').append('<option value="'+data['job_process_id_PK']+'" selected>'+data['job_process_name']+'</option>');
          }else{
              $('#stockReceive_job_process_Id').append('<option value="'+data['job_process_id_PK']+'">'+data['job_process_name']+'</option>');
          }
        });
                 
       $('#stockReceive_job_process_Id').selectpicker('refresh');

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
              $('#stockReceive_Book_id').append('<option value="'+data['book_id_PK']+'" selected>'+data['book_number']+'</option>');
          }else{
              $('#stockReceive_Book_id').append('<option value="'+data['book_id_PK']+'">'+data['book_number']+'</option>');
          }
        });
                 
       $('#stockReceive_Book_id').selectpicker('refresh');

      }
  });
}

function addStockReceiveToServer(){

  var addStockReceiveToServerdata = new FormData(document.getElementById("stockReceiveform"));
  addStockReceiveToServerdata.append('stockReceive_party_value_Id', stockReceiveDataMillParty.id());

      // AJAX request
    $.ajax({
      url:'<?=base_url()?>InventryStockReceiveController/insertStockReceive',
      method: 'post',
      data: addStockReceiveToServerdata,
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
                              text: " Stock Receive is successfully added",
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

function stockReceiveBookReferesh(){
 bookList();
}

function stockReceiveJobProcessReferesh(){
  jobProcessList();
}

function addValidationStockReceive(){
  $("#stockReceive_groupName").prop('required',true);
  $("#stockReceive_qualityName").prop('required',true);
  $("#stockReceive_pcs").prop('required',true);
  $("#stockReceive_cut").prop('required',true);
  $("#stockReceive_quantity").prop('required',true);
}

function removeValidationStockReceive(){
    $('#stockReceive_groupName').removeAttr('required');
    $('#stockReceive_qualityName').removeAttr('required');
    $('#stockReceive_pcs').removeAttr('required');
    $('#stockReceive_cut').removeAttr('required');
    $('#stockReceive_quantity').removeAttr('required');
}


// $(document).ready(function() {

//  var counter = 1;
 
//  var t = $('#tbl_inventoryReceive').DataTable({
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



