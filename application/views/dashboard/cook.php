<?php $this->load->view('layouts/header'); ?> 
<div class="page-heading">
    <h3>
        Dashboard
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
        </li>
        <li class="active"> My Dashboard </li>
    </ul>
</div>
<!-- page heading end-->

<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <!--statistics start-->
            <div class="row state-overview">
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="panel blue">
                        <div class="symbol">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="state-value">
                            <div class="value"><?php echo $orderCount; ?></div>
                            <div class="title"> Total Number of orders</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="panel green">
                        <div class="symbol">
                            <i class="fa fa-eye"></i>
                        </div>
                        <div class="state-value">
                            <div class="value"><?php echo $dishCount; ?></div>
                            <div class="title"> No. Dishes Posted</div>
                        </div>
                    </div>
                </div>
            </div>
            <!--statistics end-->
        </div>
    </div>
</div>
<!--body wrapper end-->
<?php $this->load->view('layouts/footer'); ?> 