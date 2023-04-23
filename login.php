<?php
error_reporting();
session_start();
include 'database.php';

if(isset($_POST['login'])) 
{
   $email = mysqli_real_escape_string($conn,$_POST['email']);
   $password = mysqli_real_escape_string($conn,$_POST['password']);

   $query = "SELECT * from usertable where email = '$email' and password='$password' ";
   $result = mysqli_query($conn, $query);
  

   if(mysqli_num_rows($result) > 0) 
   {
      while($row = mysqli_fetch_assoc($result))
      {
         $_SESSION['name'] = $row['name'];
         $_SESSION['login'] = "yes";
      }
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
   <title>Login</title>
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <div class="container">
      <div class="row">
         <div class="col">
            <form class="form-inline" action="" method="post">
               <div class="mt-5 ">
                  <h1 class="text-center">LOGIN</h1>
               </div>
               <div class="form-group offset-4">
                  <label for="uname">Email</label>
                  <input type="email" placeholder="Enter email" class="form-control form-control-sm w-50" name="email" required>
               </div>
               <div class="form-group offset-4 mt-2">
                  <label for="psw">Password</label>
                  <input type="password" placeholder="Enter Password" class="form-control form-control-sm w-50" name="password" required>
               </div>
               <div class="form-group offset-4 mt-3">
                  <button type="submit" class="btn btn-outline-info" class="form-control form-control-sm" name="login">Login</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</body>

</html>