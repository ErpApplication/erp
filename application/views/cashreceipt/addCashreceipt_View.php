	<style type="text/css">
hr {
    border: none;
    height: 1px;
    /* Set the hr color */
    color: #333; /* old IE */
    background-color: #333; /* Modern Browsers */

}

.vl {
  border-left: 1px solid #333;
  height: 400px;
  margin-top: -16px;
  margin-bottom: -16px;
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
                 
            <a href="<?= base_url(); ?>CashReceiptController" class="btn btn-primary">Back</a>

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
           <form id="cashreceiptform" method="post">
                    <div class="row">

    <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
    <div class="col-md-2 form-group"></div>
         <div class="col-md-3 form-group">
             <label >Voucher No  </label>
                 <input type="text" class="form-control" name="cash_Receipt_Voucher_No_Id" id="cash_Receipt_Voucher_No_Id" placeholder="Enter Voucher No" autocomplete="off" required pattern="[0-9 ]+"> 

    </div>                         
                        
 <div class="col-md-3 form-group">
       <label> Date </span> </label>
            <input type="Date" class="form-control " name="cash_Receipt_Date_Id" id="cash_Receipt_Date_Id" placeholder="Enter cash Receipt Date " autocomplete="off" required pattern="[a-zA-Z ]+"> 
          </div>
        </div>
        <hr>
        <div class="row">
     <div class="col-md-7 form-group">
             <label>Cr.{jmi}</label>             
    <hr>
  <div class="row">
         <div class="col-md-4 form-group">
               <label>Srno : </label>
                  <input type="text" class="form-control " name="serialNumber" id="serialNumber" placeholder="Enter cash Receipt Srno" autocomplete="off" required pattern="[0-9 ]+" readonly> 
         </div>
     <div class="col-md-8 form-group">
          <label>Party Balance :</label>
            <input type="text" class="form-control" name="cash_Receipt_Party_Balance_Id" id="cash_Receipt_Party_Balance_Id" placeholder="Enter Purchase Party " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Party_Code_Id') ?>
         </div>
       </div>
       <div class="row ">
     <div class="col-md-4 form-group">
            <label> Party :</label>
                  <input type="text" class="form-control " name="cash_Receipt_Party_Code_Id" id="cash_Receipt_Party_Code_Id" placeholder="Enter Cash Receipt Party" autocomplete="off" required pattern="[0-9 ]+"> 
                        
                </div>
                     <div class="col-md-8 form-group">
                    <div class="row">
                     <div class="col-md-10 form-group">
                      <label> </label>
                      <input type="text" class="form-control txt_Space" name="cash_Receipt_Party_Value_Id" id="cash_Receipt_Party_Value_Id" placeholder="Enter Sales Party " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('challan_Party_Id') ?>
                    </div>

                    <div class="col-md-2 form-group">
                    <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>AccountMasterController/insertAccountMaster">Add</a>
                    </div>
                    </div>
                    </div>

          </div>           
      <div class="row">
            <div class="col-md-6 form-group">
                <label>Amount :<span >  </span> </label>
                      <input type="text" class="form-control " name="cash_Receipt_Amount_Id" id="cash_Receipt_Amount_Id" placeholder="Enter cash Receipt Amount " autocomplete="off" required pattern="[a-zA-Z]+"> 
           </div>
     <div class="col-md-6 form-group">
            <label>Receipt No <span >  </span> </label>
                <input type="text" class="form-control " name="cash_Receipt_Receipt_No_Id" id="cash_Receipt_Receipt_No_Id" placeholder="Enter cash Receipt Receipt No" autocomplete="off" required pattern="[a-zA-Z ]+"> 
          </div>
          </div>           
      <div class="row">
    <div class="col-md-8 form-group">
          <label>Narration :</label>
              <input type="text" class="form-control" name="cash_Receipt_Narration_Id" id="cash_Receipt_Narration_Id" placeholder="Enter Narration" autocomplete="off" required pattern="[a-zA-Z ]+"> 
              </div>
              <div class="col-md-4 form-group">
          <label>Bal :<span >  </span> </label>
              <input type="text" class="form-control" name="cash_Receipt_Bal_Id" id="cash_Receipt_Bal_Id" placeholder="Enter cash Receipt Bal" autocomplete="off" required pattern="[a-zA-Z ]+"> 
              </div>
          </div> 
        </div>          
      <hr>
   <div class="col-md-5 form-group vl">
     
  <label>Dr. {uFir}</label>
      <hr>
    <div class="row ">
      <div class="col-md-6">
        <label>Cash :</label>
             <input type="text" class="form-control" name="cash_Receipt_Cash_Id" id="cash_Receipt_Cash_Id" placeholder="Enter cash Receipt Cash" autocomplete="off" required pattern="[0-9 ]+"> 
                                       
       </div>
  <div class="col-md-6 form-group">
       <label>Balance : </label>
          <input type="text" class="form-control " name="cash_Receipt_Balance_Id" id="cash_Receipt_Balance_Id" placeholder="Enter cash Receipt Balance" autocomplete="off" required pattern="[0-9 ]+"> 
                                       
            </div>
          </div>
    <div class="row">
     <div class="col-md-12 form-group">
      <div class="row">
      <div class="col-md-7 form-group">

    <label> Book </label>
      <select id="cash_Receipt_Book_Id" name="cash_Receipt_Book_Id" class="form-control selectpicker" data-live-search="true" required>
        <option value="">--Select--</option>
      </select>
    </div>


   <div class="col-md-2 form-group">
                <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BooksController/insertBook">Add</a>
            </div>
            <div class="col-md-3 form-group">
                <a class="now-ui-icons arrows-1_refresh-69" onclick="cashReceiptBookReferesh();">Referesh</a>
            </div>

            </div>

          </div>
          </div>

          <div class="row">
  <div class="col-md-12 form-group">
         <label>Narration 2: </label>
             <input type="text" class="form-control " name="cash_Receipt_Narration_Two_Id" id="cash_Receipt_Narration_Two_Id" placeholder="Enter cash Receipt Narration Two" autocomplete="off" required pattern="[0-9 ]+"> 
                                       
        </div>
     </div>
 </div>
</div>

<hr>
<div class="row">
  <div class="col-md-6 form-group">
    <label>F6 = Modify detail </label>
  </div>
  <div class="col-md-1 form-group">
    <a name="add_Detail"  id="clear_Detail" class="btn btn-primary">Clear</a>
    </div>
    <div class="col-md-1 form-group">
          <a name="add_Detail"  id="add_Detail" class="btn btn-primary">Add</a>
    </div>
  
</div>
 <table id="tbl_inventoryIssue" class="display responsive" >
            <thead>
              <tr bgcolor="silver">
                  <th>Srno.</th>
                  <th>Party Balance</th>
                  <th>PartyCode</th>
                  <th>PartyValue</th>
                  <th>Amount</th>
                  <th>Receipt No</th>
                  <th>Narration</th>
                  <th>Bal.</th>
                  <th>Cash</th>
                  <th>Balance</th>
                  <th>Book</th>
                  <th>Narration 2</th>
              </tr>
            
          </thead>
        </table>
   
    </div>
    </form>                  
    <button name="add_cashReceipt" id="add_cashReceipt" class="btn btn-primary"><?php if($uid==""){echo "Add Cash Receipt";}else{echo "update Cash Receipt";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>
 <script type='text/javascript'>


 var cashReceiptDataParty = $("#cash_Receipt_Party_Value_Id").tautocomplete({
        
        width: "500px",
        columns: ['Acount Master Name', 'City Name', 'Contact Number'],
        placeholder: "Search Mill Party",
        id: "cashReceiptParty_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getAccountMaster",
            type: "POST",
            data: function()
             {
                var x = {millPartyName: $('#cashReceiptParty_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + cashReceiptDataParty.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = cashReceiptDataParty.searchdata();
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

    addValidationCashReceipt();

    if ($("#cashreceiptform").validate().element('#cash_Receipt_Party_Balance_Id') == false || $("#cashreceiptform").validate().element('#cash_Receipt_Party_Code_Id') == false || $("#cashreceiptform").validate().element('#cash_Receipt_Party_Value_Id') == false|| $("#cashreceiptform").validate().element('#cash_Receipt_Amount_Id') == false|| $("#cashreceiptform").validate().element('#cash_Receipt_Receipt_No_Id') == false|| $("#cashreceiptform").validate().element('#cash_Receipt_Narration_Id') == false|| $("#cashreceiptform").validate().element('#cash_Receipt_Bal_Id') == false|| $("#cashreceiptform").validate().element('#cash_Receipt_Cash_Id') == false|| $("#cashreceiptform").validate().element('#cash_Receipt_Balance_Id') == false|| $("#cashreceiptform").validate().element('#cash_Receipt_Book_Id') == false|| $("#cashreceiptform").validate().element('#cash_Receipt_Narration_Two_Id') == false)
    {

    }else
    {

      var nextid = $("#serialNumber").val();

      tbl_inventoryIssue.row.add( [
       '<input type="text" id="'+nextid+'" name="sno[]" value="'+$("#serialNumber").val()+'">',
       '<input type="text" id="'+nextid+'" name="cash_Receipt_Party_Balance_Id[]" value="'+$("#cash_Receipt_Party_Balance_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="cash_Receipt_Party_Code_Id[]" value="'+$("#cash_Receipt_Party_Code_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="cash_Receipt_Party_Value_Id[]" value="'+$("#cash_Receipt_Party_Value_Id").val()+'">',
        '<input type="text" id="'+nextid+'" name="cash_Receipt_Amount_Id[]" value="'+$("#cash_Receipt_Amount_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="cash_Receipt_Receipt_No_Id[]" value="'+$("#cash_Receipt_Receipt_No_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="cash_Receipt_Narration_Id[]" value="'+$("#cash_Receipt_Narration_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="cash_Receipt_Bal_Id[]" value="'+$("#cash_Receipt_Bal_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="cash_Receipt_Cash_Id[]" value="'+$("#cash_Receipt_Cash_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="cash_Receipt_Balance_Id[]" value="'+$("#cash_Receipt_Balance_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="cash_Receipt_Book_Id[]" value="'+$("#cash_Receipt_Book_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="cash_Receipt_Narration_Two_Id[]" value="'+$("#cash_Receipt_Narration_Two_Id").val()+'">',
       
        ] ).node().id = nextid;
      
    tbl_inventoryIssue.draw( false );

      $('#cash_Receipt_Party_Balance_Id').val("");
      $('#cash_Receipt_Party_Code_Id').val("");
      $('#cash_Receipt_Party_Value_Id').val("");
      $('#cash_Receipt_Amount_Id').val("");
      $('#cash_Receipt_Receipt_No_Id').val("");
      $('#cash_Receipt_Narration_Id').val("");
      $('#cash_Receipt_Bal_Id').val("");
      $('#cash_Receipt_Cash_Id').val("");
      $('#cash_Receipt_Balance_Id').val("");
      $('#cash_Receipt_Book_Id').val("");
      $('#cash_Receipt_Narration_Two_Id').val("");
      
    }
        
 
    } );
} );

$(document).ready(function(){
    var x = $('#cash_Receipt_Book_Id').val();
    bookList(x);
     $('#add_cashReceipt').on('click', function () {

      removeValidationCashReceipt();
      
        if ($('#cashreceiptform').valid())
        {
            addCashReceiptToServer();
        }
    });

});
$('#cash_Receipt_Book_Id').selectpicker('refresh');

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
              $('#cash_Receipt_Book_Id').append('<option value="'+data['book_id_PK']+'" selected>'+data['book_number']+'</option>');
          }else{
              $('#cash_Receipt_Book_Id').append('<option value="'+data['book_id_PK']+'">'+data['book_number']+'</option>');
          }
        });
                 
       $('#cash_Receipt_Book_Id').selectpicker('refresh');

      }
  });
}

function addCashReceiptToServer(){
  var cashReceiptToServerdata = new FormData(document.getElementById("cashreceiptform"));
   cashReceiptToServerdata.append('cash_Receipt_Party_Value_Id', cashReceiptDataParty.id());

      // AJAX request
    $.ajax({
      url:'<?=base_url()?>CashReceiptController/insertCashReceipt',
      method: 'post',
      data: cashReceiptToServerdata,
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
                              text: "Cash Receipt is successfully added",
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

function cashReceiptBookReferesh(){
  bookList();
}

function addValidationCashReceipt(){
  $("#cash_Receipt_Party_Balance_Id").prop('required',true);
  $("#cash_Receipt_Party_Code_Id").prop('required',true);
  $("#cashReceiptParty_row_id").prop('required',true);
  $("#cash_Receipt_Amount_Id").prop('required',true);
  $("#cash_Receipt_Receipt_No_Id").prop('required',true);
  $("#cash_Receipt_Narration_Id").prop('required',true);
  $("#cash_Receipt_Bal_Id").prop('required',true);
  $("#cash_Receipt_Cash_Id").prop('required',true);
  $("#cash_Receipt_Balance_Id").prop('required',true);
  $("#cash_Receipt_Book_Id").prop('required',true);
  $("#cash_Receipt_Narration_Two_Id").prop('required',true);
}

function removeValidationCashReceipt(){
    $('#cash_Receipt_Party_Balance_Id').removeAttr('required');
    $('#cash_Receipt_Party_Code_Id').removeAttr('required');
    $('#cashReceiptParty_row_id').removeAttr('required');
    $('#cash_Receipt_Amount_Id').removeAttr('required');
    $('#cash_Receipt_Receipt_No_Id').removeAttr('required');
    $('#cash_Receipt_Narration_Id').removeAttr('required');
    $('#cash_Receipt_Bal_Id').removeAttr('required');
    $('#cash_Receipt_Cash_Id').removeAttr('required');
    $('#cash_Receipt_Balance_Id').removeAttr('required');
    $('#cash_Receipt_Book_Id').removeAttr('required');
    $('#cash_Receipt_Narration_Two_Id').removeAttr('required');
}


</script>



 