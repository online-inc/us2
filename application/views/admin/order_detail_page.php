<?php include("header.php"); ?>

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12 mx-auto">
            <div class="card">

            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container" id="printInvoice">
   <div class="col-md-12">
      <div class="invoice">

         <!-- begin invoice-company -->
         <div class="invoice-company text-inverse f-w-600">
            <span class="pull-right hidden-print">
            <!-- <a href="javascript:;" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-file t-plus-1 text-danger fa-fw fa-lg"></i> Export as PDF</a> -->
            <a href="javascript:;" onclick="printDiv('printInvoice')" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
            </span>
            <img src="https://online.inc/wp-content/uploads/2020/01/online.jpg" style="width:25%;" alt="">
         </div><br>
         <!-- end invoice-company -->
         <!-- begin invoice-header -->
         
        <div class="invoice-header">
          <div class="row">
            <div class="col-lg-6">
                <div class="invoice-from">
                   <h2>Billing Information</h2>
                   <address class="m-t-5 m-b-5">
                      <table>
                        <tbody>
                          <?php
                          $domain_array = json_encode($user_information);
                          $user_information = json_decode($domain_array, true);
                          //print_r($user_details);exit();
                          ?>
                          <tr>
                            <td>Comapny Name: </td>
                            <td><?= $user_details[0]->organization; ?></td>
                          </tr>
                          <tr>
                            <td>Name: </td>
                            <td><?= $user_details[0]->firstname.' '.$user_details[0]->lastname; ?></td>
                          </tr>
                          <tr>
                            <td>Address: </td>
                            <td><?= $user_details[0]->address1.' '.$user_details[0]->address2; ?></td>
                          </tr>
                          <tr>
                            <td>Phone Number: </td>
                            <td><?= $user_details[0]->phone; ?></td>
                          </tr>
                          <tr>
                            <td>Email ID: </td>
                            <td><?= $user_details[0]->email; ?></td>
                          </tr>
                        </tbody>
                      </table>
                   </address>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="invoice-date">
                  <h2>Order Information</h2>
                  <address class="m-t-5 m-b-5">
                    <?php $php_array = json_encode($order_view_detail);
                      $orderData = json_decode($php_array,true);
                    ?>
                      <table>
                        <?php //foreach ($user_information as $domain_value) { ?>
                        <tbody>
                          <tr>
                            <td>Order ID: </td>
                            <td><?= $orderData[0]['order_number']; ?></td>
                          </tr>
                          <tr>
                            <td>Trans ID: </td>
                            <td><?= $orderData[0]['txn_id']; ?></td>
                          </tr>
                          <tr>
                            <td>Order Date: </td>
                            <td><?= $orderData[0]['created']; ?></td>
                          </tr>
                          <tr>
                            <td>Payment Status: </td>
                            <td><?= $orderData[0]['payment_status']; ?></td>
                          </tr>
                          <tr>
                            <td>Paid Amounts: </td>
                            <td><?= '$'.$orderData[0]['paid_amount']; ?></td>
                          </tr>
                        </tbody>
                        <?php //} ?>
                      </table>
                  </address>
                </div>
            </div>
          </div>    
        </div><br>
        <div class="invoice-content">
          <h3>ITEMS ORDERED</h3>
          <div class="table-responsive">
            <table class="table table-invoice">
              <thead>
                <tr>
                  <th>RENEWAL</th>
                  <th>DESCRIPTION</th>
                  <th>RENEW PRICE</th>
                  <th>AMOUNT</th>
                </tr>
              </thead>
              <tbody>
                <?php
                //$domain_array = json_encode($user_information);
                //$user_information = json_decode($domain_array, true);
                $domain_array = json_encode($order_detail_info);
                $order_detail_info = json_decode($domain_array, true);
                foreach ($order_detail_info as $domain_value) {
                ?>
                <tr>
                  <td><?= $domain_value['renew_date']; ?></td>
                  <td><?= $domain_value['domainName']; ?></td>
                  <td><?= $domain_value['renew_price']; ?></td>
                  <td><?= $domain_value['price']; ?></td>
                </tr>
              <?php } ?>
              <tr style="background: #000; color: #fff">
                <th></th><th></th>
                <th>Final Total:</th>
                <th><?= '$'.$orderData[0]['paid_amount']; ?></th>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
   </div>
</div>
</div>
</div>
</div>
</div>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}    
</script>
<?php include("footer.php"); ?>