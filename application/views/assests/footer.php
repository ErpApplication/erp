<footer class="footer">
        <div class="container-fluid">
    
          <div class="copyright" id="copyright">
            &copy;
            <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
             </script> Manufacture Accounting

          </div>
        </div>
      </footer>
    </div>
  </div>
 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase/fonts/font_roboto/roboto.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase/dhtmlx.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css"/>




 
   <!-- Forms Validations Plugin -->
  <script src="<?php echo base_url(); ?>assets/js/plugins/jquery.validate.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery-validate-min.js"></script>
   <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="<?php echo base_url(); ?>assets/js/plugins/jquery.bootstrap-wizard.js"></script>
   <!-- Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="<?php echo base_url(); ?>assets/js/plugins/bootstrap-selectpicker.js"></script>
   <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="<?php echo base_url(); ?>assets/js/plugins/bootstrap-datetimepicker.js"></script>
   <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
  <script src="<?php echo base_url(); ?>assets/js/plugins/jquery.dataTables.min.js"></script>

  <script src="<?php echo base_url(); ?>assets/codebase/dhtmlx.js"></script>


   <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <!-- <script src="<?php echo base_url(); ?>assets/demo/demo.js"></script> -->

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      // demo.initDashboardPageCharts();

      // demo.initVectorMap();

    });
  </script>



  <script>
   $(document).ready(function(){

    var selector = '.nav li';

      $(selector).on('click', function(){
          $(selector).removeClass('active');
          $(this).addClass('active');
      });


      
  });

    </script>


    <script type='text/javascript'>
  // baseURL variable
  var baseURL= "<?php echo base_url();?>";
 
  $(document).ready(function()
  {
    jQuery('.numbersOnly').keyup(function () {
        this.value = this.value.replace(/[^0-9]/g,'');
    });

     jQuery('.floatOnly').keyup(function () {
        this.value = this.value.replace(/[^0-9.]/g,'');
    });

    jQuery('.txtOnly').keyup(function () {
        this.value = this.value.replace(/[^a-zA-Z]/g,'');
    });

    jQuery('.txt_Space').keyup(function () {
        this.value = this.value.replace(/[^a-zA-Z ]/g,'');
    });

    jQuery('.txt_Space_number').keyup(function () {
        this.value = this.value.replace(/[^a-zA-Z0-9, ]/g,'');
    });

    jQuery('.alpha_numeric').keyup(function () {
        this.value = this.value.replace(/[^a-zA-Z0-9]/g,'');
    });

     jQuery('.emailOnly').keyup(function () { 
         this.value = this.value.replace(/[^\w\.+@a-zA-Z_+?\.a-zA-Z\.]/g,'');

     });

  $(".datepicker").datepicker({dateFormat: 'dd/mm/yy', minDate: 0});


});
 
</script>

</body>

</html>