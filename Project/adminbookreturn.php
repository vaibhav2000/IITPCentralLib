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

     

    $q= "select *,(datediff(curdate(),returnDate)) as finedays from issues where email='".$_POST['email']."' and bookID='".$_POST['bookID']."';";
    
    if(!mysqli_query($conn,$q))
     die("Error Updating Data: ".mysqli_error($conn));


     $res = mysqli_query($conn,$q);
     $row = mysqli_fetch_assoc($res);


     echo "<br>"."<br>"."<br>"."<br>";
     if(mysqli_num_rows($res)==0)
       die("This book has not been issued by this user");
      

     $fine= $row['finedays'];

    
     $q= "delete from issues where email='".$_POST['email']."' and bookID='".$_POST['bookID']."';";
     mysqli_query($conn,$q);
     
     $q= "update librarymember set fine = fine+".$fine." where email='".$_POST['email']."';";
     mysqli_query($conn,$q);
   

     echo "This book has now been returned"; 
}
else{
?>

<br><br><br><br>
<br><br>
<div class="nodecoration" style="margin-left: 5%;">
<h2>Book Return</h2>



 <form  action="" method="POST">
 <input style="border: medium solid black;" type="email" name= "email" required="required" placeholder="Email Here..."><br><br>
 <input  style="border: medium solid black;"  type="text" name= "bookID" required="required" placeholder="Book ID here..."><br><br>
  <p>Return Date: <?php echo date('Y-m-d');?>  </p>
  <input type="submit">
</div>



<?php } ?>


</body>
</html> 