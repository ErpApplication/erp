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
                 
            <a href="<?= base_url(); ?>BankPaymentController" class="btn btn-primary">Back</a>

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
           <form id="bankpaymentform">
                    <div class="row">

    <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
    <div class="col-md-2 form-group"></div>
         <div class="col-md-3 form-group">
             <label >Voucher No  </label>
                 <input type="text" class="form-control" name="bank_Payment_Voucher_No_Id" id="bank_Payment_Voucher_No_Id" placeholder="Enter Voucher No" autocomplete="off" required pattern="[0-9 ]+"> 

    </div>                         
                        
 <div class="col-md-3 form-group">
       <label> Date </span> </label>
            <input type="Date" class="form-control " name="bank_Payment_Date_Id" id="bank_Payment_Date_Id" placeholder="Enter Bank Payment Date " autocomplete="off" required pattern="[a-zA-Z ]+"> 
          </div>
        </div>
        <hr>
        <div class="row">
     <div class="col-md-6 form-group">
             <label>Cr.{jmi}</label>             
    <hr>
  <div class="row">
         <div class="col-md-4 form-group">
               <label>Bank : </label>
                  <input type="text" class="form-control " name="bank_Payment_Bank_Id" id="bank_Payment_Bank_Id" placeholder="Enter Bank Payment Bank" autocomplete="off" required pattern="[0-9 ]+"> 
         </div>
     <div class="col-md-8 form-group">
          <label> Balance :</label>
            <input type="text" class="form-control" name="bank_Payment_Balance_Id" id="bank_Payment_Balance_Id" placeholder="Enter Bank Payment Balance " autocomplete="off" required pattern="[0-9 ]+"> 
         </div>
       </div>
       <div class="row ">
     <div class="col-md-12 form-group">
       <div class="row">
        <div class="col-md-7 form-group">
            <label> Book :</label>
             <select id="bank_Payment_Book_Id" name="bank_Payment_Book_Id" class="form-control selectpicker" data-live-search="true" required>
                <option value="">--Select--</option>
              </select> 
      </div>

      <div class="col-md-2 form-group">
        <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BooksController/insertBook">Add</a>
            </div>
            <div class="col-md-3 form-group">
                <a class="now-ui-icons arrows-1_refresh-69" onclick="bankPaymentBookReferesh();">Referesh</a>
            </div>

            </div>
            </div> 
      
          </div>           
      <div class="row">
            <div class="col-md-12 form-group">
                <label>Narration 2 : </label>
                      <input type="text" class="form-control " name="bank_Payment_Narration_Two_Id" id="bank_Payment_Narration_Two_Id" placeholder="Enter Bank Payment Narration 2 " autocomplete="off" required pattern="[a-zA-Z]+"> 
           </div>
         </div> 
        </div>          
      <hr>
   <div class="col-md-6 form-group vl">
     
  <label>Dr. {uFir}</label>
      <hr>
    <div class="row ">
      <div class="col-md-4 form-group">
        <label>Srno :</label>
             <input type="text" class="form-control " name="serialNumber" id="serialNumber" placeholder="Enter cash Payment Srno" autocomplete="off" required pattern="[0-9 ]+" readOnly> 
                                       
       </div>
<div class="col-md-2 form-group"></div>
  <div class="col-md-6 form-group">
       <label>Party Balance : </label>
          <input type="text" class="form-control " name="bank_Payment_Party_Balance_Id" id="bank_Payment_Party_Balance_Id" placeholder="Enter Bank Payment Party Balance" autocomplete="off" required pattern="[0-9 ]+"> 
                                       
            </div>
          </div>
          <div class="row">
     <div class="col-md-4 form-group">
           <label> Party </label>
             <input type="text" class="form-control " name="bank_Payment_Party_Code_Id" id="bank_Payment_Party_Code_Id" placeholder="Enter Bank Payment Party Code" autocomplete="off" required pattern="[0-9 ]+"> 
            </div>
             <div class="col-md-8 form-group">
              <div class="row">
              <div class="col-md-10 form-group">
                <label>  </label>
             <input type="text" class="form-control " name="bank_Payment_Party_Value_Id" id="bank_Payment_Party_Value_Id" placeholder="Enter bank Payment Party value" autocomplete="off" required pattern="[0-9 ]+"> 
            </div>
              <div class="col-md-2 form-group">
              <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>AccountMasterController/insertAccountMaster">Add</a>
              </div>
              </div>
              </div>

          </div>
          <div class="row">
  <div class="col-md-6 form-group">
         <label>Amount : </label>
             <input type="text" class="form-control " name="bank_Payment_Amount_Id" id="bank_Payment_Amount_Id" placeholder="Enter bank Payment Amount" autocomplete="off" required pattern="[0-9 ]+"> 
                                       
        </div>
        <div class="col-md-6 form-group">
         <label>Cheque/DD No : </label>
             <input type="text" class="form-control " name="bank_Payment_Cheque_No_Id" id="bank_Payment_Cheque_No_Id" placeholder="Enter bank Payment Cheque No" autocomplete="off" required pattern="[0-9 ]+"> 
                                       
        </div>
     </div>
     <div class="row">
  <div class="col-md-9 form-group">
         <label>Narration : </label>
             <input type="text" class="form-control " name="bank_Payment_Narration_Id" id="bank_Payment_Narration_Id" placeholder="Enter bank Payment Narration" autocomplete="off" required pattern="[0-9 ]+"> 
                                       
        </div>
        <div class="col-md-3 form-group">
         <label>Bal. : </label>
             <input type="text" class="form-control " name="bank_Payment_Bal_Id" id="bank_Payment_Bal_Id" placeholder="Enter bank Payment Balance" autocomplete="off" required pattern="[0-9 ]+"> 
                                       
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
  
</div>
 <table id="tbl_inventoryIssue" class="display responsive" >
            <thead>
              <tr bgcolor="silver">
                  <th>Srno.</th>
                  <th>Party Balance Dr.</th>
                  <th>Partycode Dr.</th>
                  <th>Partyvalue Dr.</th>
                  <th>Amount Dr.</th>
                  <th>Cheque/DD No Dr.</th>
                  <th>Narration Dr.</th>
                  <th>Bal. Dr.</th>
                  <th>Bank Cr.</th>
                  <th>Balance Cr.</th>
                  <th>Book Cr.</th>
                  <th>Narration 2 Cr.</th>
                  

              </tr>
            
          </thead>
        </table>
   
    </div>
    </form>                  
    <button name="add_bankPayment" id="add_bankPayment" class="btn btn-primary"><?php if($uid==""){echo "Add Bank Payment";}else{echo "update Bank Payment";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>
 <script type='text/javascript'>

 var bankPaymentDataParty = $("#bank_Payment_Party_Value_Id").tautocomplete({
        
        width: "500px",
        columns: ['Acount Master Name', 'City Name', 'Contact Number'],
        placeholder: "Search Mill Party",
        id: "bankPaymentParty_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getAccountMaster",
            type: "POST",
            data: function()
             {
                var x = {millPartyName: $('#bankPaymentParty_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + bankPaymentDataParty.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = bankPaymentDataParty.searchdata();
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
   
   addValidationBankPayment();

  $('#add_Detail').on( 'click', function () {
    if ($("#bankpaymentform").validate().element('#bank_Payment_Party_Balance_Id') == false || $("#bankpaymentform").validate().element('#bank_Payment_Party_Code_Id') == false || $("#bankpaymentform").validate().element('#bank_Payment_Party_Value_Id') == false|| $("#bankpaymentform").validate().element('#bank_Payment_Amount_Id') == false|| $("#bankpaymentform").validate().element('#bank_Payment_Cheque_No_Id') == false|| $("#bankpaymentform").validate().element('#bank_Payment_Narration_Id') == false|| $("#bankpaymentform").validate().element('#bank_Payment_Bal_Id') == false|| $("#bankpaymentform").validate().element('#bank_Payment_Bank_Id') == false|| $("#bankpaymentform").validate().element('#bank_Payment_Balance_Id') == false|| $("#bankpaymentform").validate().element('#bank_Payment_Book_Id') == false|| $("#bankpaymentform").validate().element('#bank_Payment_Narration_Two_Id') == false)
    {

    }else
    {

      var nextid = $("#serialNumber").val();

      tbl_inventoryIssue.row.add( [
       '<input type="text" id="'+nextid+'" name="sno[]" value="'+$("#serialNumber").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Payment_Party_Balance_Id[]" value="'+$("#bank_Payment_Party_Balance_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Payment_Party_Code_Id[]" value="'+$("#bank_Payment_Party_Code_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Payment_Party_Value_Id[]" value="'+$("#bank_Payment_Party_Value_Id").val()+'">',
        '<input type="text" id="'+nextid+'" name="bank_Payment_Amount_Id[]" value="'+$("#bank_Payment_Amount_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Payment_Cheque_No_Id[]" value="'+$("#bank_Payment_Cheque_No_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Payment_Narration_Id[]" value="'+$("#bank_Payment_Narration_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Payment_Bal_Id[]" value="'+$("#bank_Payment_Bal_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Payment_Bank_Id[]" value="'+$("#bank_Payment_Bank_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Payment_Balance_Id[]" value="'+$("#bank_Payment_Balance_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Payment_Book_Id[]" value="'+$("#bank_Payment_Book_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Payment_Narration_Two_Id[]" value="'+$("#bank_Payment_Narration_Two_Id").val()+'">',
       
        ] ).node().id = nextid;
      
    tbl_inventoryIssue.draw( false );

      $('#bank_Payment_Party_Balance_Id').val("");
      $('#bank_Payment_Party_Code_Id').val("");
      $('#bank_Payment_Party_Value_Id').val("");
      $('#bank_Payment_Amount_Id').val("");
      $('#bank_Payment_Cheque_No_Id').val("");
      $('#bank_Payment_Narration_Id').val("");
      $('#bank_Payment_Bal_Id').val("");
      $('#bank_Payment_Bank_Id').val("");
      $('#bank_Payment_Balance_Id').val("");
      $('#bank_Payment_Book_Id').val("");
      $('#bank_Payment_Narration_Two_Id').val("");
      
    }
        
 
    } );
} );


$(document).ready(function(){
    var x = $('#bank_Payment_Book_Id').val();
    bookList(x);

   $('#add_bankPayment').on('click', function () {

       removeValidationBankPayment();

        if ($('#bankpaymentform').valid())
        {
            addBankPaymentToServer();
        }
    });


$('#bank_Payment_Book_Id').selectpicker('refresh');

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
              $('#bank_Payment_Book_Id').append('<option value="'+data['book_id_PK']+'" selected>'+data['book_number']+'</option>');
          }else{
              $('#bank_Payment_Book_Id').append('<option value="'+data['book_id_PK']+'">'+data['book_number']+'</option>');
          }
        });
                 
       $('#bank_Payment_Book_Id').selectpicker('refresh');

      }
  });
}

  });

function addBankPaymentToServer(){
  var bankPaymentToServerdata = new FormData(document.getElementById("bankpaymentform"));
   bankPaymentToServerdata.append('bank_Payment_Party_Value_Id', bankPaymentDataParty.id());

      // AJAX request
    $.ajax({
      url:'<?=base_url()?>BankPaymentController/insertBankPayment',
      method: 'post',
      data: bankPaymentToServerdata,
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
                              text: "Bank Payment is successfully added",
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
function bankPaymentBookReferesh(){
  bookList();
}

function addValidationBankPayment(){
  $("#bank_Payment_Party_Balance_Id").prop('required',true);
  $("#bank_Payment_Party_Code_Id").prop('required',true);
  $("#bankPaymentParty_row_id").prop('required',true);
  $("#bank_Payment_Amount_Id").prop('required',true);
  $("#bank_Payment_Cheque_No_Id").prop('required',true);
  $("#bank_Payment_Narration_Id").prop('required',true);
  $("#bank_Payment_Bal_Id").prop('required',true);
  $("#bank_Payment_Bank_Id").prop('required',true);
  $("#bank_Payment_Balance_Id").prop('required',true);
  $("#bank_Payment_Book_Id").prop('required',true);
  $("#bank_Payment_Narration_Two_Id").prop('required',true);
}

function removeValidationBankPayment(){
    $('#bank_Payment_Party_Balance_Id').removeAttr('required');
    $('#bank_Payment_Party_Code_Id').removeAttr('required');
    $('#bankPaymentParty_row_id').removeAttr('required');
    $('#bank_Payment_Amount_Id').removeAttr('required');
    $('#bank_Payment_Cheque_No_Id').removeAttr('required');
    $('#bank_Payment_Narration_Id').removeAttr('required');
    $('#bank_Payment_Bal_Id').removeAttr('required');
    $('#bank_Payment_Bank_Id').removeAttr('required');
    $('#bank_Payment_Balance_Id').removeAttr('required');
    $('#bank_Payment_Book_Id').removeAttr('required');
    $('#bank_Payment_Narration_Two_Id').removeAttr('required');
}

</script>



