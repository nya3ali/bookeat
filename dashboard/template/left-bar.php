<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<aside id="sidebar-left" class="sidebar-left">

	<div class="sidebar-header">
		<div class="sidebar-title">
			Navigation Menu
		</div>
		<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle" onclick="hidelogo();">
			<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<div class="nano">
		<div class="nano-content">
			<nav id="menu" class="nav-main" role="navigation">
				<ul class="nav nav-main">
					<li class="nav-active">
						<a href="accueil.php">
							<i class="fa fa-home" aria-hidden="true"></i>
							<span>Dashboard : </span><span class="name"><?php echo $_SESSION['name']; ?></span>
						</a>
					</li>
					<?php if ((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)) { ?>
						<li class="nav-parent">
							<a>
								<i class="fas fa-users" aria-hidden="true"></i>
								<span>Manage Tables </span>
							</a>
							<ul class="nav nav-children">
								<li>
									<a href="person-table-add.php">
										<span class="pull-right label label-primary">Add</span>
										<i class="fa fa-plus-square" aria-hidden="true"></i>
										<span>Add New Table</span>
									</a>
								</li>
								<li>
									<a href="person-table-list.php">
										<span class="pull-right label label-info">List</span>
										<i class="fas fa-list-ul" aria-hidden="true"></i>
										<span>List of Available Tables</span>
									</a>
								</li>
							</ul>
						</li>
					<?php } ?>
					<?php if ((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)) { ?>
						<li class="nav-parent">
							<a>
								<i class="fas fa-utensils" aria-hidden="true"></i>

								<span>Manage Menu </span>
							</a>
							<ul class="nav nav-children">
								<li>
									<a href="menu-add.php">
										<span class="pull-right label label-primary">Add</span>
										<i class="fa fa-plus-square" aria-hidden="true"></i>
										<span>Add New Product</span>
									</a>
								</li>
								<li>
									<a href="menu-list.php">
										<span class="pull-right label label-info">List</span>
										<i class="fas fa-list-ul" aria-hidden="true"></i>
										<span>Liste of Available Dishes</span>
									</a>
								</li>
							</ul>
						</li>
					<?php } ?>
					<?php if ((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)) { ?>
						<li class="nav-parent">
							<a>
								<i class="fas fa-money-check-alt" aria-hidden="true"></i>
								<span>Booking</span>
							</a>
							<ul class="nav nav-children">
								<li>
									<a href="booking-list.php">
										<span class="pull-right label label-info">List</span>
										<i class="fas fa-list-ul" aria-hidden="true"></i>
										<span>Manage Bookings</span>
									</a>
								</li>
							</ul>
						</li>
					<?php } ?>
				</ul>
			</nav>
			<hr>
			<hr class="separator" />
		</div>
	</div>
	<div class="logo-bookeat" id="logo-bookeat">
		<span class="text-1">Your Logo`eat</span>
		<span class="text-2">© 2022</span>
	</div>
</aside>

<!-- Script hide Logo -->
<script>
	function hidelogo() {
		var hidelogo = document.getElementById("logo-bookeat");
		if (hidelogo.style.display === "none") {
			hidelogo.style.display = "block";
		} else {
			hidelogo.style.display = "none";
		}
	}
</script>