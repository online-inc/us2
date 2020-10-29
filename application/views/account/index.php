<?php include("header.php"); ?>
<div class="container">
<div class="row">
    <div class="col-lg-8">
      <h1 style="color:#d83b02;">Account Overview</h1>
    </div>
    <div class="col-lg-4">
    <!-- <button type="button" class="btn btn-success btn-lg">MY PRODUCTS</button> -->
    <button type="button" class="btn btn-info btn-lg float-right">MY DOMAINS</button>
    </div>
  </div>
</div>

<div class="container my-box">
    <div class="row">
      <div class="col-lg-12">
        <div class="card bg-light mb-3" style="max-width: 100%;">
          <!-- <div class="card-header">Header</div> -->

            <div class="card-body">
                <div class="col-lg-12">
                  <div class="list-group">
                      <div class="list-group-item list-group-item-action flex-column align-items-start active">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1">Domain Name</h5>
                        </div>
                      </div>
                      
          <?php if($product){ ?>
                    <?php foreach($product as $rows){ ?>
                      <div class="list-group-item flex-column align-items-start" style="margin:10px;">
                        <div class="w-100 justify-content-between">
                          <div class="row">
                            <div class="col-lg-6">
                             <a href="<?= base_url('domain_details/info/')?><?= $rows->domainName ?>"><h5 class="mb-1"><?= $rows->domainName ?></h5></a>
                            </div>
                            
                            <div class="col-lg-3">
                          <small class="text-muted">Expires on <?php echo date('d-M-Y',strtotime($rows->renewal_date)); ?></small>
                            </div>
                            <div class="col-lg-3">
                            <button type="button" class="btn btn-success btn-sm float-right">Renew</button>
                            </div>
                        </div>
                        </div>
                        <!-- <p class="mb-1">Renewal Price: $300</p> -->
                        <!-- <small class="text-muted">Donec id elit non mi porta.</small> -->
                          <large>
                            <button type="button" class="btn btn-info btn-sm">DNS</button>
                          </large>
                      </div>
                    <?php } ?>

                    <?php }else{ ?>
                        <h2>No Products Available</h2>
                      <?php }?>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3">
        <div class="card bg-light mb-3" style="max-width: 100%;">
            <div class="card-body">
            <a href="#">
              <h2 class="card-title text-center"><i class="fa fa-cogs" aria-hidden="true"></i></h2>
              <p class="card-text text-center">Account Settings</p>
            </a>
            </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card bg-light mb-3" style="max-width: 100%;">
          <div class="card-body">
            <a href="#">
              <h2 class="card-title text-center"><i class="fa fa-key" aria-hidden="true"></i></h2>
              <p class="card-text text-center">Security Settings</p>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card bg-light mb-3" style="max-width: 100%;">
          <div class="card-body">
            <a href="#">
              <h2 class="card-title text-center"><i class="fa fa-credit-card" aria-hidden="true"></i></h2>
              <p class="card-text text-center">Auto Renewals</p>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card bg-light mb-3" style="max-width: 100%;">
          <div class="card-body">
            <a href="#">
              <h2 class="card-title text-center"><i class="fa fa-user-circle-o" aria-hidden="true"></i></h2>
              <p class="card-text text-center">User Profile</p>
            </a>
          </div>
        </div>
      </div>  
</div>
</div>
<?php include("footer.php"); ?>