<!-- select-menu.php -->
<?php
if (isset($_POST['reservation'])) {
  $res_id = $_POST['res_id'];
  $reservation_name = $_POST['reservation_name'];
  // $reservation_first_name = $_POST['reservation_first_name'];
  $reservation_phone = $_POST['reservation_phone'];
  // $reservation_mail = $_POST['reservation_email'];
  $reservation_date = $_POST['reservation_date'];
  $reservation_time = $_POST['reservation_time'];

  // $table = $_POST["table"];
  // $chair = $_POST["chair"];

  include 'template/header.php'; ?>

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

  <body>

    <?php include 'template/nav-bar.php'; ?>
    <!-- END nav -->

    <section class="home-slider owl-carousel" style="height: 400px;">
      <div class="slider-item" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center">
            <div class="col-md-10 col-sm-12 ftco-animate text-center" style="padding-bottom: 25%;">
              <p class="breadcrumbs"><span class="mr-2"><a href="accueil.php">Home</a></span> <span>Menu</span></p>
              <h1 class="mb-3">Our Exclusive Menu</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <form action="book.php" method="POST">
      <section class="ftco-section bg-light">
        <div class="container">
          <div class="row justify-content-center mb-5 pb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
              <span class="subheading">Our Menu</span>
              <h2>Discover Our Exclusive Menu</h2>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8 dish-menu">
            </div>
            <div class="col-md-4">
              <h2 class="h4 mb-4">Reservation Information</h2>
              <div class="d-flex ftco-animate">
                <div class="col-md-12 flex-column">
                  <div class="row d-block flex-row">
                    <div class="col mb-2 d-flex py-4 border" style="background: white;">
                      <div class="align-self-center">
                        <p class="mb-0"><span>Reservation Name:</span> <a href=""><?php echo $reservation_name; ?></a></p>
                      </div>
                    </div>
                    <!-- <div class="col mb-2 d-flex py-4 border" style="background: white;">
                      <div class="align-self-center">
                        <p class="mb-0"><span>Reservation Prénom:</span> <a href=""><?php echo $reservation_first_name; ?></a></p>
                      </div>
                    </div> -->
                    <div class="col mb-2 d-flex py-4 border" style="background: white;">
                      <div class="align-self-center">
                        <p class="mb-0"><span>Phone:</span> <a href=""><?php echo $reservation_phone; ?></a></p>
                      </div>
                    </div>
                    <!-- <div class="col mb-2 d-flex py-4 border" style="background: white;">
                      <div class="align-self-center">
                        <p class="mb-0"><span>Mail:</span> <a href=""><?php echo $reservation_mail; ?></a></p>
                      </div>
                    </div> -->
                    <div class="col mb-2 d-flex py-4 border" style="background: white;">
                      <div class="align-self-center">
                        <p class="mb-0"><span>Reservation Date:</span> <a href=""><?php echo $reservation_date; ?></a></p>
                      </div>
                    </div>
                    <div class="col mb-2 d-flex py-4 border" style="background: white;">
                      <div class="align-self-center">
                        <p class="mb-0"><span>Reservation Time:</span> <a href=""><?php echo $reservation_time; ?></a></p>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12" style="text-align: center;">
              <input type="hidden" name="res_id" value="<?php echo $res_id; ?>">
              <input type="hidden" name="reservation_name" value="<?php echo $reservation_name; ?>">
              <!-- <input type="hidden" name="reservation_first_name" value="<?php echo $reservation_first_name; ?>"> -->
              <input type="hidden" name="reservation_phone" value="<?php echo $reservation_phone; ?>">
              <!-- <input type="hidden" name="reservation_email" value="<?php echo $reservation_mail; ?>"> -->
              <input type="hidden" name="reservation_date" value="<?php echo $reservation_date; ?>">
              <input type="hidden" name="reservation_time" value="<?php echo $reservation_time; ?>">
              
              <p id="confirm"><input type="submit" value="Confirm" name="confirm" class="btn btn-primary py-3 px-5"></p>

            </div>
          </div>
        </div>
      </section>
    </form>



    <?php include 'template/instagram.php'; ?>

    <?php include 'template/footer.php'; ?>

    <?php include 'template/script.php'; ?>

  </body>

  </html>
<?php } ?>

<script type="text/javascript">
  $(document).ready(function() {
    $('input[type="checkbox"]').click(function() {
      // alert($('.menu:checked').length);

      var btnconfirm = document.getElementById("confirm");
      var maxchecked = $('.menu:checked').length;
      // alert(maxchecked) 
      if (maxchecked > 0) {
        btnconfirm.style.display = "block";
      } else {
        btnconfirm.style.display = "none";
      }


    });
  });
</script>