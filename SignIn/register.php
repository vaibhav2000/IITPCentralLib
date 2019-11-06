<?php
include('config.php');

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST["inputname"];
    $pass = $_POST["inputpass"];

    $q= "select username from user where username='$name'; ";
 
    $res= mysqli_query($conn, $q); 
    
    if(mysqli_num_rows($res) == 1)
     echo "Username Already Exists"; 
    else 
     {
        $q= "insert into user values('$name','$pass','');";
        
        mysqli_query($conn,$q);
        echo "You have been Registered successfully. Please Proceed to the login page."; 
        
        $_SESSION['username']= $name;
        
        
     }
   
}
else
{
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

 <div class = "contentholder">
<div class="uppername">
  
  <div class="login">Sign Up</div> <div class="signup">Already a user?<a href="login.php">Log In!</a></div> 
  <br><br>
  </div>
 
  <form action="" method="post">
    <input type="text" name="inputname"  required="required" placeholder="Name Here..."><br>
    <input type="text" name="inputpass" required="required" placeholder="Password Here..." ><br>
    <input type="submit" value="Submit">
  </form>

</div>
 </body>
</html>

<?php
}
?>