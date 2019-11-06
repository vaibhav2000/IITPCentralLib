<?php
include('config.php');
session_start();
?>

<html>
<head>

 <title>Welcome!</title>
<link rel="stylesheet" href="outline.css">
</head>
<body style="text-align: left !important;">

<?php
if(!isset($_SESSION['curruser']))
  {
?> 
<div style="font-size:50px;margin-top:20%;" >
<a href="login.php">LOGIN</a> | <a href="register.php">SIGN UP</a> 
  </div>
<?php       

  }
else{
  $curruser  =  $_SESSION['curruser'];  
?> 
   
  <br><br> 
  Hello <?php echo $curruser;?><br>
  Your Secret String is 
  
  <?php
   
    $res= mysqli_query($conn,"select spec from user where username='$curruser'");
    $row = mysqli_fetch_array($res,MYSQLI_ASSOC); 
    echo '"'.$row['spec'].'".';
    
  ?>
   
  You can change it here. 

  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <a href="logout.php">LOGOUT</a>

<?php }?>

</body>
<html>