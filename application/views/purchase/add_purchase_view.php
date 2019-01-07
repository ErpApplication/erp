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
                 
            <a href="<?= base_url(); ?>PurchaseController" class="btn btn-primary">Back</a>

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
          <form id="purchaseform" method="post">
        <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">

      <div class="row">
          <div class="col-md-6 form-group">
          <div class="row">
         <div class="col-md-7 form-group">
          <label >Book  </label>
            <select id="add_Purchase_Book_Id" name="add_Purchase_Book_Id" class="form-control selectpicker" data-live-search="true" required>
              <option value="">--Select--</option>
            </select> 
            </div> 

            <div class="col-md-2 form-group">
                <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BooksController/insertBook">Add</a>
            </div>
            <div class="col-md-3 form-group">
                <a class="now-ui-icons arrows-1_refresh-69" onclick="purchaseBookReferesh();">Referesh</a>
            </div>

            </div>
            </div>                        
                        
 <div class="col-md-2 form-group">
       <label> Bal.: </span> </label>
            <input type="text" class="form-control " name="add_Purchase_Bal_Id" id="add_Purchase_Bal_Id" placeholder="Enter Purchase Bal" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Purchase_Bal_Id') ?>
          </div>
     <div class="col-md-4 form-group">
             <label>RCM Bill No:</label>
<!--                  <input type="text" class="form-control" name="add_Purchase_Rcm_Bill_Id" id="add_Purchase_Rcm_Bill_Id" placeholder="check from client for this field" autocomplete="off" required pattern="[0-9 ]+" readonly> <?php echo form_error('add_Purchase_Rcm_Bill_Id') ?>
 -->        </div>
    </div>
  <div class="row">
         <div class="col-md-3 form-group">
               <label>Pur. Bill No</label>
                  <input type="text" class="form-control " name="add_Purchase_Pur_Bill_No_Id" id="add_Purchase_Pur_Bill_No_Id" placeholder="Enter Purchase  Bill No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Pur_Bill_No_Id') ?>
         </div>
     <div class="col-md-2 form-group">
          <label>Party </label>
            <input type="text" class="form-control" name="add_Purchase_Party_Code_Id" id="add_Purchase_Party_Code_Id" placeholder="Enter Purchase Party " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Party_Code_Id') ?>
         </div>
     <div class="col-md-4 form-group">
       <div class="row">
       <div class="col-md-10 form-group">
        <label> </label>
        <input type="text" class="form-control " name="add_Purchase_Party_Value_Id" id="add_Purchase_Party_Value_Id" placeholder="Enter Purchase Party" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Party_Value_Id') ?>
      </div>
        <div class="col-md-2 form-group">
        <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>AccountMasterController/insertAccountMaster">Add</a>
        </div>
        </div>
        </div>

      <div class="col-md-3 form-group">
            <label>Inv.Type(T/R) </label>
            <select name="add_Purchase_Inv_Type_Id" id="add_Purchase_Inv_Type_Id" class="form-control selectpicker" data-live-search="true" required>
             <option value="t">T</option>
             <option value="r">R</option>
            </select>
<!--                  <input type="text" class="form-control " name="add_Purchase_Inv_Type_Id" id="add_Purchase_Inv_Type_Id" placeholder=" Enter Purchase Inv Type" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Inv_Type_Id') ?>
 -->              </div>
          </div>           
      <div class="row">
            <div class="col-md-3 form-group">
                <label>Bill Date <span >  </span> </label>
                      <input type="Date" class="form-control " name="add_Purchase_Bill_Date_Id" id="add_Purchase_Bill_Date_Id" placeholder="Enter Purchase Bill Date" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('add_Purchase_Bill_Date_Id') ?>
           </div>
           <div class="col-md-6 form-group">
            <div class="row">
            <div class="col-md-10 form-group">
            <label>Broker <span >  </span> </label>
              <input type="text" class="form-control " name="add_Purchase_Broker_Id" id="add_Purchase_Broker_Id" placeholder="Enter Purchase Broker" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Purchase_Broker_Id') ?>
            </div>
            <div class="col-md-2 form-group">
          <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BrokerController/insertBroker">Add</a>
          </div>
          </div>
          </div>


    <div class="col-md-2 form-group">
          <label>Cr Days<span >  </span> </label>
              <input type="text" class="form-control" name="add_Purchase_Cr_Days_Id" id="add_Purchase_Cr_Days_Id" placeholder="Enter Purchase Cr Days" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Purchase_Cr_Days_Id') ?>
              </div>
          </div>           
      <div class="row">
   <div class="col-md-3 form-group">
        <label>L.R.No  </span></label>
             <input type="text" class="form-control" name="add_Purchase_L_R_No_Id" id="add_Purchase_L_R_No_Id" placeholder="Enter Purchase L R No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_L_R_No_Id') ?>
                                       
       </div>
  <div class="col-md-3 form-group">
       <label>L.R.Dt. </label>
          <input type="Date" class="form-control " name="add_Purchase_L_R_Dt_Id" id="add_Purchase_L_R_Dt_Id" placeholder="Enter Purchase L R Dt" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_L_R_Dt_Id') ?>
                                       
            </div>
     <div class="col-md-2 form-group">
           <label> Case No. </label>
             <input type="text" class="form-control " name="add_Purchase_Case_No_Id" id="add_Purchase_Case_No_Id" placeholder="Enter Purchase Case No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Case_No_Id') ?>
            </div>
  <div class="col-md-4 form-group">
         <label>Transport </label>
             <input type="text" class="form-control " name="add_Purchase_Transport_Id" id="add_Purchase_Transport_Id" placeholder="Enter Purchase Transport" autocomplete="off" required pattern="[0-9 ]+">                        
        </div>
 </div>
 <div style="border-style: inset; padding: 15px">
  <div class="row" >
    <div class="col-md-1 form-group">
       <label >S.No. </label>

           <input type="text" class="form-control " name="serialNumber" id="serialNumber" placeholder="Enter Purchase Purchase Sr No" autocomplete="off" required readonly=""> <?php echo form_error('serialNumber') ?>
      </div>
  <div class="col-md-3 form-group" >
       <label>Description </label>
            <input type="text" class="form-control " name="add_Purchase_Description_Id" id="add_Purchase_Description_Id" placeholder="Enter Purchase Description" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Description_Id') ?>
        </div>
    <div class="col-md-1 form-group" >
        <label>Nos </label>
            <input type="text" class="form-control " name="add_Purchase_Nos_Id" id="add_Purchase_Nos_Id" placeholder="Enter Purchase Nos" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Nos_Id') ?>
        </div>
    <div class="col-md-2 form-group" >
       <label>Cut </label>
            <input type="text" class="form-control " name="add_Purchase_Cut_Id" id="add_Purchase_Cut_Id" placeholder="Enter Purchase Cut" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Cut_Id') ?>
       </div>
    <div class="col-md-2 form-group">
           <label>Quantity </label>
              <input type="text" class="form-control " name="add_Purchase_Quantity_Id" id="add_Purchase_Quantity_Id" placeholder="Enter Purchase Quantity" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Quantity_Id') ?>
       </div>
    <div class="col-md-1 form-group">
          <label>PM </label>
              <input type="text" class="form-control " name="add_Purchase_PM_Id" id="add_Purchase_PM_Id" placeholder="Enter Purchase PM" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_PM_Id') ?>
          </div>
     <div class="col-md-1 form-group">
          <label>Rate </label>
              <input type="text" class="form-control " name="add_Purchase_Rate_Id" id="add_Purchase_Rate_Id" placeholder="Enter Purchase Rate" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Rate_Id') ?>
         </div>
     <div class="col-md-1 form-group">
        <label >Disc % </label>
                <input type="text" class="form-control " name="add_Purchase_Disc_Id" id="add_Purchase_Disc_Id" placeholder="Enter Purchase Disc" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Disc_Id') ?>
          </div>
      </div>
  <div class="row">
      <div class="col-md-2 form-group">
            <label >Amount </label>
              <input type="text" class="form-control " name="add_Purchase_Amount_Id" id="add_Purchase_Amount_Id" placeholder="Enter Purchase Amount" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Amount_Id') ?>
          </div>
      <div class="col-md-1 form-group">
             <label >SGST </label>
                <input type="text" class="form-control " name="add_Purchase_Sgst_Id" id="add_Purchase_Sgst_Id" placeholder="Enter Purchase SGST" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Sgst_Id') ?>
          </div>
    <div class="col-md-1 form-group">
           <label>CGST </label>
              <input type="text" class="form-control " name="add_Purchase_Cgst_Id" id="add_Purchase_Cgst_Id" placeholder="Enter Purchase CGST" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Cgst_Id') ?>
           </div>
      <div class="col-md-2 form-group">
            <label >Net Amt </label>
               <input readonly type="text" class="form-control" name="add_Purchase_Net_Amt_Id" id="add_Purchase_Net_Amt_Id" placeholder="Enter Purchase Net Amt " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Net_Amt_Id') ?>
             </div>
        <div class="col-md-1 form-group">
              <label >Net Rate </label>
                   <input type="text" class="form-control " name="add_Purchase_Net_Rate_Id" id="add_Purchase_Net_Rate_Id" placeholder="Enter Purchase Net Rate" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Net_Rate_Id') ?>
          </div>
      <div class="col-md-2 form-group">
           <label>Freight </label>
                <input type="text" class="form-control " name="add_Purchase_Freight_Id" id="add_Purchase_Freight_Id" placeholder="check form client for this field" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Freight_Id') ?>
             </div>
       <div class="col-md-1 form-group">
             <label>GST</label>
                <input type="text" class="form-control" name="add_Purchase_Gst_Id" id="add_Purchase_Gst_Id" placeholder="check form client for this field " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Purchase_Gst_Id') ?>
            </div>
     <!--  <div class="col-md-1 form-group">
            <label> </label>
                  <input type="text" class="form-control" name="add_Purchase_Gst_Id" id="add_Purchase_Gst_Id" placeholder="Enter Purchase GST" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Purchase_Gst_Id') ?>
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
      <div class="col-md-3 form-group ">
                 <label>Basic Amt </label>
                     <input type="text" class="form-control" name="add_Purchase_Basic_Amt_Id" id="add_Purchase_Basic_Amt_Id" placeholder="Enter Purchase Basic Amt" autocomplete="off" required pattern="[0-9]+" readonly> <?php echo form_error('add_Purchase_Basic_Amt_Id') ?>
                </div>
      <div class="col-md-3 form-group ">
              <label >SGST </label>
                  <input type="text" class="form-control" name="purchase_Sgst_Id" id="purchase_Sgst_Id" placeholder="Enter Purchase SGST" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('purchase_Sgst_Id') ?>
                 </div>
             
          
     <div class="col-md-3 form-group">
          <label >CGST </label>
              <input type="text" class="form-control" name="purchase_Cgst_Id" id="purchase_Cgst_Id" placeholder="Enter Purchase CGST" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('purchase_Cgst_Id') ?>
              </div>
                          
        </div>
   <div class="row ">
      <div class="col-md-6 form-group">
            <label >Desc </label>
                <input type="text" class="form-control " name="add_Purchase_Desc_Id" id="add_Purchase_Desc_Id" placeholder="Enter Purchase Desc" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Desc_Id') ?>
           </div>
                          
        <div class="col-md-1 form-group">
               <label >T.D.S. Rate </label>
<!--                    <input type="text" class="form-control " name="add_Purchase_T_D_S_Rate_Code_Id" id="add_Purchase_T_D_S_Rate_Code_Id" placeholder="chek from client for this field " autocomplete="off" required readOnly pattern="[0-9]+"> <?php echo form_error('add_Purchase_T_D_S_Rate_Code_Id') ?>
 -->            </div>
              <div class="col-md-2 form-group">
                  <label > </label>
<!--                      <input type="text" class="form-control " name="add_Purchase_T_D_S_Rate_Value_Id" id="add_Purchase_T_D_S_Rate_Value_Id" placeholder="chek from client for this field " autocomplete="off" required readOnly pattern="[0-9]+"> <?php echo form_error('add_Purchase_T_D_S_Rate_Value_Id') ?>
 -->               </div>
            <div class="col-md-3 form-group">
        <label >(F9) Other(+/-) </label>
              <input type="text" class="form-control " name="add_Purchase_F9_Other_Id" id="add_Purchase_F9_Other_Id" placeholder="Enter Purchase (F9) Other(+/-) " autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_F9_Other_Id') ?>
              </div>
          </div>
    <div class="row ">
         <div class="col-md-4 form-group">
            <label >Eway Bill No. </label>
              <input type="text" class="form-control " name="add_Purchase_Eway_Bill_Id" id="add_Purchase_Eway_Bill_Id" placeholder="Enter Purchase Eway Bill No." autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Eway_Bill_Id') ?>
           </div>
        <div class="col-md-3 form-group">
              <label >Rnd Off. </label>
                   <input type="text" class="form-control " name="add_Purchase_Rnd_Off_Code_Id" id="add_Purchase_Rnd_Off_Code_Id" placeholder="Enter Purchase Rnd Off." autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Rnd_Off_Code_Id') ?>
         </div>
     <div class="col-md-2 form-group">
          <label > </label>
<!--               <input type="text" class="form-control " name="add_Purchase_Rnd_Off_Value_Id" id="add_Purchase_Rnd_Off_Value_Id" placeholder="Enter Purchase Rnd Off" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Rnd_Off_Value_Id') ?>
 -->           </div>
     <div class="col-md-3 form-group">
             <label >Bill Amount </label>
                <input type="text" class="form-control " name="add_Purchase_Bill_Amount_Id" id="add_Purchase_Bill_Amount_Id" placeholder="Enter Purchase Bill Amount" autocomplete="off" required pattern="[0-9]+" readonly> <?php echo form_error('add_Purchase_Bill_Amount_Id') ?>
            </div>
        </div>
    </form>                  
    <button name="add_purchaseMaster" id="add_purchaseMaster" class="btn btn-primary"><?php if($uid==""){echo "Add Purchase Master";}else{echo "update Purchase Master";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>

<?php  $this->load->view('assests/footer'); ?>
 <script type='text/javascript'>

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

   var purchaseDataTransport = $("#add_Purchase_Transport_Id").tautocomplete({
        width: "500px",
        columns: ['Transport Name', 'City Name', 'Phone Number'],
        placeholder: "Search Transport",
        id: "purchaseTransport_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getTransport/",
            type: "POST",
            data: function()
             {
                var x = {TransportName: $('#purchaseTransport_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + purchaseDataTransport.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = purchaseDataTransport.searchdata();
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

var purchaseDataDescription = $("#add_Purchase_Description_Id").tautocomplete({
        width: "500px",
        columns: ['Iteam Name', 'MRP', 'cut'],
        placeholder: "Search Iteam",
        id: "purchaseDescription_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/get_Iteam/",
            type: "POST",
            data: function()
             {
                var x = {IteamName: $('#purchaseDescription_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + purchaseDataDescription.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = purchaseDataDescription.searchdata();
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

 var issueMillDataMillParty = $("#add_Purchase_Party_Value_Id").tautocomplete({
        
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

    addValidationPurchaseReturn();
    
    if ($("#purchaseform").validate().element('#add_Purchase_Description_Id') == false || $("#purchaseform").validate().element('#add_Purchase_Nos_Id') == false || $("#purchaseform").validate().element('#add_Purchase_Cut_Id') == false|| $("#purchaseform").validate().element('#add_Purchase_Quantity_Id') == false|| $("#purchaseform").validate().element('#add_Purchase_PM_Id') == false|| $("#purchaseform").validate().element('#add_Purchase_Rate_Id') == false|| $("#purchaseform").validate().element('#add_Purchase_Disc_Id') == false|| $("#purchaseform").validate().element('#add_Purchase_Amount_Id') == false|| $("#purchaseform").validate().element('#add_Purchase_Sgst_Id') == false|| $("#purchaseform").validate().element('#add_Purchase_Cgst_Id') == false|| $("#purchaseform").validate().element('#add_Purchase_Net_Amt_Id') == false|| $("#purchaseform").validate().element('#add_Purchase_Net_Rate_Id') == false|| $("#purchaseform").validate().element('#add_Purchase_Freight_Id') == false|| $("#purchaseform").validate().element('#add_Purchase_Gst_Id') == false)
    {

    }else
    {

      var nextid = $("#serialNumber").val();

      tbl_inventoryIssue.row.add( [
       '<input type="text" id="'+nextid+'" name="sno[]" value="'+$("#serialNumber").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Purchase_Description_Id[]" value="'+$("#add_Purchase_Description_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Purchase_Nos_Id[]" value="'+$("#add_Purchase_Nos_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Purchase_Cut_Id[]" value="'+$("#add_Purchase_Cut_Id").val()+'">',
        '<input type="text" id="'+nextid+'" name="add_Purchase_Quantity_Id[]" value="'+$("#add_Purchase_Quantity_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Purchase_PM_Id[]" value="'+$("#add_Purchase_PM_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Purchase_Rate_Id[]" value="'+$("#add_Purchase_Rate_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Purchase_Disc_Id[]" value="'+$("#add_Purchase_Disc_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Purchase_Amount_Id[]" value="'+$("#add_Purchase_Amount_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Purchase_Sgst_Id[]" value="'+$("#add_Purchase_Sgst_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Purchase_Cgst_Id[]" value="'+$("#add_Purchase_Cgst_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Purchase_Net_Amt_Id[]" class="add_Purchase_Net_Amt_Id" value="'+$("#add_Purchase_Net_Amt_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Purchase_Net_Rate_Id[]" value="'+$("#add_Purchase_Net_Rate_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Purchase_Freight_Id[]" value="'+$("#add_Purchase_Freight_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Purchase_Gst_Id[]" value="'+$("#add_Purchase_Gst_Id").val()+'">',
        ] ).node().id = nextid;
      
    tbl_inventoryIssue.draw( false );

      $('#add_Purchase_Description_Id').val("");
      $('#add_Purchase_Nos_Id').val("");
      $('#add_Purchase_Cut_Id').val("");
      $('#add_Purchase_Quantity_Id').val("");
      $('#add_Purchase_PM_Id').val("");
      $('#add_Purchase_Rate_Id').val("");
      $('#add_Purchase_Disc_Id').val("");
      $('#add_Purchase_Amount_Id').val("");
      $('#add_Purchase_Sgst_Id').val("");
      $('#add_Purchase_Cgst_Id').val("");
      $('#add_Purchase_Net_Amt_Id').val("");
      $('#add_Purchase_Net_Rate_Id').val("");
      $('#add_Purchase_Freight_Id').val("");
      $('#add_Purchase_Gst_Id').val("");
    }
       purchaseNetAmountAddation(); 
 
    });
});

$(document).ready(function(){

  var x = $('#add_Purchase_Book_Id').val();
  bookList(x);
  //transportList();

     $('#add_purchaseMaster').on('click', function () {
        
         removeValidationPurchaseReturn();

        if ($('#purchaseform').valid())
        {          
          addPurchaseMasterToServer();

        }
    });
    });

$('#add_Purchase_Book_Id').selectpicker('refresh');

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
              $('#add_Purchase_Book_Id').append('<option value="'+data['book_id_PK']+'" selected>'+data['purchase_account_name']+'</option>');
          }else{
              $('#add_Purchase_Book_Id').append('<option value="'+data['book_id_PK']+'">'+data['purchase_account_name']+'</option>');
          }
        });
                 
       $('#add_Purchase_Book_Id').selectpicker('refresh');

      }
  });
}

$('#add_Purchase_Book_Id').selectpicker('refresh');

function addPurchaseMasterToServer(){
  var purchaseToServerdata = new FormData(document.getElementById("purchaseform"));
  purchaseToServerdata.append('add_Purchase_Broker_Id', purchaseDataBroker.id());
  purchaseToServerdata.append('add_Purchase_Party_Value_Id', issueMillDataMillParty.id());
  purchaseToServerdata.append('add_Purchase_Transport_Id', purchaseDataTransport.id());
  purchaseToServerdata.append('add_Purchase_Description_Id', purchaseDataDescription.id());

      // AJAX request
    $.ajax({
      url:'<?=base_url()?>PurchaseController/insertPurchase',
      method: 'post',
      data: purchaseToServerdata,
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
                              text: "Purchase Master is successfully added",
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
function purchaseBookReferesh(){
  bookList();
}

function purchaseNetAmountAddation(){
  var totalNetAmount = 0;
  $('.add_Purchase_Net_Amt_Id').each(function(){
           var tempVal = this.value;
           if(tempVal == 0){
             //invalid = true;
           }else
           {
            totalNetAmount = parseFloat(totalNetAmount) + parseFloat(tempVal);
           }
  });

   $('#add_Purchase_Basic_Amt_Id').val(totalNetAmount);
             //console.log("totalNetAmount : " + totalNetAmount);
}

function purchaseCommonCalculation(){
  var quantity=$('#add_Purchase_Quantity_Id').val();
  var rate=$("#add_Purchase_Rate_Id").val();
  var discount=$("#add_Purchase_Disc_Id").val();
  var sgst=$("#add_Purchase_Sgst_Id").val();
  var cgst=$("#add_Purchase_Cgst_Id").val();
  var netRate=$("#add_Purchase_Net_Rate_Id").val();
  var gst=$("#add_Purchase_Gst_Id").val();
  
  var purchase_sgst=$("#purchase_Sgst_Id").val();
  var purchase_cgst=$("#purchase_Cgst_Id").val();
  
  var basicAmount=$("#add_Purchase_Basic_Amt_Id").val();
  var netAmount=$("#add_Purchase_Net_Amt_Id").val();

//console.log("netAmount"+netAmount);
  console.log("cgst : " + cgst);
  console.log("quantity"+quantity);
  console.log("rate"+discount);

// Set Amount
var amount=parseFloat(quantity) * parseFloat(rate);
// Get Amount
var totalamount = $("#add_Purchase_Amount_Id").val();
if(rate==""){
}else{
    var result=parseFloat(quantity)*parseFloat(rate);
    $("#add_Purchase_Amount_Id").val(result);
}
if(discount==""){
}else{
    var disResult=parseFloat(discount)*parseFloat(amount)/100;
    var resultSet=parseFloat(amount)-parseFloat(disResult);
    $("#add_Purchase_Amount_Id").val(resultSet);
}
if(sgst==""){
}else{
  if(amount==""){
  }else{
    var sgstResult=parseFloat(sgst)*parseFloat(totalamount)/100;
    var resultSet=parseFloat(totalamount)+parseFloat(sgstResult);
    $("#add_Purchase_Net_Amt_Id").val(resultSet);
  } 
} 
if(cgst==""){
}else{
    var cgstResult=parseFloat(cgst)*parseFloat(totalamount)/100;
    var resultSet=parseFloat(totalamount)+parseFloat(cgstResult);
    
    $("#add_Purchase_Net_Amt_Id").val(resultSet);
  
}

  if(amount==""){
   }else{
    var cgstResult=parseFloat(cgst == "" ? "0" : cgst)*parseFloat(totalamount)/100;
    var sgstResult=parseFloat(sgst == "" ? "0" : sgst)*parseFloat(totalamount)/100;
    var resultSetAmount=parseFloat(totalamount)+parseFloat(sgstResult)+parseFloat(cgstResult);
    $("#add_Purchase_Net_Amt_Id").val(resultSetAmount);
  }


  var purchaseCgstResult=parseFloat(purchase_cgst == "" ? "0" : purchase_cgst)*parseFloat(basicAmount)/100;
  var purchaseSgstResult=parseFloat(purchase_sgst == "" ? "0" : purchase_sgst)*parseFloat(basicAmount)/100;
  var resultSetAmount=parseFloat(basicAmount)+parseFloat(purchaseSgstResult)+parseFloat(purchaseCgstResult);
  $("#add_Purchase_Bill_Amount_Id").val(resultSetAmount);
 



// if(gst==""){
//   return false;
// }else{
//   if(amount==""){
//     return false;
//   }else{
//     var gstResult=parseFloat(gst)*parseFloat(amount)/100;
//     var resultSet=parseFloat(amount)+parseFloat(gstResult);
//     $("#add_Purchase_Net_Amt_Id").val(resultSet);
//     $("#add_Purchase_Amount_Id").val(resultSet);
//   }
// }

} 

$("#add_Purchase_Quantity_Id").keyup(function(){
   purchaseCommonCalculation();
});

$("#add_Purchase_Rate_Id").keyup(function(){
   purchaseCommonCalculation();
});

$("#add_Purchase_Disc_Id").keyup(function(){
   purchaseCommonCalculation();
});

$("#add_Purchase_Sgst_Id").keyup(function(){
   purchaseCommonCalculation();
});

$("#add_Purchase_Cgst_Id").keyup(function(){
   purchaseCommonCalculation();
});

$("#add_Purchase_Net_Amt_Id").keyup(function(){
   purchaseCommonCalculation();
});

$("#add_Purchase_Gst_Id").keyup(function(){
   purchaseCommonCalculation();
});

$("#purchase_Sgst_Id").keyup(function(){
   purchaseCommonCalculation();
});

$("#purchase_Cgst_Id").keyup(function(){
   purchaseCommonCalculation();
});

function addValidationPurchaseReturn(){
  $("#add_Purchase_Description_Id").prop('required',true);
  $("#add_Purchase_Nos_Id").prop('required',true);
  $("#add_Purchase_Cut_Id").prop('required',true);
  $("#add_Purchase_Quantity_Id").prop('required',true);
  $("#add_Purchase_PM_Id").prop('required',true);
  $("#add_Purchase_Rate_Id").prop('required',true);
  $("#add_Purchase_Disc_Id").prop('required',true);
  $("#add_Purchase_Amount_Id").prop('required',true);
  $("#add_Purchase_Sgst_Id").prop('required',true);
  $("#add_Purchase_Cgst_Id").prop('required',true);
  $("#add_Purchase_Net_Amt_Id").prop('required',true);
  $("#add_Purchase_Net_Rate_Id").prop('required',true);
  $("#add_Purchase_Freight_Id").prop('required',true);
  $("#add_Purchase_Gst_Id").prop('required',true);
}

function removeValidationPurchaseReturn(){
    $('#add_Purchase_Description_Id').removeAttr('required');
    $('#add_Purchase_Nos_Id').removeAttr('required');
    $('#add_Purchase_Cut_Id').removeAttr('required');
    $('#add_Purchase_Quantity_Id').removeAttr('required');
    $('#add_Purchase_PM_Id').removeAttr('required');
    $('#add_Purchase_Rate_Id').removeAttr('required');
    $('#add_Purchase_Disc_Id').removeAttr('required');
    $('#add_Purchase_Amount_Id').removeAttr('required');
    $('#add_Purchase_Sgst_Id').removeAttr('required');
    $('#add_Purchase_Cgst_Id').removeAttr('required');
    $('#add_Purchase_Net_Amt_Id').removeAttr('required');
    $('#add_Purchase_Net_Rate_Id').removeAttr('required');
    $('#add_Purchase_Freight_Id').removeAttr('required');
    $('#add_Purchase_Gst_Id').removeAttr('required');
}

</script>



