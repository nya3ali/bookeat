<!-- manage-insert.php -->

<body>
    <?php include 'template/alert.php'; ?>
</body>

<?php
session_start();
include_once 'dbCon.php';
$con = connect();

//add table
if (isset($_POST['addtable'])) {
    $tablename = $_POST['tablename'];
    $res_id = $_SESSION['id'];
    $iquery = "INSERT INTO `restaurant_tables`( `res_id`, `person_num`) 
            VALUES ('$res_id','$tablename');";
    if ($con->query($iquery) === TRUE) {
        echo '<script>
                    swal({
                        title: false,
                        text: "Added successfully!",
                        icon: "success",
                        button: "ok",
                    }).then(function() {
                        window.location = "person-table-add.php";
                    });
                    </script>';
    } else {
        echo "Error: " . $iquery . "<br>" . $con->error;
    }
}

if (isset($_POST['addItem'])) {
    $itemname = $_POST['itemname'];
    $itemdesc = $_POST['itemdesc'];
    $price = $_POST['price'];
    $food_type = $_POST['food_type'];

    $res_id = $_SESSION['id'];

    $checkSQL = "SELECT * FROM `menu_item` WHERE res_id = '$res_id' and item_name = '$itemname' and item_desc = '$itemdesc' and price = '$price';";
    $checkresult = $con->query($checkSQL);
    if ($checkresult->num_rows > 0) {
        echo '<script>
                swal("Erreur !", "A product already exists under this name!", "error").then(function() {
                window.location = "menu-add.php";});
            </script>';
    } else {

        if (isset($_FILES['image'])) {
            // files handle
            $targetDirectory = "item-image/";
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

            if ($extension == "jpg" || $extension == "png" || $extension == "jpeg") {
                move_uploaded_file($file_tmp, $targetDirectory . $file_name);
                $iquery = "INSERT INTO `menu_item`( `res_id`, `item_name`, `item_desc`, `food_type`, `price`, `image`) 
                            VALUES ('$res_id','$itemname','$itemdesc','$food_type','$price','$file_name');";
                if ($con->query($iquery) === TRUE) {
                    echo '<script>
                    swal({
                        title: false,
                        text: "Added successfully!",
                        icon: "success",
                        button: "ok",
                    }).then(function() {
                        window.location = "menu-add.php";
                    });
                    </script>';
                } else {
                    echo "Error: " . $iquery . "<br>" . $con->error;
                }
            } else {
                echo '<script>
                        swal("Info :", "Only JPG,PNG,GIF files in the field, please.", "info").then(function() {
                        window.location = "menu-add.php";});
                    </script>';
            }
        }
    }
}
?>
