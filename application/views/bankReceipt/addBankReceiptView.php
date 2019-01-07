	<style type="text/css">
.modal-dialog {
    max-width: 1000px;
    margin: 1.75rem auto;
}

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
                 
            <a href="<?= base_url(); ?>BankReceiptController" class="btn btn-primary">Back</a>

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
           <form id="bankreceiptform">
                    <div class="row">

    <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
    <div class="col-md-2 form-group"></div>
         <div class="col-md-3 form-group">
             <label >Voucher No  </label>
                 <input type="text" class="form-control" name="bank_Receipt_Voucher_No_Id" id="bank_Receipt_Voucher_No_Id" placeholder="Enter Voucher No" autocomplete="off" required pattern="[0-9 ]+"> 

    </div>                         
                        
 <div class="col-md-3 form-group">
       <label> Date </span> </label>
            <input type="Date" class="form-control " name="bank_Receipt_Date_Id" id="bank_Receipt_Date_Id" placeholder="Enter bank Receipt Date " autocomplete="off" required pattern="[a-zA-Z ]+"> 
          </div>
        </div>
        <hr>
        <div class="row">
     <div class="col-md-6 form-group">
             <label>Cr.{jmi}</label>             
    <hr>
  <div class="row">
         <div class="col-md-4 form-group">
               <label>Srno : </label>
                  <input type="text" class="form-control " name="serialNumber" id="serialNumber" placeholder="Enter bank Receipt Srno" autocomplete="off" required pattern="[0-9 ]+" readOnly> 
         </div>
     <div class="col-md-8 form-group">
          <label>Party Balance :</label>
            <input type="text" class="form-control" name="bank_Receipt_Party_Balance_Id" id="bank_Receipt_Party_Balance_Id" placeholder="Enter Party Balance " autocomplete="off" required pattern="[0-9 ]+"> 
         </div>
       </div>
       <div class="row ">
     <div class="col-md-4 form-group">
            <label> Party :</label>
            <input type="text" class="form-control " name="bank_Receipt_Party_Code_Id" id="bank_Receipt_Party_Code_Id" placeholder="Enter bank Receipt Party" autocomplete="off" required pattern="[0-9 ]+"> 
                        
      </div>

          <div class="col-md-8 form-group">
              <div class="row">
              <div class="col-md-10 form-group">
                <label>  </label>
             <input type="text" class="form-control " name="bank_Receipt_Party_Value_Id" id="bank_Receipt_Party_Value_Id" placeholder="Enter bank Payment Party value" autocomplete="off" required pattern="[0-9 ]+"> 
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
                      <input type="text" class="form-control " name="bank_Receipt_Amount_Id" id="bank_Receipt_Amount_Id" placeholder="Enter bank Receipt Amount " autocomplete="off" required pattern="[a-zA-Z]+"> 
           </div>
     <div class="col-md-6 form-group">
            <label>Cheque/DD No <span >  </span> </label>
                <input type="text" class="form-control " name="bank_Receipt_Cheque_No_Id" id="bank_Receipt_Cheque_No_Id" placeholder="Enter bank Receipt Cheque/DD No" autocomplete="off" required pattern="[a-zA-Z ]+"> 
          </div>
          </div>           
      <div class="row">
    <div class="col-md-8 form-group">
          <label>Narration :</label>
              <input type="text" class="form-control" name="bank_Receipt_Narration_Id" id="bank_Receipt_Narration_Id" placeholder="Enter Narration" autocomplete="off" required pattern="[a-zA-Z ]+"> 
              </div>
              <div class="col-md-4 form-group">
          <label>Bal :<span >  </span> </label>
              <input type="text" class="form-control" name="bank_Receipt_Bal_Id" id="bank_Receipt_Bal_Id" placeholder="Enter bank Receipt Bal" autocomplete="off" required pattern="[a-zA-Z ]+"> 
              </div>
          </div> 
        </div>          
      <hr>
   <div class="col-md-6 form-group vl">
     
  <label>Dr. {uFir}</label>
      <hr>
    <div class="row ">
      <div class="col-md-6">
        <label>Bank :</label>
             <input type="text" class="form-control" name="bank_Receipt_Bank_Id" id="bank_Receipt_Bank_Id" placeholder="Enter bank Receipt Bank" autocomplete="off" required pattern="[0-9 ]+"> 
                                       
       </div>
  <div class="col-md-6 form-group">
       <label>Balance : </label>
          <input type="text" class="form-control " name="bank_Receipt_Balance_Id" id="bank_Receipt_Balance_Id" placeholder="Enter bank Receipt Balance" autocomplete="off" required pattern="[0-9 ]+"> 
                                       
            </div>
          </div>
          <div class="row">
     <div class="col-md-12 form-group">
      <div class="row">
        <div class="col-md-7 form-group">
           <label> Book </label>
            <select id="bank_Receipt_Book_Id" name="bank_Receipt_Book_Id" class="form-control selectpicker" data-live-search="true" required>
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
         <label>Narration 2: </label>
             <input type="text" class="form-control " name="bank_Receipt_Narration_Two_Id" id="bank_Receipt_Narration_Two_Id" placeholder="Enter bank Receipt Narration Two" autocomplete="off" required pattern="[0-9 ]+"> 
                                       
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

    <div class="col-md-1 form-group">
          <a name="show_sales_bill"  id="show_sales_bill" class="btn btn-primary">Show Sales Bill</a>
    </div>
  
</div>
  
  <div id="salesBillModal" class="modal fade" role="dialog"> 
  

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
       <div class="modal-body">
        
         <div class="table-responsive">
            <table id="tbl_salesBillList" class="table" style="width:100%">
             
              <thead>
                        <tr>
                            
                          <th>Bill Number</th>
                          <th>Bill Amount</th>
                          <th>Received Amount</th>
                          <th>Completed</th>
                          <th>Naration</th>

                        </tr>
                      </thead>

              <tbody>
               
              </tbody>
            </table>
          </div>

          <script>
$(document).ready(function() {
var tbl_salesBillList = $('#tbl_salesBillList').DataTable(
      {
       
              "processing": false,
              "serverSide": true,
              aaSorting: [[1, 'desc']],
              paging:true,
              pageLength:10,
              "processing": true,
              "pagingType": "full_numbers",
              //"scrollX": true,
              columnDefs: [{
                  orderable: false,
                  className: 'select-checkbox',
                  targets: 0
                }],
                select: {
                  style: 'os',
                  selector: 'td:first-child'
                },
               ajax: {
                  url: "<?php echo base_url() ?>BankReceiptController/salesBillListwebAPI", // The service URL
                  type: "POST",       // The type of request (post or get)
                  data:{caseSensitive: true},
                  allInOne: false,            // Set to true to load all your data in one AJAX call
                  refresh: false  ,
                   dataSrc: function (json)
                    {
                      return json.data;
                  },
                                      
          },

            "columns": [
            { "data": "bill_number"},
            { "data": "bill_amount"},
            { "data": "receivedAmount"},
            { "data": "completed"},
            { "data": "naration"},
                  
        ]
    

    } );



  $("#saveCheck").click(function(){
     var salesAmount=[];

  $.each(tbl_salesBillList.rows('.selected').nodes(), function(i, item) {
    var data = tbl_salesBillList.row(this).data();
    var id = data.counter;
    var rowJSON = {};
    rowJSON.salesIds=id;
    rowJSON.bill_number = tbl_salesBillList.cell(id,0).nodes().to$().find('input').val();
    rowJSON.bill_amount = tbl_salesBillList.cell(id,1).nodes().to$().find('input').val();
    rowJSON.rcvAmount = tbl_salesBillList.cell(id,2).nodes().to$().find('input').val();
    rowJSON.completed = tbl_salesBillList.cell(id,3).nodes().to$().find('select').val();
    
    salesAmount.push(rowJSON);
    console.log(rowJSON);

       });  

console.log(salesAmount);
     
  });

 } );
</script>
       


      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-primary" id="saveCheck">Save</button>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>


    </div>

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
                  <th>Cheque/DD No.</th>
                  <th>Narration1</th>
                  <th>Bal.</th>
                  <th>Bank</th>
                  <th>Balance</th>
                  <th>Book</th>
                  <th>Narration 2</th>
              </tr>
            
          </thead>
        </table>
   
    </div>
    </form>                  
    <button name="add_bankReceipt" id="add_bankReceipt" class="btn btn-primary"><?php if($uid==""){echo "Add Bank Receipt";}else{echo "update Bank Receipt";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>
 <script type='text/javascript'>



 var bankReceiptDataParty = $("#bank_Receipt_Party_Value_Id").tautocomplete({
        
        width: "500px",
        columns: ['Acount Master Name', 'City Name', 'Contact Number'],
        placeholder: "Search Mill Party",
        id: "bankReceiptParty_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getAccountMaster",
            type: "POST",
            data: function()
             {
                var x = {millPartyName: $('#bankReceiptParty_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + bankReceiptDataParty.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = bankReceiptDataParty.searchdata();
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
 
$( "#show_sales_bill" ).click(function() {
  $('#salesBillModal').modal('show');
  //tbl_salesBillList.ajax.reload();
});

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

    addValidationBankReceipt();

    if ($("#bankreceiptform").validate().element('#bank_Receipt_Party_Balance_Id') == false || $("#bankreceiptform").validate().element('#bank_Receipt_Party_Code_Id') == false || $("#bankreceiptform").validate().element('#bank_Receipt_Party_Value_Id') == false|| $("#bankreceiptform").validate().element('#bank_Receipt_Amount_Id') == false|| $("#bankreceiptform").validate().element('#bank_Receipt_Cheque_No_Id') == false|| $("#bankreceiptform").validate().element('#bank_Receipt_Narration_Id') == false|| $("#bankreceiptform").validate().element('#bank_Receipt_Bal_Id') == false|| $("#bankreceiptform").validate().element('#bank_Receipt_Bank_Id') == false|| $("#bankreceiptform").validate().element('#bank_Receipt_Balance_Id') == false|| $("#bankreceiptform").validate().element('#bank_Receipt_Book_Id') == false|| $("#bankreceiptform").validate().element('#bank_Receipt_Narration_Two_Id') == false)
    {

    }else
    {

      var nextid = $("#serialNumber").val();

      tbl_inventoryIssue.row.add( [
       '<input type="text" id="'+nextid+'" name="sno[]" value="'+$("#serialNumber").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Receipt_Party_Balance_Id[]" value="'+$("#bank_Receipt_Party_Balance_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Receipt_Party_Code_Id[]" value="'+$("#bank_Receipt_Party_Code_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Receipt_Party_Value_Id[]" value="'+$("#bank_Receipt_Party_Value_Id").val()+'">',
        '<input type="text" id="'+nextid+'" name="bank_Receipt_Amount_Id[]" value="'+$("#bank_Receipt_Amount_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Receipt_Cheque_No_Id[]" value="'+$("#bank_Receipt_Cheque_No_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Receipt_Narration_Id[]" value="'+$("#bank_Receipt_Narration_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Receipt_Bal_Id[]" value="'+$("#bank_Receipt_Bal_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Receipt_Bank_Id[]" value="'+$("#bank_Receipt_Bank_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Receipt_Balance_Id[]" value="'+$("#bank_Receipt_Balance_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Receipt_Book_Id[]" value="'+$("#bank_Receipt_Book_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="bank_Receipt_Narration_Two_Id[]" value="'+$("#bank_Receipt_Narration_Two_Id").val()+'">',
       
        ] ).node().id = nextid;
      
    tbl_inventoryIssue.draw( false );

      $('#bank_Receipt_Party_Balance_Id').val("");
      $('#bank_Receipt_Party_Code_Id').val("");
      $('#bank_Receipt_Party_Value_Id').val("");
      $('#bank_Receipt_Amount_Id').val("");
      $('#bank_Receipt_Cheque_No_Id').val("");
      $('#bank_Receipt_Narration_Id').val("");
      $('#bank_Receipt_Bal_Id').val("");
      $('#bank_Receipt_Bank_Id').val("");
      $('#bank_Receipt_Balance_Id').val("");
      $('#bank_Receipt_Book_Id').val("");
      $('#bank_Receipt_Narration_Two_Id').val("");
      
    }
        
 
    } );
} );



$(document).ready(function(){
    var x = $('#bank_Receipt_Book_Id').val();
    bookList(x);

   $('#add_bankReceipt').on('click', function () {

       removeValidationBankReceipt();

        if ($('#bankreceiptform').valid())
        {
            addBankReceiptToServer();
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
              $('#bank_Receipt_Book_Id').append('<option value="'+data['book_id_PK']+'" selected>'+data['book_number']+'</option>');
          }else{
              $('#bank_Receipt_Book_Id').append('<option value="'+data['book_id_PK']+'">'+data['book_number']+'</option>');
          }
        });
                 
       $('#bank_Receipt_Book_Id').selectpicker('refresh');

      }
  });
}

  });

function addBankReceiptToServer(){
  var bankReceiptToServerdata = new FormData(document.getElementById("bankreceiptform"));
   bankReceiptToServerdata.append('bank_Receipt_Party_Value_Id', bankReceiptDataParty.id());

      // AJAX request
    $.ajax({
      url:'<?=base_url()?>BankReceiptController/insertBankReceipt',
      method: 'post',
      data: bankReceiptToServerdata,
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
                              text: "Bank Receipt is successfully added",
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

function addValidationBankReceipt(){
  $("#bank_Receipt_Party_Balance_Id").prop('required',true);
  $("#bank_Receipt_Party_Code_Id").prop('required',true);
  $("#bankReceiptParty_row_id").prop('required',true);
  $("#bank_Receipt_Amount_Id").prop('required',true);
  $("#bank_Receipt_Cheque_No_Id").prop('required',true);
  $("#bank_Receipt_Narration_Id").prop('required',true);
  $("#bank_Receipt_Bal_Id").prop('required',true);
  $("#bank_Receipt_Bank_Id").prop('required',true);
  $("#bank_Receipt_Balance_Id").prop('required',true);
  $("#bank_Receipt_Book_Id").prop('required',true);
  $("#bank_Receipt_Narration_Two_Id").prop('required',true);
}

function removeValidationBankReceipt(){
    $('#bank_Receipt_Party_Balance_Id').removeAttr('required');
    $('#bank_Receipt_Party_Code_Id').removeAttr('required');
    $('#bankReceiptParty_row_id').removeAttr('required');
    $('#bank_Receipt_Amount_Id').removeAttr('required');
    $('#bank_Receipt_Cheque_No_Id').removeAttr('required');
    $('#bank_Receipt_Narration_Id').removeAttr('required');
    $('#bank_Receipt_Bal_Id').removeAttr('required');
    $('#bank_Receipt_Bank_Id').removeAttr('required');
    $('#bank_Receipt_Balance_Id').removeAttr('required');
    $('#bank_Receipt_Book_Id').removeAttr('required');
    $('#bank_Receipt_Narration_Two_Id').removeAttr('required');
}

</script>



