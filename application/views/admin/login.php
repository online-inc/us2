<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Online.inc - Admin Login</title>

	<?= link_tag("assets_admin/vendor/fontawesome-free/css/all.min.css"); ?>
	<link
		href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
		rel="stylesheet">

	<?= link_tag("assets_admin/css/sb-admin-2.min.css"); ?>

</head>

<body class="bg-gradient-primary">

	<div class="container">

		<!-- Outer Row -->
		<div class="row justify-content-center">

			<div class="col-xl-10 col-lg-12 col-md-9">

				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
							<div class="col-lg-6">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
									</div>
									<div class="user">

										<?php if($error = $this->session->flashdata('Login_Failed')) :?>
										<div class="row">
											<div class="col-lg-12">
												<div class="alert alert-danger">
													<?php echo $error; ?>
												</div>
											</div>
										</div>
										<?php endif; ?>
										<?php echo form_open('admin_login');?>
										<div class="row">
											<div class="col-lg-12">
												<div class="form-group">
													<?php echo form_input(array('class'=>'form-control form-control-user','placeholder'=>'Enter Username','name'=>'uname','value'=>set_value("uname")));  ?>
												</div>
											</div>
											<div class="col-lg-12" style="margin-bottom: 10px;">
												<?php echo form_error('uname'); ?>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12">
												<div class="form-group">
													<?php echo form_password(array('class'=>'form-control form-control-user','type'=>'password','placeholder'=>'Enter Password','name'=>'password','value'=>set_value("password"))); ?>
												</div>
											</div>
											<div class="col-lg-12" style="margin-bottom: 10px;">
												<?php echo form_error('password'); ?>
											</div>
										</div>

										<div class="form-group">
											<div class="custom-control custom-checkbox small">
												<input type="checkbox" class="custom-control-input" id="customCheck">
												<label class="custom-control-label" for="customCheck">Remember Me</label>
											</div>
										</div>

										<div class="row">
											<div class="col-lg-12">
												<div class="form-group">
													<?php echo form_submit(array('type'=>'submit','class'=>'btn btn-primary btn-user btn-block','value'=>'Sign In')); ?>
												</div>
											</div>
										</div>
										<br><br>
										<a href="#">Forgot your password?</a><br>
										<?php echo form_close(); ?>
										<!-- <hr>
                    <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a> -->
									</div>
									<!-- <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                  </div> -->
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

	<!-- Bootstrap core JavaScript-->
	<script type="text/javascript" src="<?= base_url('assets_admin/vendor/jquery/jquery.min.js');?>"></script>
	<script type="text/javascript" src="<?= base_url('assets_admin/vendor/bootstrap/js/bootstrap.bundle.min.js');?>">
	</script>

	<!-- Core plugin JavaScript-->
	<script type="text/javascript" src="<?= base_url('assets_admin/vendor/jquery-easing/jquery.easing.min.js');?>">
	</script>

	<!-- Custom scripts for all pages-->
	<script type="text/javascript" src="<?= base_url('assets_admin/js/sb-admin-2.min.js');?>"></script>

</body>

</html>
