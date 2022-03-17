<!-- choose-table.php -->
<?php

if (isset($_POST['reservation'])) {


  $res_id = $_POST['res_id'];
  $reservation_name = $_POST['reservation_name'];
  $reservation_firstname = $_POST['reservation_firstname'];
  $reservation_phone = $_POST['reservation_phone'];
  $reservation_email = $_POST['reservation_email'];
  $reservation_date = $_POST['reservation_date'];
  $reservation_time = $_POST['reservation_time'];

  include 'template/header.php';

?>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="css/css/card.css">

  <body>
    <?php
    include 'template/nav-bar.php';
    ?>
    <!-- END nav -->

    <section class="ftco-section" style="margin-top: 10em;">
      <div class="container">
        <div class="booking-form-w3layouts">
          <!-- Form starts here -->
          <form action="book.php" method="POST">
            <div class="row">
              <h2 class="sub-heading-agileits">Availability</h2>
              <div class="col-md-12 dish-menu">
                <?php
                echo "<br>";
                echo "From : " . date("d/m/Y", strtotime($reservation_date));
                echo "<br>";
                echo " To : " . $reservation_time;
                ?>
                <div class="tab-content py-5" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="row">
                      <?php
                      include 'dbCon.php';
                      $con = connect();
                      $location = $_POST['res_id'];
                      $sql = "SELECT `id`, `person_num` FROM `restaurant_tables` WHERE res_id = $location;";
                      $result = $con->query($sql);
                      foreach ($result as $r) {
                        $table_id = $r['id'];
                      ?>
                        <div class="col-lg-3" style="min-height: 190px">
                          <p class="text-center" style="font-weight: bold; color: grey;">Table of <?php echo @$i += 1 ?> pers</p>
                          <nav class="menu2">
                            <ul style="list-style-type: none;">
                              <?php
                              $sql2 = "SELECT * FROM `restaurant_personne` WHERE tbl_id = '$table_id';";
                              $result2 = $con->query($sql2);
                              foreach ($result2 as $r2) {
                                $c_id = $r2['id'];
                                $booked = false;
                                $cbbook = "SELECT bt.id,bt.booking_id,bt.table_id,bt.table_no,bd.booking_id,bd.res_id,bd.booking_date,bd.booking_time
                                  FROM booking_table as bt, booking_details as bd
                                  WHERE bt.booking_id = bd.booking_id
                                  AND bd.res_id = '$res_id'
                                  AND bd.booking_date = '$reservation_date'
                                  AND bd.booking_time ='$reservation_time'
                                  AND bt.table_id = '$c_id';";
                                $cbbookresult = $con->query($cbbook);
                                if ($cbbookresult->num_rows > 0) {
                                  $booked = true;
                                  echo '<input type="radio" name="disa" class="" id="disabled" disabled>
                                  <label for="disabled" class="border-input disabled-input">Unavailable Sorry</label>';
                                }
                                if ($booked == true) {
                              ?>
                                  <li class="menu-item2">
                                    <input type="radio" disabled="">
                                  </li>
                                <?php } else { ?>
                                  <td>
                                    <li>
                                      <input type="radio" name="chair[]" class="chair radio-custom-label" id="<?php echo $r2['id']; ?>" value="<?php echo $r2['id']; ?>">
                                      <label for="<?php echo $r2['id']; ?>">
                                        <h3 id="h3">Available</h3>
                                      </label>
                                    </li>
                                  </td>
                                <?php } ?>
                              <?php } ?>
                            </ul>
                          </nav>
                        </div>
                      <?php } ?>
                      <div class="col-lg-12" style="margin-top: 5%;text-align: center;">
                        <div class="form-group">
                          <input type="hidden" name="res_id" value="<?php echo $res_id; ?>">
                          <input type="hidden" name="reservation_name" value="<?php echo $reservation_name; ?>">
                          <input type="hidden" name="reservation_firstname" value="<?php echo $reservation_firstname; ?>">
                          <input type="hidden" name="reservation_phone" value="<?php echo $reservation_phone; ?>">
                          <input type="hidden" name="reservation_email" value="<?php echo $reservation_email; ?>">
                          <input type="hidden" name="reservation_date" value="<?php echo $reservation_date; ?>">
                          <input type="hidden" name="reservation_time" value="<?php echo $reservation_time; ?>">
                          <p style="display:none;text-align: center;" id="viewMenu">
                            <input type="submit" value="Confirm" name="selectChair" class="btn btn-warning">
                          </p>
                        </div>
                      </div>
                    </div><!-- END -->
                  </div>
                </div>
              </div>
          </form>
          <small class="text-center" style="color: grey;">*If you would like a table for a group of more than 8 people, please contact the restaurant directly.</small>
        </div>
      </div>
    </section>

    <?php include 'template/instagram.php'; ?>

    <?php include 'template/footer.php'; ?>

    <?php include 'template/bootstrap.php'; ?>

    <?php include 'template/script.php'; ?>

  </body>

  </html>
<?php } else {
}
?>

<script type="text/javascript">
  $(document).ready(function() {
    $('input[type="radio"]').click(function() {
      // alert($('.menu:checked').length);

      var btnmenu = document.getElementById("viewMenu");
      var maxchecked = $('.chair:checked').length;
      // alert(maxchecked)
      if (maxchecked > 0) {
        btnmenu.style.display = "block";
      } else {
        btnmenu.style.display = "none";
      }
    });
  });
</script>