<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Mill Taka Pending Register</h4>
                </div>
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label>Job Process</label>
                        <select id="job_process" name="job_process" class="form-control selectpicker" data-live-search="true" required>
                            <option value="">--Select--</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Mill Party</label>
                        <input type="text" class="form-control" name="mill_party" id="mill_party" placeholder="Enter Mill Party " autocomplete="off" pattern="[a-zA-Z]+">
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Purchase Party</label>
                        <input type="text" class="form-control txt_Space" name="purchase_party" id="purchase_party" placeholder="Enter Purchase Party" autocomplete="off" pattern="[a-zA-Z]+">
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Broker</label>
                        <input type="text" class="form-control" name="broker" id="broker" placeholder=" Enter Broker" autocomplete="off" pattern="[]+">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Quality</label>
                        <input type="text" class="form-control" name="quality" id="quality" placeholder=" Enter quality" pattern="[]+">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Design</label>
                        <input type="text" class="form-control" name="design" id="design" placeholder=" Enter design" pattern="[]+">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Colour</label>
                        <input type="text" class="form-control" name="colour" id="colour" placeholder=" Enter colour" pattern="[]+">
                    </div>
                    <div class="col-md-2 offset-md-5">
                        <button name="Search" id="search" class="btn btn-primary">Search</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="printTable" class="table" style="width:100%">
                            <thead>
                            <tr>
                                <th>Mill Party Name</th>
                                <th>Mill CH Number</th>
                                <th>Issue Date</th>
                                <th>Quality</th>
                                <th>Job Process</th>
                                <th>Total Taka</th>
                                <th>Iss Meters</th>
                                <th>Rec Meters</th>
                                <th>Pending Meters</th>
                                <th>Loss Meters</th>
                                <th>Purchase party</th>
                                <th>Purchase Bill No</th>
                                <th>Broker name</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php $this->load->view('assests/footer'); ?>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.5.1/js/dataTables.colReorder.min.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.5.1/js/dataTables.colReorder.min.js"></script>

<script>
  var table;

  $(document).ready(function () {
    table = $('#printTable').DataTable({
      ordering: false,
      bSort : false,
      paging: false,
      searching: false,
      colReorder: true,
      dom: 'Bfrtip',
      buttons: [
        'colvis'
      ]

    });


    function jobProcessList(jobProcess,y=null){
      $.ajax({
        url:'<?php echo base_url(); ?>ApiController/jobProcessList',
        type:'post',
        data:{},
        dataType:'json',
        success:function(response){
          $.each(response.jobProcessList,function(index,data){

            if (data['job_process_id_PK'] == y)
            {
              $('#job_process').append('<option value="'+data['job_process_id_PK']+'" selected>'+data['job_process_name']+'</option>');
            }else{
              $('#job_process').append('<option value="'+data['job_process_id_PK']+'">'+data['job_process_name']+'</option>');
            }
          });

          $('#job_process').selectpicker('refresh');

        }
      });
    }
    $('#job_process').selectpicker('refresh');
    jobProcessList();

    var dataMillParty = $("#mill_party").tautocomplete({

      width: "500px",
      columns: ['Acount Master Name', 'City Name', 'Contact Number'],
      placeholder: "Search Mill Party",
      id: "millParty_row_id",
      theme: "white",
      ajax: {
        url: "<?php echo base_url();?>ApiController/getAccountMaster",
        type: "POST",
        data: function()
        {
          var x = {millPartyName: $('#millParty_row_id').val()};
          return x;
        },
        success: function (result) {
          var filterData = [];
          var searchData = eval("/" + dataMillParty.searchdata() + "/gi");
          $.each(result, function (i, v) {
            if (v.name.search(new RegExp(searchData)) != -1) {
              filterData.push(v);
            }
          });
          var srcfild = dataMillParty.searchdata();
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
    var dataPurchaseParty = $("#purchase_party").tautocomplete({

      width: "500px",
      columns: ['Acount Master Name', 'City Name', 'Contact Number'],
      placeholder: "Search Purchase Party",
      id: "purchaseParty_row_id",
      theme: "white",
      ajax: {
        url: "<?php echo base_url();?>ApiController/getAccountMaster",
        type: "POST",
        data: function()
        {
          var x = {purchasePartyName: $('#purchaseParty_row_id').val()};
          return x;
        },
        success: function (result) {
          var filterData = [];
          var searchData = eval("/" + dataPurchaseParty.searchdata() + "/gi");
          $.each(result, function (i, v) {
            if (v.name.search(new RegExp(searchData)) != -1) {
              filterData.push(v);
            }
          });
          var srcfild = dataPurchaseParty.searchdata();
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
    var dataBroker = $("#broker").tautocomplete({
      width: "500px",
      columns: ['Broker Name', 'City Name', 'Phone Name'],
      placeholder: "Search Broker",
      id: "broker_row_id",
      theme: "white",
      ajax: {
        url: "<?php echo base_url();?>ApiController/getBroker/",
        type: "POST",
        data: function()
        {
          var x = {BrokerName: $('#broker_row_id').val()};
          return x;
        },
        success: function (result) {
          var filterData = [];
          var searchData = eval("/" + dataBroker.searchdata() + "/gi");
          $.each(result, function (i, v) {
            if (v.name.search(new RegExp(searchData)) != -1) {
              filterData.push(v);
            }
          });
          var srcfild = dataBroker.searchdata();
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
  });
</script>
