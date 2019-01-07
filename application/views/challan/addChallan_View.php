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
                 
            <a href="<?= base_url(); ?>ChallanController" class="btn btn-primary">Back</a>

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
           <form id="challanform" method="post">
          <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">

          <div class="row">
          <div class="col-md-12 form-group">
          <div class="row">
            <div class="col-md-7 form-group">
              <label >Book  </label>
              <select id="challan_Book_Code_Id" name="challan_Book_Code_Id" class="form-control selectpicker" data-live-search="true" required>
                <option value="">--Select--</option>
              </select> 
            </div>
            <div class="col-md-2 form-group">
                <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BooksController/insertBook">Add</a>
            </div>
            <div class="col-md-3 form-group">
                <a class="now-ui-icons arrows-1_refresh-69" onclick="challanBookReferesh();">Referesh</a>
            </div>

            </div>
            </div> 
        
            </div>           
                
        <div class="row">
            <div class="col-md-3 form-group">
              <label >Challan No  </label>
              <input type="text" class="form-control numbersOnly" name="challan_challan_No_Id" id="challan_challan_No_Id" placeholder="Enter Challan No" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('challan_Party_Id') ?>
            </div>
             <div class="col-md-3 form-group">
             <label >Challan Date  </label>
             <input type="date" class="form-control" name="challan_challan_Date_Id" id="challan_challan_Date_Id" placeholder="Select Challan Date" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('challan_Party_Id') ?>
            </div>
             <div class="col-md-6 form-group">
              <label >P.O.No/ Party ch No  </label>
              <input type="text" class="form-control numbersOnly" name="challan_party_challanNo_Id" id="challan_party_challanNo_Id" placeholder="Enter Party Challan No " autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('challan_Party_Id') ?>
            </div>
         <!--     <div class="col-md-3 form-group">
             <label >Challan NO  </label>
             <input type="text" class="form-control numbersOnly" name="challan_Chalan_No_Id" id="challan_Chalan_No_Id" placeholder="Enter Sales Party" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('challan_Party_Id') ?>
            </div> -->

               </div>
                <div class="row">
                        
                    <div class="col-md-2 form-group">
                        <label>Party <span >  </span> </label>
                        <input type="text" class="form-control numbersOnly" name="challan_PartyCode_Id" id="challan_PartyCode_Id" placeholder="Enter Sales Party" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('challan_Party_Id') ?>
                    </div>
                         
                    <div class="col-md-10 form-group">
                    <div class="row">
                     <div class="col-md-10 form-group">
                      <label> </label>
                      <input type="text" class="form-control txt_Space" name="challan_PartyName_Id" id="challan_PartyName_Id" placeholder="Enter Sales Party " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('challan_Party_Id') ?>
                    </div>

                    <div class="col-md-2 form-group">
                    <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>AccountMasterController/insertAccountMaster">Add</a>
                    </div>
                    </div>
                    </div>
                 
                   </div>           
                        <div class="row">
                         <div class="col-md-2 form-group">
                            <label>Deli./cons. code </span></label>
                        
                            <input type="text" class="form-control" name="challan_Deli_Code_Id" id="challan_Deli_Code_Id" placeholder="Enter Sales Deli " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('challan_Deli_Code_Id') ?>
                                       
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Deli./cons.  </span></label>
                        
                            <input type="text" class="form-control" name="challan_Deli_value_Id" id="challan_Deli_value_Id" placeholder="Enter Sales Deli " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('challan_Deli_Code_Id') ?>
                                       
                        </div>
                               
                        <div class="col-md-5 form-group">
                        <div class="row">
                        <div class="col-md-10 form-group">
                        <label> Broker </label>
                        <input type="text" class="form-control " name="challan_Broker_Id" id="challan_Broker_Id" placeholder="Enter Sales Broker" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('challan_Broker_Id') ?>             
                        </div>
                        <div class="col-md-2 form-group">
                        <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BrokerController/insertBroker">Add</a>
                        </div>
                        </div>
                        </div>

                      <div class="col-md-3 form-group">
                        <label> Veh.no </label>
                        
                        <input type="text" class="form-control " name="challan_VehicleNo_Id" id="challan_VehicleNo_Id" placeholder="Enter Vehicle No" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('challan_Deli_Value_Id') ?>
                                       
                      </div>

                </div>

                    <div class="row">
                        
                    <div class="col-md-3 form-group">
                            <label>L.R.No. <span >  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="challan_L_R_No_Id" id="challan_L_R_No_Id" placeholder="Enter Sales L R No" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('challan_L_R_No_Id') ?>
                          </div>
                         
                    <div class="col-md-3 form-group">
                            <label> L.R.Dt. </label>
                            <input type="Date" class="form-control" name="challan_L_R_Dt_Id" id="challan_L_R_Dt_Id" placeholder="Enter Sales L.R.Dt " autocomplete="off" required pattern="[]+">
                          </div>
                          <div class="col-md-2 form-group">
                            <label> Transport </label>
                            <input type="text" class="form-control" name="challan_Transport_Id" id="challan_Transport_Id" placeholder="Enter Sales Transport " autocomplete="off" required pattern="[0-9]+"> 
                          </div>
                          <div class="col-md-2 form-group">
                            <label> Station </label>
                            <input type="text" class="form-control " name="challan_Station_Id" id="challan_Station_Id" placeholder="Enter Sales Station " autocomplete="off" required pattern="[a-zA-Z ]+">
                          </div>

                        <div class="col-md-2 form-group">
                            <label> Trans Id </label>
                            <input type="text" class="form-control " name="challan_transport_Id" id="challan_transport_Id" placeholder="Enter Transport Id " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('challan_Station_Id') ?>
                        </div>
                       
                        </div>

                         <div class="row">
                        
                    <div class="col-md-6 form-group">
                            <label>Packing <span >  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="challan_Packing_Id" id="challan_Packing_Id" placeholder="Enter Sales Packing" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('challan_Packing_Id') ?>
                          </div>
                          <div class="col-md-6 form-group">
                          <label>Case No <span >  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="challan_Case_No_Id" id="challan_Case_No_Id" placeholder="Enter Sales Case No" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('challan_Case_No_Id') ?>
                          </div>
             
        </div>
      <div style="border-style: inset; padding: 15px">
<div class="row">
    <div class="col-md-1 form-group">
        <label>S.No </label>
               <input type="text" class="form-control" id="serialNumber" placeholder="Sr No" autocomplete="off" required readonly=""> 
       </div>
    <div class="col-md-3 form-group">
       <label>Quality Name </label>
            <input type="text" class="form-control " id="challan_Quality_Name_Id" placeholder="Qty Name " autocomplete="off" required pattern="[0-9 ]+"> 
      </div>
   <div class="col-md-3 form-group">
        <label>Description </label>
            <input type="text" class="form-control " id="challan_Description_Id" placeholder="Description" autocomplete="off" required pattern="[0-9 ]+"> 
     </div>
   <div class="col-md-2 form-group">
        <label>Piece </label>
           <input type="text" class="form-control " id="challan_Piece_Id" placeholder="No" autocomplete="off" required pattern="[0-9 ]+"> 
        </div>
     <div class="col-md-3 form-group">
           <label>Cut </label>
                <input type="text" class="form-control " id="challan_cut_One_Id" placeholder="No" autocomplete="off" required pattern="[0-9 ]+">
        </div>
      <div class="col-md-2 form-group">
           <label>Qty </label>
                <input type="text" class="form-control" id="challan_Qty_Id" placeholder="Qty" autocomplete="off" required pattern="[0-9 ]+">
        </div>
      <div class="col-md-3 form-group">
          <label>PM </label>
              <input type="text" class="form-control" id="challan_PM_Id" placeholder="PM" autocomplete="off" required pattern="[0-9 ]+"> 
       </div>
    <div class="col-md-3 form-group">
          <label>Rate </label>
              <input type="text" class="form-control" id="challan_Rate_Id" placeholder="Rate" autocomplete="off" required pattern="[0-9 ]+">
   </div>
   <div class="col-md-3 form-group">
      <label >Amount </label>
         <input type="text" class="form-control" id="challan_Amount_Id" placeholder="Amount" autocomplete="off" required pattern="[0-9 ]+" readonly> 
      </div>

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
                  <th>Amount</th>

              </tr>
        </thead>
    </table>
<hr size="30">

 <div class="row ">

    <div class="col-md-6 form-group">
        <label >Remark(F9) </label>
        <input type="text" class="form-control " name="challan_remark" id="challan_remark" placeholder="Enter Remark" autocomplete="off" required pattern="[0-9]+">
   </div>

  <div class="col-md-6 form-group">
        <label >Bill Amout </label>
        <input type="text" class="form-control " name="challan_Bill_Amout_Id" id="challan_Bill_Amout_Id" placeholder="Enter Sales Bill Amout" autocomplete="off" required pattern="[0-9]+" readonly> 
   </div>
    </div>
  </form>                  
    <button name="addChallan" id="addChallan" class="btn btn-primary"><?php if($uid==""){echo "Add Challan";}else{echo "Update Challan";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>

 <script type='text/javascript'>

var challanDataTransport = $("#challan_Transport_Id").tautocomplete({
        width: "500px",
        columns: ['Transport Name', 'City Name', 'Phone Number'],
        placeholder: "Search Transport",
        id: "challanTransport_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getTransport/",
            type: "POST",
            data: function()
             {
                var x = {TransportName: $('#challanTransport_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + challanDataTransport.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = challanDataTransport.searchdata();
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

  var challanDataQuality = $("#challan_Quality_Name_Id").tautocomplete({
        width: "500px",
        columns: ['Iteam Name', 'MRP', 'cut'],
        placeholder: "Search Iteam",
        id: "challanreceiveQuality_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/get_Iteam/",
            type: "POST",
            data: function()
             {
                var x = {IteamName: $('#challanreceiveQuality_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + challanDataQuality.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = challanDataQuality.searchdata();
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

 var challanDataBroker = $("#challan_Broker_Id").tautocomplete({
        width: "500px",
        columns: ['Broker Name', 'City Name', 'Phone Name'],
        placeholder: "Search Broker",
        id: "challanBroker_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getBroker/",
            type: "POST",
            data: function()
             {
                var x = {BrokerName: $('#challanBroker_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + challanDataBroker.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = challanDataBroker.searchdata();
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

 var challanDataMillParty = $("#challan_PartyName_Id").tautocomplete({
        
        width: "500px",
        columns: ['Acount Master Name', 'City Name', 'Contact Number'],
        placeholder: "Search Mill Party",
        id: "challanParty_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getAccountMaster",
            type: "POST",
            data: function()
             {
                var x = {millPartyName: $('#challanParty_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + challanDataMillParty.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = challanDataMillParty.searchdata();
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
      "paging":   false,
      "searching":   false,
      "drawCallback": function( settings ) {

        if (tbl_inventoryIssue !== undefined)
        {
          $('#serialNumber').val(tbl_inventoryIssue.rows().count() + 1); 
        }
    }
  });


 $('#serialNumber').val(tbl_inventoryIssue.rows().count() + 1); 

  $('#add_Detail').on( 'click', function () {

    addValidationChallan();

    if ($("#challanform").validate().element('#challan_Quality_Name_Id') == false || 
      $("#challanform").validate().element('#challan_Description_Id') == false ||
      $("#challanform").validate().element('#challan_Piece_Id') == false||
      $("#challanform").validate().element('#challan_cut_One_Id') == false||
      $("#challanform").validate().element('#challan_Qty_Id') == false||
      $("#challanform").validate().element('#challan_PM_Id') == false||
      $("#challanform").validate().element('#challan_Rate_Id') == false||
      $("#challanform").validate().element('#challan_Amount_Id') == false)

    {

    }else
    {

      var nextid = $("#serialNumber").val();

      tbl_inventoryIssue.row.add( [
       '<input type="text" id="'+nextid+'" name="sno[]" value="'+$("#serialNumber").val()+'">',
       '<input type="text" id="'+nextid+'" value="'+$("#challan_Quality_Name_Id").val()+'"> <input type="hidden" id="S'+nextid+'" name="challan_Quality_Name_Id[]" value="'+challanDataQuality.id()+'">',
       '<input type="text" id="'+nextid+'" name="challan_Description_Id[]" value="'+$("#challan_Description_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="challan_Piece_Id[]" value="'+$("#challan_Piece_Id").val()+'">',
        '<input type="text" id="'+nextid+'" name="challan_cut_One_Id[]" value="'+$("#challan_cut_One_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="challan_Qty_Id[]" value="'+$("#challan_Qty_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="challan_PM_Id[]" value="'+$("#challan_PM_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="challan_Rate_Id[]" value="'+$("#challan_Rate_Id").val()+'">',
       '<input type="text" id="'+nextid+'" name="challan_Amount_Id[]" class="challan_Amount_Id" value="'+$("#challan_Amount_Id").val()+'">',
        ] ).node().id = nextid;
        
       $("#challan_Quality_Name_Id").val("");
       $("#challanreceiveQuality_row_id").val("");
       $("#challanreceiveQuality_row_id").attr("data-id", "");
       $("#challanreceiveQuality_row_id").attr("data-text", "");
          

    tbl_inventoryIssue.draw( false );

      $('#challan_Quality_Name_Id').val("");
      $('#challan_Description_Id').val("");
      $('#challan_Piece_Id').val("");
      $('#challan_cut_One_Id').val("");
      $('#challan_Qty_Id').val("");
      $('#challan_PM_Id').val("");
      $('#challan_Rate_Id').val("");
      $('#challan_Amount_Id').val("");
    }
        challanCommonCalculation();
        challanTotalAmountAddition();
 
    } );
} );

$(document).ready(function(){
    var x = $('#challan_Book_Code_Id').val();
    bookList(x);

   $('#addChallan').on('click', function () {

    removeValidationChallan();
    
        if ($('#challanform').valid())
        {
            addChallanToServer();
        }
    });


$('#challan_Book_Code_Id').selectpicker('refresh');

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
              $('#challan_Book_Code_Id').append('<option value="'+data['book_id_PK']+'" selected>'+data['sales_account_name']+'</option>');
          }else{
              $('#challan_Book_Code_Id').append('<option value="'+data['book_id_PK']+'">'+data['sales_account_name']+'</option>');
          }
        });
                 
       $('#challan_Book_Code_Id').selectpicker('refresh');

      }
  });
}

  });

function addChallanToServer(){
  var challanToServerdata = new FormData(document.getElementById("challanform"));
   challanToServerdata.append('challan_PartyName_Id', challanDataMillParty.id());
   challanToServerdata.append('challan_Broker_Id', challanDataBroker.id());
   challanToServerdata.append('challan_Transport_Id', challanDataTransport.id());

      // AJAX request
    $.ajax({
      url:'<?=base_url()?>ChallanController/insertChallan',
      method: 'post',
      data: challanToServerdata,
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
                              text: "Challan is successfully added",
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
function challanBookReferesh(){
  bookList();
}

function challanTotalAmountAddition(){
  var totalNetAmount = 0;
  $('.challan_Amount_Id').each(function(){
           var tempVal = this.value;
           if(tempVal == 0){
             //invalid = true;
           }else
           {
            totalNetAmount = parseFloat(totalNetAmount) + parseFloat(tempVal);
           }

  });

   $('#challan_Bill_Amout_Id').val(totalNetAmount);
            
}

function challanCommonCalculation(){
  var quantity=$('#challan_Qty_Id').val();
  var rate=$("#challan_Rate_Id").val();
  
if(rate=="" || quantity==""){
}else{
    var result=parseFloat(quantity)*parseFloat(rate);
    $("#challan_Amount_Id").val(result);
    console.log(result);
}
}

$("#challan_Qty_Id").keyup(function(){
   challanCommonCalculation();
});

$("#challan_Rate_Id").keyup(function(){
   challanCommonCalculation();
});

function addValidationChallan(){
  $("#challan_Quality_Name_Id").prop('required',true);
  $("#challan_Description_Id").prop('required',true);
  $("#challan_Piece_Id").prop('required',true);
  $("#challan_cut_One_Id").prop('required',true);
  $("#challan_Qty_Id").prop('required',true);
  $("#challan_PM_Id").prop('required',true);
  $("#challan_Rate_Id").prop('required',true);
  $("#challan_Amount_Id").prop('required',true);
}

function removeValidationChallan(){
    $('#challan_Quality_Name_Id').removeAttr('required');
    $('#challan_Description_Id').removeAttr('required');
    $('#challan_Piece_Id').removeAttr('required');
    $('#challan_cut_One_Id').removeAttr('required');
    $('#challan_Qty_Id').removeAttr('required');
    $('#challan_PM_Id').removeAttr('required');
    $('#challan_Rate_Id').removeAttr('required');
    $('#challan_Amount_Id').removeAttr('required');
}


</script>



