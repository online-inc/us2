<?php if(!defined('BASEPATH')) exit('NO Direct script access allowed');?>

<!DOCTYPE html>
<html class="no-js no-svg">

<head>
	<meta charset="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
	<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"> -->
	<title>Online Inc - Keyword Domains: Buy Keyword Domain and Get Found Faster</title>
	
<link rel="icon" href="https://online.inc/wp-content/uploads/2020/01/cropped-favicon-1-192x192.png" sizes="192x192" />
<link rel="apple-touch-icon-precomposed" href="https://online.inc/wp-content/uploads/2020/01/cropped-favicon-1-180x180.png" />
	<?= link_tag("assets/css/bootstrapnew.min.css"); ?>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<?= link_tag("assets/css/style.css"); ?>
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<!-- 	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"> -->

	<?= link_tag("assets/css/jquery.multiselect.css"); ?>
	<?= link_tag("assets/css/datatables.min.css"); ?>
	<script type="text/javascript" src="<?= base_url('assets/js/datatables.min.js');?>"></script>
	<style>
		body {
			font-family: sans-serif !important;
		}

	</style>
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"> -->

	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	
	<!-- 
<link href="style.css" rel="stylesheet"> -->
	<?= link_tag("assets/css/ci-style.css"); ?>

</head>

<body>
	<?php 
// for cart count items
$cart_uid = $this->session->userdata('id');
$cart_item_result = $this->db->where(['user_id'=>$cart_uid])->get('cart_items')->result(); 
?>

	<div class="body-wrap">

		<header class="myheader">
			<div class="container-fluid">
				<div class="row ">
					<div class="col-lg-8 col-md-8 col-sm-8">

						<nav class="navbar navbar-expand-lg navbar-light bg-light">
							<a class="navbar-brand" href="https://online.inc"><img
									src="https://online.inc/wp-content/uploads/2020/01/online.jpg" alt="Logo" class="logo" /></a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
								aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>

							<div class="collapse navbar-collapse" id="navbarColor01">
								<ul class="nav navbar-nav">
									<li class="nav-item"><a class="nav-link" href="https://online.inc/premium-domain">Premium Domains</a></li>
									<li class="nav-item"><a class="nav-link" href="https://online.inc/domain411">Domain411</a></li>
									<li class="nav-item dropdown"> <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"
											data-hover="dropdown">Services <b class="caret"></b></a>
										<ul class="dropdown-menu custom-dropdown">
											<li><a href="https://online.inc/lead-generation">Lead Generation</a></li>
											<li><a href="https://online.inc/geofencing">Geofencing</a></li>
											<li><a href="https://online.inc/seo-sem">SEO/SEM</a></li>
											<li><a href="https://online.inc/site-buildout">Site Buildout</a></li>
											<li><a href="https://online.inc/google-ads">Google Ads</a></li>

										</ul>
									</li>
									<li class="nav-item"><a class="nav-link" href="https://online.inc/pricing">Pricing</a></li>
									<li class="nav-item"><a class="nav-link" href="https://online.inc/about">About Us</a></li>
									<li class="nav-item"><a class="nav-link" href="https://online.inc/contact-us">Contact Us</a></li>
								</ul>
							</div>
							<!--  <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
    </form> -->

						</nav>
					</div>

					<div class="col-lg-4 col-md-4 col-sm-4">
						<nav class="navbar navbar-expand-lg navbar-light bg-light">
							<ul class="nav navbar-nav my-nav">

								<?php if($this->session->userdata('id') && $this->session->userdata('username')){ ?>
								<li class="nav-item dropdown">
									<a href="#" class="nav-link"> <?= $this->session->userdata('username') ?> </a>
								</li>
								<li class="nav-item dropdown">
									<a href="#" class="nav-link dropdown-toggle my-cart" data-toggle="dropdown" data-hover="dropdown"> <i
											class="fa fa-user-circle" aria-hidden="true"></i><b class="caret"></b></a>
									<ul class="dropdown-menu custom-dropdown">
										<li><a href="<?= base_url('account') ?>"><i class="fa fa-home" aria-hidden="true"></i> Account
												Overview</a></li>
										<li><a href="<?php //echo base_url('account/settings'); ?>#"><i class="fa fa-cog" aria-hidden="true"></i>
												Account Settings</a></li>
										<li><a href="#"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a></li>
										<li><a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i> Get Help</a></li>
										<li><a href="#"><i class="fa fa-comments" aria-hidden="true"></i> Support Messages</a></li>
										<li><a href="<?= base_url('account/logout') ?>"><i class="fa fa-sign-out" aria-hidden="true"></i>
												Logout</a></li>

									</ul>
								</li>
								<?php } else{ ?>
								<li class="nav-item dropdown">
									<a href="<?= base_url('login') ?>" class="nav-link my-cart"> <i class="fa fa-user-circle"
											aria-hidden="true"></i> Sign In</a>
								</li>
								<?php } ?>

								<li class="nav-item"><a href="<?= base_url('checkout') ?>" class="nav-link my-cart"><i
											class="fa fa-shopping-cart" aria-hidden="true"></i><span class="bg-primary text-white cart-count">
											<span
												class="countitems"><?php $cartCount=0; if($this->session->userdata('id') && $this->session->userdata('username')){if($cart_item_result){ echo count($cart_item_result) ;}else{ echo $cartCount; }}else{if($this->session->userdata('cart_items')){echo ($cartCount) + (count($this->session->userdata('cart_items')));}else{ echo $cartCount; } } ?></span>
										</span> Cart</a></li>
								<!--<li class="nav-item"><a href="<?= base_url('search') ?>" class="nav-link my-cart"><i-->
								<!--			class="fa fa-search" aria-hidden="true"></i> Domain</a></li>-->
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</header>
