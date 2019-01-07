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
                 
            <a href="<?= base_url(); ?>operator" class="btn btn-primary">Back</a>

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
           <form id="purchaseform">
                    <div class="row">

    <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
         <div class="col-md-6 form-group">
             <label >Book  </label>
                 <input type="text" class="form-control" name="add_Purchase_Book_Id" id="add_Purchase_Book_Id" placeholder="Enter Book" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Book_Id ') ?>

    </div>                         
                        
 <div class="col-md-2 form-group">
       <label> Bal.: </span> </label>
            <input type="text" class="form-control " name="add_Purchase_Bal_Id" id="add_Purchase_Bal_Id" placeholder="Enter Purchase Bal" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Purchase_Bal_Id') ?>
          </div>
     <div class="col-md-4 form-group">
             <label>RCM Bill No:</label>
                 <input type="text" class="form-control" name="add_Purchase_Rcm_Bill_Id" id="add_Purchase_Rcm_Bill_Id" placeholder="Enter Purchase Rcm Bill No." autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Rcm_Bill_Id') ?>
        </div>
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
            <label> </label>
                  <input type="text" class="form-control " name="add_Purchase_Party_Value_Id" id="add_Purchase_Party_Value_Id" placeholder="Enter Purchase Party" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Party_Value_Id') ?>
                        
                </div>
      <div class="col-md-3 form-group">
            <label>Inv.Type(T/R) </label>
                 <input type="text" class="form-control " name="add_Purchase_Inv_Type_Id" id="add_Purchase_Inv_Type_Id" placeholder=" Enter Purchase Inv Type" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Inv_Type_Id') ?>
              </div>
          </div>           
      <div class="row">
            <div class="col-md-3 form-group">
                <label>Bill Date <span >  </span> </label>
                      <input type="Date" class="form-control " name="add_Purchase_Bill_Date_Id" id="add_Purchase_Bill_Date_Id" placeholder="Enter Purchase Bill Date" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('add_Purchase_Bill_Date_Id') ?>
           </div>
     <div class="col-md-6 form-group">
            <label>Broker <span >  </span> </label>
                <input type="text" class="form-control " name="add_Purchase_Broker_Id" id="add_Purchase_Broker_Id" placeholder="Enter Purchase Broker" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Purchase_Broker_Id') ?>
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
             <input type="text" class="form-control " name="add_Purchase_Transport_Id" id="add_Purchase_Transport_Id" placeholder="Enter Purchase Transport" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Transport_Id') ?>
                                       
        </div>
 </div>
  <div class="row" >
    <div class="col-md-1 form-group">
       <label >Sr No </label>

           <input type="text" class="form-control " name="add_Purchase_Sr_No_Id" id="add_Purchase_Sr_No_Id" placeholder="Enter Purchase Purchase Sr No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Sr_No_Id') ?>
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
               <input type="text" class="form-control " name="add_Purchase_Net_Amt_Id" id="add_Purchase_Net_Amt_Id" placeholder="Enter Purchase Net Amt " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Net_Amt_Id') ?>
             </div>
        <div class="col-md-1 form-group">
              <label >Net Rate </label>
                   <input type="text" class="form-control " name="add_Purchase_Net_Rate_Id" id="add_Purchase_Net_Rate_Id" placeholder="Enter Purchase Net Rate" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Net_Rate_Id') ?>
          </div>
      <div class="col-md-2 form-group">
           <label>Freight </label>
                <input type="text" class="form-control " name="add_Purchase_Freight_Id" id="add_Purchase_Freight_Id" placeholder="Enter Purchase Freight" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Purchase_Freight_Id') ?>
             </div>
       <div class="col-md-1 form-group">
             <label>GST</label>
                <input type="text" class="form-control" name="add_Purchase_Gst_Id" id="add_Purchase_Gst_Id" placeholder="Enter Purchase GST " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Purchase_Gst_Id') ?>
            </div>
      <div class="col-md-1 form-group">
            <label> </label>
                  <input type="text" class="form-control" name="add_Purchase_Gst_Id" id="add_Purchase_Gst_Id" placeholder="Enter Purchase GST" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Purchase_Gst_Id') ?>
               </div>
        <div class="col-md-1 form-group">
          <a name="add_Detail"  id="add_Detail" class="btn btn-primary">Add</a>
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
                     <input type="text" class="form-control" name="add_Purchase_Basic_Amt_Id" id="add_Purchase_Basic_Amt_Id" placeholder="Enter Purchase Basic Amt" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Basic_Amt_Id') ?>
                </div>
      <div class="col-md-3 form-group ">
              <label >SGST </label>
                  <input type="text" class="form-control" name="add_Purchase_Sgst_Id" id="add_Purchase_Sgst_Id" placeholder="Enter Purchase SGST" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Sgst_Id') ?>
                 </div>
             
          
     <div class="col-md-3 form-group">
          <label >CGST </label>
              <input type="text" class="form-control" name="add_Purchase_Cgst_Id" id="add_Purchase_Cgst_Id" placeholder="Enter Purchase CGST" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Cgst_Id') ?>
              </div>
                          
        </div>
   <div class="row ">
      <div class="col-md-6 form-group">
            <label >Desc </label>
                <input type="text" class="form-control " name="add_Purchase_Desc_Id" id="add_Purchase_Desc_Id" placeholder="Enter Purchase Desc" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Desc_Id') ?>
           </div>
                          
        <div class="col-md-1 form-group">
               <label >T.D.S. Rate </label>
                   <input type="text" class="form-control " name="add_Purchase_T_D_S_Rate_Code_Id" id="add_Purchase_T_D_S_Rate_Code_Id" placeholder="Enter Purchase T.D.S. Rate " autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_T_D_S_Rate_Code_Id') ?>
            </div>
              <div class="col-md-2 form-group">
                  <label > </label>
                     <input type="text" class="form-control " name="add_Purchase_T_D_S_Rate_Value_Id" id="add_Purchase_T_D_S_Rate_Value_Id" placeholder="Enter Purchase T.D.S. Rate " autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_T_D_S_Rate_Value_Id') ?>
               </div>
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
              <input type="text" class="form-control " name="add_Purchase_Rnd_Off_Value_Id" id="add_Purchase_Rnd_Off_Value_Id" placeholder="Enter Purchase Rnd Off" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Rnd_Off_Value_Id') ?>
           </div>
     <div class="col-md-3 form-group">
             <label >Bill Amount </label>
                <input type="text" class="form-control " name="add_Purchase_Bill_Amount_Id" id="add_Purchase_Bill_Amount_Id" placeholder="Enter Purchase Bill Amount" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Purchase_Bill_Amount_Id') ?>
            </div>
        </div>
    </form>                  
    <button name="add_operator" id="add_operator" class="btn btn-primary"><?php if($uid==""){echo "Add Purchase Master";}else{echo "update Purchase Master";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>

<?php  $this->load->view('assests/footer'); ?>
 <script type='text/javascript'>

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
       '<input type="text" id="'+nextid+'" name="add_Purchase_Net_Amt_Id[]" value="'+$("#add_Purchase_Net_Amt_Id").val()+'">',
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
        
 
    } );
} );

</script>



