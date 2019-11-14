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

echo "<br><br><br><br><br>";


    
    $q="select *,issues.bookID as finalID, (datediff(curdate(),returnDate)) as datefine from issues inner join book on issues.bookID= book.bookID where email='".$_SESSION['curruser']."';";
    $res = mysqli_query($conn,$q);
 
    // echo $q;
    $count=0;

    if(mysqli_num_rows($res) > 0 )
     { 
    ?>
    <table class="table table-bordered table-hover" style="width:60%; margin-left:5%;" >
     <thead class="thead-dark" >
     <tr>
     <th>BookID</th>
     <th>Title</th>
     <th>Author</th>
     <th>Category</th>
     <th>ISBN No.</th>
     <th>Return Date</th>
     </tr>
       </thead>
       <?php

while($row = mysqli_fetch_assoc($res)) {
              echo "<tr>";
              echo "<td>".$row["finalID"]."</td>";
              echo "<td>".ucwords($row["title"])."</td>"; 
              echo "<td>".ucwords($row["author"])."</td>"; 
              echo "<td>".ucwords($row["category"])."</td>"; 
              echo "<td>".$row["isbnNO"]."</td>";  
              echo "<td>".$row["returnDate"]."</td>"; 
              
              echo "</tr>";
              
              // echo $row['datefine']."<br>";

              if($row["datefine"]>0)
                $count = $count + $row['datefine']*5;


             
            }
        

     }
     else 
      echo "You currently haven't issued any books.";
   
     
  $q= "select * from librarymember where email='".$_SESSION['curruser']."';";
  $res = mysqli_query($conn,$q);
  $row = mysqli_fetch_assoc($res);
  $fine= $row['fine']+ $count;
  echo "<h3 style= 'text-align:left !important;margin-left: 5% '>Total Fine: $fine INR</h3>";
   
   
    }
  ?>



</body>
</html>