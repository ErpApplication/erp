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
                 
            <a href="<?= base_url(); ?>ItemmasterController" class="btn btn-primary">Back</a>

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
           <form id="iteamMasterform" method="post">
                    <div class="row">

    <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
                  <div class="col-md-6 form-group">
                      <label >ITEM CODE <span class="mandatory"> *  
                           </span> 
                        </label>
                            <input type="text" class="form-control numbersOnly" name="iteamMaster_Item_Code" id="iteamMaster_Item_Code" placeholder="Enter ITEM CODE" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('ITEM CODE') ?>
                        </div>
                      
                       </div>
                      <div class="row">
                          <div class="col-md-6 form-group">
                            <label>ITEM NAME-1 <span class="mandatory">  *</span></label>
                            <input type="text" class="form-control txt_Space" name="iteamMaster_Item_Name" id="iteamMaster_Item_Name" placeholder="Enter ITEM NAME-1" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('Item_Name') ?>
        
                          
                          </div>
                           </div>
                        <div class="row">
                          <div class="col-md-6 form-group">
                            <label>Group<span class="mandatory"> * </span> </label>
                            <input type="text" class="form-control txt_Space" name="iteamMaster_Group" id="iteamMaster_Group" placeholder="Enter Group" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('Group') ?>
                          </div>
                        </div>
                       
                      <div class="row">
                              
                        <div class="col-md-12 form-group">
                            <label>Stock Type <span class="mandatory"> * </span></label>
                            <select id="iteamMaster_Stock" name="iteamMaster_Stock" class="form-control selectpicker" data-live-search="true" required>
                            <option value=""selected>Should have option Stock</option>
                            <option value="Finished"selected>Finished</option>
                            <option value="Raw Material"selected>Raw Material</option>
                            <option value="Trading"selected>Trading</option>
                            <option value="Semi Finished"selected>Semi Finished</option>
                          
                            </select>   
                            <?php echo form_error('country_id') ?>
                        </div>
             </div>
                              
                   <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Unit Of Measure <span class="mandatory">  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="iteamMaster_Unit" id="iteamMaster_Unit" placeholder="Enter Unit Of Measure" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('Unit') ?>
                                       
                        </div>

                        <div class="col-md-4 form-group">
                            <label>Hsn/Sac <span class="mandatory">  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="iteamMaster_Hsn" id="iteamMaster_Hsn" placeholder="Enter Hsn/Sac " autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('Hsn') ?>
                                       
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Dealer Rate <span class="mandatory">  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="iteamMaster_Dealer" id="iteamMaster_Dealer" placeholder="Enter Dealer Rate" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('Dealer') ?>
                                      
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Cut <span class="mandatory"> * </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="iteamMaster_Cut" id="iteamMaster_Cut" placeholder=" Enter Cut" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('Cut') ?>
                            </div>           
                        
                        
                    <div class="col-md-4 form-group">
                            <label>Box Pack <span >  </span> </label>
                            <input type="text" class="form-control alpha_numeric" name="iteamMaster_Box" id="iteamMaster_Box" placeholder="Enter Box Pack" autocomplete="off" required pattern="[a-zA-Z0-9]+"> <?php echo form_error('Box Pack') ?>
                          </div>
                         
                    <div class="col-md-4 form-group">
                            <label>MRP <span >  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="iteamMaster_mrp" id="iteamMaster_mrp" placeholder="Enter MRP" autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('Contact Person') ?>
                          </div>
                        
                         
                    <div class="col-md-4 form-group">
                            <label>Purchase Rate<span >  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="iteamMaster_purchaseRate" id="iteamMaster_purchaseRate" placeholder="Enter Purchase Rate" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('Contact Person') ?>
                          </div>
                        <div class="col-md-4 form-group">
                            <label>Gst Calc <span class="mandatory">*  </span></label>
                            <select id="iteamMaster_gst_calculate" name="iteamMaster_gst_calculate" class="form-control selectpicker" data-live-search="true" required>
                            <option value="1"selected>Yes</option>
                            <option value="0"selected>No</option>
                          
                            </select>   
                            <?php echo form_error('country_id') ?>
                        </div>
                           <div class="col-md-4 form-group">
                            <label>SGST % <span class="mandatory">*  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="iteamMaster_sgst" id="iteamMaster_sgst" placeholder="Enter SGST %" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('cr_days') ?>
                                       
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 form-group">
                            <label>CGST % <span class="mandatory">*  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="iteamMaster_cgst" id="iteamMaster_cgst" placeholder="Enter CGST %" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('cr_days') ?>
                                       
                        </div>
                        <div class="col-md-4 form-group">
                            <label>IGST % <span class="mandatory">*  </span></label>
                        
                            <input type="text" class="form-control numbersOnly" name="iteamMaster_igst" id="iteamMaster_igst" placeholder="Enter IGST %" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('cr_days') ?>
                                       
                        </div>
                        <div class="col-md-4 form-group" align="text-right">
                            <label>Show In Stock Report <span class="mandatory"> * </span></label>
                            <select id="iteamMaster_stock_report" name="iteamMaster_stock_report" class="form-control selectpicker" data-live-search="true" required>
                            <option value="1"selected>Yes</option>
                            <option value="0"selected>No</option>
                      
                            
                            </select>   
                            <?php echo form_error('country_id') ?>
                        </div>
                   </div>                  
                  <div class="row">
                    <div class="col-md-4 form-group">
                            <label>Opening Stock Quantity <span>  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="iteamMaster_stock_quantity" id="iteamMaster_stock_quantity" placeholder="Enter Opening Stock Quality" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('Contact Person') ?>
                          </div>
                    <div class="col-md-4 form-group">
                            <label>Opening Stock NOS <span>  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="iteamMaster_open_stock_number" id="iteamMaster_open_stock_number" placeholder="Enter Opening Stock NOS" autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('Contact Person') ?>
                          </div>
                          
                          <div class="col-md-4 form-group">
                            <label>Opening ATM <span>  </span> </label>
                            <input type="text" class="form-control" name="iteamMaster_Opening_atm" id="iteamMaster_Opening_atm" placeholder="Enter Opening ATM " autocomplete="off" required pattern="[a-zA-Z ]+"> <?php echo form_error('email') ?>
                          </div>
                         </div>
                          <div class="row">
                          <div class="col-md-4 form-group">
                            <label>Rate Updates <span>  </span> </label>
                            <input type="text" class="form-control numbersOnly" name="iteamMaster_rate_update" id="iteamMaster_rate_update" placeholder="Enter Rate Updates" autocomplete="off" required pattern="[0-9]+"> <?php echo form_error('email') ?>
                          </div>

                          <div class="col-md-4 form-group" >
                            <label>Active <span class="mandatory"> * </span></label>
                            <select id="iteamMaster_active" name="iteamMaster_active" class="form-control selectpicker" data-live-search="true" required>
                            <option value="1"selected>Yes</option>
                            <option value="0"selected>No</option>
                           </select>
                         </div>
                        <div class="col-md-4 form-group">
                            <label>Calculate On. <span class="mandatory"> * </span></label>
                        
                            <select id="iteamMaster_calculate_number" name="iteamMaster_calculate_number" class="form-control selectpicker" data-live-search="true" required>
                      <option value="Meter"selected>Mtrs</option>
                      <option value="Quantity"selected>Qnty</option>
                    </select>
                            </div>           
                        </div>
                         <div class="row">
                        <div class="col-md-4 form-group" >
                            <label>HSN UQC(GSTR-1)<span class="mandatory"> * </span></label>
                            <select id="iteamMaster_Hsn_Uqc" name="iteamMaster_Hsn_Uqc" class="form-control selectpicker" data-live-search="true" required>
                      <option value="Numbers"selected>Numbers</option>
                      <option value="Meter"selected>Meter</option>
                      <option value="Kilogrms"selected>Kilogrms</option>
                      <option value="Pieces"selected>Pieces</option>
                      <option value="Bags"selected>Bags</option>
                      <option value="Bale"selected>Bale</option>
                      <option value="Bundles"selected>Bundles</option>
                      <option value="Box"selected>Box</option>
                      <option value="Bunches"selected>Bunches</option>
                      <option value="Cans"selected>Cans</option>
                      <option value="Packs"selected>Packs</option>
                      <option value="Cartons"selected>Cartons</option>
                      <option value="Dozens"selected>Dozens</option>
                      <option value="Drums"selected>Drums</option>
                      <option value="Gross"selected>Gross</option>
                      <option value="Units"selected>Units</option>
                    </select>
                  </div>
                      <div class="col-md-4 form-group">
                            <label>HSN DESC <span >  </span></label>
                        
                            <input type="number" class="form-control" name="iteamMaster_Hsn_desc" id="iteamMaster_Hsn_desc" placeholder="Enter CR Limit." autocomplete="off" required pattern="[0-9 ]+"> <?php echo form_error('cr_limit') ?>
                                       
                        </div>                       
                        
                  </div>
                       </form>                  
                        <button name="add_iteamMaster" id="add_iteamMaster" class="btn btn-primary"><?php if($uid==""){echo "Add Iteam Master";}else{echo "update Iteam Master";} ?></button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>

<?php  $this->load->view('assests/footer'); ?>
 <script type='text/javascript'>
  $(document).ready(function(){
    //callStateAPI(1);
   $('#add_iteamMaster').on('click', function () {
        if ($('#iteamMasterform').valid())
        {
            addIteamMasterToServer();
        }
    });

  });

function addIteamMasterToServer(){
  var data1 = new FormData(document.getElementById("iteamMasterform"));
      // AJAX request
    $.ajax({
      url:'<?=base_url()?>ItemmasterController/addAccountMaster',
      method: 'post',
      data: data1,
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
                              text: "Iteam Master is successfully added",
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

</script>



