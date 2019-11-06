<?php
include("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $username = $_POST['username'];
    $pass= $_POST['pass'];
     
    $q= "select username from user where username='$username' and password='$pass' ";
 
    $res = mysqli_query($conn,$q);
    
    if(mysqli_num_rows($res)==1)
     {
           $_SESSION['curruser']= $username;
           header('location: welcome.php');
     }
    else  
    {
        echo "Invalid Credentials";
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

<div class = "contentholder">
<div class="uppername">
  
    <div class="login">Login</div> <div class="signup">New user?<a href="register.php">Sign Up!</a></div> 
   <br>
   <br>
    </div>

 <form action="" method="POST">
  <input type="text" name= "username" required="required" placeholder="Name Here..."><br>
  <input type="password" name ="pass" required="required" placeholder="Password Here..."><br>
  <input type="submit">


</form>
</div>
</body>
</html>