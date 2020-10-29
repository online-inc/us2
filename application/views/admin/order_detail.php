<?php include("header.php"); ?>

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">

<div class="col-lg-12">

    
    <!-- Show Order domains  -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Order Domains</h6>
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
                      <th>Order Number</th>
                      <th>User Name</th>
                      <th>Phone Number</th>
                      <th>Paid Amounts</th>
                      <th>Transaction ID</th>
                      <th>Payment Status</th>
                    </tr>
                  </thead>
                  <tfoot>
                      <tr class="text-center">
                        <th>S.No.</th>
                        <th>Order Number</th>
                        <th>User Name</th>
                        <th>Phone Number</th>
                        <th>Paid Amounts</th>
                        <th>Transaction ID</th>
                        <th>Payment Status</th>
                      </tr>
                  </tfoot>
                  <tbody>

                  
                  <?php if (count($order_domains)):  
                            $count=0; ?>
                        <?php foreach($order_domains as $order):
                          if($order->paid_amount_currency == 'usd')
                          {
                            $currency = '$';
                          }
                          else
                          {
                            $currency = '&#8377;';
                          }
                        ?>
                        <tr class="text-center">
                        <td><?= ++$count; ?></td>
                        <td><?= anchor("order/order_details/{$order->order_number}",$order->order_number); ?></td>
                        <td><?= $order->firstname.' '.$order->lastname; ?></td>
                        <td><?= $order->phone; ?></td>
                        <td><?= $currency.$order->paid_amount; ?></td>
                        <td><?= $order->txn_id; ?></td>
                        <td><?= $order->payment_status; ?></td>
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
</div>

</div>

<?php include("footer.php"); ?>