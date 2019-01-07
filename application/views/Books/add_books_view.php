	<div class="panel-header panel-header-sm">
  </div>
<style type="text/css">
  div.solid {
    border-style: solid;
    padding: 10px;
  }

</style>
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
                 
            <a href="<?= base_url(); ?>BooksController" class="btn btn-primary">Back</a>

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
           <form id="booksform" method="post">
                  <div class="row">

                      <div class="col-md-6 form-group">
                          <label >Book Number <span class="mandatory"> *  
                               </span> 
                            </label>
                              <input type="text" class="form-control numbersOnly" name="add_books_book_no" id="add_books_book_no" placeholder="Enter Book Number" autocomplete="off" required>

                      </div>

                      <div class="col-md-6 form-group">
                          <label >Type  <span class="mandatory"> *  
                               </span> 
                            </label>
                          <select data-live-search="true" class="form-control selectpicker" name="add_books_type" id="add_books_type"  autocomplete="off" required>
                            <option value="">--Select--</option>
                            <option value="1">Sales</option>
                            <option value="2">Purchase</option>
                            <option value="3">Both</option>
                          </select>
                      </div>

                  </div>


                   <div class="row" style="display:none;" id="purchase_show_purchase">

                      <div class="col-md-6 form-group">
                          <label >Purchase A/C Code  <span class="mandatory"> *  
                               </span> 
                            </label>
                              <input type="text" class="form-control numbersOnly" name="add_books_purchase_account_no" id="add_books_purchase_account_no" placeholder="Enter Purchase A/c Code" autocomplete="off" required>

                      </div>

                      <div class="col-md-6 form-group">
                          <label >Name  <span class="mandatory"> *  
                               </span> 
                            </label>
                         <input type="text" class="form-control txt_Space" name="add_books_purchase_name" id="add_books_purchase_name" placeholder="Enter Purchase A/C Name" autocomplete="off" required>

                      </div>

                  </div>


                  <div class="row" style="display:none;" id="purchase_show_sales">

                      <div class="col-md-6 form-group">
                          <label >Sales A/C Code  <span class="mandatory"> *  
                               </span> 
                            </label>
                              <input type="text" class="form-control numbersOnly" name="add_books_sales_account_no" id="add_books_sales_account_no" placeholder="Enter Sales A/C Code" autocomplete="off" required>

                      </div>

                      <div class="col-md-6 form-group">
                          <label >Name  <span class="mandatory"> *  
                               </span> 
                            </label>
                         <input type="text" class="form-control txt_Space" name="add_books_sales_name" id="add_books_sales_name" placeholder="Enter Sales A/C Name" autocomplete="off" required>

                      </div>

                  </div>



               <!--    <div class="row">

                      <div class="col-md-4 form-group">
                          <label >Box 1  <span class="mandatory"> *  
                               </span> 
                            </label>
                              <input type="text" class="form-control txt_Space" name="add_books_book_no" id="add_AccountMaster_Job_Process" placeholder="Enter Voucher Number" autocomplete="off" required>

                      </div>

                      <div class="col-md-4 form-group">
                          <label >Box 2  <span class="mandatory"> *  
                               </span> 
                            </label>
                          <input type="text" class="form-control txt_Space" name="add_books_book_no" id="add_AccountMaster_Job_Process" placeholder="Enter Voucher Number" autocomplete="off" required>

                         
                      </div>


                      <div class="col-md-4 form-group">
                          <label >Box 3  <span class="mandatory"> *  
                               </span> 
                            </label>
                           <input type="text" class="form-control txt_Space" name="add_books_book_no" id="add_AccountMaster_Job_Process" placeholder="Enter Voucher Number" autocomplete="off" required>

                      </div>

                  </div> -->



                  <div class="row">

                      <div class="col-md-6 form-group">
                          <label >L.R Required  <span class="mandatory"> *  
                               </span> 
                            </label>
                              <select data-live-search="true" class="form-control selectpicker" name="add_books_lr_required" id="add_books_lr_required"  autocomplete="off" required>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                          </select>

                      </div>

                      <div class="col-md-6 form-group">
                          <label >Bill Type  <span class="mandatory"> *  
                               </span> 
                            </label>
                          <select data-live-search="true" class="form-control selectpicker" name="add_books_bill_type" id="add_books_bill_type"  autocomplete="off" required>
                            <option value="1">Tax</option>
                            <option value="2">Return</option>
                          </select>
                      </div>

                  </div>


                   <div class="row">

                      <div class="col-md-6 form-group">
                          <label >Gen. Purchase  <span class="mandatory"> *  
                               </span> 
                            </label>
                              <select data-live-search="true" class="form-control selectpicker" name="add_books_gen_purchase" id="add_books_gen_purchase" autocomplete="off" required>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                          </select>

                      </div>

                      <div class="col-md-6 form-group">
                          <label >Cash Pay at Bill  <span class="mandatory"> *  
                               </span> 
                            </label>
                          <select data-live-search="true" class="form-control selectpicker" name="add_books_cash_pay_bill" id="add_books_cash_pay_bill"  autocomplete="off" required>
                             <option value="1">Yes</option>
                            <option value="0">No</option>
                          </select>
                      </div>

                  </div>


                <!--   <div class="row">

                      <div class="col-md-3 form-group">
                          <label >Desc Label - 1  <span class="mandatory"> *  
                               </span> 
                          </label>

                         <input type="text" class="form-control txt_Space" name="add_books_book_no" id="add_AccountMaster_Job_Process" placeholder="Enter Voucher Number" autocomplete="off" required>

                      </div>

                      <div class="col-md-3 form-group">
                          <label >Desc Label - 2  <span class="mandatory"> *  
                               </span> 
                            </label>
                         <input type="text" class="form-control txt_Space" name="add_books_book_no" id="add_AccountMaster_Job_Process" placeholder="Enter Voucher Number" autocomplete="off" required>

                      </div>

                      <div class="col-md-3 form-group">
                          <label >Desc Label - 3  <span class="mandatory"> *  
                               </span> 
                            </label>
                         <input type="text" class="form-control txt_Space" name="add_books_book_no" id="add_AccountMaster_Job_Process" placeholder="Enter Voucher Number" autocomplete="off" required>

                      </div>

                      <div class="col-md-3 form-group">
                          <label >Desc Label - 4  <span class="mandatory"> *  
                               </span> 
                            </label>
                         <input type="text" class="form-control txt_Space" name="add_books_book_no" id="add_AccountMaster_Job_Process" placeholder="Enter Voucher Number" autocomplete="off" required>

                      </div>
                  </div> -->

                   <div class="row">

                      <div class="col-md-3 form-group">
                          <label >T.D.S [Y/N]  <span class="mandatory"> *  
                               </span> 
                          </label>
                         <select data-live-search="true" class="form-control selectpicker" name="add_books_tds" id="add_books_tds" autocomplete="off" required>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                          </select>
                      </div>
                    </div>

            </form>   

            <button name="add_book" id="add_book" class="btn btn-primary" ><?php if($uid==""){echo "Add Book";}else{echo 'Update Book';} ?>Save</button>
                      
          </div>
        </div>
      </div>
    </div>

    </div>


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
  
  
  $('#add_books_type').on( 'change', function () {
     var type=$('#add_books_type').val();
     if(type==1){
        $('#purchase_show_sales').show();
        $('#purchase_show_purchase').hide();
     }else if(type==2){
        $('#purchase_show_purchase').show();
        $('#purchase_show_sales').hide();
     }else if(type==3){
        $('#purchase_show_purchase').show();
        $('#purchase_show_sales').show();

     }

  });

 $('#add_book').on( 'click', function () {
    if ($('#booksform').valid())
    {
        addBookToServer();
    } 
  });

  function addBookToServer(){
  var data1 = new FormData(document.getElementById("booksform"));

      // AJAX request
    $.ajax({
      url:'<?=base_url()?>BooksController/addBook',
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
                        text: "Book is successfully added",
                        expire: 0
                  });
                    //window.location.replace("<?php echo base_url(); ?>WorkIssueMillController/addWorkMill");
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


 


  $('#serialNumber').val(tbl_inventoryIssue.rows().count() + 1); 

  $('#add_Detail').on( 'click', function () {

    if ($("#operatorform").validate().element('#groupName') == false || $("#operatorform").validate().element('#qualityName') == false || $("#operatorform").validate().element('#pcs') == false || $("#operatorform").validate().element('#cut') == false || $("#operatorform").validate().element('#quantity') == false )
    {

    }else
    {

    	 

    	var nextid = $("#serialNumber").val();

      tbl_inventoryIssue.row.add( [
         '<input type="text" id="'+nextid+'" name="sno[]" value="'+$("#serialNumber").val()+'">',
    	 '<input type="text" id="'+nextid+'" name="group[]" value="'+$("#groupName").val()+'">',
    	 '<input type="text" id="'+nextid+'" name="uantityname[]" value="'+$("#qualityName").val()+'">',
    	 '<input type="text" id="'+nextid+'" name="pcs[]" value="'+$("#pcs").val()+'">',
    	 '<input type="text" id="'+nextid+'" name="cut[]" value="'+$("#cut").val()+'">',
    	 '<input type="text" id="'+nextid+'" name="quality[]" value="'+$("#quantity").val()+'">',
        ] ).node().id = nextid;
      
		tbl_inventoryIssue.draw( false );

      $('#groupName').val("");
      $('#qualityName').val("");
      $('#pcs').val("");
      $('#cut').val("");
      $('#quantity').val("");
    }
        
 
    } );


  

} );



</script>



