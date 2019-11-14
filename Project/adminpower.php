<?php
require "spellcheckutil.php"   ;
include('config.php');
session_start();
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
  
<?php
if(!isset($_SESSION['curradmin']))
{ 
    header('location: admin.php');
    die();
}
?>
 
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


<br><br><br><br>
<br><br>

<ul>
<div class="nodecoration" style="margin-left: 5%;">
<li> <a style="text-decoration: none;color: black;" href="adminbookissue.php"><h2>Book Issue</h2></a></li>
<li><a style="text-decoration: none;color: black;" href="adminbookreturn.php"><h2>Book Return</h2></a></li>
<li><a style="text-decoration: none;color: black;" href="adminbookfine.php"><h2>Fine Transaction</h2></a></li>
</ul>
</div>





</body>
</html> 