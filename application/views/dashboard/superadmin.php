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
                    <div class="panel purple">
                        <div class="symbol">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="state-value">
                            <div class="value"><?php echo $userCount; ?></div>
                            <div class="title">Total No. of register User</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="panel red">
                        <div class="symbol">
                            <i class="far fa-utensils"></i>
                        </div>
                        <div class="state-value">
                            <div class="value"><?php echo $offerCOunt; ?></div>
                            <div class="title">Total No. of Offers</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row state-overview">
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="panel blue">
                        <div class="symbol">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="state-value">
                            <div class="value"><?php echo $orderCount; ?></div>
                            <div class="title"> Total No. of orders</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="panel green">
                        <div class="symbol">
                            <i class="fa fa-utensils-alt"></i>
                        </div>
                        <div class="state-value">
                            <div class="value"><?php echo $productCount; ?></div>
                            <div class="title"> Total No. of Product</div>
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