<?php
error_reporting(0);
session_start();
include 'database.php';
if(isset($_POST['add']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $status = $_POST['status'];

    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        if(!filter_var($email,FILTER_SANITIZE_EMAIL))
        {
            echo "Invalid Email format";
        }
       
    }

    $query="SELECT * from usertable where email='$email'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0)
    {
        echo "<h4 class='text-center text-danger mt-2'>Username Already Exists</h4>";
    }
    else
    {
        $query1 = "INSERT INTO usertable (name,email,password,status)VALUES('$name','$email','$password','$status')";
        $result1 = mysqli_query($conn,$query1);
        if($result)
        {
            $success ="<h5 class='text-center text-success'>Account Created Successfully</h5>";
        }
        else{
            $failure = mysqli_error($conn);        
        }
    }
}

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
<div class="container">
    <div class="row">
        <div class="col">
            <form class="form-inline" action="" method="POST">
                <div class="mt-5 ">
                        <h1 class="text-center">SIGNUP</h1>
                </div>
                <div class="form-group offset-4">
                    <label for="uname">Name</label>
                    <input type="name" placeholder="Enter name" class="form-control form-control-sm w-50" name="name" required>
                </div>
                <div class="form-group offset-4">
                    <label for="uname">Email</label>
                    <input type="email" placeholder="Enter email" class="form-control form-control-sm w-50" name="email" required>
                </div>
                <div class="form-group offset-4 mt-2">
                    <label for="psw">Password</label>
                    <input type="password" placeholder="Enter Password" class="form-control form-control-sm w-50" name="password" required>
                </div>
                <div class="selectbox offset-4">
				    <label for="picstatus">Choose profile Pic status</label>
                    <select name="status" class="form-control form-control-sm w-50">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
			    </div>
                <div class="form-group offset-4 mt-3">
                    <button type="submit" class="btn btn-outline-info" class="form-control form-control-sm" name="add">Signup</button>
                </div>
                <div class="form-group text-center mt-2">
					<span class="psw"> Already have Account <a class="text-decoration-none" href="login.php">Login</a> here</span>
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