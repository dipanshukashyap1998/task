<?php
//database connection
  $host='localhost';
  $user='root';
  $pass=''; 
  $db='gg_project';
  $conn=mysqli_connect($host,$user,$pass,$db);
  if(!$conn) 
  {
    echo "Error: Unable to connect to the database.<br>Server said: " . mysqli_error();
    exit;
  }
  ?>