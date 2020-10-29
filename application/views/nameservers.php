<!-- Header Start -->

<?php include("account/header.php"); ?>



    
<?php //echo "<pre>";print_r($exactMatch); ?>
<style>
    .toggle{     
    border: 1px solid #555456;
    }
    .toggle-on{
      background-color: #d83b03;
    }
    .editable-buttons{
      position: relative;
    left: 208%;
    }
    @media screen and (min-width: 768px){
    .modal-dialog {
        right: auto;
        left: 0%;
    }
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
    <div class="col-lg-7 col-sm-7">
      <h3 class="text-success"><strong>Manage Nameservers</strong></h3>
            <table class="table">
        <thead>
          <tr>
            <th scope="col">NAMESERVERS</th>
            <!-- <th scope="col">CREATED</th> -->
          </tr>
        </thead>
        <tbody>

        
      <?php 
        if(array_key_exists("nameservers",$domainAPI_data)){

      foreach($domainAPI_data['nameservers'] as $row=>$value){ 
        // echo $value;
        if($value == "ns1hnx.name.com" || $value == "ns2fjz.name.com" || $value == "ns3fgh.name.com" || $value == "ns4jnz.name.com"){
          // echo $value;

      ?>
        <tr>
              <th scope="row">
                  <span class="text-success" id="ns<?= $row ?>">ns<?= $row+1 ?>.online.inc</span>
              </th>
              <!-- <td>2020-03-07</td> -->
        </tr>
      <?php
      }else{
      ?>
        <tr>
            <th scope="row">
                 <span class="text-success" id="ns<?= $row ?>"><?= $value ?></span>
            </th>
            <!-- <td>2020-03-07</td> -->
        </tr>
        <?php } 
        }

      } else{ ?>
        <tr>
          <th scope="row">
                <span class="text-success" id="ns">No Nameservers added</span>
          </th>
          <!-- <td>2020-03-07</td> -->
        </tr>
      <?php } ?>
        </tbody>
      </table>
    </div>
          
    <div class="col-lg-4 col-sm-4 offset-5">
      <form class="float-right mt-1" action="<?php echo base_url('domain_details/updateNameserver/'); ?>" method="post">
      <input type="hidden" class="form-control" id="setdefaultdomainName" name="domainName">
      
      <button type="submit" class="btn btn-warning">DEFAULT NAMESERVER</button>

      </form>
    </div>

    <div class="col-lg-3 col-sm-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success float-right mt-1" data-toggle="modal" data-target="#exampleModalCenter">
      UPDATE NAMESERVER
    </button>
              <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLongTitle">NAMESERVERS</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          <form action="<?php echo base_url('domain_details/updateNameserver/'); ?>" method="post">
          
          <input type="hidden" class="form-control" id="seupdatetdomainName" name="domainName">
              <div class="form-group row">
                  <label for="nameserver1" class="col-sm-4 col-form-label">NAMESERVER 1</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control" id="nameserver1" name="nameserver1" aria-describedby="nameserver1" placeholder="ex. ns1.online.inc *" required>
                </div>
              </div>

              <div class="form-group row">
                  <label for="nameserver2" class="col-sm-4 col-form-label">NAMESERVER 2</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control" id="nameserver2" name="nameserver2" aria-describedby="nameserver2" placeholder="ex. ns1.online.inc (Optional)" >
                </div>
              </div>

              <div class="form-group row">
                  <label for="nameserver3" class="col-sm-4 col-form-label">NAMESERVER 3</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control" id="nameserver3" name="nameserver3" aria-describedby="nameserver3" placeholder="ex. ns1.online.inc (Optional)" >
                </div>
              </div>

              <div class="form-group row">
                  <label for="nameserver4" class="col-sm-4 col-form-label">NAMESERVER 4</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control" id="nameserver4" name="nameserver4" aria-describedby="nameserver4" placeholder="ex. ns1.online.inc (Optional)">
                </div>
              </div>

              <div class="form-group row">
                  <label for="nameserver5" class="col-sm-4 col-form-label">NAMESERVER 5</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control" id="nameserver5" name="nameserver5" aria-describedby="nameserver5" placeholder="ex. ns1.online.inc (Optional)">
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            
          </form>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>

</div>

<div class="container">
  <br>

</div>
<script>

  $(document).ready(function(){

    var domainName = $("#domainName").text();
    var ns0 = $("#ns0").text();
    var ns1 = $("#ns1").text();
    var ns2 = $("#ns2").text();
    var ns3 = $("#ns3").text();
    var ns4 = $("#ns4").text();

    $("#setdefaultdomainName").val(domainName);
    $("#seupdatetdomainName").val(domainName);
    $("#nameserver1").val(ns0);
    $("#nameserver2").val(ns1);
    $("#nameserver3").val(ns2);
    $("#nameserver4").val(ns3);
    $("#nameserver5").val(ns4);



});

    // $.fn.editable.defaults.mode = 'inline';

    // $(document).ready(function() {
    //     $('#username').editable();
    // });   
</script>
<!-- Footer Start -->
<?php include("account/footer.php"); ?>
