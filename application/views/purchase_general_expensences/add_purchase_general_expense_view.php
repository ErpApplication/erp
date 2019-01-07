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
                 
            <a href="<?= base_url(); ?>Purchasegeneral_expencesController" class="btn btn-primary">Back</a>

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
          <form id="expenxespurchaseform" method="post">
        <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">

      <div class="row">
      <div class="col-md-6 form-group">
       <div class="row">
         <div class="col-md-3 form-group">
          <label>Party Code</label>
            <input type="text" class="form-control" id="GeneralExpencePurchase_Party_Code_Id" name="GeneralExpencePurchase_Party_Code_Id" placeholder="Enter Purchase Party " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Party_Code_Id') ?>
         </div>
       <div class="col-md-7 form-group">
        <label>Party </label>
        <input type="text" class="form-control " name="GeneralExpencePurchase_Party_name" id="GeneralExpencePurchase_Party_name" placeholder="Enter Purchase Party" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Party_Value_Id') ?>
        </div>
        <div class="col-md-2 form-group">
        <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>AccountMasterController/insertAccountMaster">Add</a>
        </div>
        </div>
        </div>               
                        
        <div class="col-md-6 form-group">
             <label>RCM Bill No:</label>
<!--                  <input type="text" class="form-control" name="add_Purchase_Rcm_Bill_Id" id="add_Purchase_Rcm_Bill_Id" placeholder="check from client for this field" autocomplete="off" required pattern="[0-9 ]+" readonly> <?php echo form_error('add_Purchase_Rcm_Bill_Id') ?>
 -->    </div>
    </div>

    <div class="row">
        <div class="col-md-3 form-group">
          <label>Pur. Bill No</label>
          <input type="text" class="form-control " name="GeneralExpencePurchase_billNo" id="GeneralExpencePurchase_billNo" placeholder="Enter Purchase  Bill No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Pur_Bill_No_Id') ?>
        </div>

        <div class="col-md-3 form-group">
          <label>Bill Date <span >  </span> </label>
          <input type="Date" class="form-control " name="GeneralExpencePurchase_billDate" id="GeneralExpencePurchase_billDate" placeholder="Enter Purchase Bill Date" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('add_Purchase_Bill_Date_Id') ?>
        </div>

        <div class="col-md-3 form-group">
          <label>Cr Days<span >  </span> </label>
          <input type="text" class="form-control" name="GeneralExpencePurchase_crDays" id="GeneralExpencePurchase_crDays" placeholder="Enter Purchase Cr Days" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Purchase_Cr_Days_Id') ?>
        </div>

        <div class="col-md-3 form-group">
          <label>Inv.Type(T/R) </label>
          <input type="text" class="form-control " name="GeneralExpencePurchase_inventryType" id="GeneralExpencePurchase_inventryType" placeholder=" Enter Purchase Inv Type" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Inv_Type_Id') ?>
        </div>
    </div> 
           
  <div class="row">
   <div class="col-md-3 form-group">
        <label> A/C Name Code  </span></label>
      <input type="text" class="form-control" name="GeneralExpencePurchase_acName_code" id="GeneralExpencePurchase_acName_code" placeholder="Enter A/C Code" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_L_R_No_Id') ?>
    </div>
  <div class="col-md-6 form-group">
      <label>A/C Name</label>
      <input type="text" class="form-control " name="GeneralExpencePurchase_acName" id="GeneralExpencePurchase_acName" placeholder="Enter Purchase A/C Name" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_L_R_Dt_Id') ?>                         
  </div>
  <div class="col-md-2 form-group">
    <label> Skip In GSTR </label>
      <select id="GeneralExpencePurchase_skip_gstr" name="GeneralExpencePurchase_skip_gstr" class="form-control selectpicker" data-live-search="true" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
      </select>
  </div>

 </div>

 <div style="border-style: inset; padding: 15px">

  <div class="row" >
    <div class="col-md-1 form-group">
       <label >S.No. </label>

           <input type="text" class="form-control " name="serialNumber" id="serialNumber" placeholder="Enter Purchase Purchase Sr No" autocomplete="off" required readonly=""> <?php echo form_error('serialNumber') ?>
      </div>
      <div class="col-md-2 form-group" >
       <label>Description </label>
       <input type="text" class="form-control " name="GeneralExpencePurchase_Description_Id" id="GeneralExpencePurchase_Description_Id" placeholder="Enter Purchase Description" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Description_Id') ?>
      </div>

    <div class="col-md-2 form-group">
           <label>Quantity </label>
              <input type="text" class="form-control " name="GeneralExpencePurchase_Quantity_Id" id="GeneralExpencePurchase_Quantity_Id" placeholder="Enter Purchase Quantity" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Quantity_Id') ?>
       </div>
  
     <div class="col-md-2 form-group">
          <label>Rate </label>
              <input type="text" class="form-control " name="GeneralExpencePurchase_Rate_Id" id="GeneralExpencePurchase_Rate_Id" placeholder="Enter Purchase Rate" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Rate_Id') ?>
         </div>
     <div class="col-md-2 form-group">
        <label >Disc % </label>
                <input type="text" class="form-control " name="GeneralExpencePurchase_Disc_Id" id="GeneralExpencePurchase_Disc_Id" placeholder="Enter Purchase Disc" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Disc_Id') ?>
          </div>
           <div class="col-md-3 form-group">
            <label >Amount </label>
              <input type="text" class="form-control " name="GeneralExpencePurchase_Amount_Id" id="GeneralExpencePurchase_Amount_Id" placeholder="Enter Purchase Amount" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Amount_Id') ?>
          </div>
      </div>
  <div class="row">
     
      <div class="col-md-2 form-group">
             <label >SGST </label>
                <input type="text" class="form-control " name="GeneralExpencePurchase_Sgst_Id" id="GeneralExpencePurchase_Sgst_Id" placeholder="Enter Purchase SGST" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Sgst_Id') ?>
          </div>
    <div class="col-md-2 form-group">
           <label>CGST </label>
              <input type="text" class="form-control " name="GeneralExpencePurchase_Cgst_Id" id="GeneralExpencePurchase_Cgst_Id" placeholder="Enter Purchase CGST" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Cgst_Id') ?>
           </div>
      <div class="col-md-2 form-group">
            <label >Net Amt </label>
               <input type="text" class="form-control " name="GeneralExpencePurchase_Net_Amt_Id" id="GeneralExpencePurchase_Net_Amt_Id" placeholder="Enter Purchase Net Amt " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Net_Amt_Id') ?>
             </div>
        <div class="col-md-2 form-group">
              <label >Net Rate </label>
                   <input type="text" class="form-control " name="GeneralExpencePurchase_Net_Rate_Id" id="GeneralExpencePurchase_Net_Rate_Id" placeholder="Enter Purchase Net Rate" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Net_Rate_Id') ?>
          </div>
      <div class="col-md-2 form-group">
           <label>Freight </label>
                <input type="text" class="form-control " name="GeneralExpencePurchase_Freight_Id" id="GeneralExpencePurchase_Freight_Id" placeholder="check form client for this field" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Freight_Id') ?>
             </div>
       <div class="col-md-1 form-group">
             <label>GST</label>
                <input type="text" class="form-control" name="GeneralExpencePurchase_Gst_Id" id="GeneralExpencePurchase_Gst_Id" placeholder="check form client for this field " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Purchase_Gst_Id') ?>
            </div>
   
        <div class="col-md-1 form-group">
          <a name="add_Detail"  id="add_Detail" class="btn btn-primary">Add</a>
       </div>
   </div>
   </div>
<table id="tbl_inventoryIssue" class="display responsive" >
            <thead>
              <tr bgcolor="silver">
                  <th>Sr.No.</th>
                  <th>Description</th>
                  <th>Quantity</th>
                  <th>Rate</th>
                  <th>Disc %</th>
                  <th>Amount</th>
                  <th>SGST</th>
                  <th>CGST</th>
                  <th>Net Amt</th>
                  <th>Net Rate</th>
                  <th>Freight</th>
                  <th>GST</th>

              </tr>
            
          </thead>
        </table>
   
    <div class="row ">
      <div class="col-md-3 form-group ">
          <label>Total RCM Amt </label>
          <input type="text" class="form-control" name="addExpencespurchase_rcm_Amt" id="addExpencespurchase_rcm_Amt" placeholder="Enter Purchase Basic Amt" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Basic_Amt_Id') ?>
      </div>
        <div class="col-md-3 form-group ">
          <label>Non RCM Amt </label>
          <input type="text" class="form-control" name="addExpencespurchase_nonrcm_Amt" id="addExpencespurchase_nonrcm_Amt" placeholder="Enter Purchase Basic Amt" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Basic_Amt_Id') ?>
      </div>
      <div class="col-md-3 form-group ">
          <label>Basic Amt </label>
          <input type="text" class="form-control" name="addExpencespurchase_Basic_Amt_Id" id="addExpencespurchase_Basic_Amt_Id" placeholder="Enter Purchase Basic Amt" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Basic_Amt_Id') ?>
      </div>
      <div class="col-md-3 form-group ">
        <label >SGST </label>
        <input type="text" class="form-control" name="addExpencespurchase_Sgst_Id" id="addExpencespurchase_Sgst_Id" placeholder="Enter Purchase SGST" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('purchase_Sgst_Id') ?>
      </div>
        
        </div>
        <div class="row justify-content-end">
         <div class="col-md-3">
           <label >CGST </label>
           <input type="text" class="form-control" name="addExpencespurchase_Cgst_Id" id="addExpencespurchase_Cgst_Id" placeholder="Enter Purchase CGST" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('purchase_Cgst_Id') ?>
        </div> 
        </div> 

   <div class="row ">
      <div class="col-md-6 form-group">
          <label >Desc </label>
          <input type="text" class="form-control " name="addExpencespurchase_Desc_Id" id="addExpencespurchase_Desc_Id" placeholder="Enter Purchase Desc" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Desc_Id') ?>
      </div>
                          
      <div class="col-md-1 form-group">
          <label >T.D.S. Rate </label>
<!--                    <input type="text" class="form-control " name="add_Purchase_T_D_S_Rate_Code_Id" id="add_Purchase_T_D_S_Rate_Code_Id" placeholder="chek from client for this field " autocomplete="off" required readOnly pattern="[0-9]+"> <?php echo form_error('add_Purchase_T_D_S_Rate_Code_Id') ?>
 -->  </div>
      <div class="col-md-2 form-group">
        <label > </label>
<!--                      <input type="text" class="form-control " name="add_Purchase_T_D_S_Rate_Value_Id" id="add_Purchase_T_D_S_Rate_Value_Id" placeholder="chek from client for this field " autocomplete="off" required readOnly pattern="[0-9]+"> <?php echo form_error('add_Purchase_T_D_S_Rate_Value_Id') ?>
 -->  </div>
      <div class="col-md-3 form-group">
        <label >(F9) Other(+/-) </label>
          <input type="text" class="form-control " name="addExpencespurchase_F9_Other" id="addExpencespurchase_F9_Other" placeholder="Enter Purchase (F9) Other(+/-) " autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_F9_Other_Id') ?>
      </div>
    </div>

    <div class="row ">
         <div class="col-md-4 form-group">
            <label >Eway Bill No. </label>
              <input type="text" class="form-control " name="expencesPurchase_Eway_Bill" id="expencesPurchase_Eway_Bill" placeholder="Enter Purchase Eway Bill No." autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Eway_Bill_Id') ?>
           </div>
        <div class="col-md-4 form-group">
              <label >Rnd Off. </label>
              <input type="text" class="form-control " name="expencesPurchase_Rnd_Off" id="expencesPurchase_Rnd_Off" placeholder="Enter Purchase Rnd Off." autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Rnd_Off_Code_Id') ?>
         </div>

     <div class="col-md-4 form-group">
             <label >Bill Amount </label>
                <input type="text" class="form-control " name="expencesPurchase_Bill_Amount_Id" id="expencesPurchase_Bill_Amount_Id" placeholder="Enter Purchase Bill Amount" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Bill_Amount_Id') ?>
            </div>
        </div>
    </form>                  
    <button name="add_expencespurchase" id="add_expencespurchase" class="btn btn-primary"><?php if($uid==""){echo "Add General Expences Purchase";}else{echo "Update General Expences Purchase";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>

<?php  $this->load->view('assests/footer'); ?>
 <script type='text/javascript'>

 var expencesPurchasePartyData = $("#GeneralExpencePurchase_Party_name").tautocomplete({
        
        width: "500px",
        columns: ['Acount Master Name', 'City Name', 'Contact Number'],
        placeholder: "Search Mill Party",
        id: "expencesPurchaseParty_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getAccountMaster",
            type: "POST",
            data: function()
             {
                var x = {millPartyName: $('#expencesPurchaseParty_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + expencesPurchasePartyData.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = expencesPurchasePartyData.searchdata();
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

    addValidationGeneralPurchaseExpences();

    if ($("#expenxespurchaseform").validate().element('#GeneralExpencePurchase_Description_Id') == false || 
        $("#expenxespurchaseform").validate().element('#GeneralExpencePurchase_Quantity_Id') == false ||
        $("#expenxespurchaseform").validate().element('#GeneralExpencePurchase_Rate_Id') == false||
        $("#expenxespurchaseform").validate().element('#GeneralExpencePurchase_Disc_Id') == false|| 
        $("#expenxespurchaseform").validate().element('#GeneralExpencePurchase_Amount_Id') == false|| 
        $("#expenxespurchaseform").validate().element('#GeneralExpencePurchase_Sgst_Id') == false||
        $("#expenxespurchaseform").validate().element('#GeneralExpencePurchase_Cgst_Id') == false||
        $("#expenxespurchaseform").validate().element('#GeneralExpencePurchase_Net_Amt_Id') == false||
        $("#expenxespurchaseform").validate().element('#GeneralExpencePurchase_Net_Rate_Id') == false||
        $("#expenxespurchaseform").validate().element('#GeneralExpencePurchase_Freight_Id') == false|| 
        $("#expenxespurchaseform").validate().element('#GeneralExpencePurchase_Gst_Id') == false)
     {

    }else
    {

      var nextid = $("#serialNumber").val();

      tbl_inventoryIssue.row.add( [
       '<input type="text" id="'+nextid+'" name="sno[]" value="'+$("#serialNumber").val()+'">',
       '<input type="text" id="'+nextid+'" name="GeneralExpencePurchase_Description_Id[]" value="'+$("#GeneralExpencePurchase_Description_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="GeneralExpencePurchase_Quantity_Id[]" value="'+$("#GeneralExpencePurchase_Quantity_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="GeneralExpencePurchase_Rate_Id[]" value="'+$("#GeneralExpencePurchase_Rate_Id").val()+'">',
        '<input type="text" id="'+nextid+'" name="GeneralExpencePurchase_Disc_Id[]" value="'+$("#GeneralExpencePurchase_Disc_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="GeneralExpencePurchase_Amount_Id[]" value="'+$("#GeneralExpencePurchase_Amount_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="GeneralExpencePurchase_Sgst_Id[]" value="'+$("#GeneralExpencePurchase_Sgst_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="GeneralExpencePurchase_Cgst_Id[]" value="'+$("#GeneralExpencePurchase_Cgst_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="GeneralExpencePurchase_Net_Amt_Id[]" value="'+$("#GeneralExpencePurchase_Net_Amt_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="GeneralExpencePurchase_Net_Rate_Id[]" value="'+$("#GeneralExpencePurchase_Net_Rate_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="GeneralExpencePurchase_Freight_Id[]" value="'+$("#GeneralExpencePurchase_Freight_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="GeneralExpencePurchase_Gst_Id[]" value="'+$("#GeneralExpencePurchase_Gst_Id").val()+'">',
        ] ).node().id = nextid;
      
    tbl_inventoryIssue.draw( false );

      $('#GeneralExpencePurchase_Description_Id').val("");
      $('#GeneralExpencePurchase_Quantity_Id').val("");
      $('#GeneralExpencePurchase_Rate_Id').val("");
      $('#GeneralExpencePurchase_Disc_Id').val("");
      $('#GeneralExpencePurchase_Amount_Id').val("");
      $('#GeneralExpencePurchase_Sgst_Id').val("");
      $('#GeneralExpencePurchase_Cgst_Id').val("");
      $('#GeneralExpencePurchase_Net_Amt_Id').val("");
      $('#GeneralExpencePurchase_Net_Rate_Id').val("");
      $('#GeneralExpencePurchase_Freight_Id').val("");
      $('#GeneralExpencePurchase_Gst_Id').val("");
    }
        
 
    });
});

$(document).ready(function(){

    $('#add_expencespurchase').on('click', function () {

      removeValidationGeneralPurchaseExpences();
      
        if ($('#expenxespurchaseform').valid())
        {          
          addExpencesPurchaseToServer();

        }
    });
    });

function addExpencesPurchaseToServer(){
  var expencespurchaseToServerdata = new FormData(document.getElementById("expenxespurchaseform"));
  expencespurchaseToServerdata.append('GeneralExpencePurchase_Party_name', expencesPurchasePartyData.id());

      // AJAX request
    $.ajax({
      url:'<?=base_url()?>Purchasegeneral_expencesController/insertPurchaseExpences',
      method: 'post',
      data: expencespurchaseToServerdata,
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
                              text: "Expences Purchase is successfully added",
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

function addValidationGeneralPurchaseExpences(){
  $("#GeneralExpencePurchase_Description_Id").prop('required',true);
  $("#GeneralExpencePurchase_Quantity_Id").prop('required',true);
  $("#GeneralExpencePurchase_Rate_Id").prop('required',true);
  $("#GeneralExpencePurchase_Disc_Id").prop('required',true);
  $("#GeneralExpencePurchase_Amount_Id").prop('required',true);
  $("#GeneralExpencePurchase_Sgst_Id").prop('required',true);
  $("#GeneralExpencePurchase_Cgst_Id").prop('required',true);
  $("#GeneralExpencePurchase_Net_Amt_Id").prop('required',true);
  $("#GeneralExpencePurchase_Net_Rate_Id").prop('required',true);
  $("#GeneralExpencePurchase_Freight_Id").prop('required',true);
  $("#GeneralExpencePurchase_Gst_Id").prop('required',true);
}

function removeValidationGeneralPurchaseExpences(){
    $('#GeneralExpencePurchase_Description_Id').removeAttr('required');
    $('#GeneralExpencePurchase_Quantity_Id').removeAttr('required');
    $('#GeneralExpencePurchase_Rate_Id').removeAttr('required');
    $('#GeneralExpencePurchase_Disc_Id').removeAttr('required');
    $('#GeneralExpencePurchase_Amount_Id').removeAttr('required');
    $('#GeneralExpencePurchase_Sgst_Id').removeAttr('required');
    $('#GeneralExpencePurchase_Cgst_Id').removeAttr('required');
    $('#GeneralExpencePurchase_Net_Amt_Id').removeAttr('required');
    $('#GeneralExpencePurchase_Net_Rate_Id').removeAttr('required');
    $('#GeneralExpencePurchase_Freight_Id').removeAttr('required');
    $('#GeneralExpencePurchase_Gst_Id').removeAttr('required');
}



</script>



