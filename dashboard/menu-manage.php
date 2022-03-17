<!-- menu-manage.php -->

<body>
	<?php include 'template/alert.php'; ?>
</body>

<?php
if (isset($_GET['menu_id'])) {
	$id = $_GET['menu_id'];
	$sql = "DELETE FROM `menu_item` WHERE id = '$id';";
	include_once 'dbCon.php';
	$con = connect();
	if ($con->query($sql) === TRUE) {
		echo '<script>
			swal({
				title: false,
				text: "This product has been deleted!",
				icon: "success",
				button: "ok",
			}).then(function() {
				window.location = "menu-list.php";
			});
			</script>';
	} else {
		echo "Error: " . $sql . "<br>" . $con->error;
	}
}
?>