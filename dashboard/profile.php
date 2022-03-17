<!-- booking-list.php -->
<?php
include 'template/header.php';
if (!isset($_SESSION['isLoggedIn'])) {
  echo '<script>window.location="login.php"</script>';
}

?>

<body>
  <?php include 'template/alert.php'; ?>
  <!-- start: header -->
  <?php include 'template/top-bar.php'; ?>
  <!-- end: header -->
  <div class="inner-wrapper">
    <!-- start: sidebar -->
    <?php include 'template/left-bar.php'; ?>
    <!-- end: sidebar -->
    <section role="main" class="content-body">
      <header class="page-header">
        <h2>My account</h2>
        <div class="right-wrapper pull-right">
          <ol class="breadcrumbs">
            <li>
              <a href="accueil.php">
                <i class="fa fa-home"></i>
              </a>
            </li>
            <li><span>My account</span></li>
          </ol>
          <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
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

          $sql = $con->prepare("UPDATE `rc_info` SET `rc_name`= ?, `category`= ?, `email`= ?, `website`= ?, `phone`= ?, `address`= ?, `location`= ?, `password`= ? WHERE `id`= ?;");
          $sql->bind_param("sissisisi", $_POST['fullname'], $_POST['category'], $_POST['email'], $_POST['website'], $_POST['phone'], $_POST['address'], $_POST['area'], $_POST['password'], $res_id);

          $sql->execute();

          if ($sql->affected_rows > 0) {
            echo include 'template/script-res.php';
            echo '<script>
                    swal({
                      title: "Super !",
                      text: "Your profile is now updated!",
                      icon: "success",
                      button: "ok",
                    }).then(function() {
                      window.location = "profile.php";
                    });
                    </script>';
          }  else {
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
        
        if (isset($_POST['savephoto'])) {
          $targetDirectory = "user-image/";
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
            $sql = "UPDATE `rc_info` SET `logo`='" . $file_name . "' WHERE `id`='$res_id'";
            if ($con->query($sql) === TRUE) {
              echo '<script>
                    swal({
                      title: "Super !",
                      text: "The image has been successfully updated!",
                      icon: "success",
                      button: "ok",
                    }).then(function() {
                      window.location.href ="profile.php";
                    });
                    </script>';
            } else {
              echo "Error: " . $sql . "<br>" . $con->error;
            }
          } else {
            echo '<script>
                    swal({
                      title: "Warning!",
                      text: "Only JPG, PNG, GIF extensions are accepted!",
                      icon: "error",
                      button: "ok",
                    }).then(function() {
                      window.location.href ="profile.php";
                    });
                    </script>';
          }
        }
        ?>
        <div class="contanier">
          <div class="row">
            <div class="col-lg-3">
              <!--left col-->
              <div class="panel panel-default">
                <div class="panel-body">
                  <div id="image-container " class="stretch">
                    <img class="img-profile" style="height: 250px;width: 250px;border-radius: 10px; border: 2px solid #ffba3b;" title="profile image" data-target="#logomodal" data-toggle="modal" src="<?php echo 'user-image/' . $row['logo']; ?>">
                  </div>
                </div>
                <ul class="list-group">
                  <li class="list-group-item text-muted" style="text-align: center;">Profil Restaurant</li>
                  <li class="list-group-item text-right"><span class="pull-left"><strong>Restaurant</strong></span>
                    <?php echo '<div style="text-transform: capitalize;">' . $row['rc_name'] . '</div>'; ?>
                  </li>
                  <li class="list-group-item text-right"><span class="pull-left"><strong>Siret</strong></span>
                    <?php echo '<div style="text-transform: capitalize;">' . $row['siret'] . '</div>'; ?>
                  </li>
                  <li class="list-group-item text-right"><span class="pull-left"><strong>Open / Close</strong></span>
                    <?php
                    $id = $_SESSION['id'];
                    $con = connect();
                    $sql = "SELECT `opening_res` FROM `rc_info` WHERE id = $id;";
                    $result = $con->query($sql);
                    foreach ($result as $r) {
                    ?>
                      <div class="text-right" style="color: rgb(63, 153, 63); font-weight: 600;" class="opening">De :<?php echo date('H:i', strtotime($r['opening_res'])); ?> h</div>
                    <?php
                    }
                    ?>
                    <?php
                    $id = $_SESSION['id'];
                    $con = connect();
                    $sql = "SELECT `closing_res` FROM `rc_info` WHERE id = $id;";
                    $result = $con->query($sql);
                    foreach ($result as $r) {
                    ?>
                      <div style="color: rgb(63, 153, 63); font-weight: 600;" class="opening">à : <?php echo date('H:i', strtotime($r['closing_res'])); ?> h</div>
                    <?php
                    }
                    ?>
                  </li>
                </ul>
                <!-- /.box -->
              </div>
            </div>
            <div class="col-lg-9">
              <form class="form-horizontal" method="POST" action="profile.php">
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-7">
                      <label class="col-md-4 control-label" for="Fname">Restaurant Name :</label>
                      <div class="col-md-8">
                        <input type="text" name="fullname" class="form-control" required="" placeholder="Name" value="<?php echo $row['rc_name']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-7">
                      <label class="col-md-4 control-label" for="Lname">E-mail :</label>
                      <div class="col-md-8">
                        <input type="email" name="email" class="form-control" required="" placeholder="Email" value="<?php echo $row['email']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-7">
                      <label class="col-md-4 control-label" for="Lname">WebSite :</label>
                      <div class="col-md-8">
                        <input type="text" name="website" class="form-control" placeholder="Website" value="<?php echo $row['website']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-7">
                      <label class="col-md-4 control-label" for="Mname">Phone :</label>
                      <div class="col-md-8">
                        <input type="text" name="phone" class="form-control" required="" minlength="10" maxlength="10" placeholder="Phone" value="<?php echo '0' . $row['phone']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-7">
                      <label class="col-md-4 control-label" for="CustomerAddress">Category :</label>
                      <div class="col-md-8">
                        <select data-plugin-selectTwo class="form-control" name="category" required="">
                          <option value=""> -Select Category- </option>
                          <?php
                          $sql = "SELECT * FROM `categories`;";
                          $result = $con->query($sql);
                          foreach ($result as $r) {
                            if ($row['category'] == $r['id']) {
                              echo  '<option SELECTED value="' . $r['id'] . '">' . $r['category_name'] . '</option>';
                            } else {
                              echo  '<option value="' . $r['id'] . '">' . $r['category_name'] . '</option>';
                            }
                          } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-7">
                      <label class="col-md-4 control-label" for="CustomerAddress">Area :</label>
                      <div class="col-md-8">
                        <select data-plugin-selectTwo class="form-control " name="area" required="">
                          <option value=""> -Select Area- </option>
                          <?php
                          $sql = "SELECT * FROM `locations`;";
                          $result = $con->query($sql);
                          foreach ($result as $r) {
                            if ($row['location'] == $r['id']) {
                              echo  '<option SELECTED value="' . $r['id'] . '">' . $r['location_name'] . '</option>';
                            } else {
                              echo  '<option value="' . $r['id'] . '">' . $r['location_name'] . '</option>';
                            }
                          } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-7">
                      <label class="col-md-4 control-label" for="Gender">Address :</label>
                      <div class="col-md-8">
                        <textarea name="address" id="" cols="30" rows="2" class="form-control" placeholder="Address"><?php echo $row['address']; ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-7">
                      <label class="col-md-4 control-label" for="CustomerContact">Hours :</label>
                      <div class="col-md-4">
                        <?php
                        if (isset($_POST['save'])) {
                          $id = $_SESSION['id'];
                          $time = $_POST['opening_res'];
                          $sql2 = "INSERT INTO `rc_info` (`id`, `opening_res`) VALUES ('$id', '$time') ON DUPLICATE KEY UPDATE id = $id, opening_res = '$time'";
                          $result2 = $con->query($sql2);
                        }
                        ?>
                        <label for="opening_res">Openning :</label>
                        <?php
                        $id = $_SESSION['id'];
                        $con = connect();
                        $sql = "SELECT `opening_res` FROM `rc_info` WHERE id = $id;";
                        $result = $con->query($sql);
                        foreach ($result as $r) {
                        ?>
                          <input type="time" id="opening_res" name="opening_res" min="04:00" max="03:00" value="<?php echo date('H:i', strtotime($r['opening_res'])); ?>">
                        <?php
                        }
                        ?>
                      </div>
                      <div class="col-md-4">
                        <?php
                        if (isset($_POST['save'])) {
                          $id = $_SESSION['id'];
                          $time = $_POST['closing_res'];
                          $sql2 = "INSERT INTO `rc_info` (`id`, `closing_res`) VALUES ('$id', '$time') ON DUPLICATE KEY UPDATE id = $id, closing_res = '$time'";
                          $result2 = $con->query($sql2);
                        }
                        ?>
                        <label for="closing_res">Close :</label>
                        <?php
                        $id = $_SESSION['id'];
                        $con = connect();
                        $sql = "SELECT `closing_res` FROM `rc_info` WHERE id = $id;";
                        $result = $con->query($sql);
                        foreach ($result as $r) {
                        ?>
                          <input type="time" id="closing_res" name="closing_res" min="04:00" max="03:00" value="<?php echo date('H:i', strtotime($r['closing_res'])); ?>">
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                  <!--  -->
                  <div class="form-group">
                    <div class="col-md-7">
                      <label class="col-md-4 control-label" for="CustomerContact">Password :</label>
                      <div class="col-md-8">
                        <input type="password" name="password" class="form-control" required="" placeholder="Password" value="<?php echo $row['password']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-7">
                      <label class="col-md-4 control-label" for="CustomerContact"></label>
                      <div class="col-md-8">
                        <input id="btn-loader" type="submit" value="Save" name="save" class="btn btn-warning btn-sm py-3 px-5">
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!--/col-sm-9-->
          </div>
          <!--/row-->
        </div>
        <!--/contanier-->
      </section>
      <!-- end: page -->
    </section>
  </div>

  <?php include 'template/right-bar.php'; ?>

  <?php include 'template/script-res.php'; ?>
</body>

</html>

<div class="modal fade" id="logomodal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" type="button">x</button>
        <h4 class="modal-title" id="myModalLabel">Image or/ Logo.</h4>
      </div>
      <form action="profile.php" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div class="rows">
              <div class="col-md-12">
                <div class="rows">
                  <div class="col-md-8">
                    <input class="mealid" type="hidden" name="mealid" id="mealid" value="">
                    <input name="MAX_FILE_SIZE" type="hidden" value="1000000">
                    <input id="image" name="image" type="file">
                  </div>
                  <div class="col-md-4"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
          <button class="btn btn-primary" name="savephoto" type="submit">Send Image</button>
        </div>
      </form>
    </div><!-- /.modal-content-->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->