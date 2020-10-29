<?php include("header.php"); ?>

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">

<div class="col-lg-12">

    
    <!-- Show Categories Example  -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Domain Category</h6>
        </div>
        <div class="card-body">
        <!-- Message -->
        <?php if($msg = $this->session->flashdata('user_msg')) :
                $msg_class = $this->session->flashdata('user_class'); 
                ?>
                    <div class="alert alert-dismissible <?php echo $msg_class; ?>">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong></strong> <a href="#" class="alert-link"><?php echo $msg; ?></a>.
                    </div>
            <?php endif; ?>
        <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-center">
                      <th>S.No.</th>
                      <th>Domain Name</th>
                      <th>Category Name</th>
                      <th>Buy Price</th>
                      <th>Lease Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                      <tr class="text-center">
                        <th>S.No.</th>
                        <th>Domain Name</th>
                        <th>Category Name</th>
                        <th>Buy Price</th>
                        <th>Lease Price</th>
                        <th>Action</th>
                      </tr>
                  </tfoot>
                  <tbody>

                  
                  <?php if (count($domain_list)):  
                            $count=0; ?>
                        <?php foreach($domain_list as $list): ?>
                        <tr class="text-center">
                        <td><?= ++$count; ?></td>
                        <td><?= anchor("admin/edit_domainList/{$list->id}",$list->domainName); ?></td>
                        <td><?= $list->category_name; ?></td>
                        <td><?= $list->buy_price; ?></td>
                        <td><?= $list->lease_price; ?></td>
                        <td>
                            <?=  anchor("admin/edit_domainList/{$list->id}",'<i class="fas fa-pen"></i>',['class'=>'btn btn-info btn-circle btn-sm','title'=>'Update']);?>
                            <?= 
                                form_open('admin/deleteDomainList'),
                                form_hidden('domainList_id',$list->id),
                                form_button([  'name'=> 'button','id'=> 'delete_btn','value'=> 'true','type'=>'submit','title'=> 'Delete','class'=>'btn btn-danger btn-circle btn-sm','content'=>'<i class="fas fa-trash"></i>']),
                                form_close();

                            ?>

                        </td>
                        </tr>
                        <?php  endforeach; ?>
                        <?php  else: ?>	
                        <tr colspan="4">
                        <td>No Record Found</td>
                        </tr>	
                        <?php  endif; ?>
                  
                  </tbody>
                </table>
              </div>

        </div>
    </div>

    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add Domain</h6>
        </div>
        <div class="card-body"> 
        
        <!-- Add Domain Form Open -->
        <?php echo form_open('admin/add_domainList');?>
                <?php echo form_hidden('status',1) ?>
                    <div class="row">
                        <div class="col-lg-3 col-sm-3 col-xs-3">
                            <h5>Category:</<h5>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-xs-3">
                                <div class="form-group">
                                    <select class="form-control" name="category_id" required>
                                        
                                    <option value="">Select Category</option>
                                 <?php if (count($categories)){  
                                  $count=0; ?>
                                    <?php foreach($categories as $cat){ ?>
                                            <option value="<?= $cat->id ?>"><?= $cat->category_name; ?></option>

                                <?php } } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                                <div class="col-lg-3 col-sm-3 col-xs-3">
                                    <h5>Domain Name:</<h5>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <?php echo form_input(array('class'=>'form-control form-control-user','placeholder'=>'Enter Domain Name','name'=>'domainName','value'=>set_value("domainName")));  ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <?php echo form_error('domainName'); ?>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-lg-3 col-sm-3 col-xs-3">
                                    <h5>Buy Price:</<h5>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <?php echo form_input(array('class'=>'form-control form-control-user','placeholder'=>'Enter Buy Price','name'=>'buy_price','value'=>set_value("buy_price")));  ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <?php echo form_error('buy_price'); ?>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-lg-3 col-sm-3 col-xs-3">
                                    <h5>Lease Price:</<h5>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <?php echo form_input(array('class'=>'form-control form-control-user','placeholder'=>'Enter Lease Price','name'=>'lease_price','value'=>set_value("lease_price")));  ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <?php echo form_error('lease_price'); ?>
                                </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                <?php echo form_submit(array('type'=>'submit','class'=>'btn btn-primary btn-user','value'=>'Add')); ?>
                            </div>
                        </div>

                <?php echo form_close(); ?>
        </div>
        <form method="post" id="import_form" action="<?php echo base_url(); ?>admin/import" enctype="multipart/form-data">
            <p><label>Select Excel File</label>
            <input type="file" name="file" id="file" required accept=".xls, .xlsx, .csv" /></p>
            <br />
            <input type="submit" name="import" value="Import Domains" class="btn btn-info" />
            <a href="<?php echo base_url(); ?>admin/export_domain" class="btn btn-primary">Export Domains</a>
        </form>
    </div>

    </div>
</div>

<!-- Modal --
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
 Model Closed -->

 <!-- <script>
      var elems = document.getElementsById('delete_btn');
    var confirmIt = function (e) {
        if (!confirm('Are you sure?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
 </script> -->
</div>

<?php include("footer.php"); ?>