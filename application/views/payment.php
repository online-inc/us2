<?php include("account/header.php"); ?>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
	//set your publishable key
	Stripe.setPublishableKey('pk_test_XF6R7Eh2pMTyJYyQFgSX8WWU00F5Ca5Ll6');
	//callback to handle the response from stripe
	function stripeResponseHandler(status, response) {
		if (response.error) {
			//enable the submit button
			$('#payBtn').removeAttr("disabled");
			//display the errors on the form
			// $('#payment-errors').attr('hidden','false');
			$('#payment-errors').addClass('alert alert-danger');
			$('#payment-errors').html(response.error.message);
		} else {
			var $form = $("#paymentFrm");
			//get token id
			var token = response.id;
			//insert the token into the form
			$form.append($('<input type="hidden" name="stripeToken" />').val(token));
			//submit form to the server
			$form.get(0).submit();
		}
	}
	$(document).ready(function () {
		// On form Submit
		$("#paymentFrm").submit(function (event) {
			//disable the submit button to prevent repeated clicks

			$("#payBtn").attr("disabled", "disabled");

			//create single-use token to charge the user
			Stripe.card.createToken({
				number: $('#card_num').val(),
				cvc: $('#card-cvc').val(),
				exp_month: $('#card-expiry-month').val(),
				exp_year: $('#card-expiry-year').val()
			}, stripeResponseHandler);

			// submit from callback
			return false;
		});
	});

</script>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="card bg-light" style="padding: 10px;">
				<div class="row">
					<div class="col-lg-8">
						<h1>Payment</h1>
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

	<?php // if(!empty($_SESSION["cart_items"])){ ?>
	<div class="row">
		<aside class="col-lg-9">

			<div class="card">
				<div class="card-body bg-primary text-white" style="padding:10px 50px">
					<div class="row">
						<div class="col-lg-4">
							<h5>Payment Option</h5>
						</div>
						<!-- <div class="col-lg-4">
							<h5>Name On Card</h5>
						</div>
						<div class="col-lg-4">
							<h5 class="text-right">Card Ending</h5>
						</div> -->
					</div>
				</div>
			</div>

			<div class="card-body">
				<?php if(validation_errors()): ?>
				<div class="alert alert-dismissible alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Oh snap!</strong>
					<?php echo validation_errors(); ?>
				</div>
				<?php endif ?>
			</div>
			<div id="payment-errors"></div>
			<div class="accordion" id="accordionExample">
				<div class="card">
					<div class="card-header bg-info" id="headingOne">
						<h2 class="mb-0">
							<button class="btn btn-primary" type="button" data-toggle="collapse"
								data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								Add Your Card
							</button>
						</h2>
					</div>

					<div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
						data-parent="#accordionExample">
						<div class="card-body">
							<form id="paymentFrm" action="<?php echo base_url(); ?>checkout/paymentProcess" method="post"
								enctype="multipart/form-data">
								<!-- <div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<input type="text" name="name" value="<?php echo set_value('name'); ?>"
												class="form-control" placeholder="Name" required>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<input type="email" name="email" value="<?php echo set_value('email'); ?>"
												class="form-control" placeholder="example@you.com" required>
										</div>
									</div>

								</div> -->
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<input type="number" name="card_num" id="card_num" max-length="16"
												autocomplete="off" value="<?php echo set_value('card_num'); ?>"
												class="form-control" placeholder="Card Number">
										</div>
									</div>

								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<input type="text" name="exp_month" max-length="2" id="card-expiry-month"
												autocomplete="off" value="<?php echo set_value('exp_month'); ?>"
												class="form-control" placeholder="MM" required>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<input type="text" name="exp_year" max-length="4" id="card-expiry-year"
												autocomplete="off" value="<?php echo set_value('exp_year'); ?>"
												class="form-control" placeholder="YYYY" required>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<input type="text" name="cvc" max-length="3" id="card-cvc"
												autocomplete="off" value="<?php echo set_value('cvc'); ?>"
												class="form-control" placeholder="CVC" required>
										</div>
									</div>

								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group text-right">
											<button type="reset" class="btn btn-secondary">Reset</button>
											<!-- <button type="submit" id="payBtn" class="btn btn-success">Submit</button> -->
										</div>
									</div>

								</div>

						</div>
					</div>
				</div>

			</div>

		</aside>

		<?php
		
						$total = 0;
						$count = 0;
						if($this->session->userdata('id') && $this->session->userdata('username')){
							$cart_user_id = $this->session->userdata('id');
							$cart_item_result = $this->db->where(['user_id'=>$cart_user_id])->get('cart_items')->result();
							$count = count($cart_item_result);
							foreach($cart_item_result as $keys => $values){

								$total = $total +(( $values->price)+$values->renew_price);
							}
						}
                        elseif(!empty($_SESSION["cart_items"])){
								$count = count($_SESSION["cart_items"]);
								foreach($_SESSION["cart_items"] as $keys => $values){
									
								$total = $total +(( $values["price"])+$values['renew_price']);
							}
                    	}
            ?>
		<aside class="col-lg-3">
			<div class="card bg-light">

				<div class="card-body bg-primary text-white" style="padding:10px 20px">
					<div class="row">
						<div class="col-lg-12">
							<h6><strong>Order Summary</strong> ( <?php echo $count; ?> Items )
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
							<?= 
                                form_hidden('total_items',$count),
                                form_hidden('payment', $total),
                                form_button(['name'=> 'payment_submit','id'=> 'payBtn','value'=> 'true','type'=>'submit','title'=> 'payment','class'=>'btn btn-out btn-primary btn-square btn-main','content'=>' Next Step:Payment <i class="fa fa-chevron-right" aria-hidden="true"></i>']);

                            ?>

							</form>
						</div>
					</div>
				</div>
			</div>
		</aside>
	</div>
	<?php //} ?>
</div>
<br><br>
<?php include("account/footer.php"); ?>
