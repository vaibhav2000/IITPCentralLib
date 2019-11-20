<?php
session_start();
include('config.php');

if(!isset($_SESSION['curruser']))
   header('location: index.php');
else
 {
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
  <a class="navbar-brand" href="index.php">IITP Central Library</a>
  <ul class="nav navbar-nav ml-auto">

    <li class="nav-item">
    <a class="nav-link" href="profile.php"><?php echo $_SESSION['curruser'];?></a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="issuedbooks.php">MyBooks</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="logout.php">Logout</a>
    </li>

  </ul>
</nav>



   <?php
    $q= "select * from librarymember where email='".$_SESSION['curruser']."';";

   $res = mysqli_query($conn,$q);
   $row = mysqli_fetch_assoc($res);

    echo "<br><br><br><br><br>"; 
   
    //see query if you wanna
    // echo $q."<br>"; 
  
   $fname=  $row['firstname'];
   $lname= $row['lastname'];
   $email= $row['email'];
   $pass= $row['password'];
   $dob= $row['dob'];
   $contact= $row['contactNO'];
   $room=$row['roomNo'];
   $roll=$row['rollNo'];
     ?>
 <table class="table table-bordered table-hover" style="width:60%; margin-left:5%;" >
     <tr>
         <td><strong>Name</strong></td>
         <td><?php echo $fname." ".$lname; ?></td>
     </tr>
     <tr>
         <td><strong>Roll No.</strong></td>
         <td><?php echo $roll; ?></td>
     </tr>
     
     <tr>
         <td><strong>Email</strong></td>
         <td><?php echo $email; ?></td>
     </tr>
     <tr>
         <td><strong>Password</strong></td>
         <td><?php echo $pass; ?></td>
     </tr>
     <tr>
         <td><strong>Contact</strong></td>
           <td><?php 
              if(!is_null($contact))
                echo $contact;
              else 
                 echo "Not updated"; 
                ?>
           </td>
     </tr>
     <tr>
     <td><strong>Room</strong></td>
           <td><?php 
              if(!is_null($room))
                echo $room;
              else 
                 echo "Not updated"; 
                ?>
           </td>
     </tr>
     <tr>
         <td><strong>DOB</strong></td>
         <td><?php if(!is_null($dob))
                echo $dob;
              else 
                 echo "Not updated";  ?></td>
     </tr>
     
     
 </table> 

 <div style="text-align:left; padding:5%; ">
      <a style="padding: 1%; text-decoration: none;border: medium solid black;font-size: 20px;color:black; " href="updatedata.php"> Update Information</a>
</div>

 <?php }?>
</body>
<html>