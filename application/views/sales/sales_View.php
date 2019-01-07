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
           <form id="salesform">
                    <div class="row">

    <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
                  <div class="col-md-4 form-group">
                      <label >Book  </label>
                        
                           <input type="text" class="form-control" name="add_Sales_Book_Code_Id" id="add_Sales_Book_Code_Id" placeholder="Enter Sales Book" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Book_Code_Id ') ?>

                        </div>
                      
                      
                      
                          <div class="col-md-1 form-group">
                             <label ></label>
                        
                            <input type="text" class="form-control" name="add_Sales_Book_Value_Id" id="add_Sales_Book_Value_Id" placeholder="" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Sales_Book_Value_Id') ?>
        
                          
                          </div>
                           
                        
                          <div class="col-md-2 form-group">
                            <label>Firm Bal.: </span> </label>
                           <input type="text" class="form-control " name="add_Sales_Firm_Bal_Id" id="add_Sales_Firm_Bal_Id" placeholder="Enter Sales Firm Bal" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Sales_Firm_Bal_Id') ?>
                          </div>
                       <div class="col-md-3 form-group">
                            <label>Party Bal.:</label>
                        
                            <input type="text" class="form-control" name="add_Sales_Party_Bal_Id" id="add_Sales_Party_Bal_Id" placeholder="Enter Sales Party Bal." autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Party_Bal_Id') ?>
                                       
                        </div>
                        <div class="col-md-2 form-group">
                            <label></label>
                        
                            <input type="text" class="form-control" name="add_Sales_Multi_Eway_Bill_Id" id="add_Sales_Party_Bal_Id" placeholder=" Multi Eway Bill" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Party_Bal_Id') ?>
                                       
                        </div>
                                                                     
                   </div>
                   <hr>
                              
                   <div class="row">
                        <div class="col-md-2 form-group">
                            <label> Bill No</label>
                        
                            <input type="text" class="form-control " name="add_Sales_Bill_No_Id" id="add_Sales_Bill_No_Id" placeholder="Enter Sales  Bill No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Bill_No_Id') ?>
                                       
                        </div>

                        <div class="col-md-2 form-group">
                            <label>Bill Date </label>
                        
                            <input type="Date" class="form-control" name="add_Sales_Bill_Date_Id" id="add_Sales_Bill_Date_Id" placeholder="Enter Sales Bill Date " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Bill_Date_Id') ?>
                                       
                        </div>
                        
                      
                        <div class="col-md-2 form-group">
                            <label>Inv.Type(T/R) </label>
                        
                            <input type="text" class="form-control " name="add_Sales_Inv_Type_Id" id="add_Sales_Inv_Type_Id" placeholder=" Enter Sales Inv Type" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Inv_Type_Id') ?>
                            </div>
                            <div class="col-md-2 form-group">
                            <label>Chalan No </label>
                        
                            <input type="text" class="form-control " name="add_Sales_Chalan_No_Id" id="add_Sales_Chalan_No_Id" placeholder=" Enter Sales Chalan No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Chalan_No_Id') ?>
                            </div>
                            <div class="col-md-2 form-group">
                            <label>Dt. </label>
                        
                            <input type="Date" class="form-control " name="add_Sales_Dt_Id" id="add_Sales_Dt_Id" placeholder=" Enter Sales Dt." autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Dt_Id') ?>
                            </div>
                            <div class="col-md-2 form-group">
                            <label>D.O.No </label>
                        
                            <input type="text" class="form-control " name="add_Sales_D_O_No_Id" id="add_Sales_D_O_No_Id" placeholder=" Enter Sales D.O.No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_D_O_No_Id') ?>
                          </div>
                      </div>           
                <div class="row">
                        
                    <div class="col-md-2 form-group">
                            <label>Party <span >  </span> </label>
                            <input type="text" class="form-control " name="add_Sales_Party_Id" id="add_Sales_Party_Id" placeholder="Enter Sales Party" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('add_Sales_Party_Id') ?>
                          </div>
                         
                    <div class="col-md-8 form-group">
                            <label> </label>
                            <input type="text" class="form-control " name="add_Sales_Party_Id" id="add_Sales_Party_Id" placeholder="Enter Sales Party " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Sales_Party_Id') ?>
                          </div>
                        
                         
                    <div class="col-md-2 form-group">
                            <label>Cr Days<span >  </span> </label>
                            <input type="text" class="form-control" name="add_Sales_Cr_Days_Id" id="add_Sales_Cr_Days_Id" placeholder="Enter Sales Cr Days" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Sales_Cr_Days_Id') ?>
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
                            <label> Broker </label>
                        
                            <input type="text" class="form-control " name="add_Sales_Broker_Id" id="add_Sales_Broker_Id" placeholder="Enter Sales Broker" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Broker_Id') ?>
                                       
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Veh No </label>
                        
                            <input type="text" class="form-control " name="add_Sales_Veh_No_Id" id="add_Sales_Veh_No_Id" placeholder="Enter Sales Veh No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Veh_No_Id') ?>
                                       
                        </div>
                        </div>
                        <div class="row">
                        
                    <div class="col-md-2 form-group">
                            <label>L.R.No. <span >  </span> </label>
                            <input type="text" class="form-control " name="add_Sales_L_R_No_Id" id="add_Sales_L_R_No_Id" placeholder="Enter Sales L R No" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('add_Sales_L_R_No_Id') ?>
                          </div>
                         
                    <div class="col-md-2 form-group">
                            <label> L.R.Dt. </label>
                            <input type="Date" class="form-control " name="add_Sales_L_R_Dt_Id" id="add_Sales_L_R_Dt_Id" placeholder="Enter Sales L.R.Dt " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Sales_L_R_Dt_Id') ?>
                          </div>
                          <div class="col-md-3 form-group">
                            <label> Transport </label>
                            <input type="text" class="form-control " name="add_Sales_Transport_Id" id="add_Sales_Transport_Id" placeholder="Enter Sales Transport " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Sales_Transport_Id') ?>
                          </div>
                          <div class="col-md-2 form-group">
                            <label> Station </label>
                            <input type="text" class="form-control " name="add_Sales_Station_Id" id="add_Sales_Station_Id" placeholder="Enter Sales Station " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Sales_Station_Id') ?>
                          </div>
                          <div class="col-md-3 form-group">
                            <label> Trans ID </label>
                            <input type="text" class="form-control " name="add_Sales_Trans_Id" id="add_Sales_Trans_Id" placeholder="Enter Sales Trans ID " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Sales_Trans_Id') ?>
                          </div>
                        </div>

                         <div class="row">
                        
                    <div class="col-md-2 form-group">
                            <label>Packing <span >  </span> </label>
                            <input type="text" class="form-control " name="add_Sales_Packing_Id" id="add_Sales_Packing_Id" placeholder="Enter Sales Packing" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('add_Sales_Packing_Id') ?>
                          </div>
                          <div class="col-md-2 form-group">
                          <label>Case No <span >  </span> </label>
                            <input type="text" class="form-control " name="add_Sales_Case_No_Id" id="add_Sales_Case_No_Id" placeholder="Enter Sales Case No" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('add_Sales_Case_No_Id') ?>
                          </div>
                          <div class="col-md-1 form-group">
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
            </div>
        </div>
<div class="row">
    <div class="col-md-1 form-group">
        <label>S.No </label>
               <input type="text" class="form-control " name="add_Sales_S_No_Id" id="add_Sales_S_No_Id" placeholder="Sr No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_S_No_Id') ?>
       </div>
    <div class="col-md-3 form-group">
       <label>Quality Name </label>
            <input type="text" class="form-control " name="add_Sales_Quality_Name_Id" id="add_Sales_Quality_Name_Id" placeholder="Qty Name " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Quality_Name_Id') ?>
      </div>
   <div class="col-md-2 form-group">
        <label>Description </label>
            <input type="text" class="form-control " name="add_Sales_Description_Id" id="add_Sales_Description_Id" placeholder="Description" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Description_Id') ?>
     </div>
   <div class="col-md-1 form-group">
        <label>No </label>
           <input type="text" class="form-control " name="add_Sales_No_Id" id="add_Sales_No_Id" placeholder="No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_No_Id') ?>
        </div>
     <div class="col-md-1 form-group">
           <label>No </label>
                <input type="text" class="form-control " name="add_Sales_No_One_Id" id="add_Sales_No_One_Id" placeholder="No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_No_One_Id') ?>
        </div>
      <div class="col-md-1 form-group">
           <label>Qty </label>
                <input type="text" class="form-control " name="add_Sales_Qty_Id" id="add_Sales_Qty_Id" placeholder="Qty" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Qty_Id') ?>
        </div>
      <div class="col-md-1 form-group">
          <label>PM </label>
              <input type="text" class="form-control " name="add_Sales_PM_Id" id="add_Sales_PM_Id" placeholder="PM" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_PM_Id') ?>
       </div>
    <div class="col-md-1 form-group">
          <label>Rate </label>
              <input type="text" class="form-control " name="add_Sales_Rate_Id" id="add_Sales_Rate_Id" placeholder="Rate" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Rate_Id') ?>
   </div>
     <div class="col-md-1 form-group">
            <label >Disc % </label>
                <input type="text" class="form-control " name="add_Sales_Disc_Id" id="add_Sales_Disc_Id" placeholder="Disc" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Disc_Id') ?>
        </div>
     </div>
  <div class="row">
    <div class="col-md-1 form-group">
       <label >Less % </label>
             <input type="text" class="form-control " name="add_Sales_Less_Id" id="add_Sales_Less_Id" placeholder="Less" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Less_Id') ?>
       </div>
  <div class="col-md-2 form-group">
      <label >Amount </label>
         <input type="text" class="form-control " name="add_Sales_Amount_Id" id="add_Sales_Amount_Id" placeholder="Amount" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Amount_Id') ?>
      </div>
  <div class="col-md-1 form-group">
        <label >SGST </label>
            <input type="text" class="form-control " name="add_Sales_Sgst_Id" id="add_Sales_Sgst_Id" placeholder="SGST" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Sgst_Id') ?>
      </div>
  <div class="col-md-1 form-group">
    <label >CGST </label>
        <input type="text" class="form-control " name="add_Sales_Cgst_Id" id="add_Sales_Cgst_Id" placeholder="CGST" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Cgst_Id') ?>
      </div>
  <div class="col-md-1 form-group">
        <label >Net Amt </label>
          <input type="text" class="form-control " name="add_Sales_Net_Amt_Id" id="add_Sales_Net_Amt_Id" placeholder="Net Amt " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Net_Amt_Id') ?>
      </div>
<div class="col-md-1 form-group">
      <label >Net Rate </label>
          <input type="text" class="form-control " name="add_Sales_Net_Rate_Id" id="add_Sales_Net_Rate_Id" placeholder="Net Rate" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Net_Rate_Id') ?>
      </div>
  <div class="col-md-1 form-group">
       <label>Rs.</label>
          <input type="text" class="form-control " name="add_Sales_Rs_Id" id="add_Sales_Rs_Id" placeholder="Rs" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Rs_Id') ?>
        </div>
   <div class="col-md-1 form-group">
        <label>  </label>
            <input type="text" class="form-control " name="add_Sales_Rs_Id" id="add_Sales_Rs_Id" placeholder="Rs" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Sales_Rs_Id') ?>
        </div>
  <div class="col-md-1 form-group">
         <label>SGST</label>
             <input type="text" class="form-control" name="add_Sales_Sgst_Id" id="add_Sales_Sgst_Id" placeholder="SGST " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Sales_Sgst_Id') ?>
       </div>
 <div class="col-md-1 form-group">
        <label>CGST </label>
             <input type="text" class="form-control" name="add_Sales_Cgst_Id" id="add_Sales_Cgst_Id" placeholder="GST" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Sales_Cgst_Id') ?>
      </div>
   <div class="col-md-1 form-group">
          <a name="add_Detail"  id="add_Detail" class="btn btn-primary">Add</a>
    </div>
  </div>
  <table id="tbl_inventoryIssue" class="display responsive" >
            <thead>
              <tr bgcolor="silver">
                  <th>S.No.</th>
                  <th>Quality Name</th>
                  <th>Description</th>
                  <th>No</th>
                  <th>No</th>
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
      <div class="col-md-1 form-group">
         <label >Tot PCS </label>
              <input type="text" class="form-control " name="add_Sales_Tot_Pcs_Id" id="add_Sales_Tot_Pcs_Id" placeholder="Enter Sales Tot PCS" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Tot_Pcs_Id') ?>
        </div>
  <div class="col-md-1 form-group">
          <label >Mtrs</label>
                <input type="text" class="form-control " name="add_Sales_Mtrs_Id" id="add_Sales_Mtrs_Id" placeholder="Enter Sales Mtrs" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Mtrs_Id') ?>
        </div>
    <div class="col-md-2 form-group">
           <label >CD Rs. </label>
                <input type="text" class="form-control " name="add_Sales_Cd_Rs_Id" id="add_Sales_Cd_Rs_Id" placeholder="Enter Sales CD Rs." autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Cd_Rs_Id') ?>
      </div>
          <div class="col-md-2 form-group">
             <label >Brk Rs. </label>
                  <input type="text" class="form-control " name="add_Sales_Brk_Rs_Id" id="add_Sales_Brk_Rs_Id" placeholder="Enter Sales Brk Rs" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Brk_Rs_Id') ?>
       </div>
    <div class="col-md-2 form-group">
        <label >Basic Amt </label>
             <input type="text" class="form-control " name="add_Sales_Basic_Amt_Id" id="add_Sales_Basic_Amt_Id" placeholder="Enter Sales Basic Amt" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Basic_Amt_Id') ?>
       </div>
  <div class="col-md-2 form-group">
     <label >SGST </label>
         <input type="text" class="form-control " name="add_Sales_Sgst_Sales_Id" id="add_Sales_Sgst_Sales_Id" placeholder="Enter Sales SGST" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Sgst_Sales_Id') ?>
    </div>
  <div class="col-md-2 form-group">
    <label >CGST </label>
       <input type="text" class="form-control " name="add_Sales_Cgst_Sales_Id" id="add_Sales_Cgst_Sales_Id" placeholder="Enter Sales CGST" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Cgst_Sales_Id') ?>
        </div>
     </div>
<div class="row ">
    <div class="col-md-2 form-group">
         <label >Rate: </label>
         <label > Consignee </label>
             <input type="text" class="form-control " name="add_Sales_Consignee_Code_Id" id="add_Sales_Consignee_Code_Id" placeholder="Enter Sales Rate: Consignee" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Consignee_Code_Id') ?>
         </div>
    <div class="col-md-4 form-group">
           <label ></label>
                <input type="text" class="form-control " name="add_Sales_Consignee_Value_Id" id="add_Sales_Consignee_Value_Id" placeholder="Enter Sales Consignee" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Consignee_Value_Id') ?>
                          </div>
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
                            <input type="text" class="form-control " name="add_Sales_Desc_Id" id="add_Sales_Desc_Id" placeholder="Enter Sales Desc" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Desc_Id') ?>
                          </div>
                          
                      <div class="col-md-2 form-group">
                            <label >T.D.S. Rate </label>
                            <input type="text" class="form-control " name="add_Sales_T_D_S_Rate_Code_Id" id="add_Sales_T_D_S_Rate_Code_Id" placeholder="Enter Sales T.D.S. Rate " autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_T_D_S_Rate_Code_Id') ?>
               </div>
    <div class="col-md-2 form-group">
      <label > </label>
         <input type="text" class="form-control " name="add_Sales_T_D_S_Rate_Value_Id" id="add_Sales_T_D_S_Rate_Value_Id" placeholder="Enter Sales T.D.S. Rate " autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_T_D_S_Rate_Value_Id') ?>
      </div>
              <div class="col-md-2 form-group">
                    <label >Rnd Off. </label>
                       <input type="text" class="form-control " name="add_Sales_Rnd_Off_Code_Id" id="add_Sales_Rnd_Off_Code_Id" placeholder="Enter Sales Rnd Off." autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Rnd_Off_Code_Id') ?>
                          </div>
                        <div class="col-md-1 form-group">
                            <label > </label>
                            <input type="text" class="form-control " name="add_Sales_Rnd_Off_Value_Id" id="add_Sales_Rnd_Off_Value_Id" placeholder="Enter Sales Rnd Off" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Rnd_Off_Value_Id') ?>
                          </div>
                      <div class="col-md-2 form-group">
                            <label >Bill Amout </label>
                            <input type="text" class="form-control " name="add_Sales_Bill_Amout_Id" id="add_Sales_Bill_Amout_Id" placeholder="Enter Sales Bill Amout" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Sales_Bill_Amout_Id') ?>
                          </div>
                        </div>
                       </form>                  
                        <button name="add_operator" id="add_operator" class="btn btn-primary"><?php if($uid==""){echo "Add Sales Master";}else{echo "update Sales Master";} ?></button>
                      
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
    if ($("#salesform").validate().element('#add_Sales_Quality_Name_Id') == false || $("#salesform").validate().element('#add_Sales_Description_Id') == false || $("#salesform").validate().element('#add_Sales_No_Id') == false|| $("#salesform").validate().element('#add_Sales_No_One_Id') == false|| $("#salesform").validate().element('#add_Sales_Qty_Id') == false|| $("#salesform").validate().element('#add_Sales_PM_Id') == false|| $("#salesform").validate().element('#add_Sales_Rate_Id') == false|| $("#salesform").validate().element('#add_Sales_Disc_Id') == false|| $("#salesform").validate().element('#add_Sales_Less_Id') == false|| $("#salesform").validate().element('#add_Sales_Amount_Id') == false|| $("#salesform").validate().element('#add_Sales_Sgst_Id') == false|| $("#salesform").validate().element('#add_Sales_Cgst_Id') == false|| $("#salesform").validate().element('#add_Sales_Net_Amt_Id') == false|| $("#salesform").validate().element('#add_Sales_Net_Rate_Id') == false|| $("#salesform").validate().element('#add_Sales_Rs_Id') == false|| $("#salesform").validate().element('#add_Sales_Sgst_Id') == false|| $("#salesform").validate().element('#add_Sales_Cgst_Id') == false)
    {

    }else
    {

      var nextid = $("#serialNumber").val();

      tbl_inventoryIssue.row.add( [
       '<input type="text" id="'+nextid+'" name="sno[]" value="'+$("#serialNumber").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Sales_Quality_Name_Id[]" value="'+$("#add_Sales_Quality_Name_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Sales_Description_Id[]" value="'+$("#add_Sales_Description_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Sales_No_Id[]" value="'+$("#add_Sales_No_Id").val()+'">',
        '<input type="text" id="'+nextid+'" name="add_Sales_No_One_Id[]" value="'+$("#add_Sales_No_One_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Sales_Qty_Id[]" value="'+$("#add_Sales_Qty_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Sales_PM_Id[]" value="'+$("#add_Sales_PM_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Sales_Rate_Id[]" value="'+$("#add_Sales_Rate_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Sales_Disc_Id[]" value="'+$("#add_Sales_Disc_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Sales_Less_Id[]" value="'+$("#add_Sales_Less_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Sales_Amount_Id[]" value="'+$("#add_Sales_Amount_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Sales_Sgst_Id[]" value="'+$("#add_Sales_Sgst_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Sales_Cgst_Id[]" value="'+$("#add_Sales_Cgst_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Sales_Net_Amt_Id[]" value="'+$("#add_Sales_Net_Amt_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Sales_Net_Rate_Id[]" value="'+$("#add_Sales_Net_Rate_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Sales_Rs_Id[]" value="'+$("#add_Sales_Rs_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Sales_Sgst_Id[]" value="'+$("#add_Sales_Sgst_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="add_Sales_Cgst_Id[]" value="'+$("#add_Sales_Cgst_Id").val()+'">',
        ] ).node().id = nextid;
      
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
        
 
    } );
} );

</script>



