<!-- Header Start -->

<?php include("account/header.php"); ?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<!-- <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- <script src="https://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script> -->

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<!-- 
  
<?= link_tag("assets/bootstrap-editable/css/bootstrap-editable.css"); ?>
<script type="text/javascript" src="<?= base_url('assets/bootstrap-editable/js/bootstrap-editable.js');?>"></script> -->
<script type="text/javascript" src="<?= base_url('assets/js/bootstable.min.js');?>"></script>


<?php //echo "<pre>";print_r($exactMatch); ?>
<style>
    .toggle{
        
    border: 1px solid #555456;
    
    }
    .toggle-on{
      background-color: #d83b03;
    }
    .table tfoot>tr>td {
    vertical-align: top!important;
    }
</style>
<div class="jumbotron ">
<?php 
foreach($domain_data as $domain_data){
          $domain_name = $domain_data->domainName;
  ?>
  <h3 class="text-center" id="domainName"><?= $domain_data->domainName ?></h3>
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
  <!-- Back to domain details section -->
<div class="container">
  <div class="row">
    <div class="col-sm-6">
            <h5><u><a href="<?= base_url('domain_details/info/')?><?= $domain_name ?>" class="text-info"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
      </svg>BACK TO DOMAIN DETAILS</a></u></h5>
<br><br>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-12">
            <!-- Message -->
            <?php if($msg = $this->session->flashdata('nameserver_msg')) :
                $msg_class = $this->session->flashdata('nameserver_class'); 
                ?>
                    <div class="alert alert-dismissible <?php echo $msg_class; ?>">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong></strong> <a href="#" class="alert-link"><?php echo $msg; ?></a>.
                    </div>
            <?php endif; ?>

    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-12">

      <div class="container-fluid">
      <!-- <h5><strong>REGISTRANT CONTACTS</strong></h5> -->
<div class="table-responsive">
<table class="table table-hover" id="makeEditable">
  <thead>
      <tr>
        <th>TYPE</th>
        <th>HOST</th>
        <th>ANSWER </th>
        <th>TTL </th>
        <th>PRIO </th>
        <th>ACTION </th>
      </tr>
  </thead>
  <tbody>
    <tr class="table-active">
      <th>
      </th>
      <td> content</td>
      <td> content </td>
      <td> content </td>
      <td> content </td>
      <td><button id="bElim" type="button" class="btn btn-sm btn-danger" onclick="rowElim(this);"><i class="fa fa-trash-o" aria-hidden="true"> </i> </button></td>
    </tr>
     </tbody>
</table> 
</div>

  <div>
    <form >
      <div class="row">
        <div class="col-lg-2">
          <div class="form-group">
                  <span for="type">TYPE:</span>
                  <select class="form-control" id="type" style="margin-top: 5.5%;">
                    <option value="A">A</option>
                    <option value="mx">MX</option>
                    <option value="cname">CNAME</option>
                    <option value="TXT">TXT</option>
                    <option value="SRV">SRV</option>
                    <option value="AAAA">AAAA</option>
                    <option value="NS">NS</option>
                    <option value="ANAME">ANAME</option>
                  </select>
          </div>
        </div>
        <div class="col-lg-2">
              <div class="form-group">
                <span for="host">HOST:</span>
                <input type="text" class="form-control" id="host" name="host" >
              </div>
        </div>
        <div class="col-lg-2">
              <div class="form-group">
                <span for="answer">ANSWER:</span>
                <input type="text" class="form-control" id="answer" name="answer">
              </div>
        </div>
        <div class="col-lg-2">
              <div class="form-group">
                <span for="ttl">TTL:</span>
                <input type="text" class="form-control" id="ttl" name="ttl">
              </div>
        </div>
        <div class="col-lg-2">
              <div class="form-group">
                <span for="prio">PRIO:</span>
                <input type="text" class="form-control" id="prio" name="prio">
              </div>
        </div>
        <div class="col-lg-2" style="line-height: 6em;">
            <span style="float:right;"><button class="btn btn-primary" id="">Add New record</button></span>
        </div>
      </div>
    </form>
  </div>

<!-- <span style="float:right"><button class="btn btn-primary" id="but_add">Add New Row</button></span> -->
</div>
    </div>
  </div>
</div>

<script>
//  $('#makeEditable').SetEditable({ $addButton: $('#but_add')});
</script>

<div class="container">
  <br>
</div>
<!-- Footer Start -->
<?php include("account/footer.php"); ?>
