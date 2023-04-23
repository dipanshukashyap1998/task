<?php
session_start();
if(!isset($_SESSION['login']))
{
    header('location:login.php');
}
include 'database.php';
$id=$_GET['id'];
$query="Delete from product where product_id = '$id'";
$result=mysqli_query($conn,$query);
if($result)
{
    header('location:homepage.php');
}
?>