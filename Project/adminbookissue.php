<?php
session_start();
require "spellcheckutil.php"   ;
include('config.php');

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

    echo "<br>"."<br>"."<br>"."<br>";
     
    $q= "select * from issues where bookID=".$_POST['bookID'].";";
    echo $q;
    $res = mysqli_query($conn,$q);
    
    if(mysqli_num_rows($res)>0)
     die("This book has already been issued");


    $q= "insert into issues values('".$_POST['email']."','".$_POST['bookID']."',curdate(), date_add(curdate(),interval 30 day));";
 
    if(!mysqli_query($conn,$q))
     die("Error Updating Data: ".mysqli_error($conn));

     
     echo "This book has now been issued"; 
}
else{
?>

<br><br><br><br>
<br><br>
<div class="nodecoration" style="margin-left: 5%;">
<h2>Book Issue</h2>



 <form  action="" method="POST">
 <input style="border: medium solid black;" type="email" name= "email" required="required" placeholder="Email Here..."><br><br>
 <input  style="border: medium solid black;"  type="text" name= "bookID" required="required" placeholder="Book ID here..."><br><br>
  <p>Issue Date: <?php echo date('Y-m-d');?>  </p>
  <input type="submit">
</div>



<?php } ?>


</body>
</html> 