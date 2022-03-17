<!-- table-add.php -->
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
					<h2>Manage Availability</h2>
					<div class="right-wrapper pull-right">
						<ol class="breadcrumbs">
							<li>
								<a href="index.html">
									<i class="fa fa-home"></i>
								</a>
							</li>
							<li><span>Manage Availability</span></li>
							<li><span>New Table</span></li>
						</ol>
						<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
					</div>
				</header>
				<!-- start: page -->
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<form action="manage-insert.php" method="POST" enctype="multipart/form-data">
							<section class="panel">
								<header class="panel-heading">
									<h2 class="panel-title">Add New Table</h2>
									<p class="panel-subtitle">
										To add <code>A type of table</code> please choose from the drop down menu. <br><br>
										Then go into the left nav-bar menu : <code>"Manage Tables"</code> and <code>"List of Available Tables"</code>, to add how many each tables you have.
									</p>
								</header>
								<div class="panel-body">
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="control-label">Type of table you have in your restaurant</label>
												<div class="form-group">
													<select data-plugin-selectTwo class="form-control populate" name="tablename" required="">
														<option value=""> -Select- </option>
														<option value="1 personne">Table of 1 Person</option>
														<option value="2 personnes">Table of 2 Persons</option>
														<option value="3 personnes">Table of 3 Persons</option>
														<option value="4 personnes">Table of 4 Persons</option>
														<option value="5 personnes">Table of 5 Persons</option>
														<option value="6 personnes">Table of 6 Persons</option>
														<option value="7 personnes">Table of 7 Persons</option>
														<option value="8 personnes">Table of 8 Persons</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<footer class="panel-footer">
									<input type="submit" name="addtable" class="btn btn-warning btn-sm" value="Add">
								</footer>
							</section>
						</form>
					</div>
				</div>
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