<!-- menu-list.php -->
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
					<h2>Menu</h2>
					<div class="right-wrapper pull-right">
						<ol class="breadcrumbs">
							<li>
								<a href="accueil.php">
									<i class="fa fa-home"></i>
								</a>
							</li>
							<li><span>Menu</span></li>
							<li><span>List of Dishes</span></li>
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
						<h2 class="panel-title">List of Dishes</h2>
						<p class="panel-subtitle">
							Here acces to your <code>menu list</code>, if you want to delete a product from your menu, please use <code>"Delete"</code> button.
						</p>
					</header>
					<div class="panel-body">
						<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf" data-plugin-options='{"searchPlaceholder": "Search"}'>
							<thead>
								<tr>
									<th>N°</th>
									<th>Photo</th>
									<th>Product Name</th>
									<th>Description</th>
									<th>Category</th>
									<th>Price € </th>
									<th class="hidden-phone">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$res_id = $_SESSION['id'];
								$count = 1;
								include 'dbCon.php';
								$con = connect();
								$sql = "SELECT * FROM `menu_item` WHERE res_id = '$res_id';";
								$result = $con->query($sql);
								foreach ($result as $r) {
								?>
									<tr class="gradeX">
										<td class="center hidden-phone"><?php echo $count; ?></td>
										<td class="center hidden-phone">
											<figure class="image rounded">
												<img style="height: 60px;width: 60px;border-radius: 10px; border: 2px solid #ffba3b;" src="item-image/<?php echo $r['image']; ?>" alt="Item Image">
											</figure>
										</td>
										<td><?php echo $r['item_name']; ?></td>
										<td><?php echo $r['item_desc']; ?></td>
										<td><?php echo $r['food_type']; ?></td>
										<td><?php echo $r['price']; ?></td>
										<td class="center hidden-phone">
											<a href="menu-manage.php?menu_id=<?php echo $r['id']; ?>" class="btn btn-danger btn-block btn-sm" onclick="if (!Done()) return false; ">Delete</a>
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
			<script type="text/javascript">
				function Done() {
					return confirm("Are you sure?");
				}
			</script>
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

	<!-- Specific Page Vendor -->
	<script src="assets/vendor/select2/select2.js"></script>
	<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
	<script src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
	<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>

	<!-- Theme Base, Components and Settings -->
	<script src="assets/javascripts/theme.js"></script>

	<!-- Theme Custom -->
	<script src="assets/javascripts/theme.custom.js"></script>

	<!-- Theme Initialization Files -->
	<script src="assets/javascripts/theme.init.js"></script>

	<!-- Examples -->
	<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
	<script src="assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
	<script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script>

	<!-- Sweet Alert -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>