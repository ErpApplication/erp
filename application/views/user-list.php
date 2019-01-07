




<!-- <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Manage Users</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl_productList" class="table">
                    
                    <thead>
                              <tr>

                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Registration Date</th>


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
      </div> -->



<!-- page heading end-->

<!--body wrapper start-->
<!-- <div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                
                 
                
                <div class="panel-body">
                    <div class="adv-table">
                        <table id="tbl_productList" class="table table-bordered table-striped">
                            <thead>
                              <tr>

                                <th>Profile Image</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Register Date</th>
                                <th>Total Order</th>

                                <th class="hidden-phone">Status</th>

                              </tr>
                            </thead>
                            <tbody>

                            </tbody>

                             <tfoot>
                              <tr>
                                  <th>Profile Image</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Register Date</th>
                                <th>Total Order</th>
                                <th class="hidden-phone">Status</th>
                              </tr>
                            </tfoot>

        </table>


                    </div>
                </div>

                <input type="hidden" id="uid" />

            </section>-->

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

        <?php  //$this->load->view('asset/footer');     ?>



<script >


$(document).ready(function() {



    var tbl_productList = $('#tbl_productList').DataTable(
      {
       
      "processing": false,
               "serverSide": true,
               paging:true,
               pageLength:10,
              "processing": true,
              "pagingType": "full_numbers",
              "scrollX": true,
               ajax: {
                  url: "<?php echo base_url() ?>user/userListwebAPI", // The service URL
                  type: "get",       // The type of request (post or get)
                  allInOne: false,            // Set to true to load all your data in one AJAX call
                  refresh: false  ,
                  dataSrc: function (json)
                  {
                      return json.data;
                  },
                                      
          },

            "columns": [
            { "data": "firstname"},
            { "data": "lastname"},
            { "data": "email"},
            { "data": "mobile"},
            { "data": "created_date"}
            
        
        ]
    

    } );


      $('#delete').on('click', function (e) {

        var id = $('#uid').val();

        $.ajax({
                type:'post',
                url : '<?php echo base_url('user/deleteUser/'); ?>',
                data : {'userId': id,'isActive': '0'},   
                success : function(data){
                    if(data == 1){
                      $('#DT_RowId_'+id).animate( {backgroundColor:'#EF5350'}, 1000).fadeIn(1000,function() {
                             $('#DT_RowId_'+id).removeClass("highlightwhite").addClass("highlightred");
                             $('#DT_RowId_'+id).remove();
                         });
                         setTimeout(function(){$('#DT_RowId_'+id).removeClass("highlightred").addClass('highlightwhite');;},5000);

                    }else{
                        alert('Something went wrong');
                    }
                }
          });
          
      });

} );




</script>
