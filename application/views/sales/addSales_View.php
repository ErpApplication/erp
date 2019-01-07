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
                 
            <a href="<?= base_url(); ?>SalesController" class="btn btn-primary">Back</a>

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
           <form id="salesform" method="post">
          <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">

          <div class="row">
          <div class="col-md-6 form-group">
          <div class="row">
                  <div class="col-md-7 form-group">
                      <label >Book  </label>
                       <select id="add_Sales_Book_Code_Id" name="add_Sales_Book_Code_Id" class="form-control selectpicker" data-live-search="true" required>
                        <option value="">--Select--</option>
                        </select> 
                  </div>
            <div class="col-md-2 form-group">
                <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BooksController/insertBook">Add</a>
            </div>
            <div class="col-md-3 form-group">
                <a class="now-ui-icons arrows-1_refresh-69" onclick="salesBookReferesh();">Referesh</a>
            </div>

            </div>
            </div> 
             <div class="col-md-3 form-group">
              <label >Firm Balance  </label>
              <input type="text" class="form-control numbersOnly" name="add_Sales_Firm_Bal_Id" id="add_Sales_Firm_Bal_Id" placeholder="Enter Sales Party" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Party_Id') ?>
            </div>
             <div class="col-md-3 form-group">
             <label >Party Balance  </label>
             <input type="text" class="form-control numbersOnly" name="add_Sales_Party_Bal_Id" id="add_Sales_Party_Bal_Id" placeholder="Enter Sales Party" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Party_Id') ?>
            </div>

                 <!--  <div class="col-md-2 form-group">
                  <label>D.O.No chek form client for this field</label> -->
                        
<!--                             <input type="text" class="form-control " name="add_Sales_D_O_No_Id" id="add_Sales_D_O_No_Id" placeholder=" Enter Sales D.O.No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_D_O_No_Id') ?>
<!--                            </div>-->
                     </div>           
                
        <div class="row">
            <div class="col-md-3 form-group">
              <label >Bill No  </label>
              <input type="text" class="form-control numbersOnly" name="add_Sales_Bill_No_Id" id="add_Sales_Bill_No_Id" placeholder="Enter Sales Party" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Party_Id') ?>
            </div>
             <div class="col-md-3 form-group">
             <label >Bill Date  </label>
             <input type="date" class="form-control" name="add_Sales_Bill_Date_Id" id="add_Sales_Bill_Date_Id" placeholder="Enter Sales Party" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Party_Id') ?>
            </div>
             <div class="col-md-3 form-group">
              <label >Inventry Type  </label>
              <input type="text" class="form-control numbersOnly" name="add_Sales_Inv_Type_Id" id="add_Sales_Inv_Type_Id" placeholder="Enter Sales Party" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Party_Id') ?>
            </div>
             <div class="col-md-3 form-group">
             <label >Challan NO  </label>
             <input type="text" class="form-control numbersOnly" name="add_Sales_Chalan_No_Id" id="add_Sales_Chalan_No_Id" placeholder="Enter Sales Party" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Party_Id') ?>
            </div>

               </div>
                <div class="row">
                        
                    <div class="col-md-2 form-group">
                            <label>Party <span >  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="add_Sales_PartyCode_Id" id="add_Sales_PartyCode_Id" placeholder="Enter Sales Party" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Party_Id') ?>
                          </div>
                         
                    <div class="col-md-8 form-group">
                    <div class="row">
                     <div class="col-md-10 form-group">
                      <label> </label>
                      <input type="text" class="form-control txt_Space" name="add_Sales_PartyName_Id" id="add_Sales_PartyName_Id" placeholder="Enter Sales Party " autocomplete="off" required pattern="[a-zA-Z ]+"> 
                    </div>

                    <div class="col-md-2 form-group">
                    <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>AccountMasterController/insertAccountMaster">Add</a>
                    </div>
                    </div>
                    </div>
                        
                         
                    <div class="col-md-2 form-group">
                            <label>Cr Days<span >  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="add_Sales_Cr_Days_Id" id="add_Sales_Cr_Days_Id" placeholder="Enter Sales Cr Days" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Cr_Days_Id') ?>
                          </div>
                          </div>           
                        <div class="row">

                        <div class="col-md-2 form-group">
                            <label>Deli.  </span></label>
                        
                            <input type="text" class="form-control" name="add_Sales_Deli_Code_Id" id="add_Sales_Deli_Code_Id" placeholder="Enter Sales Deli " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Deli_Code_Id') ?>
                                       
                        </div>
                               
                           <div class="col-md-5 form-group">
                            <label> </label>
                        
                            <input type="text" class="form-control " name="add_Sales_Deli_Value_Id" id="add_Sales_Deli_Value_Id" placeholder="Enter Sales Deli" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Deli_Value_Id') ?>
                                       
                        </div>
                      
                        <div class="col-md-3 form-group">
                        <div class="row">
                        <div class="col-md-10 form-group">
                        <label> Broker </label>
                        <input type="text" class="form-control " name="add_Sales_Broker_Id" id="add_Sales_Broker_Id" placeholder="Enter Sales Broker" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Broker_Id') ?>             
                        </div>
                        <div class="col-md-2 form-group">
                        <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BrokerController/insertBroker">Add</a>
                        </div>
                        </div>
                        </div>


                        <div class="col-md-2 form-group">
                            <label>Veh No </label>
                        
                            <input type="text" class="form-control " name="add_Sales_Veh_No_Id" id="add_Sales_Veh_No_Id" placeholder="Enter Sales Veh No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Veh_No_Id') ?>
                                       
                        </div>
                        </div>
                        <div class="row">
                        
                    <div class="col-md-2 form-group">
                            <label>L.R.No. <span >  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="add_Sales_L_R_No_Id" id="add_Sales_L_R_No_Id" placeholder="Enter Sales L R No" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_L_R_No_Id') ?>
                          </div>
                         
                    <div class="col-md-2 form-group">
                            <label> L.R.Dt. </label>
                            <input type="text" class="form-control" name="add_Sales_L_R_Dt_Id" id="add_Sales_L_R_Dt_Id" placeholder="Enter Sales L.R.Dt " autocomplete="off" required pattern="[]+"> <?php echo form_error('add_Sales_L_R_Dt_Id') ?>
                          </div>
                          <div class="col-md-3 form-group">
                            <label> Transport </label>
                            <input type="text" class="form-control numbersOnly" name="add_Sales_Transport_Id" id="add_Sales_Transport_Id" placeholder="Enter Sales Transport " autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Transport_Id') ?>
                          </div>
                          <div class="col-md-2 form-group">
                            <label> Station </label>
                            <input type="text" class="form-control " name="add_Sales_Station_Id" id="add_Sales_Station_Id" placeholder="Enter Sales Station " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Sales_Station_Id') ?>
                          </div>
                          <div class="col-md-3 form-group">
                            <label> Trans ID </label>
                            <input type="text" class="form-control numbersOnly" name="add_Sales_Trans_Id" id="add_Sales_Trans_Id" placeholder="Enter Sales Trans ID " autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Trans_Id') ?>
                          </div>
                        </div>

                         <div class="row">
                        
                    <div class="col-md-6 form-group">
                            <label>Packing <span >  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="add_Sales_Packing_Id" id="add_Sales_Packing_Id" placeholder="Enter Sales Packing" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Packing_Id') ?>
                          </div>
                          <div class="col-md-6 form-group">
                          <label>Case No <span >  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="add_Sales_Case_No_Id" id="add_Sales_Case_No_Id" placeholder="Enter Sales Case No" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Case_No_Id') ?>
                          </div>
                          <!-- <div class="col-md-1 form-group">
                          <label>  </label>
                            <input type="text" class="form-control " name="add_Sales_Case_No_Id" id="add_Sales_Case_No_Id" placeholder="Case No" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('add_Sales_Case_No_Id') ?>
                          </div>
                          <div class="col-md-1 form-group">
                          <label> </label>
                            <input type="text" class="form-control " name="add_Sales_Case_No_Id" id="add_Sales_Case_No_Id" placeholder="Case No" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('add_Sales_Case_No_Id') ?>
                          </div>
                          <div class="col-md-1 form-group">
                          <label> <span >  </span> </label>
                            <input type="text" class="form-control " name="add_Sales_Case_No_Id" id="add_Sales_Case_No_Id" placeholder="Case No" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('add_Sales_Case_No_Id') ?>
                          </div>
                          <div class="col-md-1 form-group">
                          <label>  </label>
                            <input type="text" class="form-control " name="add_Sales_Case_No_Id" id="add_Sales_Case_No_Id" placeholder="Case No" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('add_Sales_Case_No_Id') ?>
                          </div>
                          <div class="col-md-1 form-group">
                          <label>  </label>
                            <input type="text" class="form-control " name="add_Sales_Case_No_Id" id="add_Sales_Case_No_Id" placeholder="Case No" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('add_Sales_Case_No_Id') ?>
                          </div>
                        <div class="col-md-1 form-group">
                          <label> </label>
                            <input type="text" class="form-control " name="add_Sales_Case_No_Id" id="add_Sales_Case_No_Id" placeholder="Case No" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('add_Sales_Case_No_Id') ?>
                          </div>
                          <div class="col-md-2 form-group">
                          <label> Gross Amt </label>
                            <input type="text" class="form-control " name="add_Sales_Gross_Amt_Id" id="add_Sales_Gross_Amt_Id" placeholder="Enter Sales Gross Amt" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('add_Sales_Gross_Amt_Id') ?>
            </div> -->
        </div>
      <div style="border-style: inset; padding: 15px">
<div class="row">
    <div class="col-md-1 form-group">
        <label>S.No </label>
               <input type="text" class="form-control " name="serialNumber" id="serialNumber" placeholder="Sr No" autocomplete="off" required readonly=""> <?php echo form_error('serialNumber') ?>
       </div>
    <div class="col-md-3 form-group">
       <label>Quality Name </label>
            <input type="text" class="form-control " id="add_Sales_Quality_Name_Id" placeholder="Qty Name " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Quality_Name_Id') ?>
      </div>
   <div class="col-md-2 form-group">
        <label>Description </label>
            <input type="text" class="form-control " id="add_Sales_Description_Id" placeholder="Description" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Description_Id') ?>
     </div>
   <div class="col-md-1 form-group">
        <label>Piece </label>
           <input type="text" class="form-control " id="add_Sales_Piece_Id" placeholder="No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_No_Id') ?>
        </div>
     <div class="col-md-1 form-group">
           <label>Cut </label>
                <input type="text" class="form-control " id="add_Sales_cut_One_Id" placeholder="No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_No_One_Id') ?>
        </div>
      <div class="col-md-1 form-group">
           <label>Qty </label>
                <input type="text" class="form-control " id="add_Sales_Qty_Id" placeholder="Qty" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Qty_Id') ?>
        </div>
      <div class="col-md-1 form-group">
          <label>PM </label>
              <input type="text" class="form-control " id="add_Sales_PM_Id" placeholder="PM" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_PM_Id') ?>
       </div>
    <div class="col-md-1 form-group">
          <label>Rate </label>
              <input type="text" class="form-control " id="add_Sales_Rate_Id" placeholder="Rate" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Rate_Id') ?>
   </div>
     <div class="col-md-1 form-group">
            <label >Disc % </label>
                <input type="text" class="form-control " id="add_Sales_Disc_Id" placeholder="Disc" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Disc_Id') ?>
        </div>
     </div>
  <div class="row">
    <div class="col-md-1 form-group">
       <label >Less % </label>
             <input type="text" class="form-control " id="add_Sales_Less_Id" placeholder="Less" autocomplete="off" required pattern="[0-9 ]+"> 
       </div>
  <div class="col-md-2 form-group">
      <label >Amount </label>
         <input type="text" class="form-control " id="add_Sales_Amount_Id" placeholder="Amount" autocomplete="off" required pattern="[0-9 ]+" readonly>
      </div>
  <div class="col-md-1 form-group">
        <label >SGST </label>
            <input type="text" class="form-control " id="add_Sales_Sgst_Id" placeholder="SGST" autocomplete="off" required pattern="[0-9 ]+"> 
      </div>
  <div class="col-md-1 form-group">
    <label >CGST </label>
        <input type="text" class="form-control " id="add_Sales_Cgst_Id" placeholder="CGST" autocomplete="off" required pattern="[0-9 ]+"> 
      </div>
  <div class="col-md-1 form-group">
        <label >Net Amt </label>
          <input type="text" class="form-control " id="add_Sales_Net_Amt_Id" placeholder="Net Amt " autocomplete="off" required pattern="[0-9 ]+" readonly>
      </div>
<div class="col-md-1 form-group">
      <label >Net Rate </label>
          <input type="text" class="form-control " id="add_Sales_Net_Rate_Id" placeholder="Net Rate" autocomplete="off" required pattern="[0-9]+"> 
      </div>
  <div class="col-md-1 form-group">
       <label>Rs.</label>
          <input type="text" class="form-control " id="add_Sales_Rs_Id" placeholder="Rs" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Rs_Id') ?>
        </div>
  <!--  <div class="col-md-1 form-group">
        <label>  </label>
            <input type="text" class="form-control " name="add_Sales_Rs_Id" id="add_Sales_Rs_Id" placeholder="Rs" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Rs_Id') ?>
        </div> -->
<!--   <div class="col-md-1 form-group">
         <label>SGST</label>
             <input type="text" class="form-control" name="add_Sales_Sgst_Id" id="add_Sales_Sgst_Id" placeholder="SGST " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Sales_Sgst_Id') ?>
       </div>
 <div class="col-md-1 form-group">
        <label>CGST </label>
             <input type="text" class="form-control" name="add_Sales_Cgst_Id" id="add_Sales_Cgst_Id" placeholder="GST" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Sales_Cgst_Id') ?>
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
                  <!-- <th>SGST</th>
                  <th>CGST</th> -->

              </tr>
        </thead>
    </table>
<hr size="30">
<div class="row ">
      <div class="col-md-1 form-group">
         <label >Tot PCS </label>
              <input type="text" class="form-control numbersOnly" name="add_Sales_Tot_Pcs_Id" id="add_Sales_Tot_Pcs_Id" placeholder="Enter Sales Tot PCS" autocomplete="off" required pattern="[0-9]+" readonly> <?php echo form_error('add_Sales_Tot_Pcs_Id') ?>
        </div>
  <div class="col-md-1 form-group">
          <label >Mtrs</label>
                <input type="text" class="form-control numbersOnly" name="add_Sales_Mtrs_Id" id="add_Sales_Mtrs_Id" placeholder="Enter Sales Mtrs" autocomplete="off" required pattern="[0-9]+" readonly> 
        </div>
    <div class="col-md-2 form-group">
           <label >CD Rs. </label>
                <input type="text" class="form-control numbersOnly" name="add_Sales_Cd_Rs_Id" id="add_Sales_Cd_Rs_Id" placeholder="Enter Sales CD Rs." autocomplete="off" required pattern="[0-9]+"> 
      </div>
          <div class="col-md-2 form-group">
             <label >Brk Rs. </label>
                  <input type="text" class="form-control numbersOnly" name="add_Sales_Brk_Rs_Id" id="add_Sales_Brk_Rs_Id" placeholder="Enter Sales Brk Rs" autocomplete="off" required pattern="[0-9]+"> 
       </div>
    <div class="col-md-2 form-group">
        <label >Basic Amt </label>
             <input type="text" class="form-control numbersOnly" name="add_Sales_Basic_Amt_Id" id="add_Sales_Basic_Amt_Id" placeholder="Enter Sales Basic Amt" autocomplete="off" required pattern="[0-9]+" readonly>
       </div>
  <div class="col-md-2 form-group">
     <label >SGST </label>
         <input type="text" class="form-control numbersOnly" name="add_Sales_Sgst_Sales_Id" id="add_Sales_Sgst_Sales_Id" placeholder="Enter Sales SGST" autocomplete="off" required pattern="[0-9]+" readonly> 
    </div>
  <div class="col-md-2 form-group">
    <label >CGST </label>
       <input type="text" class="form-control numbersOnly" name="add_Sales_Cgst_Sales_Id" id="add_Sales_Cgst_Sales_Id" placeholder="Enter Sales CGST" autocomplete="off" required pattern="[0-9]+" readonly>
        </div>
     </div>
<div class="row ">
    <div class="col-md-2 form-group">
<!--          <label >Rate: </label>
 -->         <label > Consignee </label>
             <input type="text" class="form-control numbersOnly" name="add_Sales_Consignee_Code_Id" id="add_Sales_Consignee_Code_Id" placeholder="Enter Sales Rate: Consignee" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Consignee_Code_Id') ?>
         </div>
   <!--  <div class="col-md-4 form-group">
           <label ></label>
                <input type="text" class="form-control " name="add_Sales_Consignee_Value_Id" id="add_Sales_Consignee_Value_Id" placeholder="Enter Sales Consignee" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Consignee_Value_Id') ?>
                          </div> -->
                       <div class="col-md-3 form-group">
                            <label >eWay Bill No. </label>
                            <input type="text" class="form-control " name="add_Sales_Eway_Bill_Id" id="add_Sales_Eway_Bill_Id" placeholder="Enter Sales eWay Bill No." autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Eway_Bill_Id') ?>
                          </div>
                      <div class="col-md-3 form-group">
                          <label >(F9) Other(+/-) </label>
                            <input type="text" class="form-control " name="add_Sales_F9_Other_Id" id="add_Sales_F9_Other_Id" placeholder="Enter Sales (F9) Other(+/-) " autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_F9_Other_Id') ?>
                          </div>
                       </div>
                 <div class="row ">
                    <div class="col-md-3 form-group">
                            <label >Desc :</label>
                            <input type="text" class="form-control numbersOnly" name="add_Sales_Desc_Id" id="add_Sales_Desc_Id" placeholder="Enter Sales Desc" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Desc_Id') ?>
                          </div>
                          
                      <div class="col-md-2 form-group">
                            <label >T.D.S. Rate </label>
                            <input type="text" class="form-control numbersOnly" name="add_Sales_T_D_S_Rate_Code_Id" id="add_Sales_T_D_S_Rate_Code_Id" placeholder="Enter Sales T.D.S. Rate " autocomplete="off" required pattern="[0-9]+">
               </div>
    <div class="col-md-2 form-group">
      <label > </label>
         <input type="text" class="form-control " name="add_Sales_T_D_S_Rate_Value_Id" id="add_Sales_T_D_S_Rate_Value_Id" placeholder="Enter Sales T.D.S. Rate " autocomplete="off" required pattern="[0-9]+" readonly>
      </div>
              <div class="col-md-2 form-group">
                    <label >Rnd Off. </label>
                       <input type="text" class="form-control " name="add_Sales_Rnd_Off_Code_Id" id="add_Sales_Rnd_Off_Code_Id" placeholder="Enter Sales Rnd Off." autocomplete="off" required pattern="[0-9]+"> 
                          </div>
                        <div class="col-md-1 form-group">
                            <label > </label>
                            <input type="text" class="form-control " name="add_Sales_Rnd_Off_Value_Id" id="add_Sales_Rnd_Off_Value_Id" placeholder="Enter Sales Rnd Off" autocomplete="off" required pattern="[0-9]+">
                          </div>
                      <div class="col-md-2 form-group">
                            <label >Bill Amout </label>
                            <input type="text" class="form-control " name="add_Sales_Bill_Amout_Id" id="add_Sales_Bill_Amout_Id" placeholder="Enter Sales Bill Amout" autocomplete="off" required pattern="[0-9]+" readonly>
                          </div>
                        </div>
                       </form>                  
                        <button name="salessMaster" id="salessMaster" class="btn btn-primary"><?php if($uid==""){echo "Add Sales Master";}else{echo "update Sales Master";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>

<?php  $this->load->view('assests/footer'); ?>
 <script type='text/javascript'>

 var salesDataBroker = $("#add_Sales_Broker_Id").tautocomplete({
        width: "500px",
        columns: ['Broker Name', 'City Name', 'Phone Name'],
        placeholder: "Search Broker",
        id: "salesBroker_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getBroker/",
            type: "POST",
            data: function()
             {
                var x = {BrokerName: $('#salesBroker_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + salesDataBroker.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = salesDataBroker.searchdata();
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

 var salesDataMillParty = $("#add_Sales_PartyName_Id").tautocomplete({
        
        width: "500px",
        columns: ['Acount Master Name', 'City Name', 'Contact Number'],
        placeholder: "Search Mill Party",
        id: "salesMillParty_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getAccountMaster",
            type: "POST",
            data: function()
             {
                var x = {millPartyName: $('#salesMillParty_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + salesDataMillParty.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = salesDataMillParty.searchdata();
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

  var salesDataDilivery = $("#add_Sales_Deli_Value_Id").tautocomplete({
        
        width: "500px",
        columns: ['Acount Master Name', 'City Name', 'Contact Number'],
        placeholder: "Search Mill Party",
        id: "salesDelivery_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getAccountMaster",
            type: "POST",
            data: function()
             {
                var x = {millPartyName: $('#salesDelivery_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + salesDataDilivery.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = salesDataDilivery.searchdata();
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

    var salesDataConsignee = $("#add_Sales_Consignee_Code_Id").tautocomplete({
        
        width: "500px",
        columns: ['Acount Master Name', 'City Name', 'Contact Number'],
        placeholder: "Search Mill Party",
        id: "salesConsignee_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getAccountMaster",
            type: "POST",
            data: function()
             {
                var x = {millPartyName: $('#salesConsignee_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + salesDataConsignee.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = salesDataConsignee.searchdata();
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

  var salesDataTransport = $("#add_Sales_Transport_Id").tautocomplete({
        width: "500px",
        columns: ['Transport Name', 'City Name', 'Phone Number'],
        placeholder: "Search Transport",
        id: "salesTransport_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getTransport/",
            type: "POST",
            data: function()
             {
                var x = {TransportName: $('#salesTransport_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + salesDataTransport.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = salesDataTransport.searchdata();
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

  var salesDataQuality = $("#add_Sales_Quality_Name_Id").tautocomplete({
        width: "500px",
        columns: ['Iteam Name', 'MRP', 'cut'],
        placeholder: "Search Iteam",
        id: "salesReceiveQuality_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/get_Iteam/",
            type: "POST",
            data: function()
             {
                var x = {IteamName: $('#salesReceiveQuality_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + salesDataQuality.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = salesDataQuality.searchdata();
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


    var salesDataChallan = $("#add_Sales_Chalan_No_Id").tautocomplete({
        width: "500px",
        columns: ['Challan Number', 'Broker Name', 'Party Name','Transport Name'],
        placeholder: "Search Transport",
        id: "salesChallan_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/get_salesDetailByChallanNo/",
            type: "POST",
            data: function()
             {
                var x = {challanNo: $('#salesChallan_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + salesDataChallan.searchdata() + "/gi");
     
                return result;

            }
        },
                
        onchange: function () {
        event.preventDefault();
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var shiftPressed = event.shiftKey;
            // AJAX request

            salesDataChallan.all();

             var totalNetAmount = 0;
            var array_totalNetAmount = [];
            var array_sgst = [];
            var array_cgst = [];
            var sgstResult = 0;
            var cgstResult = 0;
            var totalNetAmounts = 0;
              
              $('#salesMillParty_row_id').val(salesDataChallan.all().partyName);
              $('#salesBroker_row_id').val(salesDataChallan.all().broker_name);
              $('#salesTransport_row_id').val(salesDataChallan.all().transport_name);
              $('#salesDelivery_row_id').val(salesDataChallan.all().partyName);
              $('#add_Sales_Veh_No_Id').val(salesDataChallan.all().vehicle_no);
              $('#add_Sales_L_R_No_Id').val(salesDataChallan.all().lr_no);
              $('#add_Sales_L_R_Dt_Id').val(salesDataChallan.all().lr_date);
              $('#add_Sales_Station_Id').val(salesDataChallan.all().station);
              $('#add_Sales_Trans_Id').val(salesDataChallan.all().trans_id);
              $('#add_Sales_Packing_Id').val(salesDataChallan.all().packing);
              $('#add_Sales_Case_No_Id').val(salesDataChallan.all().case_no);
              $('#salesConsignee_row_id').val(salesDataChallan.all().partyName);
              
          

            var challanDetail=salesDataChallan.all().challanDetail;
        
            $.each(challanDetail,function(index,data){  
              console.log(data);
              var nextid = $("#serialNumber").val();
                tbl_inventoryIssue.row.add( [
                '<input type="text" id="'+nextid+'" name="sno[]" value="'+$("#serialNumber").val()+'">',
                '<input type="text" id="iteamRowId'+nextid+'" value="'+data.iteam_name+'" readonly> <input type="hidden" id="S'+nextid+'" name="add_Sales_Quality_Name_Id[]" value="'+data.iteam_master_id_PK+'">',
                '<input type="text" id="'+nextid+'" name="add_Sales_Description_Id[]" value="'+data.discription+'" readonly> ',
                '<input type="text" id="'+nextid+'" name="add_Sales_Piece_Id[]" class="add_Sales_Piece_Id" value="'+data.piece+'" readonly>',
                '<input type="text" id="'+nextid+'" name="add_Sales_cut_One_Id[]" class="add_Sales_cut_One_Id" value="'+data.cut+'" readonly> ',
                '<input type="text" id="'+nextid+'" name="add_Sales_Qty_Id[]" value="'+data.quantity+'" readonly>',
                '<input type="text" id="'+nextid+'" name="add_Sales_PM_Id[]" value="'+data.pm+'" readonly>',
                '<input type="text" id="'+nextid+'" name="add_Sales_Rate_Id[]" value="'+data.rate+'" readonly>',
                '<input type="text" id="'+nextid+'" name="add_Sales_Disc_Id[]" value="" readonly>',
                '<input type="text" id="'+nextid+'" name="add_Sales_Less_Id[]" value="" readonly>',
                '<input type="text" id="'+nextid+'" name="add_Sales_Amount_Id[]" class="add_Sales_Amount_Id" value="'+data.amount+'" readonly>',
                '<input type="text" id="'+nextid+'" name="add_Sales_Sgst_Id[]" class="add_Sales_Sgst_Id" value="'+data.sgst+'" readonly>',
                '<input type="text" id="'+nextid+'" name="add_Sales_Cgst_Id[]" class="add_Sales_Cgst_Id" value="'+data.cgst+'" readonly>',
                '<input type="text" id="netAmountTableRow'+nextid+'" name="add_Sales_Net_Amt_Id[]" class="add_Sales_Net_Amt_Id" value="'+totalNetAmount+'" readonly>',
                '<input type="text" id="'+nextid+'" name="add_Sales_Net_Rate_Id[]" value="" readonly>',
                '<input type="text" id="'+nextid+'" name="add_Sales_Rs_Id[]" value="" readonly>',
               //  '<input type="text" id="'+nextid+'" name="add_Sales_Sgst_Id[]" value="'+data+'" readonly>',
               // '<input type="text" id="'+nextid+'" name="add_Sales_Cgst_Id[]" value="'+data+'" readonly>',
                ] ).node().id = nextid;

      
               tbl_inventoryIssue.draw( false );
                     

             });
                 
       $("#add_Sales_Deli_Value_Id").val(salesDataChallan.all().partyName);
       //$("#salesDelivery_row_id").val("");
       $("#salesDelivery_row_id").attr("data-id", salesDataChallan.all().accountMaster_id_PK);
       $("#salesDelivery_row_id").attr("data-text",salesDataChallan.all().partyName );
      
       $("#add_Sales_Consignee_Code_Id").val(salesDataChallan.all().partyName);
       //$("#salesMillParty_row_id").val("");
       $("#salesConsignee_row_id").attr("data-id", salesDataChallan.all().accountMaster_id_PK);
       $("#salesConsignee_row_id").attr("data-text",salesDataChallan.all().partyName );
      


       $("#add_Sales_PartyName_Id").val(salesDataChallan.all().partyName);
       //$("#salesMillParty_row_id").val("");
       $("#salesMillParty_row_id").attr("data-id", salesDataChallan.all().accountMaster_id_PK);
       $("#salesMillParty_row_id").attr("data-text",salesDataChallan.all().partyName );
      
       $("#add_Sales_Broker_Id").val(salesDataChallan.all().broker_name);
       //$("#salesBroker_row_id").val(salesDataChallan.all().broker_id_PK);
       $("#salesBroker_row_id").attr("data-id", salesDataChallan.all().broker_id_PK);
       $("#salesBroker_row_id").attr("data-text", salesDataChallan.all().broker_name);

       $("#add_Sales_Transport_Id").val(salesDataChallan.all().transport_name);
       //$("#salesTransport_row_id").val(salesDataChallan.all().transport_id_PK);
       $("#salesTransport_row_id").attr("data-id", salesDataChallan.all().transport_id_PK);
       $("#salesTransport_row_id").attr("data-text", salesDataChallan.all().transport_name);


        $('.add_Sales_Amount_Id').each(function(){
           array_totalNetAmount.push(this.value);
        });

        $('.add_Sales_Sgst_Id').each(function(){
           array_sgst.push(this.value);
          });

        $('.add_Sales_Cgst_Id').each(function(){
           array_cgst.push(this.value);
          });

             
            
        $.each(array_totalNetAmount,function(index,data){  
         
          var totalNetAmt=array_totalNetAmount[index];
          var resultSgst=parseFloat(array_totalNetAmount[index])*parseFloat(array_sgst[index])/100;
          var resultCgst=parseFloat(array_totalNetAmount[index])*parseFloat(array_cgst[index])/100;
          
          var totalNetAmountsResult=parseFloat(resultSgst)+parseFloat(resultCgst)+parseFloat(totalNetAmt);
          $('#netAmountTableRow'+(index+1)).val(totalNetAmountsResult);

          sgstResult=sgstResult+resultSgst;
          cgstResult=cgstResult+resultCgst;
          totalResult=sgstResult+cgstResult;
          totalNetAmounts=totalNetAmountsResult;
        });
           
            $('#add_Sales_Sgst_Sales_Id').val(sgstResult);
            $('#add_Sales_Cgst_Sales_Id').val(cgstResult);
            salesAmountAddation();
            salesTotalPieceAddation();
            salesTotalMeterAddation();

            var amount=$('#add_Sales_Basic_Amt_Id').val();
            var sgstTotal=$('#add_Sales_Sgst_Sales_Id').val();
            var cgstTotal=$('#add_Sales_Cgst_Sales_Id').val();
            var tatalBill=parseFloat(amount)+parseFloat(sgstTotal)+parseFloat(cgstTotal);

            $('#add_Sales_Bill_Amout_Id').val(tatalBill);
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
     
     addValidationSales();

    if ($("#salesform").validate().element('#add_Sales_Quality_Name_Id') == false || 
      $("#salesform").validate().element('#add_Sales_Description_Id') == false ||
      $("#salesform").validate().element('#add_Sales_Piece_Id') == false||
      $("#salesform").validate().element('#add_Sales_cut_One_Id') == false||
      $("#salesform").validate().element('#add_Sales_Qty_Id') == false||
      $("#salesform").validate().element('#add_Sales_PM_Id') == false||
      $("#salesform").validate().element('#add_Sales_Rate_Id') == false||
      $("#salesform").validate().element('#add_Sales_Disc_Id') == false||
      $("#salesform").validate().element('#add_Sales_Less_Id') == false|| 
      $("#salesform").validate().element('#add_Sales_Amount_Id') == false|| 
      $("#salesform").validate().element('#add_Sales_Sgst_Id') == false|| 
      $("#salesform").validate().element('#add_Sales_Cgst_Id') == false||
      $("#salesform").validate().element('#add_Sales_Net_Amt_Id') == false||
      $("#salesform").validate().element('#add_Sales_Net_Rate_Id') == false||
      $("#salesform").validate().element('#add_Sales_Rs_Id') == false||
      $("#salesform").validate().element('#add_Sales_Sgst_Id') == false||
      $("#salesform").validate().element('#add_Sales_Cgst_Id') == false)
    {

    }else
    {

      var nextid = $("#serialNumber").val();

      tbl_inventoryIssue.row.add( [
       '<input type="text" id="'+nextid+'" name="sno[]" value="'+$("#serialNumber").val()+'">',
       '<input type="text" id="'+nextid+'" value="'+$("#add_Sales_Quality_Name_Id").val()+'" readonly> <input type="hidden" id="S'+nextid+'" name="add_Sales_Quality_Name_Id[]" value="'+salesDataQuality.id()+'">',
       '<input type="text" id="'+nextid+'" name="add_Sales_Description_Id[]" value="'+$("#add_Sales_Description_Id").val()+'" readonly> ',
       '<input type="text" id="'+nextid+'" name="add_Sales_Piece_Id[]" class="add_Sales_Piece_Id" value="'+$("#add_Sales_Piece_Id").val()+'" readonly>',
        '<input type="text" id="'+nextid+'" name="add_Sales_cut_One_Id[]" class="add_Sales_cut_One_Id" value="'+$("#add_Sales_cut_One_Id").val()+'" readonly> ',
       '<input type="text" id="'+nextid+'" name="add_Sales_Qty_Id[]" value="'+$("#add_Sales_Qty_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Sales_PM_Id[]" value="'+$("#add_Sales_PM_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Sales_Rate_Id[]" value="'+$("#add_Sales_Rate_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Sales_Disc_Id[]" value="'+$("#add_Sales_Disc_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Sales_Less_Id[]" value="'+$("#add_Sales_Less_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Sales_Amount_Id[]" class="add_Sales_Amount_Id" value="'+$("#add_Sales_Amount_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Sales_Sgst_Id[]" value="'+$("#add_Sales_Sgst_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Sales_Cgst_Id[]" value="'+$("#add_Sales_Cgst_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Sales_Net_Amt_Id[]" class="add_Sales_Net_Amt_Id" value="'+$("#add_Sales_Net_Amt_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Sales_Net_Rate_Id[]" value="'+$("#add_Sales_Net_Rate_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Sales_Rs_Id[]" value="'+$("#add_Sales_Rs_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Sales_Sgst_Id[]" value="'+$("#add_Sales_Sgst_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Sales_Cgst_Id[]" value="'+$("#add_Sales_Cgst_Id").val()+'" readonly>',
        ] ).node().id = nextid;

       // $("#add_Sales_Quality_Name_Id").val("");
       // $("#salesReceiveQuality_row_id").val("");
       // $("#salesReceiveQuality_row_id").attr("data-id", "");
       // $("#salesReceiveQuality_row_id").attr("data-text", "");
        

       // $("#add_Sales_PartyName_Id").val(salesDataChallan.all().partyName);
       // $("#salesMillParty_row_id").val(salesDataChallan.all().accountMaster_id_PK);
       // $("#salesMillParty_row_id").attr("data-id", salesDataChallan.all().accountMaster_id_PK);
       // $("#salesMillParty_row_id").attr("data-text", salesDataChallan.all().partyName);

       // $("#add_Sales_Broker_Id").val(salesDataChallan.all().broker_name);
       // $("#salesBroker_row_id").val(salesDataChallan.all().broker_id_PK);
       // $("#salesBroker_row_id").attr("data-id", salesDataChallan.all().broker_id_PK);
       // $("#salesBroker_row_id").attr("data-text", salesDataChallan.all().broker_name);

       // $("#add_Sales_Transport_Id").val(salesDataChallan.all().transport_name);
       // $("#salesTransport_row_id").val(salesDataChallan.all().transport_id_PK);
       // $("#salesTransport_row_id").attr("data-id", salesDataChallan.all().transport_id_PK);
       // $("#salesTransport_row_id").attr("data-text", salesDataChallan.all().transport_name);

      
    tbl_inventoryIssue.draw( false );

      $('#add_Sales_Quality_Name_Id').val("");
      $('#add_Sales_Description_Id').val("");
      $('#add_Sales_No_Id').val("");
      $('#add_Sales_No_One_Id').val("");
      $('#add_Sales_Qty_Id').val("");
      $('#add_Sales_PM_Id').val("");
      $('#add_Sales_Rate_Id').val("");
      $('#add_Sales_Disc_Id').val("");
      $('#add_Sales_Less_Id').val("");
      $('#add_Sales_Amount_Id').val("");
      $('#add_Sales_Sgst_Id').val("");
      $('#add_Sales_Cgst_Id').val("");
      $('#add_Sales_Net_Amt_Id').val("");
      $('#add_Sales_Net_Rate_Id').val("");
      $('#add_Sales_Rs_Id').val("");
      $('#add_Sales_Sgst_Id').val("");
      $('#add_Sales_Cgst_Id').val("");
    }
        salesNetAmountAddation();
 
    } );
} );

$(document).ready(function(){
    var x = $('#add_Sales_Book_Code_Id').val();
    bookList(x);

   $('#salessMaster').on('click', function () {
        
        removeValidationSales();

        if ($('#salesform').valid())
        {
            addSalesMasterToServer();
        }
    });


$('#add_Sales_Book_Code_Id').selectpicker('refresh');

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
              $('#add_Sales_Book_Code_Id').append('<option value="'+data['book_id_PK']+'" selected>'+data['sales_account_name']+'</option>');
          }else{
              $('#add_Sales_Book_Code_Id').append('<option value="'+data['book_id_PK']+'">'+data['sales_account_name']+'</option>');
          }
        });
                 
       $('#add_Sales_Book_Code_Id').selectpicker('refresh');

      }
  });
}

  });

function addSalesMasterToServer(){
  var salesToServerdata = new FormData(document.getElementById("salesform"));
   salesToServerdata.append('add_Sales_PartyName_Id', salesDataMillParty.id());
   salesToServerdata.append('add_Sales_Broker_Id', salesDataBroker.id());
   salesToServerdata.append('add_Sales_Transport_Id', salesDataTransport.id());
   salesToServerdata.append('add_Sales_Chalan_No_Id', salesDataChallan.id());
   salesToServerdata.append('add_Sales_Deli_Value_Id', salesDataDilivery.id());
   salesToServerdata.append('add_Sales_Consignee_Code_Id', salesDataConsignee.id());

      // AJAX request
    $.ajax({
      url:'<?=base_url()?>SalesController/insertSalesMaster',
      method: 'post',
      data: salesToServerdata,
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
                              text: "Sales is successfully added",
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
function salesBookReferesh(){
  bookList();
}

function addValidationSales(){
  $("#add_Sales_Quality_Name_Id").prop('required',true);
  $("#add_Sales_Description_Id").prop('required',true);
  $("#add_Sales_Piece_Id").prop('required',true);
  $("#add_Sales_cut_One_Id").prop('required',true);
  $("#add_Sales_Qty_Id").prop('required',true);
  $("#add_Sales_PM_Id").prop('required',true);
  $("#add_Sales_Rate_Id").prop('required',true);
  $("#add_Sales_Disc_Id").prop('required',true);
  $("#add_Sales_Less_Id").prop('required',true);
  $("#add_Sales_Amount_Id").prop('required',true);
  $("#add_Sales_Sgst_Id").prop('required',true);
  $("#add_Sales_Cgst_Id").prop('required',true);
  $("#add_Sales_Net_Amt_Id").prop('required',true);
  $("#add_Sales_Net_Rate_Id").prop('required',true);
  $("#add_Sales_Rs_Id").prop('required',true);
}

function removeValidationSales(){
    $('#add_Sales_Quality_Name_Id').removeAttr('required');
    $('#add_Sales_Description_Id').removeAttr('required');
    $('#add_Sales_Piece_Id').removeAttr('required');
    $('#add_Sales_cut_One_Id').removeAttr('required');
    $('#add_Sales_Qty_Id').removeAttr('required');
    $('#add_Sales_PM_Id').removeAttr('required');
    $('#add_Sales_Rate_Id').removeAttr('required');
    $('#add_Sales_Disc_Id').removeAttr('required');
    $('#add_Sales_Less_Id').removeAttr('required');
    $('#add_Sales_Amount_Id').removeAttr('required');
    $('#add_Sales_Sgst_Id').removeAttr('required');
    $('#add_Sales_Cgst_Id').removeAttr('required');
    $('#add_Sales_Net_Amt_Id').removeAttr('required');
    $('#add_Sales_Net_Rate_Id').removeAttr('required');
    $('#add_Sales_Rs_Id').removeAttr('required');
}

// function salesNetAmountAddation(){
//   var totalNetAmount = 0;
//   $('.add_Sales_Net_Amt_Id').each(function(){
//            var tempVal = this.value;
//            if(tempVal == 0){
//              //invalid = true;
//            }else
//            {
//             totalNetAmount = parseFloat(totalNetAmount) + parseFloat(tempVal);
//            }
//   });

//    $('#add_Sales_Basic_Amt_Id').val(totalNetAmount);
//              //console.log("totalNetAmountAmount : " + totalNetAmount);
// }

// function salesSgstAddation(){
//   var totalNetAmount = 0;
//   $('.add_Sales_Sgst_Id').each(function(){
//            var tempVal = this.value;
//            if(tempVal == 0){
//              //invalid = true;
//            }else
//            {
//             totalNetAmount = parseFloat(totalNetAmount) + parseFloat(tempVal);
//            }
//   });

//    //$('#add_Sales_Basic_Amt_Id').val(totalNetAmount);
//              console.log("totalNetAmount : " + totalNetAmount);
// }

// function salesCgstAddation(){
//   var totalNetAmount = 0;
//   $('.add_Sales_Cgst_Id').each(function(){
//            var tempVal = this.value;
//            if(tempVal == 0){
//              //invalid = true;
//            }else
//            {
//             totalNetAmount = parseFloat(totalNetAmount) + parseFloat(tempVal);
//            }
//   });

//    //$('#add_Sales_Basic_Amt_Id').val(totalNetAmount);
//              console.log("totalNetAmountCgst : " + totalNetAmount);
// }

function salesAmountAddation(){
  var totalNetAmount = 0;
  $('.add_Sales_Net_Amt_Id').each(function(){
           var tempVal = this.value;
           if(tempVal == 0){
             //invalid = true;
           }else
           {
            totalNetAmount = parseFloat(totalNetAmount) + parseFloat(tempVal);
           }
  });

         $('#add_Sales_Basic_Amt_Id').val(totalNetAmount);
             console.log("totalAmount : " + totalNetAmount);
}

function salesTotalMeterAddation(){
  var totalNetAmount = 0;
  $('.add_Sales_cut_One_Id').each(function(){
           var tempVal = this.value;
           if(tempVal == 0){
             //invalid = true;
           }else
           {
            totalNetAmount = parseFloat(totalNetAmount) + parseFloat(tempVal);
           }
  });

         $('#add_Sales_Mtrs_Id').val(totalNetAmount);
             console.log("totalMeter : " + totalNetAmount);
}

function salesTotalPieceAddation(){
  var totalNetAmount = 0;
  $('.add_Sales_Piece_Id').each(function(){
           var tempVal = this.value;
           if(tempVal == 0){
             //invalid = true;
           }else
           {
            totalNetAmount = parseFloat(totalNetAmount) + parseFloat(tempVal);
           }
  });

         $('#add_Sales_Tot_Pcs_Id').val(totalNetAmount);
             console.log("totalPiece : " + totalNetAmount);
}

function salesCommonCalculation(){
  var quantity=$('#add_Sales_Qty_Id').val();
  var rate=$("#add_Sales_Rate_Id").val();
  var discount=$("#add_Sales_Disc_Id").val();
  var sgst=$("#add_Sales_Sgst_Id").val();
  var cgst=$("#add_Sales_Cgst_Id").val();
  
  var salse_sgst=$("#add_Sales_Sgst_Sales_Id").val();
  var sales_cgst=$("#add_Sales_Cgst_Sales_Id").val();
  
  var basicAmount=$("#add_Sales_Basic_Amt_Id").val();

// Set Amount
var amount=parseFloat(quantity) * parseFloat(rate);
// Get Amount
var totalamount = $("#add_Sales_Amount_Id").val();

if(rate=="" || quantity==""){

}else{
    var result=parseFloat(quantity)*parseFloat(rate);
    $("#add_Sales_Amount_Id").val(result);
}
if(discount==""){

}else{
    var disResult=parseFloat(discount)*parseFloat(amount)/100;
    var resultSet=parseFloat(amount)-parseFloat(disResult);
    $("#add_Sales_Amount_Id").val(resultSet);
}
if(sgst=="" || quantity=="" || rate==""){
  
}else{

    var sgstResult=parseFloat(sgst)*parseFloat(totalamount)/100;
    var resultSet=parseFloat(totalamount)+parseFloat(sgstResult);
    $("#add_Sales_Net_Amt_Id").val(resultSet);

} 
if(cgst==""){
 
}else{
    var cgstResult=parseFloat(cgst)*parseFloat(totalamount)/100;
    var resultSet=parseFloat(totalamount)+parseFloat(cgstResult);
    
    $("#add_Sales_Net_Amt_Id").val(resultSet);
  
}

  if(amount==""){
   }else{
    var cgstResult=parseFloat(cgst == "" ? "0" : cgst)*parseFloat(totalamount)/100;
    var sgstResult=parseFloat(sgst == "" ? "0" : sgst)*parseFloat(totalamount)/100;
    var resultSetAmount=parseFloat(totalamount)+parseFloat(sgstResult)+parseFloat(cgstResult);
    $("#add_Sales_Net_Amt_Id").val(resultSetAmount);
  }


  var salesCgstResult=parseFloat(sales_cgst == "" ? "0" : sales_cgst)*parseFloat(basicAmount)/100;
  var salesSgstResult=parseFloat(salse_sgst == "" ? "0" : salse_sgst)*parseFloat(basicAmount)/100;
  var resultSetAmount=parseFloat(basicAmount)+parseFloat(salesCgstResult)+parseFloat(salesSgstResult);
  $("#add_Sales_Bill_Amout_Id").val(resultSetAmount);

} 


function tdsCalculation(){
  var amount=$('#add_Sales_Basic_Amt_Id').val();
  var sgstTotal=$('#add_Sales_Sgst_Sales_Id').val();
  var cgstTotal=$('#add_Sales_Cgst_Sales_Id').val();
  var tds=$('#add_Sales_T_D_S_Rate_Code_Id').val();
  var tatalBill=parseFloat(amount)+parseFloat(sgstTotal)+parseFloat(cgstTotal);

if(tds=="" || tds==0){
$('#add_Sales_Bill_Amout_Id').val('0');
$('#add_Sales_Bill_Amout_Id').val(tatalBill);
}else{
  var tdsResult=parseFloat(tatalBill)*parseFloat(tds)/100;
  $('#add_Sales_T_D_S_Rate_Value_Id').val(tdsResult);
  var result=parseFloat(tatalBill)+parseFloat(tdsResult);
  $('#add_Sales_Bill_Amout_Id').val(result);
}
}

$("#add_Sales_Qty_Id").keyup(function(){
   salesCommonCalculation();
});

$("#add_Sales_Rate_Id").keyup(function(){
   salesCommonCalculation();
});

$("#add_Sales_Disc_Id").keyup(function(){
   salesCommonCalculation();
});

$("#add_Sales_Sgst_Id").keyup(function(){
   salesCommonCalculation();
});

$("#add_Sales_Cgst_Id").keyup(function(){
   salesCommonCalculation();
});

$("#add_Sales_Sgst_Sales_Id").keyup(function(){
   salesCommonCalculation();
});

$("#add_Sales_Cgst_Sales_Id").keyup(function(){
   salesCommonCalculation();
});

$("#add_Sales_cut_One_Id").keyup(function(){
   salesCommonCalculation();
});

$("#add_Sales_T_D_S_Rate_Code_Id").keyup(function(){
   tdsCalculation();
});

</script>



