<?php include("header.php"); ?>
<div class="container-fluid">

<!-- Page Heading -->
<div class="row">

<div class="col-lg-12">

    
    <!-- Show Categories Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Domain Category</h6>
        </div>
        <div class="card-body">
        <?php if($msg = $this->session->flashdata('user_msg')) :
                $msg_class = $this->session->flashdata('user_class'); 
                ?>

                <div class="row">
                <div class="col-lg-6">
                    <div class="alert <?php echo $msg_class; ?>">
                    <?php echo $msg; ?>
                    </div>
                </div>
                </div>
            <?php endif; ?>
    
    <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>Category Name</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>S.No.</th>
                      <th>Category Name</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </tfoot>
                  <tbody>

                        <?php if (count($categories)):  
                            $count=0; ?>
                        <?php foreach($categories as $cat): ?>
                        <tr class="text-center">
                        <td><?= ++$count; ?></td>
                        <td><?= $cat->category_name; ?></td>
                        <td>
                        
                        <?php //anchor("admin/edit_article/{$cat->id}",'<span class="icon text-white-50"><i class="fas fa-info-circle"></i></span><span class="text">Update</span>',['class'=>'btn btn-info btn-icon-split btn-sm']); ?>
                                            
                        <?php  $mydata = array(
                        'name'          => 'button',
                        'id'            => 'delete_btn',
                        'value'         => 'true',
                        'type'          => 'submit',
                        'title'         => 'Delete',
                        'class'         => 'btn btn-danger btn-circle btn-sm',
                        'content'       => '<i class="fas fa-trash"></i>',
                        );?>
                        <a>
                        <?= 
                        form_open('admin/deleteCategory'),
                        form_hidden('id',$cat->id),
                        form_button($mydata),
                        //   form_submit(['name'=>'submit','value'=>'Delete','class'=>'btn btn-danger btn-icon-split btn-sm']),
                        form_close();

                        ?></a>
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

              <br>
        <h6 class="m-0 font-weight-bold text-primary">Add Category</h6>
                <?php echo form_open('admin/add_category');?>
                <?php echo form_hidden('admin_id',$this->session->userdata('admin_id')); ?>
                <?php echo form_hidden('status',1) ?>
                    <div class="row">
                        <div class="col-lg-5">
                        <div class="form-group">
                            <?php echo form_input(array('class'=>'form-control form-control-user','placeholder'=>'Enter Category Name','name'=>'category_name','value'=>set_value("category_name")));  ?>
                        </div>
                        </div>
                            
                        <div class="col-lg-3">
                            <div class="form-group">
                                <?php echo form_submit(array('type'=>'submit','class'=>'btn btn-primary btn-user','value'=>'Add')); ?>
                            </div>
                        </div>
                        <div class="col-lg-3">
                                <?php echo form_error('category_name'); ?>
                        </div>
                    </div>
                <?php echo form_close(); ?>
        </div>
    </div>
    </div>
</div>

</div>

<?php include("footer.php"); ?>