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
                 
            <a href="<?= base_url(); ?>ReceiveworkController" class="btn btn-primary">Back</a>

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

           <form id="receiveform" method="post">
           <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">

            <div class="row">
            <div class="col-md-6 form-group">
            <div class="row">
            <div class="col-md-7 form-group">
            <label >Book</label>
            <select id="receive_Work_Book_Code_Id" name="receive_Work_Book_Code_Id" class="form-control selectpicker" data-live-search="true" required>
              <option value="">--Select--</option>
            </select> 
            </div>
            <div class="col-md-2 form-group">
              <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BooksController/insertBook">Add</a>
            </div>
            <div class="col-md-3 form-group">
              <a class="now-ui-icons arrows-1_refresh-69" onclick="receiveWorkBookReferesh();">Referesh</a>
            </div>

            </div>
            </div>
            

        <!--     <div class="col-md-2 form-group">
              <label ></label>
             <input type="text" class="form-control" name="add_Receive_Work_Book_Value_Id" id="add_Receive_Work_Book_Value_Id" placeholder="" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Receive_Work_Book_Value_Id') ?>
            </div> -->

            <div class="col-md-3 form-group">
              <label> Bal.: </span> </label>
              <input type="text" class="form-control " name="add_Receive_Work_Bal_Id" id="add_Receive_Work_Bal_Id" placeholder="Enter Receive work Bal" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Receive_Work_Bal_Id') ?>
             </div>
          <div class="col-md-3 form-group">
              <label> Receive Challan No </label>
              <input type="text" class="form-control " name="add_Receive_Work_Receive_Challan_No_Id" id="add_Receive_Work_Receive_Challan_No_Id" placeholder="Enter Receive Challan No" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Receive_Work_Receive_Challan_No_Id') ?>
                 </div>
          </div>
          <hr>
           <div class="row">
              <div class="col-md-3 form-group">
                <label> G.P.Bill No</label>
                  <input type="text" class="form-control " name="add_Receive_Work_G_P_Bill_No_Id" id="add_Receive_Work_G_P_Bill_No_Id" placeholder="Enter Receive G.P.Bill No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Receive_Work_G_P_Bill_No_Id') ?>
                                       
            </div>
          <div class="col-md-3 form-group">
               <label>Challan No </label>
                 <input type="text" class="form-control" name="add_Receive_Work_Challan_No_Id" id="add_Receive_Work_Challan_No_Id" placeholder="Enter Receive Work Challan No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Receive_Work_Challan_No_Id') ?>
                                       
             </div>
        <div class="col-md-2 form-group">
               <label>Party </label>
                  <input type="text" class="form-control " name="add_Receive_Work_Party_Value_Id" id="add_Receive_Work_Party_Value_Id" placeholder=" Enter Receive Party" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Receive_Work_Party_Code_Id') ?>
             </div>
           <div class="col-md-4 form-group">
             <div class="row">
            <div class="col-md-10 form-group">
            <label></label>
              <input type="text" class="form-control " name="add_Receive_Work_Party_Code_Id" id="add_Receive_Work_Party_Code_Id" placeholder=" Enter Receive Party " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Receive_Work_Party_Value_Id') ?>
            </div>
            <div class="col-md-2 form-group">
            <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>AccountMasterController/insertAccountMaster">Add</a>
            </div>
            </div>
            </div>

         </div>           
       <div class="row">
          <div class="col-md-3 form-group">
              <label>Receive Date </label>
                 <input type="Date" class="form-control " name="add_Receive_Work_Receive_Date_Id" id="add_Receive_Work_Receive_Date_Id" placeholder="Enter Receive Date" autocomplete="off" required pattern="[a-zA-Z]+"> <?php echo form_error('add_Receive_Work_Receive_Date_Id') ?>
            </div>
        <div class="col-md-5 form-group">
           <div class="row">
          <div class="col-md-10 form-group">
          <label> Broker</label>
           <input type="text" class="form-control " name="add_Receive_Work_Broker_Id" id="add_Receive_Work_Broker_Id" placeholder="Enter Receive Broker " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Receive_Work_Broker_Id') ?>
        </div>
            <div class="col-md-2 form-group">
          <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BrokerController/insertBroker">Add</a>
          </div>
          </div>
          </div>
   <div class="col-md-2 form-group">
             <label>Cr. Days</label>
                <input type="text" class="form-control" name="add_Receive_work_Cr_Days_Id" id="add_Receive_work_Cr_Days_Id" placeholder="Enter Receive Cr. Days" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('add_Receive_work_Cr_Days_Id') ?>
         </div>
      </div>           
   <div class="row">
           <div class="col-md-3 form-group">
             <label>L.R.No. </label>
               <input type="text" class="form-control" name="add_Receive_Work_L_R_No_Id" id="add_Receive_Work_L_R_No_Id" placeholder="Enter L.R.No. " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Receive_Work_L_R_No_Id') ?>
        </div>
      <div class="col-md-3 form-group">
             <label>Tempo No </label>
               <input type="text" class="form-control" name="add_Receive_Work_Tempo_No_Id" id="add_Receive_Work_Tempo_No_Id" placeholder="Enter Tempo No. " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Receive_Work_Tempo_No_Id') ?>
          </div>
          <div class="col-md-4 form-group">
             <label>Transport</label>
               <input type="text" class="form-control" name="add_Receive_Work_Transport_Id" id="add_Receive_Work_Transport_Id" placeholder="Enter Transport " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Receive_Work_Transport_Id') ?>
          </div>
        </div>
        <hr>
  <div class="row">
      <div class="col-md-3 form-group">
           <label> Our Challan No.</label>
               <input type="text" class="form-control " name="add_Receive_Work_Our_Challan_No_Id" id="add_Receive_Work_Our_Challan_No_Id" placeholder="Enter Our Challan No." autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Receive_Work_Our_Challan_No_Id') ?>
         </div>
       <div class="col-md-3 form-group">
               <label> Lot No. </label>
                  <input type="text" class="form-control " name="add_Receive_Work_Lot_No_Id" id="add_Receive_Work_Lot_No_Id" placeholder="Enter Lot No." autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Receive_Work_Lot_No_Id') ?>
                                       
         </div>
      <div class="col-md-4 form-group">
             <label>Issue Quality </label>
                   <input type="text" class="form-control " name="add_Receive_Work_Issue_Quality_Id" id="add_Receive_Work_Issue_Quality_Id" placeholder="Enter Issue Quality" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Receive_Work_Issue_Quality_Id') ?>
                                       
                </div>
                <div class="col-md-1 form-group">
             <label>PCS</label>
                   <input type="text" class="form-control " name="add_Receive_Work_Pcs_Id" id="add_Receive_Work_Pcs_Id" placeholder="Enter PCS" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Receive_Work_Pcs_Id') ?>
                                       
                </div>
                <div class="col-md-1 form-group">
             <label>Mtrs </label>
                   <input type="text" class="form-control " name="add_Receive_Work_Mtrs_Id" id="add_Receive_Work_Mtrs_Id" placeholder="Enter Mtrs" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Receive_Work_Mtrs_Id') ?>
                                       
                </div>
            </div>
        <div style="border-style: inset; padding: 15px">
<div class="row">
    <div class="col-md-1 form-group">
        <label>S.No </label>
               <input type="text" class="form-control " name="serialNumber" id="serialNumber" placeholder="Sr No" autocomplete="off" required readonly> <?php echo form_error('serialNumber') ?>
       </div>
    <div class="col-md-3 form-group">
       <label> Receive Quality </label>
            <input type="text" class="form-control " id="add_Receive_Work_Receive_Quality_Id" placeholder=" Enter Receive Quality  " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Receive_Work_Receive_Quality_Id') ?>
      </div>
   <div class="col-md-2 form-group">
        <label>PCS/Taka </label>
            <input type="text" class="form-control " id="add_Receive_Pcs_Taka_Id" placeholder="PCS/Taka" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Receive_Pcs_Taka_Id') ?>
     </div>
   
     <div class="col-md-2 form-group">
           <label>Meters </label>
                <input type="text" class="form-control " id="add_Receive_Work_Meters_Id" placeholder="Meters" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Receive_Work_Meters_Id') ?>
        </div>
      <div class="col-md-2 form-group">
           <label>Short/Long </label>
                <input type="text" class="form-control " id="add_Receive_Work_Short_Long_Id" placeholder="Short/Long" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('add_Receive_Work_Short_Long_Id') ?>
        </div>
     
      <div class="col-md-2 form-group">
          <label>PM </label>
              <input type="text" class="form-control " id="add_Receive_Work_Pm_Id" placeholder="PM" autocomplete="off" required pattern="[0-9 ]+"> 
       </div>
       </div>
  <div class="row">
    <div class="col-md-2 form-group">
          <label>Rate </label>
              <input type="text" class="form-control " id="add_Receive_Work_Rate_Id" placeholder="Rate" autocomplete="off" required pattern="[0-9 ]+" > 
   </div>
   <div class="col-md-2 form-group">
        <label >Amount </label>
            <input type="text" class="form-control " id="add_Receive_Work_Amount_Id" placeholder="Amount" autocomplete="off" required pattern="[0-9 ]+" readonly> 
      </div>
     <div class="col-md-2 form-group">
            <label >Design </label>
                <input type="text" class="form-control " id="add_Receive_Work_Design_Id" placeholder="Design" autocomplete="off" required pattern="[0-9 ]+">
        </div>
    <div class="col-md-2 form-group">
       <label >Colour </label>
             <input type="text" class="form-control " id="add_Receive_Work_Colour_Id" placeholder="Colour" autocomplete="off" required pattern="[0-9 ]+"> 
       </div>
  <div class="col-md-2 form-group">
      <label >Finish</label>
         <input type="text" class="form-control " id="add_Receive_Work_Fin_Id" placeholder="Enter Receive Work Finish" autocomplete="off" required pattern="[0-9 ]+"> 
      </div>
  
   <div class="col-md-2 form-group">
          <a name="add_Detail"  id="add_Detail" class="btn btn-primary">Add</a>
    </div>
  </div>
</div>
<table id="tbl_inventoryIssue" class="display responsive" >
            <thead>

              <tr bgcolor="silver">
                  <th>S.No.</th>
                  <th>Receive Quality </th>
                  <th>PCS/Taka</th>
                  <th>Meters</th>
                  <th>Short/Long</th>
                  <th>PM</th>
                  <th>Rate</th>
                  <th>Amount</th>
                  <th>Design</th>
                  <th>Colour</th>
                  <th>Finish</th>
              </tr>
        </thead>
        <!-- <tbody style="overflow-y:auto; height:300px; width: 1050px; position:absolute">
      </tbody> -->
    </table>

<hr size="30">
<div class="row ">
      <div class="col-md-5 form-group">
         <label >(F9) Desc : </label>
              <input type="text" class="form-control " name="add_Receive_Work_F_Nine_Desc_Id" id="add_Receive_Work_F_Nine_Desc_Id" placeholder="Enter Receive F9 Desc" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Receive_Work_F_Nine_Desc_Id') ?>
        </div>
  <div class="col-md-1 form-group">
          <label >Disc %</label>
                <input type="text" class="form-control " name="add_Receive_Work_Disc_Code_Id" id="add_Receive_Work_Disc_Code_Id" placeholder="Enter Dics %" autocomplete="off" required pattern="[0-9]+"> 
        </div>
        <div class="col-md-2 form-group">
          <label ></label>
                <input type="text" class="form-control " name="add_Receive_Work_Disc_Value_Id" id="add_Receive_Work_Disc_Value_Id" placeholder="Enter Disc %" autocomplete="off" required pattern="[0-9]+" readonly>
        </div>
        <div class="col-md-2 form-group">
          <label >Other(+)</label>
                <input type="text" class="form-control " name="add_Receive_Work_Other_Plus_Id" id="add_Receive_Work_Other_Plus_Id" placeholder="Enter Other(+)" autocomplete="off" required pattern="[0-9]+">
        </div>
        <div class="col-md-2 form-group">
          <label >(-)</label>
                <input type="text" class="form-control " name="add_Receive_Work_Other_Minus_Id" id="add_Receive_Work_Other_Minus_Id" placeholder="Enter Other(-)" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Receive_Work_Other_Minus_Id') ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 form-group"></div>
          <div class="col-md-2 form-group">

          <label >T.D.S. Rate</label>
                <input type="text" class="form-control " name="add_Receive_Work_T_D_S_Rate_Code_Id" id="add_Receive_Work_T_D_S_Rate_Code_Id" placeholder="Enter T.D.S. Rate" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Receive_Work_T_D_S_Rate_Code_Id') ?>
        </div>
        <div class="col-md-2 form-group">
          <label ></label>
                <input type="text" class="form-control " name="add_Receive_Work_T_D_S_Rate_Value_Id" id="add_Receive_Work_T_D_S_Rate_Value_Id" placeholder="Enter T.D.S. Rate" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Receive_Work_T_D_S_Rate_Value_Id') ?>
        </div>
         </div>
      <div class="row">
        <div class="col-md-8 form-group"></div>
    <!--     <div class="col-md-2 form-group">
          <label >(+)</label>
                <input type="text" class="form-control " name="add_Receive_Work_T_D_S_Rate_Plus_Id" id="add_Receive_Work_T_D_S_Rate_Plus_Id" placeholder="Enter T.D.S. Rate Plus" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Receive_Work_T_D_S_Rate_Plus_Id') ?>
        </div>
        <div class="col-md-2 form-group">
          <label >(-)</label>
                <input type="text" class="form-control " name="add_Receive_Work_T_D_S_Rate_Minus_Id" id="add_Receive_Work_T_D_S_Rate_Minus_Id" placeholder="Enter T.D.S. Rate Minus" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('add_Receive_Work_T_D_S_Rate_Minus_Id') ?>
        </div> -->
        </div>
        <div class="row">
             <div class="col-md-6 form-group">
          <label >Total Add Amount</label>
                <input type="text" class="form-control " name="add_Receive_Work_Bill_totalAmount_Id" id="add_Receive_Work_Bill_totalAmount_Id" placeholder="Enter Total Bill Amount" autocomplete="off" required pattern="[0-9]+" readonly>
        </div>
          <div class="col-md-6 form-group">
          <label >Bill Amount</label>
                <input type="text" class="form-control " name="add_Receive_Work_Bill_Amount_Id" id="add_Receive_Work_Bill_Amount_Id" placeholder="Enter Bill Amount" autocomplete="off" required pattern="[0-9]+" readonly>
        </div>

        </div>             
      </form>                  
           <button name="add_receive" id="add_receive" class="btn btn-primary"><?php if($uid==""){echo "Add Receive Work Master";}else{echo "update Receive Work Master";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>

<?php  $this->load->view('assests/footer'); ?>
 <script type='text/javascript'>

     var workReceiveDataBroker = $("#add_Receive_Work_Broker_Id").tautocomplete({
        width: "500px",
        columns: ['Broker Name', 'City Name', 'Phone Name'],
        placeholder: "Search Broker",
        id: "workReceiveBroker_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getBroker/",
            type: "POST",
            data: function()
             {
                var x = {BrokerName: $('#workReceiveBroker_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + workReceiveDataBroker.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = workReceiveDataBroker.searchdata();
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

 var workReceiveDataMillParty = $("#add_Receive_Work_Party_Code_Id").tautocomplete({
        
        width: "500px",
        columns: ['Acount Master Name', 'City Name', 'Contact Number'],
        placeholder: "Search Mill Party",
        id: "workReceiveMillParty_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getAccountMaster",
            type: "POST",
            data: function()
             {
                var x = {millPartyName: $('#workReceiveMillParty_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + workReceiveDataMillParty.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = workReceiveDataMillParty.searchdata();
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

var workReceiveDispatchDataTransport = $("#add_Receive_Work_Transport_Id").tautocomplete({
        width: "500px",
        columns: ['Transport Name', 'City Name', 'Phone Number'],
        placeholder: "Search Transport",
        id: "workReceiveDispatchTransport_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getTransport/",
            type: "POST",
            data: function()
             {
                var x = {TransportName: $('#workReceiveDispatchTransport_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + workReceiveDispatchDataTransport.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = workReceiveDispatchDataTransport.searchdata();
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



   var workReceiveDispatchDataChallanNo = $("#add_Receive_Work_Our_Challan_No_Id").tautocomplete({
        
        width: "500px",
        columns: ['Challan Number','Mill Party Name', 'Broker Name'],
        placeholder: "Search Challan Number",
        id: "workReceiveDispatchChallanNo_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/get_workReceiveDispatchChallanNo",
            type: "POST",
            data: function()
             {         
                var x = {billNo: $('#workReceiveDispatchChallanNo_row_id').val(),millId: workReceiveDataMillParty.id,brokerId: workReceiveDataBroker.id};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + workReceiveDispatchDataChallanNo.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = workReceiveDispatchDataChallanNo.searchdata();
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
            workReceiveDispatchDataChallanNo.all();
            console.log(workReceiveDispatchDataChallanNo.all().rate);
            //$('#add_Receive_Work_Rate_Id').val(workReceiveDispatchDataChallanNo.all().rate);
      
            return;
        }  

    } 
    });

  var workReceiveDispatchDataQuality = $("#add_Receive_Work_Receive_Quality_Id").tautocomplete({
        width: "500px",
        columns: ['Iteam Name'],
        placeholder: "Search Iteam",
        id: "workReceivesDispatchQuality_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/get_workReceiveDispatchIteam/",
            type: "POST",
            data: function()
             {
                var x = {item: $('#workReceivesDispatchQuality_row_id').val(),ChallanNo:workReceiveDispatchDataChallanNo.id};
                return x;
             },
            success: function (result) {
              
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
        
        addValidationReceiveWork();

    if ($("#receiveform").validate().element('#add_Receive_Work_Receive_Quality_Id') == false || $("#receiveform").validate().element('#add_Receive_Pcs_Taka_Id') == false || $("#receiveform").validate().element('#add_Receive_Work_Meters_Id') == false|| $("#receiveform").validate().element('#add_Receive_Work_Short_Long_Id') == false|| $("#receiveform").validate().element('#add_Receive_Work_Pm_Id') == false|| $("#receiveform").validate().element('#add_Receive_Work_Rate_Id') == false|| $("#receiveform").validate().element('#add_Receive_Work_Amount_Id') == false|| $("#receiveform").validate().element('#add_Receive_Work_Design_Id') == false|| $("#receiveform").validate().element('#add_Receive_Work_Colour_Id') == false|| $("#receiveform").validate().element('#add_Receive_Work_Fin_Id') == false)
    {

    }else
    {

      var nextid = $("#serialNumber").val();

      tbl_inventoryIssue.row.add( [
       '<input type="text" id="'+nextid+'" name="sno[]" value="'+$("#serialNumber").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" value="'+$("#add_Receive_Work_Receive_Quality_Id").val()+'" readonly> <input type="hidden" id="r'+nextid+'" name="add_Receive_Work_Receive_Quality_Id[]" value="'+workReceiveDispatchDataQuality.id()+'">',
       '<input type="text" id="'+nextid+'" name="add_Receive_Pcs_Taka_Id[]" value="'+$("#add_Receive_Pcs_Taka_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Receive_Work_Meters_Id[]" value="'+$("#add_Receive_Work_Meters_Id").val()+'" readonly>',
        '<input type="text" id="'+nextid+'" name="add_Receive_Work_Short_Long_Id[]" value="'+$("#add_Receive_Work_Short_Long_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Receive_Work_Pm_Id[]" value="'+$("#add_Receive_Work_Pm_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Receive_Work_Rate_Id[]" value="'+$("#add_Receive_Work_Rate_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Receive_Work_Amount_Id[]" class="add_Receive_Work_Amount_Id" value="'+$("#add_Receive_Work_Amount_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Receive_Work_Design_Id[]" value="'+$("#add_Receive_Work_Design_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Receive_Work_Colour_Id[]" value="'+$("#add_Receive_Work_Colour_Id").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="add_Receive_Work_Fin_Id[]" value="'+$("#add_Receive_Work_Fin_Id").val()+'" readonly>',
      
        ] ).node().id = nextid;

       $("#add_Receive_Work_Receive_Quality_Id").val("");
       $("#workReceivesDispatchQuality_row_id").val("");
       $("#workReceivesDispatchQuality_row_id").attr("data-id", "");
       $("#workReceivesDispatchQuality_row_id").attr("data-text", "");
        
      
    tbl_inventoryIssue.draw( false );

      $('#add_Receive_Work_Receive_Quality_Id').val("");
      $('#add_Receive_Pcs_Taka_Id').val("");
      $('#add_Receive_Work_Meters_Id').val("");
      $('#add_Receive_Work_Short_Long_Id').val("");
      $('#add_Receive_Work_Pm_Id').val("");
      $('#add_Receive_Work_Rate_Id').val("");
      $('#add_Receive_Work_Amount_Id').val("");
      $('#add_Receive_Work_Design_Id').val("");
      $('#add_Receive_Work_Colour_Id').val("");
      $('#add_Receive_Work_Fin_Id').val("");
      
      
    }
        workReceiveDespatchTotalAmountAddition();
 
    } );
} );

$(document).ready(function(){
    var x = $('#receive_Work_Book_Code_Id').val();
    //var jobProcess = $('#workIssueMill_issue_job_process').val();
   // jobProcessList();
    bookList(x);

   $('#add_receive').on('click', function () {

          removeValidationReceiveWork();

        if ($('#receiveform').valid())
        {
            addReceiveWorkMasterToServer();
        }
    });

});
$('#receive_Work_Book_Code_Id').selectpicker('refresh');

function bookList(x,y=null){
  $.ajax({
      url:'<?php echo base_url(); ?>ApiController/bookList',
      type:'post',
      data:{purchase:'2'},
      dataType:'json',
      success:function(response){
       $.each(response.bookList,function(index,data){  

          if (data['book_id_PK'] == y)
          {  
              $('#receive_Work_Book_Code_Id').append('<option value="'+data['book_id_PK']+'" selected>'+data['purchase_account_name']+'</option>');
          }else{
              $('#receive_Work_Book_Code_Id').append('<option value="'+data['book_id_PK']+'">'+data['purchase_account_name']+'</option>');
          }
        });
                 
       $('#receive_Work_Book_Code_Id').selectpicker('refresh');

      }
  });
}

function addReceiveWorkMasterToServer(){

  var workReceiveMasterToServerdata = new FormData(document.getElementById("receiveform"));
  workReceiveMasterToServerdata.append('add_Receive_Work_Broker_Id', workReceiveDataBroker.id());
  workReceiveMasterToServerdata.append('add_Receive_Work_Party_Code_Id', workReceiveDataMillParty.id());
  workReceiveMasterToServerdata.append('add_Receive_Work_Transport_Id', workReceiveDispatchDataTransport.id());
  workReceiveMasterToServerdata.append('add_Receive_Work_Our_Challan_No_Id', workReceiveDispatchDataChallanNo.id());
  //workReceiveMasterToServerdata.append('add_Receive_Work_Receive_Quality_Id', workReceiveDispatchDataQuality.id());

      // AJAX request
    $.ajax({
      url:'<?=base_url()?>ReceiveworkController/insertWorkReceiveMaster',
      method: 'post',
      data: workReceiveMasterToServerdata,
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
                              text: "Work Issue Mill is successfully added",
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

function receiveWorkBookReferesh(){
 bookList();
}

function workReceiveDespatchTotalAmountAddition(){
  var totalNetAmount = 0;
  $('.add_Receive_Work_Amount_Id').each(function(){
           var tempVal = this.value;
           if(tempVal == 0){
             //invalid = true;
           }else
           {
            totalNetAmount = parseFloat(totalNetAmount) + parseFloat(tempVal);
           }

  });

   $('#add_Receive_Work_Bill_totalAmount_Id').val(totalNetAmount);
            

}

function receiveDispatchCommonCalculation(){

var taka=$('#add_Receive_Pcs_Taka_Id').val();
  var rate=$("#add_Receive_Work_Rate_Id").val();
  var totalAmount=$("#add_Receive_Work_Bill_Amount_Id").val();
  var discount_percentage=$("#add_Receive_Work_Disc_Code_Id").val();
  var otherPlus=$("#add_Receive_Work_Other_Plus_Id").val();
  var otherMinus=$("#add_Receive_Work_Other_Minus_Id").val();
  var totalAmountResult=$("#add_Receive_Work_Bill_totalAmount_Id").val();

if(rate=="" || taka==""){
}else{
    var result=parseFloat(taka)*parseFloat(rate);
    $("#add_Receive_Work_Amount_Id").val(result);
}

if(discount_percentage=="" || totalAmountResult==""){
    //$("#add_Receive_Work_Bill_Amount_Id").val('0');
}else{
    
    var resultSet=parseFloat(totalAmountResult)*parseFloat(discount_percentage)/100;
    var result=parseFloat(totalAmountResult)-parseFloat(resultSet);
    $("#add_Receive_Work_Disc_Value_Id").val(resultSet);
    $("#add_Receive_Work_Bill_Amount_Id").val(result);
}

if(otherPlus=="" || totalAmount=="" || totalAmountResult=="" || discount_percentage==""){
    //$("#add_Receive_Work_Bill_Amount_Id").val('0');
}else{
     
  var resultSet=parseFloat(totalAmountResult)*parseFloat(discount_percentage)/100;
  var result=parseFloat(totalAmountResult)-parseFloat(resultSet);   
  var results=parseFloat(result)+parseFloat(otherPlus); 
  $("#add_Receive_Work_Bill_Amount_Id").val(results);
}

if(otherMinus=="" || totalAmount=="" || totalAmountResult=="" || discount_percentage==""){
    //$("#add_Receive_Work_Bill_Amount_Id").val('0');
}else{
     
  var resultSet=parseFloat(totalAmountResult)*parseFloat(discount_percentage)/100;
  var result=parseFloat(totalAmountResult)-parseFloat(resultSet);   
  var results=parseFloat(result)-parseFloat(otherMinus); 
  $("#add_Receive_Work_Bill_Amount_Id").val(results);
}

}

$("#add_Receive_Pcs_Taka_Id").keyup(function(){
   receiveDispatchCommonCalculation();
});

$("#add_Receive_Work_Disc_Code_Id").keyup(function(){
   receiveDispatchCommonCalculation();
});

$("#add_Receive_Work_Other_Plus_Id").keyup(function(){
   receiveDispatchCommonCalculation();
});

$("#add_Receive_Work_Other_Minus_Id").keyup(function(){
   receiveDispatchCommonCalculation();
});

$("#add_Receive_Work_Rate_Id").keyup(function(){
   receiveDispatchCommonCalculation();
});

function addValidationReceiveWork(){
  $("#add_Receive_Work_Receive_Quality_Id").prop('required',true);
    $("#add_Receive_Pcs_Taka_Id").prop('required',true);
    $("#add_Receive_Work_Meters_Id").prop('required',true);
    $("#add_Receive_Work_Short_Long_Id").prop('required',true);
    $("#add_Receive_Work_Pm_Id").prop('required',true);
    $("#add_Receive_Work_Rate_Id").prop('required',true);
    $("#add_Receive_Work_Amount_Id").prop('required',true);
    $("#add_Receive_Work_Design_Id").prop('required',true);
    $("#add_Receive_Work_Colour_Id").prop('required',true);
    $("#add_Receive_Work_Fin_Id").prop('required',true);
}

function removeValidationReceiveWork(){
    $('#add_Receive_Work_Receive_Quality_Id').removeAttr('required');
    $('#add_Receive_Pcs_Taka_Id').removeAttr('required');
    $('#add_Receive_Work_Meters_Id').removeAttr('required');
    $('#add_Receive_Work_Short_Long_Id').removeAttr('required');
    $('#add_Receive_Work_Pm_Id').removeAttr('required');
    $('#add_Receive_Work_Rate_Id').removeAttr('required');
    $('#add_Receive_Work_Amount_Id').removeAttr('required');
    $('#add_Receive_Work_Design_Id').removeAttr('required');
    $('#add_Receive_Work_Colour_Id').removeAttr('required');
    $('#add_Receive_Work_Fin_Id').removeAttr('required');
}

</script>



