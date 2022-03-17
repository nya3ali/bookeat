<!-- invoice.php -->
<?php include 'template/header.php';
if (!isset($_SESSION['isLoggedIn'])) {
	echo '<script>window.location="login.php"</script>';
}
?>

<body>
	<section class="body">
		<!-- start: header -->
		<?php include 'template/top-bar.php'; ?>
		<!-- end: header -->
		<div class="inner-wrapper">
			<!-- start: sidebar -->
			<?php include 'template/left-bar.php'; ?>
			<!-- end: sidebar -->
			<section role="main" class="content-body">
				<header class="page-header">
					<h2>Booking Details</h2>
					<div class="right-wrapper pull-right">
						<ol class="breadcrumbs">
							<li>
								<a href="accueil.php">
									<i class="fa fa-home"></i>
								</a>
							</li>
							<li><span>Bookings</span></li>
							<li><span>Manage Bookings</span></li>
							<li><span>Bookings Details</span></li>
						</ol>
						<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
					</div>
				</header>
				<!-- start: page -->
				<section class="panel">
					<div class="panel-body">
						<div class="invoice">
							<header class="clearfix">
								<div class="row">
									<div class="col-sm-4 mt-md">
										<h2 class="h2 mt-none mb-sm text-dark text-bold">BOOKINGS</h2>
										<h4 style="color: orange;" class="h4 m-none text-bold">
											N° #<?php echo $_GET['booking-number']; ?></h4>
									</div>
									<?php
									include 'dbCon.php';
									$con = connect();
									$res_id = $_SESSION['id'];
									$sql = "SELECT * FROM `rc_info` where id = '$res_id';";
									$result = $con->query($sql);
									foreach ($result as $r) {
									?>
										<div class="col-sm-8 text-right mt-md mb-md">
											<address class="ib mr-xlg">
												<b class="text-capitalize"><?php echo $r['rc_name']; ?></b>
												<br />
												<b class="text-capitalize"><?php echo $r['first_name']; ?></b>
												<br />
												<?php echo $r['address']; ?>
												<br />
												<!-- FOR FRANCE -->
												Phone : +33 0<?php echo $r['phone']; ?>
												<br />
												<?php echo $r['email']; ?>
											</address>
											<div class="ib">
												<img style="width: 200px;height: 200px;" src="user-image/<?php echo $r['logo']; ?>" alt="OKLER Themes" />
											</div>
										</div>
									<?php } ?>
								</div>
							</header>
							<?php
							$booking_number = $_GET['booking-number'];
							$sql2 = "SELECT * FROM `booking_details` where booking_id = '$booking_number';";
							$result2 = $con->query($sql2);
							foreach ($result2 as $r2) {
								$booking_date = $r2['booking_date'];
								$booking_time = $r2['booking_time'];
								$booking_name = $r2['name'];
								$booking_first_name = $r2['first_name'];
								$booking_phone = $r2['phone'];
							} ?>
							<div class="bill-info">
								<div class="row">
									<div class="col-md-6">
										<div class="bill-to">
											<p class="h4 mb-xs text-dark text-semibold">Customer Informations :</p>
											<address>
												<?php echo "Last Name & First Name : " . $booking_name; ?>
												<?php echo $booking_first_name; ?>
												<br />
												<!-- French number phone -->
												Phone : +33 <?php echo $booking_phone; ?>
											</address>
										</div>
									</div>
									<div class="col-md-6">
										<div class="bill-data text-right">
											<p class="h4 mb-xs text-dark text-semibold">Date & Hour Booking Information :</p>
											<p class="mb-none">
												<span class="text-dark">Booking Date :</span>
												<span class="value"><?php echo date("d/m/Y", strtotime($booking_date)); ?></span>
											</p>
											<p class="mb-none">
												<span class="text-dark">Booking Hour :</span>
												<span class="value"><?php echo $booking_time; ?></span>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="bill-info">
								<div class="row">
									<div class="col-md-6">
										<div class="bill-to">
											<p class="h4 mb-xs text-dark text-semibold">How many persons & Table number:</p>
											<address id="table">
												<?php
												$booking_number = $_GET['booking-number'];
												$sql3 = "SELECT bt.booking_id,bt.table_no,rt.person_num
														FROM booking_table as bt, restaurant_personne as rc,restaurant_tables as rt
														WHERE bt.table_id = rc.id
														AND rc.tbl_id = rt.id
														and bt.booking_id ='$booking_number';";
												$result3 = $con->query($sql3);
												foreach ($result3 as $r3) {
												?>
													<?php echo $r3['table_no']; ?>,
												<?php  } ?>
											</address>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="text-right mr-lg">
						</div>
					</div>
				</section>
				<!-- end: page -->
			</section>
		</div>
		<?php include 'template/right-bar.php'; ?>
	</section>

	<!-- Vendor -->
	<script src="assets/vendor/jquery/jquery.js"></script>
	<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
	<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
	<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
	<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

	<!-- Theme Base, Components and Settings -->
	<script src="assets/javascripts/theme.js"></script>

	<!-- Theme Custom -->
	<script src="assets/javascripts/theme.custom.js"></script>

	<!-- Theme Initialization Files -->
	<script src="assets/javascripts/theme.init.js"></script>

	<!-- Sweet Alert -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>