<?php

$result = $con->query($sql);
foreach ($result as $r) {
?>
	<li>
		<div class="img-box v-append-recommend_time v-lazyload-ele-yes">
			<div class="needflow">
				<a href="reservation.php?res_id=<?php echo $r['id']; ?>">
					<img class="lazyload zoom" src="dashboard/user-image/<?php echo $r['logo']; ?>" />
				</a>
				<div class="overlay"></div>
				<p class="name"><?php echo $r['rc_name']; ?></p>
			</div>
			<div class="icon-box mobilenoshow"></div>
			<p class="detail-p">Book-3x | Unlock -10% </p>
			<div class="time-box">
				<span></span>
				<p><?php echo date('H:i', strtotime($r['opening_res'])); ?> h - <?php echo date('H:i', strtotime($r['closing_res'])); ?> h </p>
				<?php
				if ($r['full_service'] == 1) {
					echo '<p style="margin-left: 1rem;">&nbsp;<i class="fas fa-check" required style="color: rgb(63, 153, 63);"></i> Full Time Service.</p>';
				} else {
					echo '<p style="margin-left: 1rem;">&nbsp;<i class="fas fa-times fa-lg" style="color: rgb(241, 75, 75);"></i> No Full Time Service.</p>';
				}
				?>
				<div class="clear"></div>
			</div>
		</div>
	</li>

<?php } ?>