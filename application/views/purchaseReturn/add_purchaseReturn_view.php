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
                 
            <a href="<?= base_url(); ?>PurchaseReturnController" class="btn btn-primary">Back</a>

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
          <form id="purchaseReturnform" method="post">
        <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">

      <div class="row">
          <div class="col-md-6 form-group">
          <div class="row">
         <div class="col-md-7 form-group">
          <label >Book  </label>
            <select id="purchaseReturn_Book_Id" name="purchaseReturn_Book_Id" class="form-control selectpicker" data-live-search="true" required>
              <option value="">--Select--</option>
            </select> 
            </div> 

            <div class="col-md-2 form-group">
                <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BooksController/insertBook">Add</a>
            </div>
            <div class="col-md-3 form-group">
                <a class="now-ui-icons arrows-1_refresh-69" onclick="purchaseReturnBookReferesh();">Referesh</a>
            </div>

            </div>
            </div>                        
                        
 <div class="col-md-6 form-group">
       <label> Bal.: </span> </label>
            <input type="text" class="form-control " name="purchaseReturn_Bal_Id" id="purchaseReturn_Bal_Id" placeholder="Enter Purchase Bal" autocomplete="off" required pattern="[a-zA-Z ]+"> 
          </div>
    </div>

  <div class="row">
         <div class="col-md-3 form-group">
               <label>Pur. Bill No</label>
                  <input type="text" class="form-control " name="purchaseReturn_Pur_Bill_No_Id" id="purchaseReturn_Pur_Bill_No_Id" placeholder="Enter Purchase  Bill No" autocomplete="off" required pattern="[0-9 ]+"> 
         </div>
     <div class="col-md-2 form-group">
          <label>Party </label>
            <input type="text" class="form-control" name="purchaseReturn_Party_Code_Id" id="purchaseReturn_Party_Code_Id" placeholder="Enter Purchase Party " autocomplete="off" required pattern="[0-9 ]+"> 

         </div>
     <div class="col-md-4 form-group">
       <div class="row">
       <div class="col-md-10 form-group">
        <label> </label>
        <input type="text" class="form-control " name="purchaseReturn_Party_Value_Id" id="purchaseReturn_Party_Value_Id" placeholder="Enter Purchase Party" autocomplete="off" required pattern="[0-9 ]+"> 
      </div>
        <div class="col-md-2 form-group">
        <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>AccountMasterController/insertAccountMaster">Add</a>
        </div>
        </div>
        </div>

      <div class="col-md-3 form-group">
            <label>Inv.Type(T/R) </label>
                 <input type="text" class="form-control " name="purchaseReturn_Inv_Type_Id" id="purchaseReturn_Inv_Type_Id" placeholder=" Enter Purchase Inv Type" autocomplete="off" required pattern="[0-9 ]+">
              </div>
          </div>           
      <div class="row">
            <div class="col-md-3 form-group">
                <label>Bill Date <span >  </span> </label>
                      <input type="Date" class="form-control " name="purchaseReturn_Bill_Date_Id" id="purchaseReturn_Bill_Date_Id" placeholder="Enter Purchase Bill Date" autocomplete="off" required pattern="[a-zA-Z]+"> 
           </div>
           <div class="col-md-6 form-group">
            <div class="row">
            <div class="col-md-10 form-group">
            <label>Broker <span >  </span> </label>
              <input type="text" class="form-control " name="purchaseReturn_Broker_Id" id="purchaseReturn_Broker_Id" placeholder="Enter Purchase Broker" autocomplete="off" required pattern="[a-zA-Z ]+"> 
            </div>
            <div class="col-md-2 form-group">
          <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BrokerController/insertBroker">Add</a>
          </div>
          </div>
          </div>


    <div class="col-md-2 form-group">
          <label>Cr Days<span >  </span> </label>
              <input type="text" class="form-control" name="purchaseReturn_Cr_Days_Id" id="purchaseReturn_Cr_Days_Id" placeholder="Enter Purchase Cr Days" autocomplete="off" required pattern="[a-zA-Z ]+"> 
              </div>
          </div>           
      <div class="row">
   <div class="col-md-3 form-group">
        <label>L.R.No  </span></label>
             <input type="text" class="form-control" name="purchaseReturn_L_R_No_Id" id="purchaseReturn_L_R_No_Id" placeholder="Enter Purchase L R No" autocomplete="off" required pattern="[0-9 ]+"> 
                                       
       </div>
  <div class="col-md-3 form-group">
       <label>L.R.Dt. </label>
          <input type="Date" class="form-control " name="purchaseReturn_L_R_Dt_Id" id="purchaseReturn_L_R_Dt_Id" placeholder="Enter Purchase L R Dt" autocomplete="off" required pattern="[0-9 ]+"> 
                                       
            </div>
     <div class="col-md-2 form-group">
           <label> Case No. </label>
             <input type="text" class="form-control " name="purchaseReturn_Case_No_Id" id="purchaseReturn_Case_No_Id" placeholder="Enter Purchase Case No" autocomplete="off" required pattern="[0-9 ]+"> 
            </div>
  <div class="col-md-4 form-group">
         <label>Transport </label>
             <input type="text" class="form-control " name="purchaseReturn_Transport_Id" id="purchaseReturn_Transport_Id" placeholder="Enter Purchase Transport" autocomplete="off" required pattern="[0-9 ]+">
                                       
        </div>
 </div>
 <div style="border-style: inset; padding: 15px">
  <div class="row" >
    <div class="col-md-1 form-group">
       <label >S.No. </label>

           <input type="text" class="form-control " name="serialNumber" id="serialNumber" placeholder="Enter Purchase Purchase Sr No" autocomplete="off" required readonly=""> 
      </div>
  <div class="col-md-3 form-group" >
       <label>Description </label>
            <input type="text" class="form-control " name="purchaseReturn_Description_Id" id="purchaseReturn_Description_Id" placeholder="Enter Purchase Description" autocomplete="off" required pattern="[0-9 ]+">
        </div>
    <div class="col-md-1 form-group" >
        <label>Meter </label>
            <input type="text" class="form-control " name="purchaseReturn_Nos_Id" id="purchaseReturn_Nos_Id" placeholder="Enter Purchase Nos" autocomplete="off" required pattern="[0-9 ]+">
        </div>
    <div class="col-md-2 form-group" >
       <label>Cut </label>
            <input type="text" class="form-control " name="purchaseReturn_Cut_Id" id="purchaseReturn_Cut_Id" placeholder="Enter Purchase Cut" autocomplete="off" required pattern="[0-9 ]+"> 
       </div>
    <div class="col-md-2 form-group">
           <label>Quantity </label>
              <input type="text" class="form-control " name="purchaseReturn_Quantity_Id" id="purchaseReturn_Quantity_Id" placeholder="Enter Purchase Quantity" autocomplete="off" required pattern="[0-9 ]+">
       </div>
    <div class="col-md-1 form-group">
          <label>PM </label>
              <input type="text" class="form-control " name="purchaseReturn_PM_Id" id="purchaseReturn_PM_Id" placeholder="Enter Purchase PM" autocomplete="off" required pattern="[0-9 ]+"> 
          </div>
     <div class="col-md-1 form-group">
          <label>Rate </label>
              <input type="text" class="form-control " name="purchaseReturn_Rate_Id" id="purchaseReturn_Rate_Id" placeholder="Enter Purchase Rate" autocomplete="off" required pattern="[0-9 ]+">
         </div>
     <div class="col-md-1 form-group">
        <label >Disc % </label>
                <input type="text" class="form-control " name="purchaseReturn_Disc_Id" id="purchaseReturn_Disc_Id" placeholder="Enter Purchase Disc" autocomplete="off" required pattern="[0-9 ]+"> 
          </div>
      </div>
  <div class="row">
      <div class="col-md-2 form-group">
            <label >Amount </label>
              <input type="text" class="form-control " name="purchaseReturn_Amount_Id" id="purchaseReturn_Amount_Id" placeholder="Enter Purchase Amount" autocomplete="off" required pattern="[0-9 ]+"> 
          </div>
      <div class="col-md-1 form-group">
             <label >SGST </label>
                <input type="text" class="form-control " name="purchaseReturn_Sgst_Id" id="purchaseReturn_Sgst_Id" placeholder="Enter Purchase SGST" autocomplete="off" required pattern="[0-9 ]+">
          </div>
    <div class="col-md-1 form-group">
           <label>CGST </label>
              <input type="text" class="form-control " name="purchaseReturn_Cgst_Id" id="purchaseReturn_Cgst_Id" placeholder="Enter Purchase CGST" autocomplete="off" required pattern="[0-9 ]+"> 
           </div>
      <div class="col-md-2 form-group">
            <label >Net Amt </label>
               <input type="text" class="form-control " name="purchaseReturn_Net_Amt_Id" id="purchaseReturn_Net_Amt_Id" placeholder="Enter Purchase Net Amt " autocomplete="off" required pattern="[0-9 ]+"> 
             </div>
        <div class="col-md-1 form-group">
              <label >Net Rate </label>
                   <input type="text" class="form-control " name="purchaseReturn_Net_Rate_Id" id="purchaseReturn_Net_Rate_Id" placeholder="Enter Purchase Net Rate" autocomplete="off" required pattern="[0-9]+">
          </div>
      <div class="col-md-2 form-group">
           <label>Freight </label>
                <input type="text" class="form-control " name="purchaseReturn_Freight_Id" id="purchaseReturn_Freight_Id" placeholder="check form client for this field" autocomplete="off" required pattern="[0-9 ]+">
             </div>
       <div class="col-md-1 form-group">
             <label>GST</label>
                <input type="text" class="form-control" name="purchaseReturn_Gst_Id" id="purchaseReturn_Gst_Id" placeholder="check form client for this field " autocomplete="off" required pattern="[a-zA-Z ]+"> 
            </div>
     <!--  <div class="col-md-1 form-group">
            <label> </label>
                  <input type="text" class="form-control" name="purchaseReturn_Gst_Id" id="purchaseReturn_Gst_Id" placeholder="Enter Purchase GST" autocomplete="off" required pattern="[a-zA-Z ]+"> 
               </div> -->
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
                  <th>Nos</th>
                  <th>Cut</th>
                  <th>Quantity</th>
                  <th>PM</th>
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
      <div class="col-md-6 form-group">
            <label >Desc </label>
            <input type="text" class="form-control " name="purchaseReturn_Desc_Id" id="purchaseReturn_Desc_Id" placeholder="Enter Purchase Desc" autocomplete="off" required pattern="[0-9]+">
      </div>

      <div class="col-md-3 form-group ">
                 <label>Basic Amt </label>
                     <input type="text" class="form-control" name="purchaseReturn_Basic_Amt_Id" id="purchaseReturn_Basic_Amt_Id" placeholder="Enter Purchase Basic Amt" autocomplete="off" required pattern="[0-9]+"> 
                </div>
      <div class="col-md-3 form-group ">
              <label >SGST </label>
                  <input type="text" class="form-control" name="purchase_Sgst_Id" id="purchase_Sgst_Id" placeholder="Enter Purchase SGST" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('purchase_Sgst_Id') ?>
                 </div>
                          
        </div>

        <div class="row ">
           <div class="col-md-6 form-group">
          <label >Reason(GSTR-1) </label>
            <select id="purchaseReturn_reason_id" name="purchaseReturn_reason_id" class="form-control selectpicker" data-live-search="true" required>
              <option value="Sales Return">01-Sales Return</option>
            </select>
          </div>

          <div class="col-md-4 form-group ">
          <label >CGST </label>
              <input type="text" class="form-control" name="return_Cgst_Id" id="return_Cgst_Id" placeholder="Enter Purchase CGST" autocomplete="off" required pattern="[0-9]+"> 
          </div>

        </div>


    <div class="row ">
      <div class="col-md-4 form-group">
        <label >Eway Bill No. </label>
        <input type="text" class="form-control " name="purchaseReturn_Eway_Bill_Id" id="purchaseReturn_Eway_Bill_Id" placeholder="Enter Purchase Eway Bill No." autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('purchaseReturn_Eway_Bill_Id') ?>
      </div>    
        
      <div class="col-md-4 form-group">
        <label >Is RCM Bill </label>
          <select id="purchaseReturn_rcm_bil" name="purchaseReturn_rcm_bil" class="form-control selectpicker" data-live-search="true" required>
            <option value="no">No</option>
          </select>
      </div>

    <div class="col-md-4 form-group">
      <label >(F9) Other(+/-) </label>
      <input type="text" class="form-control " name="purchaseReturn_F9_Other_Id" id="purchaseReturn_F9_Other_Id" placeholder="Enter Purchase (F9) Other(+/-) " autocomplete="off" required pattern="[0-9]+">
    </div>

  </div>

    <div class="row ">
         <div class="col-md-2 form-group">
            <label >Purchase Bill No. </label>
              <input type="text" class="form-control " name="purchaseReturn_Purchase_Bill_Id" id="purchaseReturn_Purchase_Bill_Id" placeholder="Enter Purchase Bill No." autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('purchaseReturn_Eway_Bill_Id') ?>
           </div>

           <div class="col-md-2 form-group">
            <label >Pur. Bill Date </label>
              <input type="date" class="form-control " name="purchaseReturn_pur_Bill_date" id="purchaseReturn_pur_Bill_date" placeholder="Enter Purchase Bill Date" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('purchaseReturn_Eway_Bill_Id') ?>
           </div>

        <div class="col-md-3 form-group">
              <label >Rnd Off. </label>
                   <input type="text" class="form-control " name="purchaseReturn_Rnd_Off_Code_Id" id="purchaseReturn_Rnd_Off_Code_Id" placeholder="Enter Purchase Rnd Off." autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('purchaseReturn_Rnd_Off_Code_Id') ?>
         </div>
     <div class="col-md-2 form-group">
          <label > </label>
<!--               <input type="text" class="form-control " name="purchaseReturn_Rnd_Off_Value_Id" id="purchaseReturn_Rnd_Off_Value_Id" placeholder="Enter Purchase Rnd Off" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('purchaseReturn_Rnd_Off_Value_Id') ?>
 -->           </div>
     <div class="col-md-3 form-group">
             <label >Bill Amount </label>
                <input type="text" class="form-control " name="purchaseReturn_Bill_Amount_Id" id="purchaseReturn_Bill_Amount_Id" placeholder="Enter Purchase Bill Amount" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('purchaseReturn_Bill_Amount_Id') ?>
            </div>
        </div>
    </form>                  
    <button name="purchaseReturnMaster" id="purchaseReturnMaster" class="btn btn-primary"><?php if($uid==""){echo "Add Purchase Master";}else{echo "update Purchase Master";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>

 <script type='text/javascript'>

   var purchaseReturnDataBroker = $("#purchaseReturn_Broker_Id").tautocomplete({
        width: "500px",
        columns: ['Broker Name', 'City Name', 'Phone Name'],
        placeholder: "Search Broker",
        id: "purchaseReturnbroker_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getBroker/",
            type: "POST",
            data: function()
             {
                var x = {BrokerName: $('#purchaseReturnbroker_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + purchaseReturnDataBroker.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = purchaseReturnDataBroker.searchdata();
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

 var purchaseReturnDataParty = $("#purchaseReturn_Party_Value_Id").tautocomplete({
        
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
                var searchData = eval("/" + purchaseReturnDataParty.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = purchaseReturnDataParty.searchdata();
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

   var purchaseDataBroker = $("#add_Purchase_Broker_Id").tautocomplete({
        width: "500px",
        columns: ['Broker Name', 'City Name', 'Phone Name'],
        placeholder: "Search Broker",
        id: "purchasebroker_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getBroker/",
            type: "POST",
            data: function()
             {
                var x = {BrokerName: $('#purchasebroker_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + purchaseDataBroker.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = purchaseDataBroker.searchdata();
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

   var purchaseReturnDataTransport = $("#purchaseReturn_Transport_Id").tautocomplete({
        width: "500px",
        columns: ['Transport Name', 'City Name', 'Phone Number'],
        placeholder: "Search Transport",
        id: "purchaseReturnTransport_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getTransport/",
            type: "POST",
            data: function()
             {
                var x = {TransportName: $('#purchaseReturnTransport_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + purchaseReturnDataTransport.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = purchaseReturnDataTransport.searchdata();
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

var purchaseReturnDataDescription = $("#purchaseReturn_Description_Id").tautocomplete({
        width: "500px",
        columns: ['Iteam Name', 'MRP', 'cut'],
        placeholder: "Search Iteam",
        id: "purchaseReturnDescription_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/get_Iteam/",
            type: "POST",
            data: function()
             {
                var x = {IteamName: $('#purchaseReturnDescription_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + purchaseReturnDataDescription.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = purchaseReturnDataDescription.searchdata();
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

    addValidationPurchase();
    
    if ($("#purchaseReturnform").validate().element('#purchaseReturn_Description_Id') == false || $("#purchaseReturnform").validate().element('#purchaseReturn_Nos_Id') == false || $("#purchaseReturnform").validate().element('#purchaseReturn_Cut_Id') == false|| $("#purchaseReturnform").validate().element('#purchaseReturn_Quantity_Id') == false|| $("#purchaseReturnform").validate().element('#purchaseReturn_PM_Id') == false|| $("#purchaseReturnform").validate().element('#purchaseReturn_Rate_Id') == false|| $("#purchaseReturnform").validate().element('#purchaseReturn_Disc_Id') == false|| $("#purchaseReturnform").validate().element('#purchaseReturn_Amount_Id') == false|| $("#purchaseReturnform").validate().element('#purchaseReturn_Sgst_Id') == false|| $("#purchaseReturnform").validate().element('#purchaseReturn_Cgst_Id') == false|| $("#purchaseReturnform").validate().element('#purchaseReturn_Net_Amt_Id') == false|| $("#purchaseReturnform").validate().element('#purchaseReturn_Net_Rate_Id') == false|| $("#purchaseReturnform").validate().element('#purchaseReturn_Freight_Id') == false|| $("#purchaseReturnform").validate().element('#purchaseReturn_Gst_Id') == false)
    {

    }else
    {

      var nextid = $("#serialNumber").val();

      tbl_inventoryIssue.row.add( [
       '<input type="text" id="'+nextid+'" name="sno[]" value="'+$("#serialNumber").val()+'">',
       '<input type="text" id="'+nextid+'" name="purchaseReturn_Description_Id[]" value="'+$("#purchaseReturn_Description_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="purchaseReturn_Nos_Id[]" value="'+$("#purchaseReturn_Nos_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="purchaseReturn_Cut_Id[]" value="'+$("#purchaseReturn_Cut_Id").val()+'">',
        '<input type="text" id="'+nextid+'" name="purchaseReturn_Quantity_Id[]" value="'+$("#purchaseReturn_Quantity_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="purchaseReturn_PM_Id[]" value="'+$("#purchaseReturn_PM_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="purchaseReturn_Rate_Id[]" value="'+$("#purchaseReturn_Rate_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="purchaseReturn_Disc_Id[]" value="'+$("#purchaseReturn_Disc_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="purchaseReturn_Amount_Id[]" value="'+$("#purchaseReturn_Amount_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="purchaseReturn_Sgst_Id[]" value="'+$("#purchaseReturn_Sgst_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="purchaseReturn_Cgst_Id[]" value="'+$("#purchaseReturn_Cgst_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="purchaseReturn_Net_Amt_Id[]" value="'+$("#purchaseReturn_Net_Amt_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="purchaseReturn_Net_Rate_Id[]" value="'+$("#purchaseReturn_Net_Rate_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="purchaseReturn_Freight_Id[]" value="'+$("#purchaseReturn_Freight_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="purchaseReturn_Gst_Id[]" value="'+$("#purchaseReturn_Gst_Id").val()+'">',
        ] ).node().id = nextid;
      
    tbl_inventoryIssue.draw( false );

      $('#purchaseReturn_Description_Id').val("");
      $('#purchaseReturn_Nos_Id').val("");
      $('#purchaseReturn_Cut_Id').val("");
      $('#purchaseReturn_Quantity_Id').val("");
      $('#purchaseReturn_PM_Id').val("");
      $('#purchaseReturn_Rate_Id').val("");
      $('#purchaseReturn_Disc_Id').val("");
      $('#purchaseReturn_Amount_Id').val("");
      $('#purchaseReturn_Sgst_Id').val("");
      $('#purchaseReturn_Cgst_Id').val("");
      $('#purchaseReturn_Net_Amt_Id').val("");
      $('#purchaseReturn_Net_Rate_Id').val("");
      $('#purchaseReturn_Freight_Id').val("");
      $('#purchaseReturn_Gst_Id').val("");
    }
        
 
    });
});

$(document).ready(function(){

  var x = $('#purchaseReturn_Book_Id').val();
  bookList(x);

     $('#purchaseReturnMaster').on('click', function () {
        
        removeValidationPurchase();
        
        if ($('#purchaseReturnform').valid())
        {          
          addPurchaseMasterToServer();

        }
    });
    });

$('#purchaseReturn_Book_Id').selectpicker('refresh');

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
              $('#purchaseReturn_Book_Id').append('<option value="'+data['book_id_PK']+'" selected>'+data['book_number']+'</option>');
          }else{
              $('#purchaseReturn_Book_Id').append('<option value="'+data['book_id_PK']+'">'+data['book_number']+'</option>');
          }
        });
                 
       $('#purchaseReturn_Book_Id').selectpicker('refresh');

      }
  });
}

function addPurchaseMasterToServer(){
  var purchaseReturnToServerdata = new FormData(document.getElementById("purchaseReturnform"));
  purchaseReturnToServerdata.append('purchaseReturn_Broker_Id', purchaseReturnDataBroker.id());
  purchaseReturnToServerdata.append('purchaseReturn_Party_Value_Id', purchaseReturnDataParty.id());
  purchaseReturnToServerdata.append('purchaseReturn_Transport_Id', purchaseReturnDataTransport.id());
  purchaseReturnToServerdata.append('purchaseReturn_Description_Id', purchaseReturnDataDescription.id());

      // AJAX request
    $.ajax({
      url:'<?=base_url()?>PurchaseReturnController/insertPurchaseReturn',
      method: 'post',
      data: purchaseReturnToServerdata,
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
                              text: "Purchase Return is successfully added",
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
function purchaseReturnBookReferesh(){
  bookList();
}

function addValidationPurchase(){
  $("#purchaseReturn_Description_Id").prop('required',true);
  $("#purchaseReturn_Nos_Id").prop('required',true);
  $("#purchaseReturn_Cut_Id").prop('required',true);
  $("#purchaseReturn_Quantity_Id").prop('required',true);
  $("#purchaseReturn_PM_Id").prop('required',true);
  $("#purchaseReturn_Rate_Id").prop('required',true);
  $("#purchaseReturn_Disc_Id").prop('required',true);
  $("#purchaseReturn_Amount_Id").prop('required',true);
  $("#purchaseReturn_Sgst_Id").prop('required',true);
  $("#purchaseReturn_Cgst_Id").prop('required',true);
  $("#purchaseReturn_Net_Amt_Id").prop('required',true);
  $("#purchaseReturn_Net_Rate_Id").prop('required',true);
  $("#purchaseReturn_Freight_Id").prop('required',true);
  $("#purchaseReturn_Gst_Id").prop('required',true);
}

function removeValidationPurchase(){
    $('#purchaseReturn_Description_Id').removeAttr('required');
    $('#purchaseReturn_Nos_Id').removeAttr('required');
    $('#purchaseReturn_Cut_Id').removeAttr('required');
    $('#purchaseReturn_Quantity_Id').removeAttr('required');
    $('#purchaseReturn_PM_Id').removeAttr('required');
    $('#purchaseReturn_Rate_Id').removeAttr('required');
    $('#purchaseReturn_Disc_Id').removeAttr('required');
    $('#purchaseReturn_Amount_Id').removeAttr('required');
    $('#purchaseReturn_Sgst_Id').removeAttr('required');
    $('#purchaseReturn_Cgst_Id').removeAttr('required');
    $('#purchaseReturn_Net_Amt_Id').removeAttr('required');
    $('#purchaseReturn_Net_Rate_Id').removeAttr('required');
    $('#purchaseReturn_Freight_Id').removeAttr('required');
    $('#purchaseReturn_Gst_Id').removeAttr('required');
}

</script>



