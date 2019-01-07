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
                 
            <a href="<?= base_url(); ?>SalesReturnController" class="btn btn-primary">Back</a>

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
           <form id="salesReturnform" method="post">
          <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">

          <div class="row">
          <div class="col-md-6 form-group">
          <div class="row">
            <div class="col-md-7 form-group">
              <label >Book  </label>
              <select id="salesReturn_Book_Code_Id" name="salesReturn_Book_Code_Id" class="form-control selectpicker" data-live-search="true" required>
                <option value="">--Select--</option>
              </select> 
            </div>
            <div class="col-md-2 form-group">
                <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BooksController/insertBook">Add</a>
            </div>
            <div class="col-md-3 form-group">
                <a class="now-ui-icons arrows-1_refresh-69" onclick="salesReturnBookReferesh();">Referesh</a>
            </div>

            </div>
            </div> 
             <div class="col-md-3 form-group">
              <label >Firm Balance  </label>
              <input type="text" class="form-control numbersOnly" name="salesReturn_Firm_Bal_Id" id="salesReturn_Firm_Bal_Id" placeholder="Enter Sales Party" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Party_Id') ?>
            </div>
             <div class="col-md-3 form-group">
             <label >Party Balance  </label>
             <input type="text" class="form-control numbersOnly" name="salesReturn_Party_Bal_Id" id="salesReturn_Party_Bal_Id" placeholder="Enter Sales Party" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Party_Id') ?>
            </div>

                 <!--  <div class="col-md-2 form-group">
                  <label>D.O.No chek form client for this field</label> -->
                        
<!--                             <input type="text" class="form-control " name="salesReturn_D_O_No_Id" id="salesReturn_D_O_No_Id" placeholder=" Enter Sales D.O.No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('salesReturn_D_O_No_Id') ?>
<!--                            </div>-->
                     </div>           
                
        <div class="row">
            <div class="col-md-3 form-group">
              <label >Bill No  </label>
              <input type="text" class="form-control numbersOnly" name="salesReturn_Bill_No_Id" id="salesReturn_Bill_No_Id" placeholder="Enter Sales Party" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Party_Id') ?>
            </div>
             <div class="col-md-3 form-group">
             <label >Bill Date  </label>
             <input type="date" class="form-control" name="salesReturn_Bill_Date_Id" id="salesReturn_Bill_Date_Id" placeholder="Enter Sales Party" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Party_Id') ?>
            </div>
             <div class="col-md-3 form-group">
              <label >Inventry Type  </label>
              <input type="text" class="form-control numbersOnly" name="salesReturn_Inv_Type_Id" id="salesReturn_Inv_Type_Id" placeholder="Enter Sales Party" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Party_Id') ?>
            </div>
             <div class="col-md-3 form-group">
             <label >Challan NO  </label>
             <input type="text" class="form-control numbersOnly" name="salesReturn_Chalan_No_Id" id="salesReturn_Chalan_No_Id" placeholder="Enter Sales Party" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Party_Id') ?>
            </div>

               </div>
                <div class="row">
                        
                    <div class="col-md-2 form-group">
                            <label>Party <span >  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="salesReturn_PartyCode_Id" id="salesReturn_PartyCode_Id" placeholder="Enter Sales Party" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Party_Id') ?>
                          </div>
                         
                    <div class="col-md-6 form-group">
                    <div class="row">
                     <div class="col-md-10 form-group">
                      <label> </label>
                      <input type="text" class="form-control txt_Space" name="salesReturn_PartyName_Id" id="salesReturn_PartyName_Id" placeholder="Enter Sales Party " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('salesReturn_Party_Id') ?>
                    </div>

                    <div class="col-md-2 form-group">
                    <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>AccountMasterController/insertAccountMaster">Add</a>
                    </div>
                    </div>
                    </div>
                    <div class="col-md-2 form-group">
                     <label>Challan Date<span >  </span> </label>
                     <input type="date" class="form-control numbersOnly" name="salesReturn_challan_date" id="salesReturn_challan_date" placeholder="Enter Sales Cr Days" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Cr_Days_Id') ?>
                    </div>
                         
                    <div class="col-md-2 form-group">
                            <label>Cr Days<span >  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="salesReturn_Cr_Days_Id" id="salesReturn_Cr_Days_Id" placeholder="Enter Sales Cr Days" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Cr_Days_Id') ?>
                    </div>
                   </div>           
                        <div class="row">

                        <div class="col-md-2 form-group">
                            <label>Deli.  </span></label>
                        
                            <input type="text" class="form-control" name="salesReturn_Deli_Code_Id" id="salesReturn_Deli_Code_Id" placeholder="Enter Sales Deli " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('salesReturn_Deli_Code_Id') ?>
                                       
                        </div>
                               
                           <div class="col-md-5 form-group">
                            <label> </label>
                        
                            <input type="text" class="form-control " name="salesReturn_Deli_Value_Id" id="salesReturn_Deli_Value_Id" placeholder="Enter Sales Deli" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('salesReturn_Deli_Value_Id') ?>
                                       
                        </div>
                      
                        <div class="col-md-5 form-group">
                        <div class="row">
                        <div class="col-md-10 form-group">
                        <label> Broker </label>
                        <input type="text" class="form-control " name="salesReturn_Broker_Id" id="salesReturn_Broker_Id" placeholder="Enter Sales Broker" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('salesReturn_Broker_Id') ?>             
                        </div>
                        <div class="col-md-2 form-group">
                        <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BrokerController/insertBroker">Add</a>
                        </div>
                        </div>
                        </div>


                    
                        </div>
                        <div class="row">
                        
                    <div class="col-md-3 form-group">
                            <label>L.R.No. <span >  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="salesReturn_L_R_No_Id" id="salesReturn_L_R_No_Id" placeholder="Enter Sales L R No" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_L_R_No_Id') ?>
                          </div>
                         
                    <div class="col-md-3 form-group">
                            <label> L.R.Dt. </label>
                            <input type="Date" class="form-control" name="salesReturn_L_R_Dt_Id" id="salesReturn_L_R_Dt_Id" placeholder="Enter Sales L.R.Dt " autocomplete="off" required pattern="[]+"> <?php echo form_error('salesReturn_L_R_Dt_Id') ?>
                          </div>
                          <div class="col-md-3 form-group">
                            <label> Transport </label>
                            <input type="text" class="form-control numbersOnly" name="salesReturn_Transport_Id" id="salesReturn_Transport_Id" placeholder="Enter Sales Transport " autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Transport_Id') ?>
                          </div>
                          <div class="col-md-3 form-group">
                            <label> Station </label>
                            <input type="text" class="form-control " name="salesReturn_Station_Id" id="salesReturn_Station_Id" placeholder="Enter Sales Station " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('salesReturn_Station_Id') ?>
                          </div>
                       
                        </div>

                         <div class="row">
                        
                    <div class="col-md-6 form-group">
                            <label>Packing <span >  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="salesReturn_Packing_Id" id="salesReturn_Packing_Id" placeholder="Enter Sales Packing" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Packing_Id') ?>
                          </div>
                          <div class="col-md-6 form-group">
                          <label>Case No <span >  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="salesReturn_Case_No_Id" id="salesReturn_Case_No_Id" placeholder="Enter Sales Case No" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Case_No_Id') ?>
                          </div>
                          <!-- <div class="col-md-1 form-group">
                          <label>  </label>
                            <input type="text" class="form-control " name="salesReturn_Case_No_Id" id="salesReturn_Case_No_Id" placeholder="Case No" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('salesReturn_Case_No_Id') ?>
                          </div>
                          <div class="col-md-1 form-group">
                          <label> </label>
                            <input type="text" class="form-control " name="salesReturn_Case_No_Id" id="salesReturn_Case_No_Id" placeholder="Case No" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('salesReturn_Case_No_Id') ?>
                          </div>
                          <div class="col-md-1 form-group">
                          <label> <span >  </span> </label>
                            <input type="text" class="form-control " name="salesReturn_Case_No_Id" id="salesReturn_Case_No_Id" placeholder="Case No" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('salesReturn_Case_No_Id') ?>
                          </div>
                          <div class="col-md-1 form-group">
                          <label>  </label>
                            <input type="text" class="form-control " name="salesReturn_Case_No_Id" id="salesReturn_Case_No_Id" placeholder="Case No" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('salesReturn_Case_No_Id') ?>
                          </div>
                          <div class="col-md-1 form-group">
                          <label>  </label>
                            <input type="text" class="form-control " name="salesReturn_Case_No_Id" id="salesReturn_Case_No_Id" placeholder="Case No" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('salesReturn_Case_No_Id') ?>
                          </div>
                        <div class="col-md-1 form-group">
                          <label> </label>
                            <input type="text" class="form-control " name="salesReturn_Case_No_Id" id="salesReturn_Case_No_Id" placeholder="Case No" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('salesReturn_Case_No_Id') ?>
                          </div>
                          <div class="col-md-2 form-group">
                          <label> Gross Amt </label>
                            <input type="text" class="form-control " name="salesReturn_Gross_Amt_Id" id="salesReturn_Gross_Amt_Id" placeholder="Enter Sales Gross Amt" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('salesReturn_Gross_Amt_Id') ?>
            </div> -->
        </div>
      <div style="border-style: inset; padding: 15px">
<div class="row">
    <div class="col-md-1 form-group">
        <label>S.No </label>
               <input type="text" class="form-control " name="serialNumber" id="serialNumber" placeholder="Sr No" autocomplete="off" required readonly=""> <?php echo form_error('serialNumber') ?>
       </div>
    <div class="col-md-2 form-group">
       <label>Quality Name </label>
            <input type="text" class="form-control " name="salesReturn_Quality_Name_Id" id="salesReturn_Quality_Name_Id" placeholder="Qty Name " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('salesReturn_Quality_Name_Id') ?>
      </div>
   <div class="col-md-2 form-group">
        <label>Description </label>
            <input type="text" class="form-control " name="salesReturn_Description_Id" id="salesReturn_Description_Id" placeholder="Description" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('salesReturn_Description_Id') ?>
     </div>
   <div class="col-md-2 form-group">
        <label>Piece </label>
           <input type="text" class="form-control " name="salesReturn_Piece_Id" id="salesReturn_Piece_Id" placeholder="No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('salesReturn_No_Id') ?>
        </div>
     <div class="col-md-1 form-group">
           <label>Cut </label>
                <input type="text" class="form-control " name="salesReturn_cut_One_Id" id="salesReturn_cut_One_Id" placeholder="No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('salesReturn_No_One_Id') ?>
        </div>
      <div class="col-md-1 form-group">
           <label>Qty </label>
                <input type="text" class="form-control " name="salesReturn_Qty_Id" id="salesReturn_Qty_Id" placeholder="Qty" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('salesReturn_Qty_Id') ?>
        </div>
      <div class="col-md-1 form-group">
          <label>PM </label>
              <input type="text" class="form-control " name="salesReturn_PM_Id" id="salesReturn_PM_Id" placeholder="PM" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('salesReturn_PM_Id') ?>
       </div>
    <div class="col-md-1 form-group">
          <label>Rate </label>
              <input type="text" class="form-control " name="salesReturn_Rate_Id" id="salesReturn_Rate_Id" placeholder="Rate" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('salesReturn_Rate_Id') ?>
   </div>
     <div class="col-md-1 form-group">
            <label >Disc % </label>
                <input type="text" class="form-control " name="salesReturn_Disc_Id" id="salesReturn_Disc_Id" placeholder="Disc" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('salesReturn_Disc_Id') ?>
        </div>
     </div>
  <div class="row">
   <!--  <div class="col-md-1 form-group">
       <label >Less % </label>
             <input type="text" class="form-control " name="salesReturn_Less_Id" id="salesReturn_Less_Id" placeholder="Less" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('salesReturn_Less_Id') ?>
       </div> -->
  <div class="col-md-2 form-group">
      <label >Amount </label>
         <input type="text" class="form-control " name="salesReturn_Amount_Id" id="salesReturn_Amount_Id" placeholder="Amount" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('salesReturn_Amount_Id') ?>
      </div>
  <div class="col-md-1 form-group">
        <label >SGST </label>
            <input type="text" class="form-control " name="salesReturn_Sgst_Id" id="salesReturn_Sgst_Id" placeholder="SGST" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('salesReturn_Sgst_Id') ?>
      </div>
  <div class="col-md-2 form-group">
    <label >CGST </label>
        <input type="text" class="form-control " name="salesReturn_Cgst_Id" id="salesReturn_Cgst_Id" placeholder="CGST" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('salesReturn_Cgst_Id') ?>
      </div>
  <div class="col-md-2 form-group">
        <label >Net Amt </label>
          <input type="text" class="form-control " name="salesReturn_Net_Amt_Id" id="salesReturn_Net_Amt_Id" placeholder="Net Amt " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('salesReturn_Net_Amt_Id') ?>
      </div>
<div class="col-md-2 form-group">
      <label >Net Rate </label>
          <input type="text" class="form-control " name="salesReturn_Net_Rate_Id" id="salesReturn_Net_Rate_Id" placeholder="Net Rate" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Net_Rate_Id') ?>
      </div>
  <div class="col-md-2 form-group">
       <label>Disc Rs.</label>
          <input type="text" class="form-control " name="salesReturn_Rs_Id" id="salesReturn_Rs_Id" placeholder="Rs" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('salesReturn_Rs_Id') ?>
        </div>
  <!--  <div class="col-md-1 form-group">
        <label>  </label>
            <input type="text" class="form-control " name="salesReturn_Rs_Id" id="salesReturn_Rs_Id" placeholder="Rs" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('salesReturn_Rs_Id') ?>
        </div> -->
<!--   <div class="col-md-1 form-group">
         <label>SGST</label>
             <input type="text" class="form-control" name="salesReturn_Sgst_Id" id="salesReturn_Sgst_Id" placeholder="SGST " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('salesReturn_Sgst_Id') ?>
       </div>
 <div class="col-md-1 form-group">
        <label>CGST </label>
             <input type="text" class="form-control" name="salesReturn_Cgst_Id" id="salesReturn_Cgst_Id" placeholder="GST" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('salesReturn_Cgst_Id') ?>
      </div> -->
   <div class="col-md-1 form-group">
          <a name="add_Detail"  id="add_Detail" class="btn btn-primary">Add</a>
    </div>
  </div>
</div>
  <table id="tbl_inventoryIssue" class="display responsive" >
            <thead>
              <tr bgcolor="silver">
                  <th>S.No.</th>
                  <th>Quality Name</th>
                  <th>Description</th>
                  <th>Piece</th>
                  <th>Cut</th>
                  <th>Qty</th>
                  <th>PM</th>
                  <th>Rate</th>
                  <th>Disc %</th>
                  <th>Less %</th>
                  <th>Amount</th>
                  <th>SGST</th>
                  <th>CGST</th>
                  <th>Net Amt</th>
                  <th>Net Rate</th>
                  <th>Rs.</th>
                  <th>SGST</th>
                  <th>CGST</th>

              </tr>
        </thead>
    </table>
<hr size="30">
<div class="row ">
      <div class="col-md-3 form-group">
         <label >Tot PCS </label>
              <input type="text" class="form-control numbersOnly" name="salesReturn_Tot_Pcs_Id" id="salesReturn_Tot_Pcs_Id" placeholder="Enter Sales Tot PCS" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Tot_Pcs_Id') ?>
        </div>
  <div class="col-md-3 form-group">
          <label >Mtrs</label>
                <input type="text" class="form-control numbersOnly" name="salesReturn_Mtrs_Id" id="salesReturn_Mtrs_Id" placeholder="Enter Sales Mtrs" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Mtrs_Id') ?>
        </div>

    <div class="col-md-3 form-group">
        <label >Basic Amt </label>
             <input type="text" class="form-control numbersOnly" name="salesReturn_Basic_Amt_Id" id="salesReturn_Basic_Amt_Id" placeholder="Enter Sales Basic Amt" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Basic_Amt_Id') ?>
       </div>
  <div class="col-md-3 form-group">
     <label >SGST </label>
         <input type="text" class="form-control numbersOnly" name="salesReturn_Sgst_Sales_Id" id="salesReturn_Sgst_Sales_Id" placeholder="Enter Sales SGST" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Sgst_Sales_Id') ?>
    </div>
 
     </div>

    <div class="row">
       <div class="col-md-6 form-group">
        <label >Desc :</label>
        <input type="text" class="form-control numbersOnly" name="salesReturn_Desc_Id" id="salesReturn_Desc_Id" placeholder="Enter Sales Desc" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Desc_Id') ?>
      </div>

      <div class="col-md-6 form-group">
       <label >CGST </label>
       <input type="text" class="form-control numbersOnly" name="salesReturn_Cgst_Sales_Id" id="salesReturn_Cgst_Sales_Id" placeholder="Enter Sales CGST" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Cgst_Sales_Id') ?>
      </div>
    </div>

<div class="row ">
    <div class="col-md-2 form-group">
         <label > Consignee code</label>
             <input type="text" class="form-control numbersOnly" name="salesReturn_Consignee_Code_Id" id="salesReturn_Consignee_Code_Id" placeholder="Enter Sales Rate: Consignee" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Consignee_Code_Id') ?>
    </div>
    <div class="col-md-3 form-group">
         <label > Consignee</label>
             <input type="text" class="form-control numbersOnly" name="salesReturn_Consignee_Code_Id" id="salesReturn_Consignee_Code_Id" placeholder="Enter Sales Rate: Consignee" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Consignee_Code_Id') ?>
    </div>

          <div class="col-md-2 form-group">
            <label >Rnd Off. Code </label>
            <input type="text" class="form-control " name="salesReturn_Rnd_Off_Code_Id" id="salesReturn_Rnd_Off_Code_Id" placeholder="Enter Sales Rnd Off." autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Rnd_Off_Code_Id') ?>
          </div>

          <div class="col-md-3 form-group">
            <label >Rnd Off. </label>
            <input type="text" class="form-control " name="salesReturn_Rnd_Off_value_Id" id="salesReturn_Rnd_Off_value_Id" placeholder="Enter Sales Rnd Off. value" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Rnd_Off_Code_Id') ?>
          </div>

        <div class="col-md-2 form-group">
            <label >(F9) Other(+/-) </label>
              <input type="text" class="form-control " name="salesReturn_F9_Other_Id" id="salesReturn_F9_Other_Id" placeholder="Enter Sales (F9) Other(+/-) " autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_F9_Other_Id') ?>
            </div>
         </div>
 <div class="row ">
 <div class="col-md-3 form-group">
        <label >Reason </label>
        <select id="salesReturn_reason_Id" name="salesReturn_reason_Id" class="form-control selectpicker" data-live-search="true" required>
          <option value="salesReturn">01-Sales Return</option>
        </select> 
   </div>

    <div class="col-md-3 form-group">
        <label >Sales Bill No </label>
        <input type="text" class="form-control " name="salesReturn_Bill_no" id="salesReturn_Bill_no" placeholder="Enter Sales Bill Amout" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Bill_Amout_Id') ?>
   </div>

    <div class="col-md-3 form-group">
        <label >Sales Bill Date </label>
        <input type="date" class="form-control " name="salesReturn_Bill_date" id="salesReturn_Bill_date" placeholder="Enter Sales Bill Amout" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Bill_Amout_Id') ?>
   </div>

  <div class="col-md-3 form-group">
        <label >Bill Amout </label>
        <input type="text" class="form-control " name="salesReturn_Bill_Amout_Id" id="salesReturn_Bill_Amout_Id" placeholder="Enter Sales Bill Amout" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('salesReturn_Bill_Amout_Id') ?>
   </div>
    </div>
  </form>                  
    <button name="addSalesReturn" id="addSalesReturn" class="btn btn-primary"><?php if($uid==""){echo "Add Sales Return";}else{echo "update Sales Return";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>

 <script type='text/javascript'>

 var salesReturnDataBroker = $("#salesReturn_Broker_Id").tautocomplete({
        width: "500px",
        columns: ['Broker Name', 'City Name', 'Phone Name'],
        placeholder: "Search Broker",
        id: "salesReturnBroker_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getBroker/",
            type: "POST",
            data: function()
             {
                var x = {BrokerName: $('#salesReturnBroker_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + salesReturnDataBroker.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = salesReturnDataBroker.searchdata();
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

 var salesReturnDataMillParty = $("#salesReturn_PartyName_Id").tautocomplete({
        
        width: "500px",
        columns: ['Acount Master Name', 'City Name', 'Contact Number'],
        placeholder: "Search Mill Party",
        id: "salesReturnParty_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getAccountMaster",
            type: "POST",
            data: function()
             {
                var x = {millPartyName: $('#salesReturnParty_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + salesReturnDataMillParty.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = salesReturnDataMillParty.searchdata();
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

      addValidationSalesReturn();

    if ($("#salesReturnform").validate().element('#salesReturn_Quality_Name_Id') == false || 
      $("#salesReturnform").validate().element('#salesReturn_Description_Id') == false ||
      $("#salesReturnform").validate().element('#salesReturn_Piece_Id') == false||
      $("#salesReturnform").validate().element('#salesReturn_cut_One_Id') == false||
      $("#salesReturnform").validate().element('#salesReturn_Qty_Id') == false||
      $("#salesReturnform").validate().element('#salesReturn_PM_Id') == false||
      $("#salesReturnform").validate().element('#salesReturn_Rate_Id') == false||
      $("#salesReturnform").validate().element('#salesReturn_Disc_Id') == false||
      $("#salesReturnform").validate().element('#salesReturn_Amount_Id') == false|| 
      $("#salesReturnform").validate().element('#salesReturn_Sgst_Id') == false|| 
      $("#salesReturnform").validate().element('#salesReturn_Cgst_Id') == false||
      $("#salesReturnform").validate().element('#salesReturn_Net_Amt_Id') == false||
      $("#salesReturnform").validate().element('#salesReturn_Net_Rate_Id') == false||
      $("#salesReturnform").validate().element('#salesReturn_Rs_Id') == false)

    {

    }else
    {

      var nextid = $("#serialNumber").val();

      tbl_inventoryIssue.row.add( [
       '<input type="text" id="'+nextid+'" name="sno[]" value="'+$("#serialNumber").val()+'">',
       '<input type="text" id="'+nextid+'" name="salesReturn_Quality_Name_Id[]" value="'+$("#salesReturn_Quality_Name_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="salesReturn_Description_Id[]" value="'+$("#salesReturn_Description_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="salesReturn_Piece_Id[]" value="'+$("#salesReturn_Piece_Id").val()+'">',
        '<input type="text" id="'+nextid+'" name="salesReturn_cut_One_Id[]" value="'+$("#salesReturn_cut_One_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="salesReturn_Qty_Id[]" value="'+$("#salesReturn_Qty_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="salesReturn_PM_Id[]" value="'+$("#salesReturn_PM_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="salesReturn_Rate_Id[]" value="'+$("#salesReturn_Rate_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="salesReturn_Disc_Id[]" value="'+$("#salesReturn_Disc_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="salesReturn_Amount_Id[]" value="'+$("#salesReturn_Amount_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="salesReturn_Sgst_Id[]" value="'+$("#salesReturn_Sgst_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="salesReturn_Cgst_Id[]" value="'+$("#salesReturn_Cgst_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="salesReturn_Net_Amt_Id[]" value="'+$("#salesReturn_Net_Amt_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="salesReturn_Net_Rate_Id[]" value="'+$("#salesReturn_Net_Rate_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="salesReturn_Rs_Id[]" value="'+$("#salesReturn_Rs_Id").val()+'">',
        ] ).node().id = nextid;
      
    tbl_inventoryIssue.draw( false );

      $('#salesReturn_Quality_Name_Id').val("");
      $('#salesReturn_Description_Id').val("");
      $('#salesReturn_Piece_Id').val("");
      $('#salesReturn_cut_One_Id').val("");
      $('#salesReturn_Qty_Id').val("");
      $('#salesReturn_PM_Id').val("");
      $('#salesReturn_Rate_Id').val("");
      $('#salesReturn_Disc_Id').val("");
      $('#salesReturn_Amount_Id').val("");
      $('#salesReturn_Sgst_Id').val("");
      $('#salesReturn_Cgst_Id').val("");
      $('#salesReturn_Net_Amt_Id').val("");
      $('#salesReturn_Net_Rate_Id').val("");
      $('#salesReturn_Rs_Id').val("");
    }
        
 
    } );
} );

$(document).ready(function(){
    var x = $('#salesReturn_Book_Code_Id').val();
    bookList(x);

   $('#addSalesReturn').on('click', function () {
        
         removeValidationSalesReturn();

        if ($('#salesReturnform').valid())
        {
            addSalesMasterToServer();
        }
    });


$('#salesReturn_Book_Code_Id').selectpicker('refresh');

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
              $('#salesReturn_Book_Code_Id').append('<option value="'+data['book_id_PK']+'" selected>'+data['book_number']+'</option>');
          }else{
              $('#salesReturn_Book_Code_Id').append('<option value="'+data['book_id_PK']+'">'+data['book_number']+'</option>');
          }
        });
                 
       $('#salesReturn_Book_Code_Id').selectpicker('refresh');

      }
  });
}

  });

function addSalesMasterToServer(){
  var salesReturnToServerdata = new FormData(document.getElementById("salesReturnform"));
   salesReturnToServerdata.append('salesReturn_PartyName_Id', salesReturnDataMillParty.id());
   salesReturnToServerdata.append('salesReturn_Broker_Id', salesReturnDataBroker.id());

      // AJAX request
    $.ajax({
      url:'<?=base_url()?>SalesReturnController/insertSalesReturn',
      method: 'post',
      data: salesReturnToServerdata,
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
                              text: "Sales Return is successfully added",
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
function salesReturnBookReferesh(){
  bookList();
}

function addValidationSalesReturn(){
  $("#salesReturn_Quality_Name_Id").prop('required',true);
  $("#salesReturn_Description_Id").prop('required',true);
  $("#salesReturn_Piece_Id").prop('required',true);
  $("#salesReturn_cut_One_Id").prop('required',true);
  $("#salesReturn_Qty_Id").prop('required',true);
  $("#salesReturn_PM_Id").prop('required',true);
  $("#salesReturn_Rate_Id").prop('required',true);
  $("#salesReturn_Disc_Id").prop('required',true);
  $("#salesReturn_Amount_Id").prop('required',true);
  $("#salesReturn_Sgst_Id").prop('required',true);
  $("#salesReturn_Cgst_Id").prop('required',true);
  $("#salesReturn_Net_Amt_Id").prop('required',true);
  $("#salesReturn_Net_Rate_Id").prop('required',true);
  $("#salesReturn_Rs_Id").prop('required',true);
}

function removeValidationSalesReturn(){
    $('#salesReturn_Quality_Name_Id').removeAttr('required');
    $('#salesReturn_Description_Id').removeAttr('required');
    $('#salesReturn_Piece_Id').removeAttr('required');
    $('#salesReturn_cut_One_Id').removeAttr('required');
    $('#salesReturn_Qty_Id').removeAttr('required');
    $('#salesReturn_PM_Id').removeAttr('required');
    $('#salesReturn_Rate_Id').removeAttr('required');
    $('#salesReturn_Disc_Id').removeAttr('required');
    $('#salesReturn_Amount_Id').removeAttr('required');
    $('#salesReturn_Sgst_Id').removeAttr('required');
    $('#salesReturn_Cgst_Id').removeAttr('required');
    $('#salesReturn_Net_Amt_Id').removeAttr('required');
    $('#salesReturn_Net_Rate_Id').removeAttr('required');
    $('#salesReturn_Rs_Id').removeAttr('required');
}

</script>



