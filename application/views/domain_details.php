<!-- Header Start -->

<?php include("account/header.php"); ?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<!-- <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="https://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<link href="assets/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet">
    <script src="assets/bootstrap-editable/js/bootstrap-editable.js"></script>
<?php //echo "<pre>";print_r($exactMatch); ?>
<style>
    .toggle{
      border: 1px solid #555456;
    }
    .toggle-on{
      background-color: #d83b03;
    }
</style>

<div class="jumbotron">
<?php 

foreach($domain_data as $domain_data){
          $domain_name = $domain_data->domainName;
  ?>
  <h3 class="text-center"><?= $domain_data->domainName ?></h3>
  <h5 class="text-center text-success"><strong> Expires: </strong><?php echo date('d-M-Y',strtotime($domain_data->renewal_date)); ?></h5> 
  
<?php } ?>
<br>
  <div class="container">
  <div class="row">
    <!-- <div class="col-sm-4" style="border-right: 1px solid #c4c4c4;">
      <h4><strong>WHOIS PRIVACY</strong></h4>
      <form>
        <div class="form-group">
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="customSwitch1" name="whois" checked>
            <label class="custom-control-label" for="customSwitch1"></label>
          </div>
        </div>
      </form>
    </div> -->
    <div class="col-sm-6 text-center" style="border-right: 1px solid #c4c4c4;">
      <h4><strong>AUTOMATIC RENEWAL</strong></h4>
      <form>
        <div class="form-group">
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="customSwitch2" checked="">
            <label class="custom-control-label" for="customSwitch2"></label>
          </div>
        </div>
      </form>
    </div>
    <div class="col-sm-6 text-center">
      <h4><strong>RENEWAL: $<?= $domainAPI_data['renewalPrice'] ?></strong></h4>
      <form>
        <div class="form-group">
        <button type="button" class="btn btn-success">RENEW DOMAIN</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h2>Domain Details</h2>
      <hr>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-3" style="border-right: 1px solid #c4c4c4;">
      <h5><strong>REGISTRANT CONTACTS</strong></h5>
      
<?php

        // print_r($user_Data);
        foreach($user_datafromDB as $user_datafromDB){         
          ?>
              <p>
                <?=$user_datafromDB->firstname.' '.$user_datafromDB->lastname.'<br>' ?>
                <?=$user_datafromDB->organization.'<br>' ?>
                <?=$user_datafromDB->address1.', '.$user_datafromDB->address1.'<br>' ?>
                <?=$user_datafromDB->city.', '.$user_datafromDB->state.' '.$user_datafromDB->zipcode.'<br>' ?>
                <?=$user_datafromDB->email.'<br>' ?>
                <?=$user_datafromDB->code.'.'.$user_datafromDB->phone.'<br>' ?>
                
          <a href="#">Manage Contacts</a>
              </p>
        <?php } ?>
    </div>
    <div class="col-sm-3" style="border-right: 1px solid #c4c4c4;">
      <h5><strong>NAMESERVERS</strong></h5>
      <p>

      <?php 
          if(array_key_exists("nameservers",$domainAPI_data)){
            foreach($domainAPI_data['nameservers'] as $row=>$value){
              if($value == "ns1hnx.name.com" || $value == "ns2fjz.name.com" || $value == "ns3fgh.name.com" || $value == "ns4jnz.name.com"){ ?>
                  ns<?= $row+1 ?>.online.inc <br>
              <?php
              }
              else{
              echo $value."<br>" ;
              }

            }
          } else{  
            echo "No Nameservers added<br>" ;
        } 
        ?>
      </p>
        <p>
          <a href="<?php echo base_url('domain_details/nameservers/').$domain_name; ?>">Manage Nameservers</a>
        </p>
    </div>
    <div class="col-sm-3" style="border-right: 1px solid #c4c4c4;">
      <h5><strong>DNS</strong></h5>
      <p>
          <a href="<?php echo base_url('domain_details/dns/').$domain_name; ?>">Manage DNS Records</a>
    </p>
    </div>
    
    <div class="col-sm-3">
      <h5><strong>TRANSFER AUTH CODE</strong></h5>
      <p>
          <a href="#" id="show_code">Show Auth Code</a>
    </p>
    </div>
  </div>
</div>

<div class="container">
  <br>
</div>
<!-- Footer Start -->
<?php include("account/footer.php"); ?>
