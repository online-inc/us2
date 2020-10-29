<?php include("account/header.php"); ?>
<?php //echo "<pre>";print_r($exactMatch); ?>

<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.name.com/v4/domains/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

curl_setopt($ch, CURLOPT_USERPWD, 'lcburgess' . ':' . '0cb93e671516d9f527500f9680b35ed155aa786e');

$result = curl_exec($ch);
if (curl_errno($ch)) {
	// echo 'Error:' . curl_error($ch); 
}

	$array = json_decode($result,true);
	if($array){
	$hello =$array['domains'];
	
	echo '<datalist id="domainList" style="width:600px; height:200px">';

	foreach($hello as $key => $row){
		echo '<option value="'. $row['domainName'] .'" style="width:600px">';
	}
  echo '</datalist>';
}
	// echo "</pre>";
curl_close($ch);

?>
<div class="my-search-box">
	<div class="container text-center">
		<!--         
    <h1>
      Search your Domain
    </h1> -->
		<br><br>
		<div class="row">
			<div class="col-lg-12" style="margin-bottom:5%">
				<section class="search-sec">

					<div class="row">
						<div class="col-lg-11 col-md-10 col-sm-10 p-0">
							<input type="search" class="form-control search-slt" list="domainList"
								value="<?php if(isset($searchValue)){echo $searchValue;} ?>" autocomplete="off"
								name="searchDomain" id="searchDomain" placeholder="Type Your Domain Name">
						</div>
						<div class="col-lg-1 col-md-2 col-sm-2">
							<button type="submit" class="btn wrn-btn mysearch-btn" name="search"><i class="fa fa-search"
									aria-hidden="true"></i></button>
						</div>
					</div>
				</section>
			</div>
		</div>
		<!-- Flash Data -->
		<?php if($usermsg = $this->session->flashdata('user_msg')) :
			$user_class = $this->session->flashdata('user_class');?>
		<div class="row">
			<div class="col-lg-12">
				<div class="alert <?php echo $user_class; ?>">
					<?php echo $usermsg; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>


	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-lg-12" style="padding:10px 50px;">
			<div class="card">
				<div class="card-body showDomain">
					<h4 class="card-title text-center"><b>Search Your Domain</b></h4>
				</div>
			</div>
		</div>
	</div>
</div>
<br>
<div class="container">
	<div class="row">
		<!-- <div class="col-lg-3">
      <div class="card">

	  <article class="card-group-item">
		<header class="card-header">
			<h6 class="title">Genre/ Category </h6>
		</header>
		<div class="filter-content">
			<div class="card-body">
				<div class="custom-control custom-checkbox">
					<span class="float-right badge badge-light round"></span>
				  	<input type="checkbox" class="custom-control-input" id="Check1">
				  	<label class="custom-control-label" for="Check1">Alcohal</label>
				</div>
			</div> 
		</div>
	</article>

	<article class="card-group-item">
		<header class="card-header">
			<h6 class="title">Price </h6>
		</header>
		<div class="filter-content">
			<div class="card-body">
			<div class="form-row">
			<div class="form-group col-md-6">
			  <label>Min</label>
			  <input type="number" class="form-control" id="inputEmail4" placeholder="$0">
			</div>
			<div class="form-group col-md-6 text-right">
			  <label>Max</label>
			  <input type="number" class="form-control" placeholder="$1,0000">
			</div>
			</div>
			</div>
		</div>
	</article> 
      </div>
      
	</div> -->

		<div class="col-lg-12" id="result">
			<!-- <div class="card">
				<div class="card-body">
					<div class="row">
						<h4>No record Found</h4>
					</div>
					
				</div>
			</div> -->
		</div>


	</div>
	<br><br>

	<script>
		$(document).ready(function () {
			// load_data();

			var name = $("#searchDomain").val();

			if (name != '') {
				search_domain(name);
				load_data(name);
			}

			function search_domain(query) {

				$.ajax({
					method: "POST",
					url: "<?php echo base_url(); ?>search/searchDomainAPI",
					beforeSend: function () {
						// setting a timeout
						$('.showDomain').html(
							'<h4 class="card-title text-center text-success"><b>Fetching Domain...</b></h4>'
							);
					},
					data: {
						domainName: query
					},
					success: function (data) {
						$('.showDomain').html(data);
						// console.log(data);
					}
				});
			}


			function load_data(query) {

				$.ajax({
					method: "POST",
					url: "<?php echo base_url(); ?>search/fetch",
					beforeSend: function () {
						// setting a timeout
						$('#result').html(
							'<h4 class="card-title text-center text-success"><b>Loading...</b></h4>');
					},
					data: {
						query: query
					},
					success: function (data) {
						$('#result').html(data);
						// console.log(data);
					}
				});
			}



			$(document).on('click', '.mysearch-btn', function (e) {
				var name = $("#searchDomain").val();
				if (name != '') {
					search_domain(name);
					load_data(name);
				}
			});
			// $('#searchDomain').keyup(function () { 
			// 	var search = this.value;
			// 	if(search != ''){
			// 		// console.log(search);
			// 		load_data(search);

			// 	}else{
			// 		// var mydata ='<tr><td class="text-center"><h4>Please enter some terms to search for Domain</h4></td></tr>';
			// 		// $('#result').html(mydata);
			// 		load_data();
			// 	}
			// });
		});

	</script>
	<script>
		$(document).on('click', '.add_cart', function (e) {
			// alert("helloa");
			var domain_id = $(this).data('domainid');
			var domainName = $(this).data('domainname');
			var categoryid = $(this).data('category');
			var price = $(this).data('price');
			var purpose = $(this).data('purpose');
			var year = $(this).data('year');


			// console.log(year);

			$.ajax({
				url: "<?php echo base_url(); ?>checkout/add_cart",
				method: "POST",
				data: {
					domain_id: domain_id,
					domainName: domainName,
					category_id: categoryid,
					year: year,
					price: price,
					purpose: purpose
				},
				success: function (data) {
					// console.log(data);
					$('.countitems').html(data);
					// alert(data);

				},
				error: function (data) {
					console.log(data);
					// alert(" Can't do because: " + data);
				}
			});
		});

	</script>
	<?php include("account/footer.php"); ?>
