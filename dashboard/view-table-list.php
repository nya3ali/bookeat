<!-- view-chair-list.php -->
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
					<h2>Table</h2>
					<div class="right-wrapper pull-right">
						<ol class="breadcrumbs">
							<li>
								<a href="accueil.php">
									<i class="fa fa-home"></i>
								</a>
							</li>
							<li><span>Restaurent Tables</span></li>
							<li><span>Chair List</span></li>
						</ol>
						<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
					</div>
				</header>
				<!-- start: page -->
				<section class="panel">
					<a href="#exampleModal" class="btn btn-warning btn-sm" data-toggle="modal">Add</a>
					<br>
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="fa fa-caret-down"></a>
							<a href="#" class="fa fa-times"></a>
						</div>
						<h2 class="panel-title">All tables for the chosen option</h2>
						<p class="panel-subtitle">
							To add <code>new table </code>, please choose the button <code>"Add"</code>. <br><br>
							You can delete a table if you need to.
						</p>
					</header>
					<div class="panel-body">
						<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf" data-plugin-options='{"searchPlaceholder": "Search"}'>
							<thead>
								<tr>
									<th>ID</th>
									<th>Table Number</th>
									<th class="hidden-phone">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$count = 1;
								include 'dbCon.php';
								$con = connect();
								$tbl_id = $_GET['table_id'];
								$sql = "SELECT * FROM `restaurant_personne` WHERE tbl_id = '$tbl_id' ;";
								$result = $con->query($sql);
								foreach ($result as $r) {
								?>
									<tr class="gradeX">
										<td class="center hidden-phone"><?php echo $count; ?></td>
										<td><?php echo $r['table_no']; ?></td>
										<td class="center hidden-phone">
											<a href="delete-table-num.php?table_id=<?php echo $r['id']; ?>&tbl_id=<?php echo $tbl_id; ?>" class="btn btn-danger btn-sm" onclick="if (!Done()) return false; ">Delete</a>
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

	<!-- Modal -->
	<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Table</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label>Number of tables available?</label>
							<input type="number" name="num_of_chair" required="" class="form-control" min="1" max="15" placeholder="min 1 - max 15">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" name="addchair" class="btn btn-warning btn-sm" value="Add">
						<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>
<?php
if (isset($_POST['addchair'])) {
	$num_of_chair = $_POST['num_of_chair'];
	$tbl_id = $_GET['table_id'];
	$indert = false;
	$tbl_name = "";
	$sql = "SELECT * FROM `restaurant_tables` WHERE id = '$tbl_id' ;";
	$result = $con->query($sql);
	foreach ($result as $r) {
		$tbl_name = $r['person_num'];
	}
	for ($i = 1; $i <= $num_of_chair; $i++) {
		$table_no = $i;
		$exct = "- Table N° ";
		$iquery = "INSERT INTO `restaurant_personne`( `tbl_id`, `table_no`) 
            VALUES ('$tbl_id','$tbl_name$exct$table_no');";
		if ($con->query($iquery) === TRUE) {
			$insert = true;
		} else {
			echo "Error: " . $iquery . "<br>" . $con->error;
		}
	}
	if ($insert == true) {
		echo '<script>
                    swal({
						title: "Super !",
						text: "The tables have been added successfully!",
						icon: "success",
						button: "ok",
                    }).then(function() {
						window.location.href ="view-table-list.php?table_id=" + dist;
                    });
                    </script>'; ?>
		<script type="text/javascript">
			var dist = <?php echo $tbl_id; ?>;
		</script>
<?php
	}
}
?>