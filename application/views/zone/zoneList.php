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
                <h4 class="card-title">Zone List</h4>
              </div>
              <div class="card-body">

                        <div class="panel-body">
                         <form id="zone_form">
                   <input type="hidden" id="uid" name="uid">
                            <div class="col-md-4 form-group">                          
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Zone Name"  required pattern="/^[a-zA-Z0-9 ]+$/"> 
                            </div>
                          
                           </form>
                           
                            <button name="add_zone" style='visibility:show' id="add_zone" class="btn btn-primary" >Add Zone</button>
                           
                            <button name="update_zone" id="update_zone"  style='display:none'  class="btn btn-primary">Update Zone</button>
                            


                        </div>


                <div class="table-responsive">
                  <table id="tbl_zoneList" class="table" style="width:100%">
                    
                    <thead>
                              <tr>
                                <th>Zone Name</th>
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

function UpdateZone(id,name)
{  
    console.log(id);
    $("#name").val(name);
    $("#uid").val(id);


    $('#update_zone').show();
    $('#add_zone').hide();
}

$(document).ready(function() {



    var tbl_productList = $('#tbl_zoneList').DataTable(
      {
       
      "processing": false,
               "serverSide": true,
               paging:true,
               pageLength:10,
              "processing": true,
              "pagingType": "full_numbers",
              "scrollX": true,
               ajax: {
                  url: "<?php echo base_url() ?>zone/zoneListwebAPI", // The service URL
                  type: "get",       // The type of request (post or get)
                  allInOne: false,            // Set to true to load all your data in one AJAX call
                  refresh: false  ,
                  dataSrc: function (json)
                  {
                      var cars = [];

                      for (var i = 0; i < json.data.length; i++) 
                      {
                        var object =  json.data[i];
                        object.edit = "<a href='#' onclick=UpdateZone('"+(object.id)+"','"+(object.name)+"')><i class='fa fa-edit fa-lg'></i></a>";
                      }

                      return json.data;
                  },
                                      
          },

            "columns": [
            { "data": "name"},
            { "data": "edit"}
           
            
        
        ]
    

    } );

 $('#add_zone').on('click', function () {
    
       if ($('#zone_form').valid() == true)
       {
           addZoneToServer();
       }
   });

 function addZoneToServer()
   {
        var name = $("#name").val();
        
        $.ajax({
        url:'<?=base_url()?>Zone/ZoneAdd',
        method: 'post',
        data: {name: name},
        dataType: 'json',
        success: function(response){
                        if(response){

                            var result=JSON.stringify(response);
                            var resultJsonDecode = jQuery.parseJSON(result);
                                //alert(result);
                            $("#msg").html(resultJsonDecode.message);
                        //    alert(resultJsonDecode.status);

                            if(resultJsonDecode.status==1){
                                 dhtmlx.message({
                                          type: "success",
                                          text: "Zone is successfully created",
                                          expire: 0
                                        });

                                $("#zone_form")[0].reset();
                               

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

 $('#update_zone').on('click', function () {

       if ($('#zone_form').valid() == true)
       {
           updateZoneToServer();
       }
   });

 function updateZoneToServer()
   {
    var uid=$('#uid').val();
    var name = $("#name").val();


    $.ajax({
      url:'<?=base_url()?>Zone/ZoneAdd',
      method: 'post',
      data: {uid:uid,name: name},
      dataType: 'json',
      success: function(response){
                       if(response){

                          var result=JSON.stringify(response);
                          var resultJsonDecode = jQuery.parseJSON(result);

                            if(resultJsonDecode.status==1){
                                    dhtmlx.message({
                                    type: "success",
                                    text: "Zone is successfully updated",
                                    expire: 0
                                  });

                                $('#update_zone').hide();
                                $('#add_zone').show();
                                $("#zone_form")[0].reset();

                              
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




} );




</script>
