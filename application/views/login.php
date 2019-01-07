<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="ThemeBucket">
        <link rel="shortcut icon" href="#" type="image/png">

        <title>Login</title>

        <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="<?php echo base_url(); ?>src/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>src/css/now-ui-dashboard.css?v=1.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo base_url(); ?>src/css/demo/demo.css" rel="stylesheet" />
     
    </head>

    <body class="">

        

        <div class="container">
            <form id="login_form" ole="form" class="form-signin" method="POST" action="<?php echo base_url(); ?>login/do_login" novalidate="true" autocomplete="off">


                    <div class="form-signin-heading text-center">
                    <h1 class="sign-title">Sign In</h1>
                    <!--<img src="<?php //echo base_url();   ?>images/login-logo.png" alt=""/>-->
                     <div class="row">
                    <br><br>
                     <div class="col-md-4"></div>
                      <div class="col-md-4">
                    <?php if ($this->session->flashdata('error_msg') != NULL) { ?>
                        <div id="failure_msg" class="alert alert-danger">
                            Incorrect user name / password. Please try again.
                        </div>
                    <?php } ?>

                        <?php if ($this->session->flashdata('errors_msg') != NULL) { ?>
                        <div id="failure_msg" class="alert alert-danger">
                           Please Enter Valid user name / Password.
                        </div>
                    <?php } ?>
                    </div>
                    </div>
                    </div>



                    <div class="row">
                                            <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>UserName</label>
                    <input id="email" type="text" class="form-control" name="username" placeholder="Username" required autofocus value="">
                           <?php echo form_error('username', '<p class="help-block">', '</p>'); ?>                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Password</label>
                    <input id="password" placeholder="Password" type="password" class="form-control" name="password" required value="">
                           <?php echo form_error('password', '<p class="help-block">', '</p>'); ?>                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-round btn-lg btn-block mb-3" type="submit">
                        <i class="fa fa-check"></i>
                    </button>                      </div>
                    </div>
                  </div>

                </div>

                <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Forgot Password ?</h4>
                            </div>
                            <div class="modal-body">
                                <p>Enter your e-mail address below to reset your password.</p>
                                <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                                <button class="btn btn-primary" type="button">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->

            </form>

        </div>


<!--   Core JS Files   -->
  <script src="<?php echo base_url(); ?>src/js/core/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>src/js/core/popper.min.js"></script>
  <script src="<?php echo base_url(); ?>src/js/core/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>src/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="<?php echo base_url(); ?>src/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url(); ?>src/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo base_url(); ?>src/js/now-ui-dashboard.min.js?v=1.1.0" type="text/javascript"></script>


    </body>
</html>

