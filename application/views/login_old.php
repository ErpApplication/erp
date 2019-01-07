


<?php $this->load->view('assests/header'); ?>

<style>
::placeholder {
    color: red;
    opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
   color: red;
}

::-ms-input-placeholder { /* Microsoft Edge */
   color: red;
}
</style>

<div class="wrapper wrapper-full-page ">

<div class="full-page-background" style="background-color:#ffffff  ">

    <div class="full-page login-page section-image" filter-color="black" data-image="assets/img/bg14.jpg">
      <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
      <div class="content" style="background-color:white">
        <div class="container">
          <div class="col-md-4 ml-auto mr-auto">


              <form id="login_form" class="form-signin" method="POST" action="<?php echo base_url(); ?>login/do_login" >


                    <div class="form-signin-heading text-center">
                   
                    <img src="<?php echo base_url();   ?>assets/img/kishk_logo.png" alt=""/>
                    <br><br>
                    <?php if ($this->session->flashdata('error_msg') != NULL) { ?>
                        <div id="failure_msg" class="alert alert-danger">
                            Incorrect email id / password. Please try again.
                        </div>
                    <?php } ?>

                        <?php if ($this->session->flashdata('errors_msg') != NULL) { ?>
                        <div id="failure_msg" class="alert alert-danger">
                           Please Enter Valid EmailId / Password.
                        </div>
                    <?php } ?>
                    </div>

              <div class="card card-login card-plain">
                <div class="card-header ">
                  <div class="logo-container">
                    <img src="img/bg14.jpg" alt="">
                  </div>
                </div>
                <div class="card-body ">
                  <div class="input-group no-border form-control-lg">
                    <span class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="now-ui-icons users_circle-08"></i>
                      </div>
                    </span>
                   <input style="color:#000000" id="email" type="email" class="form-control" name="username" placeholder="Email" required>
                           
                  </div>
                  <div class="input-group no-border form-control-lg">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="now-ui-icons ui-1_lock-circle-open"></i>
                      </div>
                    </div>
                   <input id="password" style="color:#000000" placeholder="Password" type="password" class="form-control" name="password" required minlength="15" maxlength="15">
                          
                  </div>
                </div>
              
                      <button type="submit" class="btn btn-primary btn-round btn-lg btn-block mb-3">
                       <!--  <i class="fa fa-check"></i> -->Login
                    </button>          
           


              </div>
            </form>
          </div>
        </div>
      </div>

   <?php //$this->load->view('assests/footer') ?>
   </div>


