<?php
session_start(); 
include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Logout</title>
    <link rel = "stylesheet" href = "css/bootstrap.css">
    <link rel = "stylesheet"  href = "css/style.css">
</head>
<body class="logout">
    <div class="container">
        <div class="row">
            <div class="col" id="logout">
            <?php
              session_destroy();
                ?>
                <h3 class="text-center text-uppercase mt-5 p-5">You are logged out,Want to<br><a  class ="text-decoration-none text-warning"href="login.php">Login</a> again</h3>
            </div>
        </div>
    </div>
</body>
</html>