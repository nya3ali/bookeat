<!-- Search-header.php -->
<section>
	<div class="background-header">

	</div>
</section>

<div class="ftco-section-reservation">
	<div class="container">
		<div class="row">
			<div class="col-md-12 reservation">
				<div class="block-17">
					<!--  -->
					<form action="restaurant-list.php" method="POST" class="form-inline justify-content-center form-header">
						<div class="form-group mb-2">
							<label for="staticEmail2" class="sr-only">Email</label>
							<select name="city" class="custom-select mr-sm-2">
								<option value="Montpellier" required="">Montpellier</option>
								<option value="Nimes" disabled>Nîmes (Soon)</option>
							</select>
						</div>
						<div class="form-group mb-2">
							<label for="inputPassword2" class="sr-only">Password</label>
							<select name="area" class="custom-select mr-sm-2 populate" data-plugin-selectTwo required="">
								<option selected>Choose your Area</option>
								<?php
								$con = connect();
								$sql = "SELECT * FROM `locations`;";
								$result = $con->query($sql);
								foreach ($result as $r) {
								?>
									<option value="<?php echo $r['id']; ?>"><?php echo $r['location_name']; ?></option>
								<?php } ?>
							</select>
						</div>
						<input type="submit" class="btn btn-outline-warning mb-2 btn-header" name="find" value="Search" style="margin-left: 20px;">
					</form>
					<!--  -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END -->