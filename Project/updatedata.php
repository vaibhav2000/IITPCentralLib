<?php
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
if(!isset($_SESSION['curruser']))
   header('location: index.php');
else
 {
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
   $room= $row['roomNo'];
   $roll=$row['rollNo'];

//    echo $fname.$lname.$email.$pass.$dob.$contact.$roll;
 
     ?>
<div class="nodecoration">     
<form action="" method="POST" autocomplete="off">
 <table class="table table-bordered table-hover" style="width:60%; margin-left:5%;" >
     <tr>
         <td><strong>First Name</strong></td>
         <td> <input type="text" name= "fname" required="required" value= <?php echo $fname;?>  ></td>
     </tr>
     <tr>
         <td><strong>Last Name</strong></td>
         <td> <input type="text" name= "lname" required="required" value= <?php echo $lname;?>  ></td>
     </tr>
     <tr>
         <td><strong>Roll No.</strong></td>
         <td> <input type="text" name= "roll" required="required" value= <?php echo $roll;?>  ></td>
     </tr>
     
     <tr>
         <td><strong>Email</strong></td>
         <td> <input type="email" name= "email" required="required" value= <?php echo $email;?>  ></td>
    </tr>
     <tr>
         <td><strong>Password</strong></td>
         <td> <input type="text" name= "pass" required="required" value= <?php echo $pass;?>  ></td>
       </tr>
     <tr>
         <td><strong>Contact</strong></td>      
         <td> <input type="text" name= "contact"  value= 
         <?php 
              if(!is_null($contact))
                echo $contact;
              else 
                 echo "NotUpdated"; 
                ?>
             ></td>
     </tr>

     <tr>
         <td><strong>Room</strong></td>      
         <td> <input type="text" name= "room"  value= 
         <?php 
              if(!is_null($room))
                echo $room;
              else 
                 echo "NotUpdated"; 
                ?>
             ></td>
     </tr>


     <tr>
         <td><strong>DOB</strong></td>
           
         <td> <input type="date" name= "dob"  value= 
           <?php if(!is_null($dob))
                echo $dob;
              else 
                 echo "NotUpdated";  ?>
            ></td>
     </tr>
     
     
 </table> 
 
 <input  type="submit" value="Update">
</form>
 
 </div>

 <?php }
 

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $q= "update librarymember set email= '".$_POST['email']."' where email= '".$_SESSION['curruser']."';";
    // echo $q;
 
    if(!mysqli_query($conn,$q))
     die("Error Updating Data: ".mysqli_error($conn));
     

     $q= "update librarymember set firstname= '".$_POST['fname']."' where email= '".$_SESSION['curruser']."';";
     mysqli_query($conn,$q); 
     $q= "update librarymember set lasttname= '".$_POST['lname']."' where email= '".$_SESSION['curruser']."';";
     mysqli_query($conn,$q); 
     $q= "update librarymember set rollNo= '".$_POST['roll']."' where email= '".$_SESSION['curruser']."';";
     mysqli_query($conn,$q); 
     $q= "update librarymember set password= '".$_POST['pass']."' where email= '".$_SESSION['curruser']."';";
     mysqli_query($conn,$q); 


     if($_POST['contact']!= 'NotUpdated')
     {$q= "update librarymember set contactNO= '".$_POST['contact']."' where email= '".$_SESSION['curruser']."';";
     mysqli_query($conn,$q); }

     if($_POST['room']!= 'NotUpdated')
     {$q= "update librarymember set roomNo= '".$_POST['room']."' where email= '".$_SESSION['curruser']."';";
     mysqli_query($conn,$q); }

     if($_POST['dob']!= 'NotUpdated')
     {$q= "update librarymember set dob= '".$_POST['dob']."' where email= '".$_SESSION['curruser']."';";
     mysqli_query($conn,$q); }
        
     header('location: profile.php');
}
 
 ?>
</body>
<html>