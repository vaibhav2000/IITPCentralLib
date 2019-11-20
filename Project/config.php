<?php

$conn = mysqli_connect('localhost','root','password');

if(!$conn)
 {
  echo "Error Connecting to the server";
  die();
}

mysqli_query($conn,"use project;");


?>