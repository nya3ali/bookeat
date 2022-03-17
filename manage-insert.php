<!-- manage-insert.php -->

<body>
	<?php include 'dashboard/template/alert.php'; ?>
</body>

<?php
session_start();
include_once 'dbCon.php';
$con = connect();
if (isset($_POST['submit'])) {
	// Use function to prevent user to escape characters
	$fullname = mysqli_real_escape_string($con, $_POST['rc_name']);
	$first_name = mysqli_real_escape_string($con, $_POST['first_name']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$phone = $_POST['phone'];
	$password = mysqli_real_escape_string($con, $_POST['password']);

	$role = 2;

	// existing email check
	$checkSQL = "SELECT * FROM `rc_info` WHERE email=?;";
	// Create prepared statement to prevent sql injection anything' or 'x'='x
	$stmt = mysqli_stmt_init($con);
	// Prepare the prepared statement
	if (!mysqli_stmt_prepare($stmt, $checkSQL)) {
		echo "SQL declaration has failed.";
	} else {
		// Bind parameters to the placeholder
		mysqli_stmt_bind_param($stmt, "s", $email);
		// Run parameters inside db
		mysqli_stmt_execute($stmt);
		$checkresult = mysqli_stmt_get_result($stmt);
		if ($checkresult->num_rows > 0) {
			echo '<script>alert("Warning! This E-mail already exists.")</script>';
			echo '<script>window.location="register.php"</script>';
		} else {
			if (isset($_FILES['image'])) {
				// files handle
				$targetDirectory = "dashboard/user-image/";
				// get the file name
				$file_name = $_FILES['image']['name'];
				// get the mime type
				$file_mime_type = $_FILES['image']['type'];
				// get the file size
				$file_size = $_FILES['image']['size'];
				// get the file in temporary
				$file_tmp = $_FILES['image']['tmp_name'];
				// get the file extension, pathinfo($variable_name,FLAG)
				$extension = pathinfo($file_name, PATHINFO_EXTENSION);

				//register as customer
				if ($extension == "jpg" || $extension == "png" || $extension == "jpeg") {
					move_uploaded_file($file_tmp, $targetDirectory . $file_name);
					$iquery = "INSERT INTO `rc_info`(`rc_name`, `first_name`, `email`, `phone`, `password`, `role`) 
								VALUES (?, ?, ?, ?, ?, ?);";
					$stmt2 = mysqli_stmt_init($con);
					if (!mysqli_stmt_prepare($stmt2, $iquery)) {
						echo "Error : SQL.";
					} else {
						mysqli_stmt_bind_param($stmt2, "sssisi", $fullname, $first_name, $email, $phone, $password, $role);
						mysqli_stmt_execute($stmt2);
						if ($stmt2 === TRUE) {
							echo '<script>alert("You are registered !")</script>';
							echo '<script>window.location="login.php"</script>';
						} else {
							echo "Error: " . $iquery . "<br>" . $con->error;
						}
					}
				} else {
					echo '<script>alert("Required JPG,PNG,GIF in Logo Field.")</script>';
					echo '<script>window.location="register.php"</script>';
				}
			} else {
				$file_name = "";
				$iquery = "INSERT INTO `rc_info`(`rc_name`, `first_name`, `email`, `phone`, `password`, `role`) 
							VALUES (?, ?, ?, ?, ?, ?);";
				$stmt2 = mysqli_stmt_init($con);
				if (!mysqli_stmt_prepare($stmt2, $iquery)) {
					echo "Error: " . $iquery . "<br>" . $con->error;
				} else {
					mysqli_stmt_bind_param($stmt2, "sssisi", $fullname, $first_name, $email, $phone, $password, $role);
					mysqli_stmt_execute($stmt2);
					echo '<script>alert("New account well added!")</script>';
					echo '<script>window.location="login.php"</script>';
				}
			}
		}
	}
}

//register as restaurant
if (isset($_POST['submit2'])) {
	$fullname = mysqli_real_escape_string($con, $_POST['rc_name']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$website = mysqli_real_escape_string($con, $_POST['website']);
	$phone = $_POST['phone'];
	$address = mysqli_real_escape_string($con, $_POST['address']);
	$category = $_POST['category'];
	$area = $_POST['area'];
	$open = $_POST['opening_res'];
	$close = $_POST['closing_res'];
	$service = $_POST['full_service'];
	// Siret is the number of the company
	$siret = mysqli_real_escape_string($con, $_POST['siret']);
	$password = mysqli_real_escape_string($con, $_POST['password']);

	$role = 1;

	$checkSQL = "SELECT * FROM `rc_info` WHERE email=?;";
	// Create prepared statement to prevent sql injection
	$stmt = mysqli_stmt_init($con);
	// Prepare the prepared statement
	if (!mysqli_stmt_prepare($stmt, $checkSQL)) {
		echo "SQL declaration has failed.";
	} else {
		// Bind parameters to the placeholder
		mysqli_stmt_bind_param($stmt, "s", $email);
		// Run parameters inside db
		mysqli_stmt_execute($stmt);
		$checkresult = mysqli_stmt_get_result($stmt);
		if ($checkresult->num_rows > 0) {
			echo '<script>alert("Warning ! A restaurant with this E-mail already exists.")</script>';
			echo '<script>window.location="register.php"</script>';
		} else {
			if (isset($_FILES['image'])) {
				// files handle
				$targetDirectory = "dashboard/user-image/";
				// get the file name
				$file_name = $_FILES['image']['name'];
				// get the mime type
				$file_mime_type = $_FILES['image']['type'];
				// get the file size
				$file_size = $_FILES['image']['size'];
				// get the file in temporary
				$file_tmp = $_FILES['image']['tmp_name'];
				// get the file extension, pathinfo($variable_name,FLAG)
				$extension = pathinfo($file_name, PATHINFO_EXTENSION);
				if ($extension == "jpg" || $extension == "png" || $extension == "jpeg") {
					move_uploaded_file($file_tmp, $targetDirectory . $file_name);
					$iquery = "INSERT INTO `rc_info`(`rc_name`, `category`, `email`, `website`, `phone`, `address`, `location`, `opening_res`, `closing_res`, `full_service`,`logo`, `siret`, `password`, `role`) 
							VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
					$stmt2 = mysqli_stmt_init($con);
					if (!mysqli_stmt_prepare($stmt2, $iquery)) {
						echo "Error: " . $iquery . "<br>" . $con->error;
					} else {
						mysqli_stmt_bind_param($stmt2, "sissisissisisi", $fullname, $category, $email, $website, $phone, $address, $area, $open, $close, $service, $file_name, $siret, $password, $role);
						mysqli_stmt_execute($stmt2);
						echo '<script>alert("You are successfully registered!")</script>';
						echo '<script>window.location="login.php"</script>';
					}
					// Confirmation Mail PHPMailer.
					// $id = $con->insert_id;
					// include 'dashboard/mailSender.php';
					// $mail->Body = '<html><body>
					// 				S\'il vous plaît veuillez vérifier votre mail en cliquant sur le lient ci-dessous :
					// 				<a href="http://localhost/book_eat/verifyaccount.php?email=' . $email . '&id=' . $id . '&auth=' . $password . '"></a>
					// 				</body></html>';
					// $mail->addAddress($email, "Demande de réservation approuvée.");
					// if ($mail->send()) {
					// 	echo '<script>alert("Restaurant ajouté avec succès ! Vous recevrez bientôt un mail de vérification de compte.")</script>';
					// 	echo '<script>window.location="verifyaccount.php?view=verifyaccount&email=' . $email . '&id=' . $id . '&auth=' . $password . '"</script>';
					// 	echo '<script>alert("Restaurant ajouté avec succès")</script>';
					// 	echo '<script>window.location="login.php"</script>';
					// } else {
					// 	echo '<script>alert("Restaurant ajouté avec succès")</script>';
					// 	echo '<script>window.location="login.php"</script>';
					// }
				} else {
					echo '<script>alert("Required JPG,PNG,GIF in Logo Field.")</script>';
					echo '<script>window.location="register.php"</script>';
				}
			} else {
				$file_name = "";

				$iquery = "INSERT INTO `rc_info`( `rc_name`, `category`,`email`, `website`,`phone`, `address`, `location`, `opening_res`, `closing_res`, `full_service`, `logo`, `siret`, `password`, `role`) 
						VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stmt2 = mysqli_stmt_init($con);
				if (!mysqli_stmt_prepare($stmt2, $iquery)) {
					echo "Error: " . $iquery . "<br>" . $con->error;
				} else {
					mysqli_stmt_bind_param($stmt2, "sissisissisisi", $fullname, $category, $email, $website, $phone, $address, $area, $open, $close, $service, $file_name, $siret, $password, $role);
					mysqli_stmt_execute($stmt2);
					echo '<script>alert("New account added!")</script>';
					echo '<script>window.location="login.php"</script>';
				}
			}
		}
	}
}

if (isset($_POST['book'])) {

	$bdinsert = false;
	$u_id = $_SESSION['id'];
	$res_id = $_POST['res_id'];
	$reservation_name = $_POST['reservation_name'];
	$reservation_firstname = $_POST['reservation_firstname'];
	$reservation_phone = $_POST['reservation_phone'];
	$reservation_email = $_POST['reservation_email'];
	$reservation_date = $_POST['reservation_date'];
	$reservation_time = $_POST['reservation_time'];

	date_default_timezone_set("Europe/Paris");
	$make_time = date("h:i:sa");
	$make_date = date("Y-m-d");
	$booking_id = uniqid();

	$iquery = "INSERT INTO `booking_details`(`booking_id`,`res_id`,`c_id`,`make_date`, `make_time`, `name`, `first_name`,`phone`, `email`, `booking_date`, `booking_time`) 
				VALUES ('$booking_id','$res_id','$u_id','$make_date','$make_time','$reservation_name','$reservation_firstname','$reservation_phone','$reservation_email','$reservation_date','$reservation_time');";
	if ($con->query($iquery) === TRUE) {
		$bdinsert = true;
	} else {
		echo "Error: " . $iquery . "<br>" . $con->error;
	}

	$cinsert = false;
	if ($bdinsert == true) {
		for ($q = 0; $q < count($_POST["chair"]); $q++) {
			$c_id = $_POST['chair'][$q];
			$table_no = "";
			$sql5 = "SELECT * FROM `restaurant_personne` WHERE id = '$c_id';";
			$result5 = $con->query($sql5);
			foreach ($result5 as $r5) {
				$table_no = $r5['table_no'];
			}
			$ciQuery = "INSERT INTO `booking_table`(`booking_id`, `table_id`, `table_no`) 
						VALUES ('$booking_id','$c_id','$table_no');";
			if ($con->query($ciQuery) === TRUE) {
				$cinsert = true;
			} else {
				echo "Error: " . $ciQuery . "<br>" . $con->error;
			}
		}
	}

	if ($bdinsert == true && $cinsert == true) {
		echo '<script>
                    swal({
                        title: "Thank you !",
                        text: "The restaurant will send you a Confirmation Email soon. :D",
                        icon: "success",
                        button: "ok",
                    }).then(function() {
                        window.location = "accueil.php";
                    });
                    </script>';
	} else {
		echo "Error: " . $iquery . "<br>" . $con->error;
		echo "Error: " . $ciQuery . "<br>" . $con->error;
		echo "Error: " . $iquery . "<br>" . $con->error;
	}
}
?>