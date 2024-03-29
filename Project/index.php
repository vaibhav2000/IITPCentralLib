<?php
session_start();
require "spellcheckutil.php"   ;
include('config.php');


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
  <a class="navbar-brand" href=".">IITP Central Library</a>
  <ul class="nav navbar-nav ml-auto">
<?php
  if(!isset($_SESSION['curruser']))
  { 
 ?> 
    <li class="nav-item">
      <a class="nav-link" href="login.php">Login</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="register.php">Sign Up</a>
    </li>
  <?php
  }
  else
  {
  ?>  
 
    <li class="nav-item">
    <a class="nav-link" href="profile.php"><?php echo $_SESSION['curruser'];?></a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="issuedbooks.php">MyBooks</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="logout.php">Logout</a>
    </li>

  <?php } ?>
  </ul>
</nav>



<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {

echo "<div class='insideres'><br><br><br><br>";  
echo "<h2>Search Results</h2>";

    $search = $_POST['searchfield'];
    $search= strtolower($search);
    
     
  
// $guess= $spellcheckObject->Suggestions($search);
// $guess = array_map('strtolower', $guess);
// if($guess[0][0]=='*')
//   $guess= array();
// if(array_search($search, $guess)===false)
//     array_unshift($guess , $search);

 $guess= explode(" ",$search); 

 $unique= array(); 

 echo "Suggestions: ";
 for($i=0;$i<count($guess);$i++)
  { 

    $search= $guess[$i];
    $temp = $spellcheckObject->Suggestions($search);
    
    $temp = array_map('strtolower', $temp);

    if($temp[0][0]=='*')
      $temp= array();

    if(array_search($search, $temp)===false)
      array_unshift($temp , $search);

    for($j=0;$j<count($temp);$j++)
    {
      
    $curr= $temp[$j];
    
    //See Search keys from here vab!
    echo $curr.',';

    // $q= "select * from book where title like '%$curr%' or author like '%$curr%' or bookID like '%$curr%' or type like '%$curr%' or category like '%$curr%' or isbnNO like '%$curr%' ";   

    $q="select book.bookID,title,author,publisher.publisherID,publisher.name as publishername,category,isbnNO,price,type from publishedby inner join book on publishedby.bookID= book.bookID inner join publisher 
    on publishedby.publisherID= publisher.publisherID where book.title like '%$curr%' or book.author like '%$curr%' or book.bookID like '%$curr%' or book.type like '%$curr%' or book.category like '%$curr%' 
    or book.isbnNO like '%$curr%' or publisher.name like '%$curr%'; ";


         $res = mysqli_query($conn,$q);

               if (mysqli_num_rows($res) > 0 ) { 
                 
                while($row = mysqli_fetch_assoc($res)) {
                  array_push($unique,$row["bookID"]);         
               }
    
       }
     }

    }

    $unique=array_unique($unique);

     

    
    if(count($unique)>0)  
      {
       
      
    for($j=0;$j<count($unique);$j++) 
      {
      
      $currstr= $unique[$j];
      // $q= "select * from book where bookID=$currstr"; 
      
      $q="select book.bookID,title,author,publisher.name as publishername,publisher.publisherID,category,type,isbnNO from publishedby inner join book on publishedby.bookID= book.bookID inner join publisher 
      on publishedby.publisherID= publisher.publisherID where book.bookID=$currstr;";

      $res = mysqli_query($conn,$q);

     echo "<br><br>";
      while($row = mysqli_fetch_assoc($res)) {
                  
           ?>
                  
<div class="card" style="width:50%;margin: auto;background-color: rgb(194, 194, 194);text-align: left;">
  <div class="card-body">
    <h4 class="card-title"> <a style="text-decoration:none;" target="_blank" href=<?php echo "'https://www.google.com/search?q=".str_replace(' ','+',ucwords($row["title"]))."'";?>><?php echo ucwords($row["title"]); ?> </a> </h4>
    <p class="card-text" style="margin-left: 35%;">
      <?php echo "-By ".ucwords($row["author"]); ?>
    </p>
    <p class="card-text">
    <?php echo "<strong>BookID:</strong> ".($row["bookID"]); ?><br> 
    <?php echo "<strong>Publisher:</strong> ".ucwords($row["publishername"]); ?><br> 
    <?php echo "<strong>PublisherID:</strong> ".($row["publisherID"]); ?><br> 
    <?php echo "<strong>Category:</strong> ".ucwords($row["category"]); ?><br> 
    <?php echo "<strong>ISBN:</strong> ".($row["isbnNO"]); ?><br> 
    </p>
    </div>
</div>

<br>
                  
           <?php       
                  
                  
                  }
        }   
       
    }
    else
     echo "No Match Found.<br>";

echo "</div>";
}
else{
?>


<div class="contentholder">
<h1>SearchUtil</h1>
<form   action="" method="POST" autocomplete="off">
  <input type="text" name= "searchfield" required="required" placeholder="Search Here...">
  <input type="submit" value="Go">
 </form>
</div>



<?php } ?>


</body>
</html> 