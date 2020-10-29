<?php include("account/header.php"); ?>
<style>
body{
    background:#eee;
}
</style>


<div class="container">
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
         </div>
         <!-- end invoice-company -->
         <!-- begin invoice-header -->
         
         <div class="invoice-header">
        <div class="row">
        <div class="col-lg-4">
            <div class="invoice-from">
               <small>from</small>
               <address class="m-t-5 m-b-5">
                  <strong class="text-inverse">ONLINE.INC</strong><br>
                  <!-- 605 W. Congress St<br>
                  Lafayette, LA 70501<br> -->
                  Email: info@online.inc
                  <!-- Phone: (123) 456-7890<br>
                  Fax: (123) 456-7890 -->
               </address>
            </div>

        </div>
        <div class="col-lg-4">

        <div class="invoice-to">
        <small>to</small>
        <address class="m-t-5 m-b-5">
        <?php $user_information = $this->db->select()->from('users')->where('id',$this->session->userdata('id'))->get()->result();
                foreach($user_information as $rows){
        ?>
            <strong class="text-inverse"><?= $rows->organization ?></strong><br>
            <?= $rows->address1 ?>, <?= $rows->address2 ?><br>
            <?= $rows->state ?>, <?= $rows->city ?>, <?= $rows->zipcode ?><br>
            Phone: <?= $rows->phone ?><br>
            Email: <?= $rows->email ?><br>

                <?php } ?>
        </address>
        </div>
                
                </div>
                <div class="col-lg-4">
                    <div class="invoice-date">
                    <?php 
                            foreach($invoice_information as $rows){
                    ?>
                    
                    <small>Invoice</small>
                    <div class="date text-inverse m-t-5"><?php echo date('d M, Y',strtotime($rows->created)); ?></div>
                    <div class="invoice-detail">
                        <b>Order Number:</b> <?= $rows->order_number ?><br>
                        <b>Txn Id:</b> <?= $rows->txn_id ?><br>
                    </div>

                    <?php } ?>
                    </div>
                
                </div>
                </div>
            
         </div>
         <!-- end invoice-header -->
         <!-- begin invoice-content -->
         <div class="invoice-content">
            <!-- begin table-responsive -->
            <div class="table-responsive">
               <table class="table table-invoice">
                  <thead>
                     <tr>
                        <th>DOMIAN DESCRIPTION</th>
                        <th class="text-center" width="30%">Price</th>
                        <th class="text-center" width="10%">Year</th>
                        <th class="text-right" width="20%">TOTAL</th>
                     </tr>
                  </thead>
                  <tbody>

                  <?php  
                  $totalPrice = 0;
                  foreach($invoice_information as $row){
                    $totol_amount = $this->db->select()->from('order_items')->where('order_id',$row->id)->get()->result();
                         foreach($totol_amount as $rows){
                     ?>
                     <tr>
                        <td>
                           <span class="text-inverse" style="font-size:20px;"><b><?= $rows->domainName ?></b></span>
                        </td>
                        <td class="text-center">Domain Price: <?php echo number_format($rows->price,2); ?><br>Renewal Price: <?php echo number_format( $rows->renew_price,2); ?></td>
                        <td class="text-center"><?= $rows->year ?> Yr</td>
                        <td class="text-right"><?php echo number_format($rows->price + $rows->renew_price,2);  ?></td>
                     </tr>

                     <?php 
                      $totalPrice= $totalPrice + $rows->price + $rows->renew_price;
                        } 
                               
                        } ?>
                  </tbody>
               </table>
            </div>
            <!-- end table-responsive -->
            <!-- begin invoice-price -->

            <div class="invoice-price">
               
               <div class="invoice-price-right">
                  <small>TOTAL</small> <span class="f-w-600"><?php echo number_format($totalPrice,2) ; ?></span>
               </div>

            </div>

            <!-- end invoice-price -->
        </div>
         <!-- end invoice-content -->
         <!-- begin invoice-note -->
         <!-- <div class="invoice-note">
            * Make all cheques payable to [Your Company Name]<br>
            * Payment is due within 30 days<br>
            * If you have any questions concerning this invoice, contact  [Name, Phone Number, Email]
         </div> -->
         <!-- end invoice-note -->
         <!-- begin invoice-footer -->
         <div class="invoice-footer">
            <p class="text-center m-b-5 f-w-600">
               THANK YOU FOR YOUR BUSINESS
            </p>
            <p class="text-center">
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> online.inc</span>
               <!-- <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:016-18192302</span> -->
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> info@online.inc</span>
            </p>
         </div>
         <!-- end invoice-footer -->
      </div>
   </div>

</div>
               
        </div>
    </div>
</div>

<div class="container">
<div class="row">
    <div class="col-lg-12">
    <!-- <button type="button" class="btn btn-success btn-lg">MY PRODUCTS</button> -->
    <a href="<?php echo base_url('account') ?>" type="button" class="btn btn-info float-right text-white">Account Overview</a>
    <a href="https://online.inc" type="button" class="btn btn-primary float-right text-white">Home</a>
    </div>
  </div>
</div>
</div>

<br>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}    
</script>
<?php include("account/footer.php"); ?>