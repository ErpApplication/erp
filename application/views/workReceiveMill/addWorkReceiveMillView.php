<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
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
                 
            <a href="<?= base_url(); ?>WorkReceiveMillController" class="btn btn-primary">Back</a>

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
           <form id="workMillReceiveform" method="post">

    <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
          <div class="row">
            <div class="col-md-6 form-group">
            <div class="row">
            <div class="col-md-7 form-group">
             <label >Book <span class="mandatory"> * </span></label>
             <select id="workReceiveMill_issue_book" name="workReceiveMill_issue_book" class="form-control selectpicker" data-live-search="true" required>
              <option value="">--Select--</option>
              </select> 
            </div>

            <div class="col-md-2 form-group">
                <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BooksController/insertBook">Add</a>
            </div>
            <div class="col-md-3 form-group">
                <a class="now-ui-icons arrows-1_refresh-69" onclick="receiveBookReferesh();">Referesh</a>
            </div>

            </div>
            </div>
            
            <div class="col-md-6 form-group">
            <div class="row">
            <div class="col-md-6 form-group">
            <label> Balance <span class="mandatory">*</span></label>
                <input type="text" class="form-control numbersOnly" name="workReceiveMill_balance" id="workReceiveMill_balance" placeholder="Enter Receive Balance" autocomplete="off" required pattern="[0-9]+"> 
            </div>
            <div class="col-md-6 form-group">
            <label> Receive Challan No. <span class="mandatory">*</span></label>
                <input type="text" class="form-control numbersOnly" name="workReceiveMill_ReceiveChallan" id="workReceiveMill_ReceiveChallan" placeholder="Enter Receive Challan" autocomplete="off" required pattern="[0-9]+"> 
            </div>

            </div>
            </div>
                      
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <div class="row">
              <div class="col-md-6 form-group">
              <label>G.P Bill Number<span class="mandatory"> * </span> </label>
              <input type="text" class="form-control numbersOnly" name="workReceiveMill_gp_bill" id="workReceiveMill_gp_bill" placeholder="Enter G P Bill Number" autocomplete="off" required pattern="[0-9]+">
            </div>
             
            <div class="col-md-6 form-group">
            <label>Chalan Number<span class="mandatory"> * </span> </label>  
            <input type="text" class="form-control numbersOnly" name="workReceiveMill_chalan_number" id="workReceiveMill_chalan_number" placeholder="Enter Receive Challan Number" autocomplete="off" required pattern="[a-zA-Z ]+">
            </div>
            </div>
            </div>

            <div class="col-md-6 form-group">
             <div class="row">
              <div class="col-md-4 form-group">
              <label>Mill Party code<span class="mandatory"> * </span> </label>
              <input type="text" class="form-control numbersOnly" name="workReceiveMill_party_code" id="workReceiveMill_party_code" placeholder="Enter Mill Party Code" autocomplete="off" required pattern="[0-9]+">
            </div>
             
            <div class="col-md-8 form-group">
            <div class="row">
            <div class="col-md-10 form-group">
            <label>Mill Party Name<span class="mandatory"> * </span> </label>  
            <input type="text" class="form-control txt_Space" name="workReceiveMill_party_name" id="workReceiveMill_party_name" placeholder="Enter Mill Party Name" autocomplete="off" required pattern="[a-zA-Z ]+">
            </div>
             <div class="col-md-2 form-group">
              <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>AccountMasterController/insertAccountMaster">Add</a>
              </div>
              </div>
              </div>

            </div>
            </div>             
            </div>

          <div class="row">
          <div class="col-md-3 form-group">
            <label>Receive Date <span class="mandatory"> * </span></label>
            <input type="date" class="form-control" name="workReceiveMill_receive_date" id="workReceiveMill_receive_date" placeholder=" Select Receive Date" autocomplete="off" required pattern="[]+">
          </div> 

          <div class="col-md-6 form-group">
          <div class="row">
          <div class="col-md-10 form-group">
            <label>Broker <span class="mandatory"> * </span></label>
            <input type="text" class="form-control" name="workReceiveMill_boker" id="workReceiveMill_boker" placeholder="Select Broker" autocomplete="off" required pattern="[]+">
          </div>
          <div class="col-md-2 form-group">
          <a class="now-ui-icons ui-1_simple-add" target="_blank" href="<?php echo base_url(); ?>BrokerController/insertBroker">Add</a>
          </div>
          </div>
          </div>

           <div class="col-md-3 form-group">
            <label>CR Days <span class="mandatory"> * </span></label>
            <input type="text" class="form-control " name="workReceiveMill_cr_days" id="workReceiveMill_cr_days" placeholder="Select CR Days" autocomplete="off" required pattern="[]+">
          </div> 
    
          </div>

        <div class="row">
          <div class="col-md-3 form-group">
            <label>L R No. <span class="mandatory"> * </span></label>
            <input type="text" class="form-control numbersOnly" name="workReceiveMill_lr_no." id="workReceiveMill_lr_no" placeholder=" Enter L R Number" autocomplete="off" required pattern="[]+">
          </div> 

           <div class="col-md-3 form-group">
            <label>Tempo Number <span class="mandatory"> * </span></label>
            <input type="text" class="form-control numbersOnly" name="workReceiveMill_tempo_no" id="workReceiveMill_tempo_no" placeholder=" Enter Tempo Number" autocomplete="off" required pattern="[]+">
          </div> 

           <div class="col-md-6 form-group">
            <label>Transport <span class="mandatory"> * </span></label>
            <input type="text" class="form-control " name="workReceiveMill_transport" id="workReceiveMill_transport" placeholder=" Enter Transport" autocomplete="off" required pattern="[]+">
          </div> 
    
          </div>

          <div class="row">
          <div class="col-md-2 form-group">
            <label>Our Ch. No.(F7) <span class="mandatory"> * </span></label>
            <input type="text" class="form-control numbersOnly" name="workReceiveMill_our_ch_no" id="workReceiveMill_our_ch_no" placeholder=" Enter Challan Number" autocomplete="off" required pattern="[]+">
          </div> 

           <div class="col-md-2 form-group">
            <label>Lot Number <span class="mandatory"> * </span></label>
            <input type="text" class="form-control numbersOnly" name="workReceiveMill_our_lot_no" id="workReceiveMill_our_lot_no" placeholder=" Enter Lot Number" autocomplete="off" required pattern="[]+">
          </div> 

           <div class="col-md-3 form-group">
            <label>Issue Quality <span class="mandatory"> * </span></label>
            <input type="text" class="form-control " name="workReceiveMill_our_issue_quality" id="workReceiveMill_our_issue_quality" placeholder=" Enter Issue Quality" autocomplete="off" required pattern="[]+">
          </div> 

           <div class="col-md-2 form-group">
            <label>Finish Quality <span class="mandatory"> * </span></label>
            <input type="text" class="form-control " name="workReceiveMill_our_finish_quality" id="workReceiveMill_our_finish_quality" placeholder=" Enter Finish Quality" autocomplete="off" required pattern="[]+">
          </div> 

           <div class="col-md-3 form-group">
            <label>Rate <span class="mandatory"> * </span></label>
            <input type="text" class="form-control numbersOnly" name="workReceiveMill_our_rate" id="workReceiveMill_our_rate" placeholder=" Enter Finish Quality" autocomplete="off" required pattern="[]+" readonly>
          </div> 
    
          </div>


           <div class="row solid">


                    <div class="col-md-1 form-group">
                          <label >S.No. <span class="mandatory"> *  
                               </span> 
                            </label>
                          <input type="text" class="form-control" name="serialNumber" id="serialNumber" autocomplete="off" required readonly> 
                      </div>

                      <div class="col-md-2 form-group">
                          <label >Taka Number <span class="mandatory"> *  
                               </span> 
                            </label>
                          <input type="text" class="form-control numbersOnly" name="workReceiveMill_taka_no" id="workReceiveMill_taka_no" autocomplete="off" required pattern="[0-9]+"> 
                      </div>


                      <div class="col-md-2 form-group">
                          <label >Grey Meters<span class="mandatory"> *  
                               </span> 
                            </label>
                          <input type="text" class="form-control numbersOnly" name="workReceiveMill_grey_meter" id="workReceiveMill_grey_meter" autocomplete="off" required readonly pattern="[0-9]+">
                      </div>


                      <div class="col-md-2 form-group">
                          <label >Finish Meters<span class="mandatory"> *  
                               </span> 
                            </label>
                          <input type="text" class="form-control" name="workReceiveMill_finish_meter" id="workReceiveMill_finish_meter" autocomplete="off" required >
                      </div>


                      <div class="col-md-1 form-group">
                          <label >Short/Long <span class="mandatory"> *  
                               </span> 
                            </label>
                          <input type="text" class="form-control numbersOnly" name="workReceiveMill_short_long" id="workReceiveMill_short_long" autocomplete="off" required readonly pattern="[0-9]+"> 
                      </div>


                      <div class="col-md-1 form-group">
                          <label >%<span class="mandatory"> *  
                               </span> 
                            </label>
                          <input type="text" class="form-control numbersOnly" name="workReceiveMill_percentage" id="workReceiveMill_percentage" autocomplete="off" required readonly pattern="[0-9]+">
                      </div>


                      <div class="col-md-1 form-group">
                          <label >Finish<span class="mandatory"> *  
                               </span> 
                            </label>
                             <select id="workReceiveMill_finish" name="workReceiveMill_finish" class="form-control selectpicker" data-live-search="true" required>
                                <option value="1">Y</option>
                                <option value="0">N</option>
                                </select> 
<!--                           <input type="text" class="form-control" name="workReceiveMill_finish" id="workReceiveMill_finish" autocomplete="off" required >
 -->                      </div>

                      <div class="col-md-1 form-group">
                          <label >Amount<span class="mandatory"> *  
                               </span> 
                            </label>
                          <input type="text" class="form-control" name="workReceiveMill_amount" id="workReceiveMill_amount" autocomplete="off" required readonly>
                      </div>


                       <div class="col-md-1 form-group">
                          <a name="add_Detail"  id="add_Detail" class="btn btn-primary">Add</a>
                      </div>
                  </div>

                  <table id="tbl_inventoryIssue" class="display responsive" >
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Taka Number</th>
                            <th>Grey Meters</th>
                            <th>Finish Meter</th>
                            <th>Short/Long</th>
                            <th>%</th>
                            <th>Finish</th>
                            <th>Amount</th>
                        </tr>
                      
                    </thead>
                </table>



        <div class="row">

        <div class="col-md-6 form-group">
            <label>(F9) Desc. <span class="mandatory">  </span></label>
            <input type="text" class="form-control " name="workReceiveMill_desc" id="workReceiveMill_desc" placeholder=" Enter Receive Desc" autocomplete="off" required pattern="[]+">
          </div>

              <div class="col-md-3 form-group">
                <label>Gross Amount <span class="mandatory">  </span></label>
                <input type="text" class="form-control numbersOnly" name="workReceiveMill_gross_amount" id="workReceiveMill_gross_amount" placeholder="Enter Total Gross Amount" autocomplete="off" pattern="[0-9]+" readonly>            
              </div>

              <div class="col-md-1 form-group">
                <label>% code <span class="mandatory">  </span></label>
                <input type="text" class="form-control numbersOnly" name="workReceiveMill_desc_percentage_code" id="workReceiveMill_desc_percentage_code" placeholder="Enter Desc Percentage Code" autocomplete="off" required pattern="[0-9]+">            
              </div>

              <div class="col-md-2 form-group">
                <label>Desc % <span class="mandatory">  </span></label>
                <input type="text" class="form-control numbersOnly" name="workReceiveMill_desc_percentage" id="workReceiveMill_desc_percentage" placeholder="Enter Desc Percentage" autocomplete="off" required pattern="[0-9]+">            
              </div>

          
          </div>


          </form>                
          <button name="add_work_mill_Receive" id="add_work_mill_Receive" class="btn btn-primary"><?php if($uid==""){echo "Add Work Mill Receive";}else{echo "update Work Mill Receive";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>

<?php  $this->load->view('assests/footer'); ?>
 <script type='text/javascript'>


  var receiveMillDataBroker = $("#workReceiveMill_boker").tautocomplete({
        width: "500px",
        columns: ['Broker Name', 'City Name', 'Phone Name'],
        placeholder: "Search Broker",
        id: "receiveBroker_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getBroker/",
            type: "POST",
            data: function()
             {
                var x = {BrokerName: $('#receiveBroker_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + receiveMillDataBroker.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = receiveMillDataBroker.searchdata();
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

 var receiveMillDataMillParty = $("#workReceiveMill_party_name").tautocomplete({
        
        width: "500px",
        columns: ['Acount Master Name', 'City Name', 'Contact Number'],
        placeholder: "Search Mill Party",
        id: "receiveMillParty_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getAccountMaster",
            type: "POST",
            data: function()
             {
                var x = {millPartyName: $('#receiveMillParty_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + receiveMillDataMillParty.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = receiveMillDataMillParty.searchdata();
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

var workReceiveMillDataTransport = $("#workReceiveMill_transport").tautocomplete({
        width: "500px",
        columns: ['Transport Name', 'City Name', 'Phone Number'],
        placeholder: "Search Transport",
        id: "workReceiveMillTransport_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/getTransport/",
            type: "POST",
            data: function()
             {
                var x = {TransportName: $('#workReceiveMillTransport_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + workReceiveMillDataTransport.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = workReceiveMillDataTransport.searchdata();
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

 var issueReceiveDataChallanNo = $("#workReceiveMill_our_ch_no").tautocomplete({
        
        width: "500px",
        columns: ['Challan Number','Mill Party Name', 'Broker Name'],
        placeholder: "Search Challan Number",
        id: "receiveChallanNo_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/get_receiveChallanNo",
            type: "POST",
            data: function()
             {         
                var x = {billNo: $('#receiveChallanNo_row_id').val(),millId: receiveMillDataMillParty.id,brokerId: receiveMillDataBroker.id};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + issueReceiveDataChallanNo.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = issueReceiveDataChallanNo.searchdata();
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
            issueReceiveDataChallanNo.all();
            console.log(issueReceiveDataChallanNo.all().rate);
            $('#workReceiveMill_our_rate').val(issueReceiveDataChallanNo.all().rate);
            return;
        }  

    } 
    });

var workReceiveDataQuality = $("#workReceiveMill_our_issue_quality").tautocomplete({
        width: "500px",
        columns: ['Iteam Name', 'MRP', 'cut'],
        placeholder: "Search Iteam",
        id: "receiveQuality_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/get_Iteam/",
            type: "POST",
            data: function()
             {
                var x = {IteamName: $('#receiveQuality_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + workReceiveDataQuality.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = workReceiveDataQuality.searchdata();
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

var workReceiveDataFinishQuality = $("#workReceiveMill_our_finish_quality").tautocomplete({
        width: "500px",
        columns: ['Iteam Name', 'MRP', 'cut'],
        placeholder: "Search Iteam",
        id: "receiveFinishQuality_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/get_Iteam/",
            type: "POST",
            data: function()
             {
                var x = {IteamName: $('#receiveFinishQuality_row_id').val()};
                return x;
             },
            success: function (result) {
                var filterData = [];
                var searchData = eval("/" + workReceiveDataFinishQuality.searchdata() + "/gi");
                $.each(result, function (i, v) {
                    if (v.name.search(new RegExp(searchData)) != -1) {
                        filterData.push(v);
                    }
                });
                var srcfild = workReceiveDataFinishQuality.searchdata();
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

var workReceiveTakaData = $("#workReceiveMill_taka_no").tautocomplete({
        width: "500px",
        columns: ['Taka Number', 'Meters', 'Remark'],
        placeholder: "Search Taka",
        id: "receiveTaka_row_id",
        theme: "white", 
        ajax: {
            url: "<?php echo base_url();?>ApiController/get_receiveDetail/",
            type: "POST",
            data: function()
             {
                var x = {takaId:$('#receiveTaka_row_id').val(),issueBillId:issueReceiveDataChallanNo.id};
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
            workReceiveTakaData.all();
        console.log(workReceiveTakaData.all().meters);
            $('#workReceiveMill_grey_meter').val(workReceiveTakaData.all().meters)
            return;
        }  

    } 
    });

  $(document).ready(function(){
     var x = $('#workReceiveMill_issue_book').val();
     bookList(x);

   $('#add_work_mill_Receive').on('click', function () {
        
        removeValidationReceiveMillWork();
        
        if ($('#workMillReceiveform').valid())
        {
            addWorReceiveMillToServer();
        }
    });

  });

 $('#workReceiveMill_issue_book').selectpicker('refresh');

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
              $('#workReceiveMill_issue_book').append('<option value="'+data['book_id_PK']+'" selected>'+data['sales_account_name']+'</option>');
          }else{
              $('#workReceiveMill_issue_book').append('<option value="'+data['book_id_PK']+'">'+data['sales_account_name']+'</option>');
          }
        });
                 
       $('#workReceiveMill_issue_book').selectpicker('refresh');

      }
  });
}

function addWorReceiveMillToServer(){
  var receiveMillToServerdata = new FormData(document.getElementById("workMillReceiveform"));
  receiveMillToServerdata.append('workReceiveMill_boker', receiveMillDataBroker.id());
  receiveMillToServerdata.append('workReceiveMill_party_name', receiveMillDataMillParty.id());
  receiveMillToServerdata.append('workReceiveMill_transport', workReceiveMillDataTransport.id());
  receiveMillToServerdata.append('workReceiveMill_our_ch_no', issueReceiveDataChallanNo.id());
  receiveMillToServerdata.append('workReceiveMill_our_issue_quality',workReceiveDataQuality.id());
  receiveMillToServerdata.append('workReceiveMill_our_finish_quality',workReceiveDataFinishQuality.id());
  receiveMillToServerdata.append('workReceiveMill_taka_no',workReceiveTakaData.id());

      // AJAX request
    $.ajax({
      url:'<?=base_url()?>WorkReceiveMillController/insertWorkReceiveMill',
      method: 'post',
      data: receiveMillToServerdata,
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

     addValidationReceiveMillWork();

    if ($("#workMillReceiveform").validate().element('#workReceiveMill_taka_no') == false || $("#workMillReceiveform").validate().element('#workReceiveMill_grey_meter') == false || $("#workMillReceiveform").validate().element('#workReceiveMill_finish_meter') == false)
    {

    }else
    {

      var nextid = $("#serialNumber").val();

      tbl_inventoryIssue.row.add( [
       '<input type="text" id="'+nextid+'" name="sno[]" value="'+$("#serialNumber").val()+'">',
       '<input type="text" id="'+nextid+'" name="workReceiveMill_taka_no[]" value="'+$("#workReceiveMill_taka_no").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="workReceiveMill_grey_meter[]" value="'+$("#workReceiveMill_grey_meter").val()+'" readonly>',
       '<input type="text" id="'+nextid+'" name="workReceiveMill_finish_meter[]" value="'+$("#workReceiveMill_finish_meter").val()+'" readonly>',
        '<input type="text" id="'+nextid+'" name="workReceiveMill_short_long[]" value="'+$("#workReceiveMill_short_long").val()+'" readonly>',
        '<input type="text" id="'+nextid+'" name="workReceiveMill_percentage[]" value="'+$("#workReceiveMill_percentage").val()+'" readonly>',
        '<input type="text" id="'+nextid+'" name="workReceiveMill_finish[]" value="'+$("#workReceiveMill_finish").val() +'" readonly>',
        '<input type="text" id="'+nextid+'" name="workReceiveMill_amount[]" class="workReceiveMill_amount" value="'+$("#workReceiveMill_amount").val()+'" readonly>',
        ] ).node().id = nextid;
   

       $("#workReceiveMill_taka_no").val("");
       $("#receiveTaka_row_id").val("");
       $("#receiveTaka_row_id").attr("data-id", "");
       $("#receiveTaka_row_id").attr("data-text", "");

        


    tbl_inventoryIssue.draw( false );

      $('#workReceiveMill_taka_no').val("");
      $('#workReceiveMill_grey_meter').val("");
      $('#workReceiveMill_finish_meter').val("");
      $('#workReceiveMill_short_long').val("");
      $('#workReceiveMill_percentage').val("");
      $('#workReceiveMill_finish').val("");
      $('#workReceiveMill_amount').val("");
    }
      workReceiveTotalAmountAddition();

    } );
} );

function receiveBookReferesh(){
  bookList();
}
   //var uid=$('#uid').val();

    // AJAX request
   //  $.ajax({
   //    url:'<?=base_url()?>Transport/GetTransportDetail',
   //    method: 'post',
   //    data: {uid:uid},
   //    dataType: 'json',
   //    success: function(response){
   //                     if(response){

   //                        var result=JSON.stringify(response);
   //                        var resultJsonDecode = jQuery.parseJSON(result);
   //                        var results=JSON.stringify(resultJsonDecode.resultSet);
   //                        var resultSet = jQuery.parseJSON(results);
   //                      //  alert(result);
   //                        //alert(resultSet.transport_name);
   //                      //   alert(resultSet.message);

   //                      $("#transport_name").val(resultSet.transport_name);
   //                      $("#contact_person").val(resultSet.contact_person);
   //                      $("#country_id").val(resultSet.country_id_FK);
   //                      $("#state_id").val(resultSet.state_id_FK);
   //                      $("#city_id").val(resultSet.city_id_FK);
   //                      $("#transport_address").val(resultSet.transport_address);
   //                      $("#pincode").val(resultSet.pincode);
   //                      $("#gst").val(resultSet.GST);
   //                      $("#landline").val(resultSet.landline);
   //                      $("#transport_landline_code").val(resultSet.landline_code);
   //                      $("#contact_number").val(resultSet.contact_mobile);
   //                      $("#transport_contact_code").val(resultSet.country_code);

   //                      callStateAPI(resultSet.country_id_FK,resultSet.state_id_FK);
   //                      callCityAPI(resultSet.state_id_FK,resultSet.city_id_FK);
                        
                   
   //               }


   //    }
      
   // });

//});
function workReceiveTotalAmountAddition(){
  var totalNetAmount = 0;
  $('.workReceiveMill_amount').each(function(){
           var tempVal = this.value;
           if(tempVal == 0){
             //invalid = true;
           }else
           {
            totalNetAmount = parseFloat(totalNetAmount) + parseFloat(tempVal);
           }

  });

   $('#workReceiveMill_gross_amount').val(totalNetAmount);
            
}

function receiveMillCommonCalculation(){
  var finishMeter=$('#workReceiveMill_finish_meter').val();
  var rate=$("#workReceiveMill_our_rate").val();
  var grayMeter=$("#workReceiveMill_grey_meter").val();
  var shortsPercentage=$("#workReceiveMill_short_long").val();

if(rate=="" || finishMeter==""){
}else{
    var result=parseFloat(finishMeter)*parseFloat(rate);
    $("#workReceiveMill_amount").val(result);
}

if(finishMeter==""){
    $("#workReceiveMill_short_long").val('0');
    $("#workReceiveMill_percentage").val('0');
    $("#workReceiveMill_amount").val('0');

}else{
    var results=parseFloat(grayMeter)-parseFloat(finishMeter);
    var resultSet=parseFloat(results)/parseFloat(grayMeter)*100;
    $("#workReceiveMill_short_long").val(results);
    $("#workReceiveMill_percentage").val(resultSet);

}

}

$("#workReceiveMill_finish_meter").keyup(function(){
   receiveMillCommonCalculation();
});

function addValidationReceiveMillWork(){
  $("#workReceiveMill_taka_no").prop('required',true);
  $("#workReceiveMill_grey_meter").prop('required',true);
  $("#workReceiveMill_finish_meter").prop('required',true);
  $("#workReceiveMill_short_long").prop('required',true);
  $("#workReceiveMill_percentage").prop('required',true);
  $("#workReceiveMill_finish").prop('required',true);
  $("#workReceiveMill_amount").prop('required',true);
}

function removeValidationReceiveMillWork(){
    $('#workReceiveMill_taka_no').removeAttr('required');
    $('#workReceiveMill_grey_meter').removeAttr('required');
    $('#workReceiveMill_finish_meter').removeAttr('required');
    $('#workReceiveMill_short_long').removeAttr('required');
    $('#workReceiveMill_percentage').removeAttr('required');
    $('#workReceiveMill_finish').removeAttr('required');
    $('#workReceiveMill_amount').removeAttr('required');
}

</script>



