<?php
session_start();
include("config.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $email = $_POST['username'];
    $pass= $_POST['pass'];
     
    $q= "select username from libraryadmin where username='$email' and password='$pass' ";
    $res = mysqli_query($conn,$q);
    
    if(mysqli_num_rows($res)==1)
     {
           $_SESSION['curradmin']= $email;
           header('location: adminpower.php');
           exit;
          }
    else  
    {
        echo "<div class='placeright'>Invalid Credentials</div>";
    }
    
}
?>

<html>
<head>
<link rel="stylesheet" href="outline.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#000000" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link href='https://fonts.googleapis.com/css?family=Roboto Mono' rel='stylesheet'>
   
 <title>Login</title>
</head>
<body>

<nav class="fixed-top navbar navbar-expand-sm navbar-dark" style="background-color: black;">
  <a class="navbar-brand" href="index.php">IITP Central Library</a>
  <ul class="nav navbar-nav ml-auto">

   
    <li class="nav-item">
      <a class="nav-link" href="#">AdminPANEL</a>
    </li>
  
  </ul>
</nav>





<div class = "contentholder">
  <div class="checkout"></div> 
<div class="uppername">
  
    <div class="login">AdminLogin</div>  
    <br><br>
    </div>

 <form action="" method="POST">
  <input type="text" name= "username" required="required" placeholder="Email Here..."><br>
  <input type="password" name ="pass" required="required" placeholder="Password Here..."><br>
  <input type="submit">


</form>
</div>
</body>
</html>