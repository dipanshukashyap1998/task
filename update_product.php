<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:login.php');
}
error_reporting(0);
include 'database.php';
$id = $_GET['id'];
if (isset($_POST['update'])) {
    $product_name = $_POST['pname'];
    $product_price = $_POST['pprice'];
    $product_detail = $_POST['pdetail'];

    if (file_exists($_FILES['pimage']['tmp_name']) && is_uploaded_file($_FILES['pimage']['tmp_name'])) {
        $file_name = $_FILES['pimage']['name'];
        $file_size = $_FILES['pimage']['size'];
        $file_tmp  = $_FILES['pimage']['tmp_name'];
        $file_type = $_FILES['pimage']['type'];
        $file_error = $_FILES['pimage']['error'];
        $folder = "uploads/";

        if ($file_error === 0) {
            if ($file_size > 200000) {
                $error = "Sorry your file is too large";
            } else {
                $fileext = explode('.', $file_name);
                $filecheck = strtolower(end($fileext));
                $allowedext = array("jpg", "jpeg", "png");

                if (in_array($filecheck, $allowedext)) {
                    if (move_uploaded_file($file_tmp, $folder . $file_name)) {
                        echo "Photo successfully uploaded";
                    } else {
                        echo "Photo could not be uploaded";
                    }
                } else {
                    $errors .= "<li>extension must be of .jpg, .jpeg, .png</li>";
                }
            }
        }

        $query = "UPDATE product SET product_name='$product_name',product_price='$product_price',product_detail='$product_detail',product_image='$file_name' where product_id=$id";
    } else {
        $query = "UPDATE product SET product_name='$product_name',product_price='$product_price',product_detail='$product_detail' where product_id=$id";
    }
    $result = mysqli_query($conn, $query);
    if ($result) {
        header('location:homepage.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mt-5">
                        <h1 class="text-center">PRODUCT UPDATION</h1>
                    </div>
                    <?php
                    $query = "SELECT * from product where product_id=$id";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $prod_name = $row['product_name'];
                            $prod_price = $row['product_price'];
                            $prod_detail = $row['product_detail'];
                            $prod_image = $row['product_image'];
                        }
                    }

                    ?>
                    <div class="form-group offset-4">
                        <label for="uname">Product Name</label>
                        <input type="text" placeholder="Enter product name" class="form-control form-control-sm w-50" name="pname" value="<?php echo $prod_name; ?>" required>
                    </div>
                    <div class="form-group offset-4">
                        <label for="uname">Product Price</label>
                        <input type="text" placeholder="Enter product price" class="form-control form-control-sm w-50" name="pprice" value="<?php echo $prod_price; ?>" required>
                    </div>
                    <div class="form-group offset-4 mt-2">
                        <label for="psw">Product Details</label>
                        <input type="text" placeholder="Enter product details" class="form-control form-control-sm w-50" name="pdetail" value="<?php echo $prod_detail; ?>" required>
                    </div>
                    <div class="form-group offset-4 mt-2">
                        <label for="psw">Product Image</label>
                        <input type="file" class="form-control form-control-sm w-50" name="pimage" accept=".jpg, .jpeg, .png">
                    </div>
                    <?php echo "<img src='uploads/{$prod_image}'  class ='offset-5' alt='product' id='product_image'>" ?>
                    <div class="form-group offset-4 mt-3">
                        <button type="submit" class="btn btn-outline-info" class="form-control form-control-sm" name="update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>