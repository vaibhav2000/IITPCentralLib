<?php
require "spellcheckutil.php"   ;
include('config.php');
session_start();

if(!isset($_SESSION['curradmin']))
{ 
    header('location: admin.php');
    die();
}
?>

<html>
<head>
<title>BookSearch</title>
<link rel="stylesheet" href="bookoutline.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#000000" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link href='https://fonts.googleapis.com/css?family=Roboto Mono' rel='stylesheet'>
</head>
<body>
  

 
<nav class="fixed-top navbar navbar-expand-sm navbar-dark" style="background-color: black;">
  <a class="navbar-brand" href=".">IITP Central Library</a>
  <ul class="nav navbar-nav ml-auto">

    <li class="nav-item">
    <a class="nav-link" href='#'><?php echo $_SESSION['curradmin'];?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="logout.php">Logout</a>
    </li>
</ul>
</nav>


<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {

     

   
    $q= "update librarymember set fine= 0 where email='".$_POST['email']."';";
    echo "<br>"."<br>"."<br>"."<br>";
    if(!mysqli_query($conn,$q))
     die("Error Updating Data: ".mysqli_error($conn));

     
     echo "The fine associated with user ".$_POST['email']." has been updated."; 
}
else{
?>

<br><br><br><br>
<br><br>
<div class="nodecoration" style="margin-left: 5%;">
<h2>Fine Transaction</h2>

 <form  action="" method="POST">
 <input style="border: medium solid black;" type="email" name= "email" required="required" placeholder="Email Here..."><br><br>
  <input type="submit">
</div>



<?php } ?>


</body>
</html> 