<!-- approve-reject.php -->

<body>
	<?php include 'template/alert.php'; ?>
</body>

<?php
session_start();
include_once 'dbCon.php';
$con = connect();
//reject 
if (isset($_GET['breject_id'])) {
	$id = $_GET['breject_id'];
	$sql = "UPDATE booking_details SET status = 0 WHERE id = '$id';";
	if ($con->query($sql) === TRUE) {
		echo '<script>
                    swal({
                        title: false,
                        text: "This reservation has been refused!",
                        icon: "success",
                        button: "ok",
                    }).then(function() {
                        window.location = "booking-list.php";
                    });
                    </script>';
	} else {
		echo "Error: " . $sql . "<br>" . $con->error;
	}
}

// approve booking request
if (isset($_GET['bapprove_id'])) {
	$id = $_GET['bapprove_id'];
	$sql = "UPDATE booking_details SET status = 1 WHERE id = '$id';";

	$sql2 = "SELECT `id`, `c_id`, (SELECT `rc_name` FROM `rc_info` WHERE rc_info.id= booking_details.c_id) as username,(SELECT `email` FROM `rc_info` WHERE rc_info.id= booking_details.c_id) as email FROM booking_details WHERE id = '$id';";
	$result = $con->query($sql2);
	foreach ($result as $r) {
		$cname = $r['username'];
		$email = $r['email'];
	}

	$sql8 = "SELECT * FROM `booking_details` WHERE id = '$id';";
	$result8 = $con->query($sql8);
	foreach ($result8 as $r8) {
		// Mail of confirmation
		if ($con->query($sql) === TRUE) {
			include 'mailSender.php';
			$mail->Body = '<!DOCTYPE html>
			<html xmlns:fb="https://www.facebook.com/2008/fbml" xmlns:og="http://opengraph.org/schema/">
			<head>
				<meta property="og:title" content="Book eat" />
				<meta property="fb:page_id" content="43929265776" />
				<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
				<title></title>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<style type="text/css">
					/* CLIENT-SPECIFIC RESET */
					body,
					table,
					td,
					a {
						-webkit-text-size-adjust: 100%;
						-ms-text-size-adjust: 100%;
					}

					/* Prevent WebKit and Windows mobile changing default text sizes */
					table,
					td {
						mso-table-lspace: 0pt;
						mso-table-rspace: 0pt;
					}

					/* Remove spacing between tables in Outlook 2007 and up */
					img {
						-ms-interpolation-mode: bicubic;
					}

					/* Allow smoother rendering of resized image in Internet Explorer */
					/* DEVICE-SPECIFIC RESET */
					a[x-apple-data-detectors] {
						color: inherit !important;
						text-decoration: none !important;
						font-size: inherit !important;
						font-family: inherit !important;
						font-weight: inherit !important;
						line-height: inherit !important;
					}

					/* iOS BLUE LINKS */
					/* RESET */
					img {
						border: 0;
						height: auto;
						line-height: 100%;
						outline: none;
						text-decoration: none;
						display: block;
					}

					table {
						border-collapse: collapse;
					}

					body {
						height: 100% !important;
						margin: 0 !important;
						padding: 0 !important;
						width: 100% !important;
					}

					/* VARIABLES */
					.textAlignLeft {
						text-align: left;
					}

					.textAlignRight {
						text-align: right;
					}

					.textAlignCenter {
						text-align: center;
					}

					.desktopHide {
						display: none;
					}

					.floatleft {
						float: left;
					}

					/* TYPOGRAPHY */
					body {
						font-family: "Asap", Helvetica, Arial, sans-serif;
						color: #1E2332;
						-webkit-font-smoothing: antialiased;
						-moz-osx-font-smoothing: grayscale;
						font-smoothing: always;
						text-rendering: optimizeLegibility;
					}

					.h1 {
						vertical-align: middle;
						font-size: 48px;
						line-height: 54px;
						font-family: Avenir, "Asap", Helvetica, sans-serif;
						color: #1E2332;
						font-weight: bold;
						font-weight: 600;
					}

					.h2 {
						vertical-align: middle;
						font-size: 24px;
						line-height: 30px;
						font-family: Avenir, "Asap", Helvetica, sans-serif;
						color: #1E2332;
						font-weight: bold;
						font-weight: 600;
					}

					.textBig {
						font-size: 20px;
						line-height: 30px;
						font-family: "Avenir", "Asap", Helvetica, sans-serif;
						font-weight: normal;
						font-weight: 400;
						color: #4B505B;
					}

					.textMedium {
						font-size: 18px;
						line-height: 27px;
						font-family: "Avenir", "Asap", Helvetica, sans-serif;
						font-weight: normal;
						font-weight: 400;
						color: #4B505B;
					}

					.textSmall {
						font-size: 16px;
						line-height: 24px;
						font-family: "Avenir", "Asap", Helvetica, sans-serif;
						font-weight: normal;
						font-weight: 400;
						color: #4B505B;
					}

					.text--bold {
						font-weight: bold;
						font-weight: 600;
					}

					.text--link {
						font-weight: normal;
						font-weight: 400;
						text-decoration: underline;
					}

					.text--linkNoUnderline {
						font-weight: normal;
						font-weight: 400;
						text-decoration: none;
					}

					/* FONT COLORS */
					.textColorDark {
						color: #1E2332;
					}

					.textColorBlue {
						color: #00A5FF;
					}

					.textColorAmber {
						color: #ffb03b;
					}

					.textColorGray {
						color: #787C84;
					}

					.textColorWhite {
						color: #FFFFFF;
					}

					/* BUTTON */
					.button {
						line-height: 1;
						color: #FFFFFF;
						padding: 0 40px;
						text-decoration: none;
						outline: none;
						border-radius: 30px;
						max-width: 300px;
						margin: 0 auto;
					}

					.button--dark {
						background: #1E2332;
					}

					.button--amber {
						background-color: #ffb03b;
					}

					.button-link {
						text-decoration: none;
					}

					.button-text {
						color: #FFFFFF;
						text-decoration: none;
						font-family: "Avenir", "Asap", Helvetica, sans-serif;
						font-size: 18px;
						line-height: 1;
						font-weight: bold;
						font-weight: 600;
						text-decoration: none;
					}

					/* LAYOUT */
					.wrapper {
						max-width: 600px;
					}

					.table--half {
						width: 50%;
						float: left;
					}

					.table--oneThird {
						width: 33.333334%;
						float: left;
					}

					.table--TwoThirds {
						width: 66.666667%;
						float: left;
					}

					/* HEADER */
					.header {
						padding: 40px 20px 0px;
						background: #ffb03b;
					}

					.header-tockLogoImage {
						display: block;
						color: #FFFFFF;
						font-size: 16px;
					}

					.header-heroImage {
						padding-bottom: 20px;
					}

					/* HERO */
					.hero {
						padding: 20px 20px 0;
						background: #ffb03b;
					}

					.hero-headline {
						padding: 20px 0 10px;
						display: block;
					}

					.hero-image--top {
						padding-top: 40px;
					}

					.hero-image--bottom {
						padding-bottom: 40px;
					}

					/* MESSAGE */
					.message {
						padding: 0 20px;
					}

					.message-text {
						padding-bottom: 10px;
					}

					/* FOOTER */
					.footer {
						padding: 80px 20px 40px;
					}

					.footer-socialLinks {
						padding-bottom: 20px;
					}

					.footer-socialLink {
						float: left;
					}

					/* PREHEADER */
					.preheader {
						display: none;
						font-size: 1px;
						color: #FFFFFF;
						line-height: 1px;
						max-height: 0px;
						max-width: 0px;
						opacity: 0;
						overflow: hidden;
					}

					/* MOBILE STYLES */
					@media screen and (max-width: 600px) {

						/* DEVICE-SPECIFIC RESET */
						div[style*="margin: 16px 0;"] {
							margin: 0 !important;
						}

						/* ANDROID CENTER FIX */
						/* VARIABLES */
						.mobileHide {
							display: none !important;
						}

						.desktopHide {
							display: table-cell !important;
						}

						.mobile-textAlignCenter {
							text-align: center !important;
						}

						/* TYPOGRAPHY */
						.h1 {
							font-size: 42px !important;
							line-height: 42px !important;
						}

						.h2 {
							font-size: 20px !important;
							line-height: 24px !important;
						}

						.textBig {
							font-size: 18px !important;
							line-height: 27px !important;
						}

						.textMedium {
							font-size: 16px !important;
							line-height: 24px !important;
						}

						.textSmall {
							font-size: 14px !important;
							line-height: 21px !important;
						}

						/* BUTTON */
						.button {
							display: block !important;
							padding-left: 0 !important;
							padding-right: 0 !important;
						}

						.mobile-buttonContainer {
							width: 100% !important;
						}

						.button-text {
							font-size: 16px !important;
						}

						/* LAYOUT */
						.wrapper {
							width: 100% !important;
							max-width: 100% !important;
						}

						.responsive-table {
							width: 100% !important;
						}

						/* HERO */
						.hero-image--top img,
						.hero-image--bottom img {
							width: 100% !important;
							height: auto !important;
						}
					}
				</style>
			</head>

			<body style="margin: 0 !important; padding: 0 !important;">
				<!-- HIDDEN PREHEADER TEXT -->
				<div class="preheader">
				&#127858; Status of your booking with Your Logo`EAT.
				</div>
				<table border="0" cellpadding="0" cellspacing="0" width="100%" class="mainTable">
					<!-- HEADER -->
					<tr>
						<td align="center" class="header">
							<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapper">
								<tr>
									
								</tr>
							</table>
						</td>
					</tr>
					<!-- HERO -->
					<tr>
						<td align="center" class="hero">
							<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapper">
								<tr>
									<td align="center" valign="top" class="hero-headline">
										<span class="h1 textColorWhite">Reservation confirmed  <br>see you soon!</span>
									</td>
								</tr>
								<tr>
									<td align="center" valign="top">
										<a href="#" target="_blank" class="button-link">
											<table border="0" cellspacing="0" cellpadding="0" class="mobile-buttonContainer">
												<tr>
													<td align="center" valign="center" width="100%" class="button button--dark">
														<table border="0" cellspacing="0" cellpadding="0" width="100%">
															<tr>
																<td style="height:18px; line-height:18px;">&nbsp;</td>
															</tr>
															<tr>
																<td align="center" valign="center">
																	<span class="button-text">Visit Your Logo`EAT</span>
																</td>
															</tr>
															<tr>
																<td style="height:18px; line-height:18px;">&nbsp;</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</a>
									</td>
								</tr>
								<tr>
									<td align="center" valign="top" class="hero-image--top">
										<img src="https://i.ibb.co/TM6rvB7/Untitled-9.png" alt="Chicago Skyline">
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<!-- MESSAGE -->
					<tr>
						<td align="center" class="message">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="wrapper">
								<tr>
									<td align="center" valign="top" class="hero-image--bottom">
										<img src="https://storage.googleapis.com/tock-public-assets/images-email-campaigns/chicago/skyline-chicago-bottom.png" width="600" height="85" alt="Chicago Skyline">
									</td>
								</tr>
								<tr>
									<td align="center" class="message-text">
										<div class="h2">Booking details</div>
										<div class="textMedium">
											Hello ' . $cname . ' ' . $r8["first_name"] . '<br>
											Your booking is confirmed by the restaurant, for the ' . date("d/m/Y", strtotime($r8["booking_date"])) . ' at ' . $r8["booking_time"] . ' <br>
											Thank you and see you soon with Your Logo`EAT !
										</div>
									</td>
								</tr>
								<tr>
									<td align="center" valign="top">
										<a href="https://www.tocktix.com/restaurants?utm_source=skyline&utm_medium=email&utm_campaign=outbound-chicago-2" target="_blank" class="button-link">
											<table border="0" cellspacing="0" cellpadding="0" class="mobile-buttonContainer">
												<tr>
													<td align="center" valign="center" width="100%" class="button button--amber">
													</td>
												</tr>
											</table>
										</a>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<!-- FOOTER -->
					<tr>
						<td align="center" class="footer">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="wrapper">
								<tr>
									<td align="center" class="footer-socialLinks">
										<table width="210" border="0" cellspacing="0" cellpadding="0" align="center">
											<tr>
												<td width="33%" align="center" class="footer-socialLink">
													<a href="#"><img src="https://storage.googleapis.com/tock-public-assets/images-email-template/icon-facebook.png" alt="Facebook" width="60" height="60" class="footer-socialLinkImage"></a>
												</td>
												<td width="33%" align="center" class="footer-socialLink">
													<a href="#"><img src="https://storage.googleapis.com/tock-public-assets/images-email-template/icon-twitter.png" alt="Twitter" width="60" height="60" class="footer-socialLinkImage"></a>
												</td>
												<td width="33%" align="center" class="footer-socialLink">
													<a href="#"><img src="https://storage.googleapis.com/tock-public-assets/images-email-template/icon-instagram.png" alt="Instagram" width="60" height="60" class="footer-socialLinkImage"></a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</body>
			</html>';
			$mail->addAddress($email, "Booking Approved");
			if ($mail->send()) {
				echo '<script>
                        swal("This reservation has been confirmed!", "An email with details and booking confirmation will be sent to the customer.", "success").then(function() {
                        window.location = "booking-list.php";});
                    </script>';
			} else {
				echo '<script>
                        swal("Info :", "Mail has not been sent.", "info").then(function() {
                        window.location = "booking-list.php";});
                    </script>';
			}
		} else {
			echo "Error: " . $sql . "<br>" . $con->error;
		}
	}
}
?>