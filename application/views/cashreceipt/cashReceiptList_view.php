
<div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <a class="btn btn-primary pull-right" href="<?php echo base_url(); ?>CashReceiptController/addCashReceipt">Add Cash Receipt </a>
                <h4 class="card-title">Cash Receipt List</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl_cashReceiptList" class="table" style="width:100%">
                    
                    <thead>
                              <tr>
                                <th>Voucher Number</th>
                                <th>Edit</th>
                              </tr>
                            </thead>

                    <tbody>
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>



<div id="myModal" class="modal fade" role="dialog"> 
  

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
       <div class="modal-body">
        Are you sure?
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>


    </div>

  </div>
</div>
<script >


$(document).ready(function() {
  
    var tbl_cashReceiptList = $('#tbl_cashReceiptList').DataTable(
      {
       
      "processing": false,
               "serverSide": true,
               paging:true,
               pageLength:10,
              "processing": true,
              "pagingType": "full_numbers",
              "scrollX": true,
               ajax: {
                  url: "<?php echo base_url() ?>CashReceiptController/cashReceiptListwebAPI", // The service URL
                  type: "get",       // The type of request (post or get)
                  allInOne: false,            // Set to true to load all your data in one AJAX call
                  refresh: false  ,
                  dataSrc: function (json)
                  {


                      var cars = [];

                      for (var i = 0; i < json.data.length; i++) 
                      {
                        var object =  json.data[i];
                        object.edit = "<a href='#'><i class='fa fa-edit fa-lg'></i></a>";
                      }



                      return json.data;
                  },
                                      
          },

            "columns": [
            { "data": "voucher_no"},
            { "data": "edit"}
           
            
        
        ]
    

    } );

} );

</script>
