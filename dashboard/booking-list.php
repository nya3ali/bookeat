<!-- booking-list.php -->
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
					<h2>Booking</h2>
					<div class="right-wrapper pull-right">
						<ol class="breadcrumbs">
							<li>
								<a href="accueil.php">
									<i class="fa fa-home"></i>
								</a>
							</li>
							<li><span>Booking</span></li>
							<li><span>Manage Bookings</span></li>
						</ol>
						<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
					</div>
				</header>
				<!-- start: page -->
				<section class="panel">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="fa fa-caret-down"></a>
							<a href="#" class="fa fa-times"></a>
						</div>
						<h2 class="panel-title">All Bookings</h2>
							To accept <code>a booking</code>, please use action. <br>
							A <code>confirmation mail</code> will be sent to the customer, with booking details. <br>
							You can open booking details by clicking <code>"Details"</code> button.
					</header>
					<div class="panel-body">
						<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf" data-plugin-options='{"searchPlaceholder": "Search"}'>
							<thead>
								<tr>
									<th>N°</th>
									<th>Last Name</th>
									<th>First Name</th>
									<th>Phone</th>
									<th>E-Mail</th>
									<th>Date</th>
									<th>Hour</th>
									<th class="hidden-phone">Status</th>
									<th class="hidden-phone">Action</th>
									<th class="hidden-phone">Details Tables/persons</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$count = 1;
								include 'dbCon.php';
								$con = connect();
								$res_id = $_SESSION['id'];
								$sql = "SELECT * FROM `booking_details` WHERE res_id = '$res_id'  ORDER BY make_date DESC;";
								$result = $con->query($sql);
								foreach ($result as $r) {
								?>
									<tr class="gradeX">
										<td class="center hidden-phone"><?php echo $count; ?></td>
										<td><?php echo $r['name']; ?></td>
										<td><?php echo $r['first_name']; ?></td>
										<td><?php echo $r['phone']; ?></td>
										<td><?php echo $r['email']; ?></td>
										<td><?php echo $r['booking_date']; ?></td>
										<td><?php echo $r['booking_time']; ?></td>
										<td class="left hidden-phone">
											<?php
											$status = $r['status'];
											if ($status == 0) {
											?>
												<p class="text-danger"><i class="far fa-calendar-times"></i> Refused</p>
											<?php } else { ?>
												<p class="text-success"><i class="far fa-calendar-check"></i> Confirmed</p>
											<?php } ?>
										</td>
										<td class="center hidden-phone">
											<?php
											if ($status == 1) {
											?>
												<a href="approve-reject.php?breject_id=<?php echo $r['id']; ?>&booking-number=<?php echo $r['booking_id']; ?>" class="btn btn-danger btn-sm btn-block" onclick="if (!Done()) return false; ">Refused</a>
											<?php } else { ?>
												<a href="approve-reject.php?bapprove_id=<?php echo $r['id']; ?>&booking-number=<?php echo $r['booking_id']; ?>" class="btn btn-success btn-sm btn-block" onclick="if (!Done()) return false; ">Confirmed</a>
											<?php } ?>
										</td>
										<td class="center hidden-phone">
											<a href="invoice.php?booking-number=<?php echo $r['booking_id']; ?>" class="btn btn-warning btn-sm btn-block">Details</a>
										</td>
									</tr>
								<?php $count++;
								} ?>
							</tbody>
						</table>
					</div>
				</section>
				<!-- end: page -->
			</section>
		</div>
		<?php include 'template/right-bar.php'; ?>
	</section>
	<script type="text/javascript">
		function Done() {
			return confirm("Are you sure?");
		}
	</script>
	<?php include 'template/script-res.php'; ?>
</body>

</html>