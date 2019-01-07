<div class="sidebar" data-color="orange">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
  -->
    <div class="logo">
        <a href="#" class="simple-text logo-mini">AM
            <a href="<?php echo base_url() ?>dashboard"><img src="<?php echo base_url(); ?>assets//kishk_logo.png"
                                                             width="40" height="40"/></a>
        </a>
        <a href="#" class="simple-text logo-normal">

        </a>
        <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-simple btn-icon btn-neutral btn-round">
                <i class="now-ui-icons text_align-center visible-on-sidebar-regular"></i>
                <i class="now-ui-icons design_bullet-list-67 visible-on-sidebar-mini"></i>
            </button>
        </div>
    </div>
    <div class="sidebar-wrapper">

        <ul id="navid" class="nav">
            <li class="<?php if ($currentPage == 'dashboard') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url() ?>dashboard">
                    <i class="now-ui-icons design_app"></i>
                    <p>Dashboard</p>
                </a>
            </li>


            <li class="<?php if ($currentPage == 'AccountType') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url() ?>AccountMasterController">
                    <i class="now-ui-icons design_app"></i>
                    <p>Account Type </p>
                </a>
            </li>
            <li class="<?php if ($currentPage == 'iteam') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url() ?>ItemmasterController">
                    <i class="now-ui-icons design_app"></i>
                    <p>Item </p>
                </a>
            </li>
            <li class="<?php if ($currentPage == 'broker') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url() ?>BrokerController">
                    <i class="now-ui-icons design_app"></i>
                    <p>Broker </p>
                </a>
            </li>
            <li class="<?php if ($currentPage == 'jobProcess') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url() ?>JobprocessmasterController">
                    <i class="now-ui-icons design_app"></i>
                    <p>Job Process </p>
                </a>
            </li>


            <li class="<?php if ($currentPage == 'category') {
                echo 'active';
            } ?>">
                <a data-toggle="collapse" href="#formMaster" aria-expanded="true">
                    <i class="now-ui-icons files_single-copy-04"></i>
                    <p>
                        Master
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="formMaster">
                    <ul class="nav">

                        <li class="<?php if ($currentPage == 'operator') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url() ?>operator">
                                <i class="now-ui-icons users_single-02"></i>
                                <p id="p">Operator</p>
                            </a>
                        </li>

                        <li class="<?php if ($currentPage == 'courier') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url(); ?>courier">
                                <span class="sidebar-mini-icon">CR</span>
                                <span class="sidebar-normal"> Courier </span>
                            </a>
                        </li>

                        <li class="<?php if ($currentPage == 'transport') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url(); ?>transport">
                                <span class="sidebar-mini-icon">TP</span>
                                <span class="sidebar-normal"> Transport  </span>
                            </a>
                        </li>

                        <li class="<?php if ($currentPage == 'bank') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url(); ?>bank">
                                <span class="sidebar-mini-icon">BK</span>
                                <span class="sidebar-normal"> Bank  </span>
                            </a>
                        </li>

                        <li class="<?php if ($currentPage == 'zone') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url(); ?>zone">
                                <span class="sidebar-mini-icon">Z</span>
                                <span class="sidebar-normal"> Zone  </span>
                            </a>
                        </li>

                        <li class="<?php if ($currentPage == 'market') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url(); ?>MarketController">
                                <span class="sidebar-mini-icon">M</span>
                                <span class="sidebar-normal"> Market  </span>
                            </a>
                        </li>

                        <li class="<?php if ($currentPage == 'branch') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url(); ?>BranchController">
                                <span class="sidebar-mini-icon">B</span>
                                <span class="sidebar-normal"> Branch  </span>
                            </a>
                        </li>

                        <li class="<?php if ($currentPage == 'company') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url(); ?>CompanyController">
                                <span class="sidebar-mini-icon">C</span>
                                <span class="sidebar-normal"> Company  </span>
                            </a>
                        </li>

                        <li class="<?php if ($currentPage == 'checker') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url(); ?>checkerController">
                                <span class="sidebar-mini-icon">C</span>
                                <span class="sidebar-normal"> Checker  </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>


            <li class="<?php if ($currentPage == 'dispatch') {
                echo 'active';
            } ?>">
                <a data-toggle="collapse" href="#formDispatchMaster" aria-expanded="true">
                    <i class="now-ui-icons files_single-copy-04"></i>
                    <p>
                        Dispatch
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="formDispatchMaster">
                    <ul class="nav">

                        <li class="<?php if ($currentPage == 'Issue') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url() ?>IssueController">
                                <i class="now-ui-icons design_app"></i>
                                <p>Issue Work Dispatch </p>
                            </a>
                        </li>

                        <li class="<?php if ($currentPage == 'receiveWorkMaster') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url() ?>ReceiveworkController">
                                <i class="now-ui-icons design_app"></i>
                                <p>Receive Work </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="<?php if ($currentPage == 'category') {
                echo 'active';
            } ?>">
                <a data-toggle="collapse" href="#formWorkMill" aria-expanded="true">
                    <i class="now-ui-icons files_single-copy-04"></i>
                    <p>
                        Work Mill
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="formWorkMill">
                    <ul class="nav">

                        <li class="<?php if ($currentPage == 'millIssue') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url() ?>WorkIssueMillController">
                                <i c lass="now-ui-icons users_single-02"></i>
                                <p id="p">Work Issue Mill</p>
                            </a>
                        </li>

                        <li class="<?php if ($currentPage == 'receiveMill') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url() ?>WorkReceiveMillController">
                                <i class="now-ui-icons users_single-02"></i>
                                <p id="p">Work Receive Mill</p>
                            </a>
                        </li>
                        <li class="<?php if ($currentPage == 'workMillReport') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url() ?>WorkMillReportController">
                                <i class="now-ui-icons users_single-02"></i>
                                <p id="p">Work Mill Report</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="<?php if ($currentPage == 'category') {
                echo 'active';
            } ?>">
                <a data-toggle="collapse" href="#formPurchase" aria-expanded="true">
                    <i class="now-ui-icons files_single-copy-04"></i>
                    <p>
                        Purchase
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="formPurchase">
                    <ul class="nav">

                        <li class="<?php if ($currentPage == 'purchaseReturn') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url() ?>PurchaseReturnController">
                                <i class="now-ui-icons design_app"></i>
                                <p>Purchase Return </p>
                            </a>
                        </li>

                        <li class="<?php if ($currentPage == 'purchase') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url() ?>PurchaseController">
                                <i class="now-ui-icons design_app"></i>
                                <p>Purchase </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="<?php if ($currentPage == 'category') {
                echo 'active';
            } ?>">
                <a data-toggle="collapse" href="#formSales" aria-expanded="true">
                    <i class="now-ui-icons files_single-copy-04"></i>
                    <p>
                        Sales
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="formSales">
                    <ul class="nav">

                        <li class="<?php if ($currentPage == 'salesReturn') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url() ?>SalesReturnController">
                                <i class="now-ui-icons design_app"></i>
                                <p>Sales Return </p>
                            </a>
                        </li>

                        <li class="<?php if ($currentPage == 'salesMaster') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url() ?>SalesController">
                                <i class="now-ui-icons design_app"></i>
                                <p>Sales </p>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="<?php if ($currentPage == 'category') {
                echo 'active';
            } ?>">
                <a data-toggle="collapse" href="#formPayment" aria-expanded="true">
                    <i class="now-ui-icons files_single-copy-04"></i>
                    <p>
                        Payment
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="formPayment">
                    <ul class="nav">
                        <li class="<?php if ($currentPage == 'bankPayment') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url() ?>BankPaymentController">
                                <i class="now-ui-icons design_app"></i>
                                <p>Bank Payment </p>
                            </a>
                        </li>

                        <li class="<?php if ($currentPage == 'bankReceipt') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url() ?>BankReceiptController">
                                <i class="now-ui-icons design_app"></i>
                                <p>Bank Receipt </p>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>


            <li class="<?php if ($currentPage == 'category') {
                echo 'active';
            } ?>">
                <a data-toggle="collapse" href="#formCash" aria-expanded="true">
                    <i class="now-ui-icons files_single-copy-04"></i>
                    <p>
                        Cash
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="formCash">
                    <ul class="nav">


                        <li class="<?php if ($currentPage == 'cashReceipt') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url() ?>CashReceiptController">
                                <i class="now-ui-icons design_app"></i>
                                <p>Cash Receipt </p>
                            </a>
                        </li>

                        <li class="<?php if ($currentPage == 'cashPayment') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url() ?>CashPaymentController">
                                <i class="now-ui-icons design_app"></i>
                                <p>Cash Payment </p>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="<?php if ($currentPage == 'Inventory') {
                echo 'active';
            } ?>">

                <a data-toggle="collapse" href="#formsExamples1" aria-expanded="true">
                    <i class="now-ui-icons files_single-copy-04"></i>
                    <p>
                        Inventory
                        <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse  show " id="formsExamples1">
                    <ul class="nav">

                        <li class="<?php if ($currentPage == 'Inventory') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url() ?>InventoryJobIssueController">
                                <i class="now-ui-icons users_single-02"></i>
                                <p>Stock Issue</p>
                            </a>
                        </li>

                        <li class="<?php if ($currentPage == 'stockReceive') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo base_url() ?>InventryStockReceiveController">
                                <i class="now-ui-icons users_single-02"></i>
                                <p>Stock Receive</p>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>


            <li class="<?php if ($currentPage == 'Books') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url() ?>BooksController">
                    <i class="now-ui-icons users_single-02"></i>
                    <p id="p">Book</p>
                </a>
            </li>

            <li class="<?php if ($currentPage == 'generalExpence_purchase') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url() ?>Purchasegeneral_expencesController">
                    <i class="now-ui-icons design_app"></i>
                    <p>General Expense/Purchase </p>
                </a>
            </li>

            <li class="<?php if ($currentPage == 'challan') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url() ?>ChallanController">
                    <i class="now-ui-icons design_app"></i>
                    <p>Challan </p>
                </a>
            </li>


        </ul>


    </div>
</div>


