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
                <a class="btn btn-primary pull-right" href="<?php echo base_url() ?>Transport/addtransport">Add Transport</a>
                <h4 class="card-title">Transport List</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl_transportList" class="table" style="width:100%">
                    
                    <thead>
                              <tr>
                                <th>Transport Name</th>
                                <th>Transport Address</th>
                                <th>Contact Person</th>
                                <th>Contact Number</th>
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



    var tbl_productList = $('#tbl_transportList').DataTable(
      {
       
      "processing": false,
               "serverSide": true,
               paging:true,
               pageLength:10,
              "processing": true,
              "pagingType": "full_numbers",
              "scrollX": true,
               ajax: {
                  url: "<?php echo base_url() ?>Transport/transportListwebAPI", // The service URL
                  type: "get",       // The type of request (post or get)
                  allInOne: false,            // Set to true to load all your data in one AJAX call
                  refresh: false  ,
                  dataSrc: function (json)
                  {
                      var cars = [];

                      for (var i = 0; i < json.data.length; i++) 
                      {
                        var object =  json.data[i];
                        object.edit = "<a href='<?php echo base_url() ?>Transport/get_update_transport_list/"+btoa(object.id)+"'><i class='fa fa-edit fa-lg'></i></a>";
                      }

                      return json.data;
                  },
                                      
          },

            "columns": [
            { "data": "transport_name"},
            { "data": "transport_address"},
            { "data": "contact_person"},
            { "data": "contact_mobile"},
            { "data": "edit"}
           
            
        
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
