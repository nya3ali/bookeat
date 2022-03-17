<!-- booking-list.php -->
<?php
include 'template/header.php';
include 'template/nav-bar.php'; 
if (!isset($_SESSION['isLoggedIn'])) {
  echo '<script>window.location="login.php"</script>';
}
?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link rel="stylesheet" href="css/css/profile.css">

<body>

  <!-- start: header -->
  
  <!-- end: header -->

  <div class="inner-wrapper" style="margin-top: 10em;">
    <!-- start: sidebar -->

    <!-- end: sidebar -->
    <section role="main" class="content-body">
      <div class="booking-form-w3layouts" style="width: 45%;">
        <header class="page-header">
          <h3 class="sub-heading-agileits">My Account</h3>
        </header>

        <!-- start: page -->
        <section>
          <?php
          include 'dbCon.php';

          $res_id = $_SESSION['id'];
          $con = connect();

          $sql = "SELECT * FROM `rc_info` where id = '$res_id';";
          $result = $con->query($sql);
          $row =  mysqli_fetch_assoc($result);

          if (isset($_POST['save'])) {
            // Create prepared statement to prevent sql injection like : anything' or 'x'='x
            $sql = $con->prepare("UPDATE `rc_info` SET `rc_name`= ?, `first_name`= ?, `email`= ?, `phone`= ?, `password`= ? WHERE `id`= ?;");
            // Bind parameters to the placeholder
            $sql->bind_param("sssisi", $_POST['fullname'], $_POST['first_name'], $_POST['email'], $_POST['phone'], $_POST['password'], $res_id);
            // Run parameters inside database res_booking
            $sql->execute();
            // Verify with If condition then display SweetAlert V2 pop-up
            if ($sql->affected_rows > 0) {
              echo include 'template/script.php';
              echo '<script>
                    swal({
                      title: "Super !",
                      text: "Your profile is now updated!",
                      icon: "success",
                      button: "ok",
                    }).then(function() {
                      window.location = "profil-user.php";
                    });
                    </script>';
            } else {
              echo include 'template/script.php';
              echo '<script>
                    swal({
                      title: "Oops !",
                      text: "A problem has occurred!",
                      icon: "warning",
                      button: "ok",
                    }).then(function() {
                      window.location = "profil-user.php";
                    });
                    </script>';
            }
          }
          ?>
          <div class="container">
            <div class="">
              <form class="form-horizontal" method="POST" action="profil-user.php">
                <div class="">
                  <h2 class="h4 mb-4 text-center" style="color: grey;">My account information</h2>
                  <div class="form-inline">
                    <div class="col mb-2 d-flex py-4" style="background: white;">
                      <div class="align-self-center">
                        <p class="mb-0"><span class="color-span-title"><i class="fas fa-user-tag fa-lg fa-fw mr-1" aria-hidden="true"></i> Last Name :</span> <input style="text-transform: capitalize;" type="text" name="fullname" class="form-control" required="" placeholder="Nom" value="<?php echo $row['rc_name']; ?>"> </p>
                      </div>
                    </div>
                    <div class="col mb-2 d-flex py-4" style="background: white;">
                      <div class="align-self-center">
                        <p class="mb-0"><span class="color-span-title"><i class="fas fa-user fa-lg fa-fw mr-1" aria-hidden="true"></i> First Name : </span> <input style="text-transform: capitalize;" type="text" name="first_name" class="form-control no-outline" required="" placeholder="Prénom" value="<?php echo $row['first_name']; ?>"></p>
                      </div>
                    </div>
                  </div>
                  <div class="form-inline">
                    <div class="col mb-2 d-flex py-4" style="background: white;">
                      <div class="align-self-center">
                        <p class="mb-0"><span class="color-span-title"><i class="fas fa-phone-square-alt fa-lg fa-fw mr-1" aria-hidden="true"></i> Phone : </span> <input type="text" name="phone" class="form-control" required="" placeholder="Télephone" value="0<?php echo $row['phone']; ?>"></p>
                      </div>
                    </div>
                    <div class="col mb-2 d-flex py-4" style="background: white;">
                      <div class="align-self-center">
                        <p class="mb-0"><span class="color-span-title"><i class="far fa-envelope fa-lg fa-fw mr-1" aria-hidden="true"></i> Mail : </span> <input type="email" name="email" class="form-control" required="" placeholder="Email" value="<?php echo $row['email']; ?>"></p>
                      </div>
                    </div>
                  </div>
                  <div class="form-inline">
                    <div class="col mb-2 d-flex py-4" style="background: white;">
                      <div class="align-self-center">
                        <p class="mb-0"><span class="color-span-title"><i class="fas fa-lock fa-lg fa-fw mr-1" aria-hidden="true"></i></i> Password : <input type="password" name="password" class="form-control" required="" placeholder="Mot de passe" value="<?php echo $row['password']; ?>"></p>
                      </div>
                    </div>
                    <div class="col mb-2 d-flex py-4 ">
                      <div class="align-self-center">
                        <div class="col-md-7">
                          <label class="col-md-4 control-label" for="CustomerContact"></label>
                          <div class="col-md-8">
                            <input id="btn-loader" type="submit" value="Sauvegarder" name="save" class="btn btn-warning">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </section>
      </div>
      <!-- end: page -->
    </section>
  </div>

  <?php include 'template/instagram.php'; ?>

  <?php include 'template/footer.php'; ?>

  <?php include 'template/bootstrap.php'; ?>

  <?php include 'template/script.php'; ?>

</body>

</html>