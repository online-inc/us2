<?php include("header.php"); ?>
<?php  $user_register_active = $this->session->flashdata('user_register_active');  ?>

<div class="lbody">
	<div class="container containernew <?php echo $user_register_active; ?>" id="container">
		<div class="form-container sign-up-container">
			<div class="form1" action="#">
				<h1 class="h1">Create Account</h1>
				<br>
				<div class="row" style="text-align:left;">
					<h4>Account Details</h4>
				</div>
				<!-- Flash Data -->
				<?php if($usermsg = $this->session->flashdata('user_msg')) :
                $user_class = $this->session->flashdata('user_class'); 
            ?>
				<div class="row">
					<div class="col-lg-12">
						<div class="alert <?php echo $user_class; ?>">
							<?php echo $usermsg; ?>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<!-- Registration Form Open -->
				<?php echo form_open('register',['style'=>'text-align:left;']);?>
				<?php echo form_hidden('status',1) ?>

				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<span class="text-danger"> <?php echo form_error('username'); ?></span>
							<?php echo form_input(['class'=>'form-control','autocomplete'=>'off','placeholder'=>'Pick a Username','name'=>'username','value'=>set_value("username")]);  ?>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<span class="text-danger"><?php echo form_error('password'); ?></span>
							<?php echo form_password(['class'=>'form-control','autocomplete'=>'off','type'=>'password','placeholder'=>'Create a Password','name'=>'password','value'=>set_value("password")]); ?>
						</div>
					</div>
				</div>

				<div class="row" style="text-align:left;">
					<h4>
						Contact Details
					</h4>
				</div>
				<div class="row" style="text-align:left;">

					<div class="col-lg-6">
						<div class="form-group">
							<span class="text-danger"> <?php echo form_error('firstname'); ?></span>
							<?php echo form_input(['class'=>'form-control','placeholder'=>'First Name *','name'=>'firstname','value'=>set_value("firstname")]);  ?>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<span class="text-danger"> <?php echo form_error('lastname'); ?></span>
							<?php echo form_input(['class'=>'form-control','placeholder'=>'Last Name *','name'=>'lastname','value'=>set_value("lastname")]);  ?>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<span class="text-danger"> <?php echo form_error('organization'); ?></span>
							<?php echo form_input(['class'=>'form-control','placeholder'=>'organization','name'=>'organization','value'=>set_value("organization")]);  ?>
						</div>
					</div>
					<div class="col-lg-3 col-sm-3 col-xs-3">
						<div class="form-group" style="margin-top:8px;">
							<?php 
                            $options = [
                                '+1'         => '+1 USA',
                                '+91'         => '+91 IN',
                                '+3'         => '+3 CA',
                            ];
                            ?>
							<span class="text-danger"> <?php echo form_error('code'); ?></span>
							<?php echo form_dropdown(['class'=>'form-control','placeholder'=>'Select','name'=>'code','value'=>set_value("code")], $options);  ?>
						</div>
					</div>
					<div class="col-lg-4 col-sm-9 col-xs-9">
						<div class="form-group">
							<span class="text-danger"> <?php echo form_error('phone'); ?></span>
							<?php echo form_input(['class'=>'form-control','placeholder'=>'Phone Number *','name'=>'phone','value'=>set_value("phone")]);  ?>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="form-group">
							<span class="text-danger"> <?php echo form_error('email'); ?></span>
							<?php echo form_input(['class'=>'form-control','placeholder'=>'Email *','name'=>'email','value'=>set_value("email")]);  ?>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<span class="text-danger"> <?php echo form_error('address1'); ?></span>
							<?php echo form_input(['class'=>'form-control','placeholder'=>'Address line 1 *','name'=>'address1','value'=>set_value("address1")]);  ?>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<span class="text-danger"> <?php echo form_error('address2'); ?></span>
							<?php echo form_input(['class'=>'form-control','placeholder'=>'Address line 2 *','name'=>'address2','value'=>set_value("address2")]);  ?>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<span class="text-danger"> <?php echo form_error('city'); ?></span>
							<?php echo form_input(['class'=>'form-control','placeholder'=>'City *','name'=>'city','value'=>set_value("city")]);  ?>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<span class="text-danger"> <?php echo form_error('state'); ?></span>
							<?php echo form_input(['class'=>'form-control','placeholder'=>'State/ Province *','name'=>'state','value'=>set_value("state")]);  ?>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<span class="text-danger"> <?php echo form_error('zipcode'); ?></span>
							<?php echo form_input(['class'=>'form-control','placeholder'=>'Zip/Postal code *','name'=>'zipcode','value'=>set_value("zipcode")]);  ?>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="form-group" style="margin-top:0px;">
							<select class="form-control">
								<option>Select Country</option>
								<option>USA</option>
								<option>India</option>
								<option>Hong Kong</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">

					<div class="col-lg-12" style="text-align: center;">
						<div class="form-group">
							<?php echo form_submit(array('type'=>'submit','class'=>'button signup-btn','value'=>'Sign Up')); ?>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
				<!-- Registration Form Closed -->
			</div>
		</div>
		<div class="form-container sign-in-container">
			<div class="form1 signin-form" action="#">
				<h1>Sign in</h1><br><br>
				<!-- Flash Data -->
				<?php if($error = $this->session->flashdata('Login_Failed')) :?>
				<div class="row">
					<div class="col-lg-12">
						<div class="alert alert-danger">
							<?php echo $error; ?>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<!-- Sign In Form Open -->

				<!-- <div class="social-container">
					<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
					<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
					<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
				</div>
				<span>or use your account</span> -->
				<?php echo form_open('login');?>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<?php echo form_input(array('class'=>'form-control','placeholder'=>'Enter Username','name'=>'uname','value'=>set_value("uname")));  ?>
						</div>
					</div>
					<div class="col-lg-12" style="margin-bottom: 10px;">
						<?php echo form_error('uname'); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<?php echo form_password(array('class'=>'form-control','type'=>'password','placeholder'=>'Enter Password','name'=>'pwd','value'=>set_value("pwd"))); ?>
						</div>
					</div>
					<div class="col-lg-12" style="margin-bottom: 10px;">
						<?php echo form_error('pwd'); ?>
					</div>
				</div>


				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<?php echo form_submit(array('type'=>'submit','class'=>'button','value'=>'Sign In')); ?>
						</div>
					</div>
				</div>
				<br><br>
				<a href="#">Forgot your password?</a><br>
				<?php echo form_close(); ?>
				<!-- Sign In Form Closed -->
			</div>
		</div>

		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1 class="h1">Welcome Back!</h1>
					<p class=p>To keep connected with us please login with your Profile</p>
					<button class="button ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1 class="h1">Hello!</h1>
					<p class="p">Create your profile and start your journey with us!</p>
					<button class="button ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Form 2 -->
<div class="cbody">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="pen-title">
					<!--   <h1>Flat Login Form</h1><span>Pen <i class='fa fa-paint-brush'></i> + <i class='fa fa-code'></i> by <a href='#'>Online.inc</a></span> -->
				</div>
				<!-- Form Module-->
				<div class="module form-module">
					<div class="toggle"><i class="fas fa-pencil-alt "><span style="display: none;" id="login"> Sign In
								(Here)</span><span id="register"> Sign Up (Here)</span></i>
					</div>
					<div class="form2" <?php if($user_register_active) echo "style='display:none'";?>>
						<h2>Login to your account</h2>

						<?php if($error = $this->session->flashdata('Login_Failed')) :?>
						<div class="row">
							<div class="col-lg-12">
								<div class="alert alert-danger">
									<?php echo $error; ?>
								</div>
							</div>
						</div>
						<?php endif; ?>
						<?php echo form_open('login');?>
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<?php echo form_input(array('class'=>'form-control','placeholder'=>'Enter Username','name'=>'uname','value'=>set_value("uname")));  ?>
								</div>
							</div>
							<div class="col-lg-12" style="margin-bottom: 10px;">
								<?php echo form_error('uname'); ?>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<?php echo form_password(array('class'=>'form-control','type'=>'password','placeholder'=>'Enter Password','name'=>'pwd','value'=>set_value("pwd"))); ?>
								</div>
							</div>
							<div class="col-lg-12" style="margin-bottom: 10px;">
								<?php echo form_error('pwd'); ?>
							</div>
						</div>


						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<?php echo form_submit(array('type'=>'submit','class'=>'button','value'=>'Sign In')); ?>
								</div>
							</div>
						</div>
						<br><br>
						<a href="#">Forgot your password?</a><br>
						<?php echo form_close(); ?>
					</div>
					<div class="form2" <?php if($user_register_active) echo "style='display:block'";?>>
						<h2>Create an account</h2>
						<div class="row" style="text-align:left;">
							<h4>Account Details</h4>
						</div>
						<?php if($usermsg = $this->session->flashdata('user_msg')) :
                                $user_class = $this->session->flashdata('user_class'); 
                                ?>

						<div class="row">
							<div class="col-lg-12">
								<div class="alert <?php echo $user_class; ?>">
									<?php echo $usermsg; ?>
								</div>
							</div>
						</div>
						<?php endif; ?>
						<?php echo form_open('register',['style'=>'text-align:left;']);?>
						<?php echo form_hidden('status',1) ?>

						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<span class="text-danger"> <?php echo form_error('username'); ?></span>
									<?php echo form_input(['class'=>'form-control','placeholder'=>'Pick a Username','name'=>'username','value'=>set_value("username")]);  ?>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<span class="text-danger"><?php echo form_error('password'); ?></span>
									<?php echo form_password(['class'=>'form-control','type'=>'password','placeholder'=>'Create a Password','name'=>'password','value'=>set_value("password")]); ?>
								</div>
							</div>
						</div>

						<div class="row" style="text-align:left;">
							<h4>
								Contact Details
							</h4>
						</div>
						<div class="row" style="text-align:left;">

							<div class="col-lg-12">
								<div class="form-group">
									<span class="text-danger"> <?php echo form_error('firstname'); ?></span>
									<?php echo form_input(['class'=>'form-control','placeholder'=>'First Name *','name'=>'firstname','value'=>set_value("firstname")]);  ?>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<span class="text-danger"> <?php echo form_error('lastname'); ?></span>
									<?php echo form_input(['class'=>'form-control','placeholder'=>'Last Name *','name'=>'lastname','value'=>set_value("lastname")]);  ?>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<span class="text-danger"> <?php echo form_error('organization'); ?></span>
									<?php echo form_input(['class'=>'form-control','placeholder'=>'organization','name'=>'organization','value'=>set_value("organization")]);  ?>
								</div>
							</div>
							<div class="col-lg-3 col-sm-3 col-xs-3">
								<div class="form-group">
									<?php 
                                $options = [
									'+1'         => '+1 USA',
									'+91'         => '+91 IN',
									'+3'         => '+3 CA',
                                ];
                                ?>
									<span class="text-danger"> <?php echo form_error('code'); ?></span>
									<?php echo form_dropdown(['class'=>'form-control','placeholder'=>'Select','name'=>'code','value'=>set_value("code")], $options);  ?>
								</div>
							</div>
							<div class="col-lg-9 col-sm-9 col-xs-9">
								<div class="form-group">
									<span class="text-danger"> <?php echo form_error('phone'); ?></span>
									<?php echo form_input(['class'=>'form-control','placeholder'=>'Phone Number *','name'=>'phone','value'=>set_value("phone")]);  ?>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<span class="text-danger"> <?php echo form_error('email'); ?></span>
									<?php echo form_input(['class'=>'form-control','placeholder'=>'Email *','name'=>'email','value'=>set_value("email")]);  ?>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<span class="text-danger"> <?php echo form_error('address1'); ?></span>
									<?php echo form_input(['class'=>'form-control','placeholder'=>'Address line 1 *','name'=>'address1','value'=>set_value("address1")]);  ?>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<span class="text-danger"> <?php echo form_error('address2'); ?></span>
									<?php echo form_input(['class'=>'form-control','placeholder'=>'Address line 2 *','name'=>'address2','value'=>set_value("address2")]);  ?>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<span class="text-danger"> <?php echo form_error('city'); ?></span>
									<?php echo form_input(['class'=>'form-control','placeholder'=>'City *','name'=>'city','value'=>set_value("city")]);  ?>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<span class="text-danger"> <?php echo form_error('state'); ?></span>
									<?php echo form_input(['class'=>'form-control','placeholder'=>'State/ Province *','name'=>'state','value'=>set_value("state")]);  ?>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<span class="text-danger"> <?php echo form_error('zipcode'); ?></span>
									<?php echo form_input(['class'=>'form-control','placeholder'=>'Zip/Postal code *','name'=>'zipcode','value'=>set_value("zipcode")]);  ?>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group" style="margin-top:0px;">
									<select class="form-control">
										<option>Select Country</option>
										<option>USA</option>
										<option>India</option>
										<option>Hong Kong</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">

							<div class="col-lg-12" style="text-align: center;">
								<div class="form-group">
									<?php echo form_submit(array('type'=>'submit','class'=>'button signup-btn','value'=>'Sign Up')); ?>
								</div>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	const signUpButton = document.getElementById( 'signUp' );
	const signInButton = document.getElementById( 'signIn' );
	const container = document.getElementById( 'container' );

	signUpButton.addEventListener( 'click', () => {
		container.classList.add( "right-panel-active" );
	} );

	signInButton.addEventListener( 'click', () => {
		container.classList.remove( "right-panel-active" );
	} );

</script>

<script>
	//  form 2
	// Toggle Function
	$( '.toggle' ).click( function () {
		// Switches the Icon
		$( this ).children( 'i' ).toggleClass( "fa-pen" );
		// Switches the forms  
		$( '.form2' ).animate( {
			height: "toggle",
			'padding-top': 'toggle',
			'padding-bottom': 'toggle',
			opacity: "toggle"
		}, "slow" );
	} );

	$( document ).ready( function () {
		$( "#login" ).click( function () {
			$( "#login" ).hide();
			$( "#register" ).show();
		} );
		$( "#register" ).click( function () {
			$( "#login" ).show();
			$( "#register" ).hide();
		} );
	} );

</script>

<?php include("footer.php"); ?>
