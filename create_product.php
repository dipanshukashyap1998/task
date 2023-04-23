<?php
session_start();
if(!isset($_SESSION['login']))
{
    header('location:login.php');
}
error_reporting(0);
include 'database.php';
if(isset($_POST['add_product']))
{
    $product_name=$_POST['pname'];
    $product_price=$_POST['pprice'];
    $product_detail=$_POST['pdetail'];
    
    $file=$_FILES['pimage'];
	$file_name =$_FILES['pimage']['name'];
	$file_size =$_FILES['pimage']['size'];
	$file_tmp  =$_FILES['pimage']['tmp_name'];
	$file_type =$_FILES['pimage']['type'];
	$file_error=$_FILES['pimage']['error'];
	$folder="uploads/";

	if($file_error === 0)
	{
		if($file_size>200000)
		{
			$error = "Sorry your file is too large";
		}
		else
		{
			$fileext= explode('.',$file_name);
			$filecheck= strtolower(end($fileext));
			$allowedext=array("jpg","jpeg","png");

			if(in_array($filecheck, $allowedext))
			{
				if(!move_uploaded_file($file_tmp,$folder.$file_name))
				{
					echo"Photo not successfully uploaded";
				}
			}
			else
			{
			$errors.="<li>extension must be of .jpg, .jpeg, .png</li>";
			}
		}
	}

    $query="INSERT INTO product (product_name,product_price,product_detail,product_image)VALUES('$product_name','$product_price','$product_detail','$file_name')";
    $result=mysqli_query($conn,$query);
    if($result)
    {
        $success= "<h5 class='text-center text-success'>Product Created Successfully</h5>";
        header('location:homepage.php');
    }
    else{
        $failure = "<h5 class='text-center text-danger'>Product Not Created Successfully</h5>";
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
                            <h1 class="text-center">PRODUCT CREATION</h1>
                    </div>
                    <div class="form-group offset-4">
                        <label for="uname">Product Name</label>
                        <input type="text" placeholder="Enter product name" class="form-control form-control-sm w-50" name="pname" required>
                    </div>
                    <div class="form-group offset-4">
                        <label for="uname">Product Price</label>
                        <input type="text" placeholder="Enter product price" class="form-control form-control-sm w-50" name="pprice" required>
                    </div>
                    <div class="form-group offset-4 mt-2">
                        <label for="psw">Product Details</label>
                        <input type="text" placeholder="Enter product details" class="form-control form-control-sm w-50" name="pdetail" required>
                    </div>
                    <div class="form-group offset-4 mt-2">
                        <label for="psw">Product Image</label>
                        <input type="file" class="form-control form-control-sm w-50" name="pimage" accept=".jpg, .jpeg, .png" required>
                    </div>
                    <div class="form-group offset-4 mt-3">
                        <button type="submit" class="btn btn-outline-info" class="form-control form-control-sm" name="add_product">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
if(isset($success))
{
    echo $success;
}
else{
    echo $failure;
}
?>
</body>
</html>