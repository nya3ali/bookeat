<!-- nav-bar.php -->
<?php include 'template/script.php'; ?>
<nav class="fixed-top navbar navbar-expand-lg navbar-light ftco_navbar bg-light ftco-navbar-light" id="ftco-navbar">
	<button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="oi oi-menu"></span> Menu
	</button>

	<div class="collapse navbar-collapse" id="ftco-nav">
		<!-- <div class="circle"> Book'eat </div> -->
		<ul class="ul">
			<li class="ul">
				<div class="logo-holder logo-5">
					<a href="accueil.php">
						<h3>Your Logo`eat</h3>
						<p class="p" style="font-style: normal; font-weight: 100; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Your booking site</p>
					</a>
				</div>
			</li>
		</ul>

		<ul class="navbar-nav ml-auto">
			<li class="nav-item active"><a href="accueil.php" class="nav-link">Home</a></li>
			<?php if (!isset($_SESSION['isLoggedIn'])) { ?>
				<li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>
				<li class="nav-item"><a href="login.php" class="nav-link">Log in</a></li>
			<?php } elseif (isset($_SESSION['isLoggedIn'])) { ?>
				<li class="nav-item dropdown">
					<a style="color: #ffb03b !important;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Hello <span style="text-transform: capitalize;"><?php echo $_SESSION['name']; ?> <?php echo $_SESSION['first_name']; ?></span>
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="profil-user.php" class="nav-link"><i class="far fa-user-circle"></i> My Profile</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Log out</a>
					</div>
				</li>
			<?php } ?>
		</ul>
	</div>
</nav>