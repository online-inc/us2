<?php include("header.php"); ?>

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-left-primary">
                <div class="card-body">
                
        <!-- Update DomainList Form Open -->
        <?php echo form_open('admin/updateDomainList/'.$domain->id);?>
                <?php echo form_hidden('status',$domain->status) ?>
                    <div class="row">
                        <div class="col-lg-3 col-sm-3 col-xs-3">
                            <h5>Category:</<h5>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-xs-3">
                                <div class="form-group">
                                    <select class="form-control" name="category_id" required>
                                        
                                    <option value="<?= $domain->category_id ?>"><?= $domain->category_name ?></option>
                                 <?php if (count($categories)){  
                                  $count=0; ?>
                                    <?php foreach($categories as $cat){ ?>
                                            <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>

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
                                        <?php echo form_input(['class'=>'form-control form-control-user','placeholder'=>'Enter Domain Name','name'=>'domainName','value'=>set_value("domainName",$domain->domainName)]);  ?>
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
                                        <?php echo form_input(['class'=>'form-control form-control-user','placeholder'=>'Enter Buy Price','name'=>'buy_price','value'=>set_value("buy_price",$domain->buy_price)]);  ?>
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
                                        <?php echo form_input(['class'=>'form-control form-control-user','placeholder'=>'Enter Lease Price','name'=>'lease_price','value'=>set_value("lease_price",$domain->lease_price)]);  ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <?php echo form_error('lease_price'); ?>
                                </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                <?php echo form_submit(['type'=>'submit','class'=>'btn btn-primary btn-user','value'=>'Update']); ?>
                            </div>
                        </div>

                <?php echo form_close(); ?>
                </div>
            </div>
        </div>
</div>
</div>
<?php include("footer.php"); ?>