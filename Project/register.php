<?php
session_start();
include('config.php');
?>

<html>
 <head>
  <title>Register</title>
   <link rel="stylesheet" href="outline.css">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="theme-color" content="#000000" />
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <link href='https://fonts.googleapis.com/css?family=Roboto Mono' rel='stylesheet'>
      
 </head>
 <body> 


<nav class="fixed-top navbar navbar-expand-sm navbar-dark" style="background-color: black;">
  <a class="navbar-brand" href="index.php">IITP Central Library</a>
  <ul class="nav navbar-nav ml-auto">

    <li class="nav-item">
      <a class="nav-link" href="login.php">Login</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="register.php">Sign Up</a>
    </li>
  
  </ul>
</nav>


<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // echo "<div class='placeregright'>Invalid Credentials</div>";

  $fname = $_POST["firstname"];
  $lname = $_POST["lastname"];
  $email = $_POST["email"];
  $roll= $_POST["rollno"];
  $pass = $_POST["pass"];
  $confpass = $_POST["confpass"];

  if($pass != $confpass)
   echo "<div class='placeregright'>Passwords don't match, please try again.</div>"; 
  else
  {
     if(strlen($pass)<6)
      echo "<div class='placeregright'>Password is too short, it must be at least 6 characters long.</div>";
     else
     if(preg_match("/[A-Z]/", $pass) && preg_match("/[a-z]/", $pass)&&preg_match('~[0-9]+~', $pass) ) 
      {
    $q= "select email from librarymember where email='$email'; ";
 
    $res= mysqli_query($conn, $q); 
    
    if(mysqli_num_rows($res) == 1)
     echo "<div class='placeregright'>Email Already Exists</div>"; 
    else 
     {
        // mysqli_query($conn,$q);
        $q= "INSERT INTO librarymember (firstname, lastname,email,password,rollNo,fine) VALUES ('$fname','$lname','$email','$pass','$roll',0)";
        mysqli_query($conn, $q);

        $_SESSION['email']= $email;
        echo "<div class='placeregright'>You have been Registered successfully. Please Proceed to the <a href='login.php'>Login page</a>.</div>"; 
       
        
        
     }
      }
     else
     echo "<div class='placeregright'>Please make sure that the password contains at least one capital letter, one small letter and a number.</div>";
  } 
   
}
?>



<div class = "contentholder">
<div class="uppername">
  
  <div class="login">Sign Up</div> <div class="signup">Already a user?<a href="login.php">Log In!</a></div> 
  <br><br>
  </div>
 
  <div class="checkout"></div>

  <form action="" method="post">
    <div class = "breaktwo">
    <input type="text" name="firstname"  required="required" placeholder="First Name Here...">
    <input type="text" name="lastname"  required="required" placeholder="Last Name Here..."><br>
    </div>

    <input type="email" name="email"  required="required" placeholder="Email Here..."><br>
    <input type="text" name="rollno" required="required" placeholder="Roll No. Here..." ><br>
    <input type="password" name="pass" required="required" placeholder="Password Here..." ><br>
    <input type="password" name="confpass" required="required" placeholder="Confirm Password..." ><br>
    
    <input type="submit" value="Submit">
  </form>
</div>
 </body>
</html>
