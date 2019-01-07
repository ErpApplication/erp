<style type="text/css">
   tr:hover {
    background-color: #fff;
}
</style>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
            <div class="col">
                <section class="panel">
                    <header class="panel-heading">
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                             </span>
                             <a href="<?php echo base_url(); ?>index.php/Branch_controller/addbranch" class="btn btn-primary">Add Branch</a>
                    </header>

                    
                    <div class="panel-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Branch Name</th>
                                <th>Branch Address</th> 
                                <th>Manager Number</th>
                                <th>Manager Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $i=1;
                            foreach($ret->result() as $row){
                              ?>
                                  <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row->branch_name; ?></td>
                                <td><?php echo $row->branch_address; ?></td>
                                <td><?php echo $row->manager_number; ?></td>
                                <td><?php echo $row->manager_email; ?></td>
                               
                                <td>
                                   <a href="<?php echo base_url(); ?>index.php/Branch_controller/get_update_branch_list/<?php echo base64_encode($row->branch_id_PK); ?>" class="btn btn-primary">Edit</a>
                                </td>
                            </tr>
                              <?php
                              $i++;
                            }
                            
                            ?>
                            
                        
                            </tbody>
                        </table>
                    </div>

                </section>
            </div>

        </div>
        <!--body wrapper end-->

  <?php $this->load->view('assests/footer') ?>


 




