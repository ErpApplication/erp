<?php $this->load->view('assests/header') ?>

<?php $this->load->view('assests/sidebar');?>

<?php $this->load->view('assests/mainContent'); ?>


<div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <a class="btn btn-primary pull-right" href="<?php echo base_url(); ?>AccountMasterController/insertAccountMaster">Add Account Master Type</a>
                <h4 class="card-title">Account Master List</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl_accountMasterList" class="table" style="width:100%">
                    
                    <thead>
                              <tr>
                                <th>Account Master Name</th>
                                <th>Broker Name</th>
                                <th>Address 1</th>
                                <th>Contact Number</th>
                                <th>Area Name</th>
                                <th>Party Gtoup</th>
                                <th>Contact Person</th>
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

        <?php  $this->load->view('assests/footer');?>



<script >


$(document).ready(function() {
  
    var tbl_accountMasterList = $('#tbl_accountMasterList').DataTable(
      {
       
      "processing": false,
               "serverSide": true,
               paging:true,
               pageLength:10,
              "processing": true,
              "pagingType": "full_numbers",
              "scrollX": true,
               ajax: {
                  url: "<?php echo base_url() ?>AccountMasterController/accountMasterListwebAPI", // The service URL
                  type: "get",       // The type of request (post or get)
                  allInOne: false,            // Set to true to load all your data in one AJAX call
                  refresh: false  ,
                  dataSrc: function (json)
                  {


                      var cars = [];

                      for (var i = 0; i < json.data.length; i++) 
                      {
                        var object =  json.data[i];
                        object.edit = "<a href='<?php echo base_url() ?>AccountMasterController/get_update_AccountMaster_list/"+btoa(object.id)+"'><i class='fa fa-edit fa-lg'></i></a>";
                      }



                      return json.data;
                  },
                                      
          },

            "columns": [
            { "data": "account_master_name"},
            { "data": "broker_name"},
            { "data": "address1"},
            { "data": "contactNumber"},
            { "data": "areaName"},
            { "data": "partyGroup"},
            { "data": "contactPerson"},
            { "data": "edit"}
           
            
        
        ]
    

    } );

} );

</script>
