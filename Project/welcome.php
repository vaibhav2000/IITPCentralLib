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
else
  echo $_SESSION['curruser'];
 ?>

</body>
<html>