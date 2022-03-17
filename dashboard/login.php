<!-- login.php -->
<?php session_start(); ?>
<!doctype html>
<html class="fixed">

<head>

	<!-- Basic -->
	<meta charset="UTF-8">

	<meta name="keywords" content="HTML5 Admin Template" />
	<meta name="description" content="Porto Admin - Responsive HTML5 Template">
	<meta name="author" content="okler.net">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Web Fonts  -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="assets/stylesheets/theme.css" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

	<!-- Head Libs -->
	<script src="assets/vendor/modernizr/modernizr.js"></script>

</head>

<body>
	<?php include 'template/alert.php'; ?>
	<!-- start: page -->
	<section class="body-sign">
		<div class="circle-login">Logo`EAT </div>
		<div class="center-sign">
			<div class="panel panel-sign">
				<div class="panel-title-sign text-right" style="margin-top: 5em !important;">
					<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Connection</h2>
				</div>
				<div class="panel-body">
					<form action="" method="POST">
						<div class="form-group mb-lg">
							<label>E-mail</label>
							<div class="input-group input-group-icon">
								<input name="email" type="email" class="form-control input-lg" required="" />
								<span class="input-group-addon">
									<span class="icon icon-lg">
										<i class="fa fa-user"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="form-group mb-lg">
							<div class="clearfix">
								<label class="pull-left">Password</label>
							</div>
							<div class="input-group input-group-icon">
								<input name="password" type="password" class="form-control input-lg" required="" />
								<span class="input-group-addon">
									<span class="icon icon-lg">
										<i class="fa fa-lock"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-8">
								<div class="checkbox-custom checkbox-default">
									<input id="RememberMe" name="rememberme" type="checkbox" />
									<label for="RememberMe">Remember Me</label>
								</div>
							</div>
							<div class="col-sm-4 text-right">
								<input type="submit" class="btn btn-primary btn-sm" name="login" value="Log In">
							</div>
						</div>
						<span class="mt-lg mb-lg line-thru text-center text-uppercase">
							<span>ou</span>
						</span>
						<div class="mb-xs text-center">
							<a class="btn btn-facebook mb-md ml-xs mr-xs">Connect with <i class="fa fa-facebook"></i></a>
							<a class="btn btn-twitter mb-md ml-xs mr-xs">Connect with <i class="fa fa-twitter"></i></a>
						</div>
						<p class="text-center">I don't have an account yet? <a href="pages-signup.html">Register!</a>
					</form>
				</div>
			</div>

		</div>
	</section>
	<!-- end: page -->

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

</body>

</html>
<?php

if (isset($_POST['login'])) {

	$email = $_POST['email'];
	$password = $_POST['password'];

	include 'dbCon.php';
	$con = connect();

	$emailSQL = "SELECT * FROM rc_info WHERE email = '$email';";

	$emailResult = $con->query($emailSQL);

	$passwordSQL = "SELECT * FROM rc_info WHERE email = '$email' And password=?;";

	$stmt = mysqli_stmt_init($con);
	// Prepare the prepared statement to prevent injection SQL from loggin with " anything' or 'x'='x "
	if (!mysqli_stmt_prepare($stmt, $passwordSQL)) {
		echo "SQL declaration has been failed.";
	} else {
		// Bind parameters to the placeholder
		mysqli_stmt_bind_param($stmt, "s", $password);
		// Run parameters inside db
		mysqli_stmt_execute($stmt);

		// $passwordResult = $con->query($passwordSQL);
		$passwordResult = mysqli_stmt_get_result($stmt);

		if ($emailResult->num_rows <= 0) {
			echo '<script>
			swal({
				title: false,
				text: "This email does not exist.",
				icon: "warning",
				button: "ok",
			}).then(function() {
				window.location = "login.php";
			});
			</script>';
		} else if ($passwordResult->num_rows <= 0) {
			echo '<script>
			swal({
				title: false,
				text: "Incorrect Password !",
				icon: "warning",
				button: "ok",
			}).then(function() {
				window.location = "login.php";
			});
			</script>';
		} else {

			$_SESSION['isLoggedIn'] = TRUE;

			$SQL = "SELECT * FROM rc_info WHERE email = '$email' And password = '$password';";

			$result = $con->query($SQL);

			foreach ($result as $r) {
				$_SESSION['id'] = $r['id'];
				$_SESSION['name'] = $r['rc_name'];
				$_SESSION['first_name'] = $r['first_name'];
				$_SESSION['email'] = $r['email'];
				$_SESSION['password'] = $r['password'];
				$_SESSION['role'] = $r['role'];
			}
			if ($_SESSION['role'] == 1) {
				echo '<script>window.location="accueil.php"</script>';
			} else {
				echo '<script>window.location="../accueil.php"</script>';
			}
		}
	}
}
?>