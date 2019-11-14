<?php

$port = 'localhost';
$username= 'root';
$pass = 'password';

$conn= mysqli_connect($port,$username,$pass);

if(!$conn)
 {
  echo "Error Connecting to the server";
  die();
}

mysqli_query($conn,"use project;");


?>