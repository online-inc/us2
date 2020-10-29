<?php include("account/header.php"); ?>
<?php

		// /* Search Bar datalist for search api */
		// if(!$this->session->userdata('cart_items')){
        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, 'https://api.name.com/v4/domains/');
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        // curl_setopt($ch, CURLOPT_USERPWD, 'lcburgess' . ':' . '0cb93e671516d9f527500f9680b35ed155aa786e');

        // $result = curl_exec($ch);
        // if (curl_errno($ch)) {
        //     echo 'Error:' . curl_error($ch);
        // }

        //     $array = json_decode($result,true);
        //     $hello =$array['domains'];
            
        //     echo '<datalist id="domainList" style="width:600px; height:200px">';

        //     foreach($hello as $key => $row){
        //         echo '<option value="'. $row['domainName'] .'" style="width:600px">';
        //     }
        // echo '</datalist>';

        //     // echo "</pre>";
		// curl_close($ch);
		// }
?>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="card bg-light" style="padding: 10px;">
				<div class="row">
					<div class="col-lg-8">
						<h1>Review Cart Items</h1>
					</div>
					<div class="col-lg-4">
						<ul class="list-inline text-center">
							<li class="list-inline-item mlist"><a href="<?= base_url('checkout')?>" class=""
									data-abc="true"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> <br>View
									Cart</a></li>

							<?php if(!$this->session->userdata('id') && !$this->session->userdata('username')){ ?>

							<li class="list-inline-item mlist"><i class="fa fa-arrow-right" aria-hidden="true"></i></li>
							<li class="list-inline-item mlist"><a href="<?= base_url('login')?>" class=""
									data-abc="true"> <i class="fa fa-lock" aria-hidden="true"></i> <br>Login</a></li>

							<?php } ?>

							<li class="list-inline-item mlist"><i class="fa fa-arrow-right" aria-hidden="true"></i></li>
							<li class="list-inline-item mlist"><a href="javascript:void(0);" class="" data-abc="true"><i
										class="fa fa-credit-card" aria-hidden="true"></i> <br>Payment</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>

	<!-- if user login in session checkout details come from database -->
	<?php if($this->session->userdata('id') && $this->session->userdata('username')){ ?>
	<?php  
			$cart_user_id = $this->session->userdata('id');
			if($this->db->where(['user_id'=>$cart_user_id])->get('cart_items')->num_rows() > 0 ){ ?>
	<div class="row">
		<aside class="col-lg-9">

			<div class="card">
				<div class="card-body bg-primary text-white" style="padding:10px 50px">
					<div class="row">
						<div class="col-lg-4">
							<h5>Items</h5>
						</div>
						<div class="col-lg-4">
							<!-- <h5>Duration</h5> -->
						</div>
						<div class="col-lg-4">
							<h5 class="text-right">Price</h5>
						</div>
					</div>
				</div>
			</div>


			<?php
					$cart_user_id = $this->session->userdata('id');
				$cart_item_result = $this->db->where(['user_id'=>$cart_user_id])->get('cart_items')->result();
				if($this->db->where(['user_id'=>$cart_user_id])->get('cart_items')->num_rows() > 0 ){
					// echo "<pre>";
						// print_r($cart_item_result);
					// exit;
					// $this->load->model('domain');

					$total = 0;
					foreach($cart_item_result as $keys => $values){
						$exactMatch = $this->db->select('*')->where(['domainName'=>$values->domainName,'status'=>0])->get('domain_list')->result();
						foreach($exactMatch as $exactMatchValues){

							echo '
							<div class="alert alert-dismissible alert-danger">
							<!-- <button type="button" class="close" data-dismiss="alert">&times;</button> -->
							<strong>Oh snap!</strong> '.$exactMatchValues->domainName.' Sold Out. Please Delete this from Cart.
						  </div>';
						}
							// exit;
			?>
			<div class="card">
				<div class="card-body  bg-light">
					<div class="row">
						<div class="col-lg-4 col-sm-12">
							<h6 class="card-title"><strong><?= $values->domainName ?></strong></h6>
						</div>
						<div class="col-lg-2 col-sm-4 col-xs-4">
							<select class="form-control purpose" style="width:auto;"
								data-domainName="<?= $values->domainName?>" data-price="<?= $values->price ?>"
								data-domainid="<?= $values->domain_id ?>" data-year="<?= $values->year ?>"
								name="purpose">
								<option value="<?= $values->purpose ?>"><?= $values->purpose ?></option>
								<!-- <option value="Buy">Buy</option> -->
							</select>
						</div>
						<div class="col-lg-2 col-sm-4 col-xs-4">
							<select class="form-control year" style="width:auto;" data-price="<?= $values->price ?>"
								data-purpose="<?= $values->purpose ?>" data-domainid="<?= $values->domain_id ?>"
								data-domainname="<?= $values->domainName ?>" name="year">
								<option value="<?= $values->year ?>"><?= $values->year ?> Year</option>
								<option value="1">1 Year</option>
								<option value="2">2 Year</option>
								<option value="3">3 Year</option>
								<option value="4">4 Year</option>
								<option value="5">5 Year</option>
							</select>
						</div>
						<div class="col-lg-3">
							<div class="price-wrap text-right"> <strong><var class="price text-success">$ <span
											class="buy_new"><?php echo number_format($values->price + $values->renew_price, 2); ?></span></var></strong>
								<br><small class="text-muted text-danger">[ $
									<?= number_format($values->price,2)." + <br> Renewal Cost: ".$values->renew_price ?>
									]</small> </div>
						</div>
						<div class="col-lg-1 text-right">
						<?= 
						        form_open('checkout/cart_delete'),
                                form_hidden('domainName',$values->domainName),
                                form_button([  'name'=> 'delete','id'=> 'delete_btn','value'=> 'true','type'=>'submit','title'=> 'Delete','class'=>'btn btn-danger btn-circle btn-sm','content'=>'<i
									class="fa fa-trash" aria-hidden="true"></i>']),
                                form_close();
                                ?>
						</div>
					</div>
				</div>
			</div>


			<?php
							$total = $total +(( $values->price)+$values->renew_price);
							// echo $total;
							// exit;
                            }
                        ?>
		</aside>

		<!-- Second column -->
		<aside class="col-lg-3">
			<div class="card bg-light">

				<div class="card-body bg-primary text-white" style="padding:10px 20px">
					<div class="row">
						<div class="col-lg-12">
							<h6><strong>Order Summary</strong> ( <?php echo count($cart_item_result); ?> Items )
							</h6>
						</div>
					</div>
				</div>
				<!-- Total Amount -->
				<div class="card-body" style="padding:15px 0px 15px 0px;">
					<br>
					<div class="row" style="padding-right:10px">
						<div class="col-lg-5">
							<h6 class="text-right"><strong>Sub Total:</strong></h6>
						</div>
						<div class="col-lg-7">
							<p class="text-right"><strong>$ <?php echo number_format($total, 2); ?></strong></p>
						</div>
					</div>
					<hr>
					<div class="row" style="padding-right:10px">
						<div class="col-lg-5">
							<h5 class="text-right"><strong>Total:</strong></h5>
						</div>
						<div class="col-lg-7">
							<p class="text-right"><strong>$ <?php echo number_format($total, 2); ?></strong></p>
						</div>
					</div>
					<br><br><br>
					<div class="row">
						<div class="col-lg-12" style="padding:0px 37px 0px 40px;">

							<?php if(!$this->session->userdata('id') && !$this->session->userdata('username')){ 
								
							?>

							<?=  anchor("login",'Next Step:Login <i class="fa fa-chevron-right" aria-hidden="true"></i>',['class'=>'btn btn-out btn-primary btn-square btn-main','id'=>'checkout-login']);?>

							<?php } else { ?>

							<?=  anchor("checkout/payment",'Next Step:Payment <i class="fa fa-chevron-right" aria-hidden="true"></i>',['class'=>'btn btn-out btn-primary btn-square btn-main']);?>

							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</aside>
	</div>

	<?php  } ?>
</div>
<?php } else{ ?>

<div class="container">

	<div class="row">
		<div class="col-lg-12">
			<section class="search-sec">
				<br>
				<h2 class="text-center"> Your Cart is empty</h2>
				<h5 class="text-center">Find the perfect domain to put in it.</h5>
			</section>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-lg-12">
			<section class="search-sec">

				<?php echo form_open('search',['method'=>'get','style'=>'text-align:left;']);?>
				<div class="row">
					<div class="col-lg-11 col-md-10 col-sm-10 p-0">
						<?php echo form_input(['type'=>'search','list'=>'domainList','class'=>'form-control search-slt','autocomplete'=>'off','placeholder'=>'Type Your Domain Name','id'=>'searchDomain','name'=>'searchDomain','value'=>set_value("searchDomain")]);  ?>
					</div>

					<div class="col-lg-1 col-md-2 col-sm-2">

						<?php echo form_button(['type'=>'submit','class'=>'btn wrn-btn mysearch-btn','name'=>'search','value'=>'search','content'     => '<i class="fa fa-search" aria-hidden="true"></i>']); ?>
					</div>
				</div>
				<?php echo form_close(); ?>
			</section>
		</div>
	</div>
</div>
<?php } 
			// check user login and fetch cart values from database
			?>

<?php } elseif(!empty($_SESSION["cart_items"])){  ?>

<div class="row">
	<aside class="col-lg-9">

		<div class="card">
			<div class="card-body bg-primary text-white" style="padding:10px 50px">
				<div class="row">
					<div class="col-lg-4">
						<h5>Items</h5>
					</div>
					<div class="col-lg-4">
						<!-- <h5>Duration</h5> -->
					</div>
					<div class="col-lg-4">
						<h5 class="text-right">Price</h5>
					</div>
				</div>
			</div>
		</div>


		<?php
                        if(!empty($_SESSION["cart_items"])){
                            $total = 0;
                            foreach($_SESSION["cart_items"] as $keys => $values){
                                ?>
		<div class="card">
			<div class="card-body  bg-light">
				<div class="row">
					<div class="col-lg-4 col-sm-12">
						<h6 class="card-title"><strong><?= $values["domainName"] ?></strong></h6>
					</div>
					<div class="col-lg-2 col-sm-4 col-xs-4">
						<select class="form-control purpose" style="width:auto;"
							data-domainName="<?= $values["domainName"] ?>" data-price="<?= $values["price"] ?>"
							data-domainid="<?= $values["domain_id"] ?>" data-year="<?= $values["year"] ?>"
							name="purpose">
							<option value="<?= $values["purpose"] ?>"><?= $values["purpose"] ?></option>
							<!-- <option value="Buy">Buy</option> -->
						</select>
					</div>
					<div class="col-lg-2 col-sm-4 col-xs-4">
						<select class="form-control year" style="width:auto;" data-price="<?= $values["price"] ?>"
							data-purpose="<?= $values["purpose"] ?>" data-domainid="<?= $values["domain_id"] ?>"
							data-domainname="<?= $values["domainName"] ?>" name="year">
							<option value="<?= $values["year"] ?>"><?= $values["year"] ?> Year</option>
							<option value="1">1 Year</option>
							<option value="2">2 Year</option>
							<option value="3">3 Year</option>
							<option value="4">4 Year</option>
							<option value="5">5 Year</option>
						</select>
					</div>
					<div class="col-lg-3">
						<div class="price-wrap text-right"> <strong><var class="price text-success">$ <span
										class="buy_new"><?php echo number_format($values['price'] + $values['renew_price'], 2); ?></span></var></strong>
							<br><small class="text-muted text-danger">[ $
								<?= number_format($values['price'],2)." + <br> Renewal Cost: ".$values['renew_price'] ?>
								]</small> </div>
					</div>
					<div class="col-lg-1 text-right">
						<?= 
						        form_open('checkout/cart_delete'),
                                form_hidden('domainName',$values["domainName"]),
                                form_button([  'name'=> 'delete','id'=> 'delete_btn','value'=> 'true','type'=>'submit','title'=> 'Delete','class'=>'btn btn-danger btn-circle btn-sm','content'=>'<i
									class="fa fa-trash" aria-hidden="true"></i>']),
                                form_close();
                                ?>
					</div>
				</div>
			</div>
		</div>


		<?php
                            $total = $total +(( $values["price"])+$values['renew_price']);
                            }
                        }
                        ?>
	</aside>

	<!-- done -->
	<aside class="col-lg-3">
		<div class="card bg-light">

			<div class="card-body bg-primary text-white" style="padding:10px 20px">
				<div class="row">
					<div class="col-lg-12">
						<h6><strong>Order Summary</strong> ( <?php echo count($_SESSION["cart_items"]); ?> Items )
						</h6>
					</div>
				</div>
			</div>
			<!-- Total Amount -->
			<div class="card-body" style="padding:15px 0px 15px 0px;">
				<br>
				<div class="row" style="padding-right:10px">
					<div class="col-lg-5">
						<h6 class="text-right"><strong>Sub Total:</strong></h6>
					</div>
					<div class="col-lg-7">
						<p class="text-right"><strong>$ <?php echo number_format($total, 2); ?></strong></p>
					</div>
				</div>
				<hr>
				<div class="row" style="padding-right:10px">
					<div class="col-lg-5">
						<h5 class="text-right"><strong>Total:</strong></h5>
					</div>
					<div class="col-lg-7">
						<p class="text-right"><strong>$ <?php echo number_format($total, 2); ?></strong></p>
					</div>
				</div>
				<br><br><br>
				<div class="row">
					<div class="col-lg-12" style="padding:0px 37px 0px 40px;">

						<?php if(!$this->session->userdata('id') && !$this->session->userdata('username')){ 
								
							?>

						<?=  anchor("login",'Next Step:Login <i class="fa fa-chevron-right" aria-hidden="true"></i>',['class'=>'btn btn-out btn-primary btn-square btn-main','id'=>'checkout-login']);?>

						<?php } else { ?>

						<?=  anchor("checkout/payment",'Next Step:Payment <i class="fa fa-chevron-right" aria-hidden="true"></i>',['class'=>'btn btn-out btn-primary btn-square btn-main']);?>

						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</aside>
</div>
<?php } else{ ?>
</div>

<div class="container">

	<div class="row">
		<div class="col-lg-12">
			<section class="search-sec">
				<br>
				<h2 class="text-center"> Your Cart is empty</h2>
				<h5 class="text-center">Find the perfect domain to put in it.</h5>
			</section>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-lg-12">
			<section class="search-sec">

				<?php echo form_open('search',['method'=>'get','style'=>'text-align:left;']);?>
				<div class="row">
					<div class="col-lg-11 col-md-10 col-sm-10 p-0">
						<?php echo form_input(['type'=>'search','list'=>'domainList','class'=>'form-control search-slt','autocomplete'=>'off','placeholder'=>'Type Your Domain Name','id'=>'searchDomain','name'=>'searchDomain','value'=>set_value("searchDomain")]);  ?>
					</div>

					<div class="col-lg-1 col-md-2 col-sm-2">

						<?php echo form_button(['type'=>'submit','class'=>'btn wrn-btn mysearch-btn','name'=>'search','value'=>'search','content'     => '<i class="fa fa-search" aria-hidden="true"></i>']); ?>
					</div>
				</div>
				<?php echo form_close(); ?>
			</section>
		</div>
	</div>
</div>
<?php } ?>
<br>
<script>
	$(document).ready(function () {
		$('.year').on('change', function () {
			var domain_id = $(this).data('domainid');
			var domainname = $(this).data('domainname').toString();
			var purpose = $(this).data('purpose');
			var price = $(this).data('price');
			var year = $(this).val();
			// alert( this.value );
			// console.log( domain_id );
			// console.log( purpose );
			// console.log( year );
			$.ajax({
				url: "<?php //echo base_url(); ?>checkout/update_cart",
				method: "POST",
				data: {
					domain_id: domain_id,
					domainname: domainname,
					purpose: purpose,
					price: price,
					year: year
				},
				success: function (data) {
					// console.log( data );
					location.reload(true);
				}
			});

		});
	});


	// $( document ).ready( function () {
	// 	$( '.purpose' ).on( 'change', function () {
	// 		var domain_id = $( this ).data( 'domainid' );
	// 		var year = $( this ).data( 'year' );
	// 		var price = $( this ).data( 'price' );
	// 		var purpose = $( this ).val();
	// 		// alert( this.value );
	// 		console.log( domain_id );
	// 		// console.log( year );
	// 		console.log( purpose );

	// 		$.ajax( {
	// 			url: "<?php //echo base_url(); ?>checkout/update_cart",
	// 			method: "POST",
	// 			data: {
	// 				domain_id: domain_id,
	// 				purpose:purpose,
	// 				price:price,
	// 				year: year
	// 			},
	// 			success: function ( data ) {
	// 				console.log( data );
	// 				location.reload( true );
	// 			}
	// 		} );

	// 	} );
	// } );

	$(document)
		.on('click', '#checkout-login', function (e) {
			
			<?php
			$this->session-> set_userdata('pre', 'cart'); ?>
		});

</script>

<?php include("account/footer.php"); ?>
