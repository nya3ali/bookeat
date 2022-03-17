<!-- reservation.php -->
<?php include 'template/header.php';

include 'dbCon.php';
if (!isset($_SESSION['isLoggedIn'])) {
  // echo '<script>alert("You need to login first.")</script>';
  // echo '<script>window.location="login.php"</script>';
  echo include 'dashboard/template/alert.php';
  echo '<script>
                    swal({
                        title: "Warning !",
                        text: "You must be logged in to book",
                        icon: "warning",
                        button: "ok",
                    }).then(function() {
                        window.location = "login.php";
                    });
                    </script>';
}
?>

<body>
  <?php include 'template/script.php'; ?>

  <?php include 'template/nav-bar.php'; ?>
  <?php include 'template/search-header.php'; ?>
  <!-- END nav -->

  <section class="ftco-section bg-light">
    <div class="container">
      <div class="row no-gutters justify-content-center mb-2 pb-2">
        <div class="col-md-7 text-center heading-section ftco-animate">
          <div class="header-h  mt-4">Booking details and Menu offers.</div>
        </div>
      </div>
      <div class="row d-flex">
        <div class="col-md-4 ftco-animate img">

          <div class="col-md-12 col-sm-4 mr-15">
            <?php
            $res_id = $_GET['res_id'];
            $con = connect();
            $sql = "SELECT * FROM `rc_info` WHERE id = $res_id;";
            $result = $con->query($sql);
            foreach ($result as $r) {
            ?>

              <div class="media-2">
                <div class="media-body">
                  <p>
                  <h5 class="light-blue regular alt-p rest-name"> <?php echo $r['rc_name']; ?></h5>
                  </p>
                </div>
              </div>

              <div class="media-2">
                <div class="media-body">
                  <p>
                    <?php echo '<img src="dashboard/user-image/' . $r['logo'] . '" alt="logo" style="background-size: cover; background-repeat: no-repeat; height: auto; max-width: 250px;border-radius: 10px; border: 2px solid #ffba3b;">' ?>
                  </p>
                </div>
              </div>

              <div class="media-2">
                <div class="media-body">
                  <p>
                    <span style="color: grey;"><i class="fas fa-store"></i></span>
                    <span class="light-blue regular alt-p"> <a class="link-web" target="_blank" href="<?php echo $r['website']; ?>">Web site</a></span>
                  </p>
                </div>
              </div>

              <div class="media-2">
                <div class="media-body">
                  <p>
                    <span style="color: grey;" class="phone-in-talk fa fa-phone"></span>
                    <span class="light-blue regular alt-p">0<?php echo $r['phone']; ?></span>
                  </p>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>

        <div class="col-md-8 ftco-animate makereservation bg-light mt-3">
          <form action="choose-table.php" method="POST">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Last Name</label>
                  <input type="text" name="reservation_name" class="form-control" placeholder="Last Name" required="" value="<?php echo $_SESSION['name']; ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">First Name</label>
                  <input type="text" name="reservation_firstname" class="form-control" placeholder="First Name" required="" value="<?php echo $_SESSION['first_name']; ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Phone</label>
                  <input type="text" name="reservation_phone" class="form-control" placeholder="Phone" required="" value="0<?php echo $_SESSION['phone']; ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">E-Mail</label>
                  <input type="email" name="reservation_email" class="form-control" placeholder="Mail" required="" value="<?php echo $_SESSION['email']; ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Day</label>
                  <input id="datepicker1" type="date" name="reservation_date" class="form-control" placeholder="Date" required="">
                </div>
                
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Hour</label>
                  <select type="time" name="reservation_time" class="form-control" placeholder="Heure" id="time" required="">
                    <option value=""> -Select- </option>
                    <option value="10:00 h">08:00</option>
                    <option value="10:00 h">08:30</option>
                    <option value="10:00 h">09:00</option>
                    <option value="10:00 h">09:30</option>
                    <option value="10:00 h">10:00</option>
                    <option value="10:30 h">10:30</option>
                    <option value="11:00 h">11:00</option>
                    <option value="11:30 h">11:30</option>
                    <option value="12:00 h">12:00</option>
                    <option value="12:30 h">12:30</option>
                    <option value="13:00 h">13:00</option>
                    <option value="13:30 h">13:30</option>
                    <option value="14:00 h">14:00</option>
                    <option value="14:30 h">14:30</option>
                    <option value="15:00 h">15:00</option>
                    <option value="15:30 h">15:30</option>
                    <option value="16:00 h">16:00</option>
                    <option value="16:30 h">16:30</option>
                    <option value="17:00 h">17:00</option>
                    <option value="17:30 h">17:30</option>
                    <option value="18:00 h">18:00</option>
                    <option value="18:30 h">18:30</option>
                    <option value="19:00 h">19:00</option>
                    <option value="19:30 h">19:30</option>
                    <option value="20:00 h">20:00</option>
                    <option value="20:30 h">20:30</option>
                    <option value="21:00 h">21:00</option>
                    <option value="21:30 h">21:30</option>
                    <option value="22:00 h">22:00</option>
                    <option value="22:30 h">22:30</option>
                    <option value="23:00 h">23:00</option>
                    <option value="23:30 h">23:30</option>
                    <option value="00:00 h">00:00</option>
                    <option value="00:30 h">00:30</option>
                    <option value="01:00 h">01:00</option>
                    <option value="01:30 h">01:30</option>
                  </select>
                  <div class="validation"></div>
                </div>
              </div>

              <div class="col-md-12 mt-3">
                <div class="form-group text-center">
                  <input type="hidden" name="res_id" value="<?php echo $_GET['res_id']; ?>">
                  <input type="submit" name="reservation" value="Next" class="btn btn-sm" style="background-color: #ffba3b !important; color: white;">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!--! ----- -->
  <section id="menu-list" class="section-padding">
    <div class="container">
      <div class="row justify-content-md-center">
        <form action="book.php" method="POST">
          <div class="col-md-12 text-center marb-35">
            <div class="header-h">Menu</div>
            <p class="header-p">Here you will find the list of all our products,
              <br>our menu is often updated.
            </p>

          </div>
          <div class="col-md-12 text-center" id="menu-filters">
            <ul>
              <li><a class="filter active" data-filter=".menu-restaurant">See all</a></li>
              <li><a class="filter " data-filter=".menu">Menu</a></li>
              <li><a class="filter " data-filter=".entree">Entree</a></li>
              <li><a class="filter " data-filter=".dish">Dish</a></li>
              <li><a class="filter" data-filter=".sidedish">Side Dish</a></li>
              <li><a class="filter" data-filter=".dessert">Dessert</a></li>
              <li><a class="filter" data-filter=".drinks">Drinks</a></li>
            </ul>
          </div>

          <div id="menu-wrapper">
            <div class="container-fluid">
              <div class="container">
                <?php
                $res_id = $_GET['res_id'];
                $con = connect();
                $sql = "SELECT * FROM `menu_item` WHERE res_id = $res_id AND food_type = 'Menu';";
                $result = $con->query($sql);
                foreach ($result as $r) {
                ?>
                  <div class="menu menu-restaurant">
                    <span class="clearfix">
                      <h6 class="menu-title"><?php echo $r['item_name']; ?></h6>
                      <span style="left:166px;right:44px;" class="menu-line"></span>
                      <span class="menu-price"><?php echo $r['price']; ?> € </span>
                    </span>
                    <span class="menu-subtitle"><?php echo $r['item_desc']; ?></span>
                  </div>
                <?php } ?>
              </div>

              <div class="container">
                <?php
                $res_id = $_GET['res_id'];
                $con = connect();
                $sql = "SELECT * FROM `menu_item` WHERE res_id = $res_id AND food_type = 'Entree';";
                $result = $con->query($sql);
                foreach ($result as $r) {
                ?>
                  <div class="entree menu-restaurant">
                    <span class="clearfix">
                      <h6 class="menu-title"><?php echo $r['item_name']; ?></h6>
                      <span style="left:166px;right:44px;" class="menu-line"></span>
                      <span class="menu-price"><?php echo $r['price']; ?> € </span>
                    </span>
                    <span class="menu-subtitle"><?php echo $r['item_desc']; ?></span>
                  </div>
                <?php } ?>
              </div>

              <div class="container">
                <?php
                $res_id = $_GET['res_id'];
                $con = connect();
                $sql = "SELECT * FROM `menu_item` WHERE res_id = $res_id AND food_type = 'Dish';";
                $result = $con->query($sql);
                foreach ($result as $r) {
                ?>
                  <div class="dish menu-restaurant">
                    <span class="clearfix">
                      <h6 class="menu-title"><?php echo $r['item_name']; ?></h6>
                      <span style="left:166px;right:44px;" class="menu-line"></span>
                      <span class="menu-price"><?php echo $r['price']; ?> € </span>
                    </span>
                    <span class="menu-subtitle"><?php echo $r['item_desc']; ?></span>
                  </div>
                <?php } ?>
              </div>

              <div class="container">
                <?php
                $res_id = $_GET['res_id'];
                $con = connect();
                $sql = "SELECT * FROM `menu_item` WHERE res_id = $res_id AND food_type = 'SideDish';";
                $result = $con->query($sql);
                foreach ($result as $r) {
                ?>
                  <div class="sidedish menu-restaurant">
                    <span class="clearfix">
                      <h6 class="menu-title"><?php echo $r['item_name']; ?></h6>
                      <span style="left:166px;right:44px;" class="menu-line"></span>
                      <span class="menu-price"><?php echo $r['price']; ?> € </span>
                    </span>
                    <span class="menu-subtitle"><?php echo $r['item_desc']; ?></span>
                  </div>
                <?php } ?>
              </div>

              <div class="container">
                <?php
                $res_id = $_GET['res_id'];
                $con = connect();
                $sql = "SELECT * FROM `menu_item` WHERE res_id = $res_id AND food_type = 'Dessert';";
                $result = $con->query($sql);
                foreach ($result as $r) {
                ?>
                  <div class="dessert menu-restaurant">
                    <span class="clearfix">
                      <h6 class="menu-title"><?php echo $r['item_name']; ?></h6>
                      <span style="left:166px;right:44px;" class="menu-line"></span>
                      <span class="menu-price"><?php echo $r['price']; ?> € </span>
                    </span>
                    <span class="menu-subtitle"><?php echo $r['item_desc']; ?></span>
                  </div>
                <?php } ?>
              </div>

              <div class="container">
                <?php
                $res_id = $_GET['res_id'];
                $con = connect();
                $sql = "SELECT * FROM `menu_item` WHERE res_id = $res_id AND food_type = 'Drinks';";
                $result = $con->query($sql);
                foreach ($result as $r) {
                ?>
                  <div class="drinks menu-restaurant">
                    <span class="clearfix">
                      <h6 class="menu-title"><?php echo $r['item_name']; ?></h6>
                      <span style="left:166px;right:44px;" class="menu-line"></span>
                      <span class="menu-price"><?php echo $r['price']; ?> € </span>
                    </span>
                    <span class="menu-subtitle"><?php echo $r['item_desc']; ?></span>
                  </div>
                <?php } ?>
              </div>
        </form>
      </div>
    </div>
  </section>
  <hr>
  <!--  -->

  <?php include 'template/instagram.php'; ?>

  <?php include 'template/footer.php'; ?>

  <?php include 'js/customJs/menu-list.php'; ?>

  <?php include 'template/script.php'; ?>
  
  <!--  -->

  <!-- Datepicker disable before current date -->
  <script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("reservation_date")[0].setAttribute('min', today);
  </script>
</body>

</html>