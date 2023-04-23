<?php
error_reporting(0);
session_start();
include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="main-header">
    <div class="container-fluid">
        <div class="row" id="header">
            <div class="col">
                <?php
                    if(isset($_SESSION['login']))
                    {
                        echo "<h1 class='text-white float-start'>PRODUCTS</h1>";
                        echo "<h5 class='text-uppercase mt-3 float-start mt-4 offset-6'>Welcome,".$_SESSION['name']."</h5>";
                        echo "<a href='logout.php' class='text-decoration-none float-end text-white btn btn-outline-danger m-2'>Logout</a>";
                        echo "<a href='create_product.php' class='text-decoration-none text-white float-end btn btn-outline-success m-2'>Add Product</a>";
                    }
                    else{
                        header('location:login.php');
                    }
                ?>
            </div>
        </div>
        <div class="row gx-0">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-uppercase">Product ID</th>
                                <th class="text-uppercase">Product Name</th>
                                <th class="text-uppercase">Product Price</th>
                                <th class="text-uppercase">Product Highlight</th>
                                <th class="text-uppercase">Product Image</th>
                                <th class="text-uppercase">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $page=$_GET['page'];
                            if(isset($_GET['page']))
                            {
                                $page=$_GET['page'];
                            }
                            else{
                                $page=1;
                            }
                            $limit=4;
                            $offset=($page-1)*$limit;
                             // to get data from database
                                $query="SELECT * from product LIMIT {$offset},{$limit}";
                                $result=mysqli_query($conn,$query);
                                if(mysqli_num_rows($result)>0)
                                {
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                    echo"<tr>
                                            <td>{$row['product_id']}</td>
                                            <td class='text-uppercase'>{$row['product_name']}</td>
                                            <td>{$row['product_price']}</td>
                                            <td class='text-uppercase'>{$row['product_detail']}</td>
                                            <td> <img src='uploads/{$row['product_image']}' alt='product' id='product_image'></td>
                                            <td>
                                                <a href='update_product.php?id={$row['product_id']}' class='text-decoration-none btn btn-outline-primary'>Edit</a>
                                                <a href='delete_product.php?id={$row['product_id']}' class='text-decoration-none btn btn-outline-primary'>Delete</a>
                                            </td>
                                        </tr>";
                                    }
                                }
                                ?>
                        </tbody>
                    </table>
                    <?php
                    $query1="SELECT * from product";
                    $result1=mysqli_query($conn,$query1);
                    if(mysqli_num_rows($result1)>0) 
                    {
                        $total_records=mysqli_num_rows($result1);
                        $total_page=ceil($total_records/$limit);
                        
                        echo "<ul class='pagination admin-pagination offset-6 position-sticky'>";
                            for($i=1;$i<=$total_page;$i++)
                            {
                                if($i==$page)
                                {
                                    $active="active";
                                }
                                else{
                                    $active='';
                                }
                                echo '<li class="page-item ."$active".">
                                        <a class="page-link mx-1" href="homepage.php?page='.$i.'">'.$i.'</a>
                                    </li>';
                            }
                        echo "</ul>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>