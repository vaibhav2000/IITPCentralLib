<html>
<head>
<title>BookSearch</title>
<link rel="stylesheet" href="outline.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#000000" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link href='https://fonts.googleapis.com/css?family=Roboto Mono' rel='stylesheet'>
  

</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
  <a class="navbar-brand" href="#">IITP Central Library</a>
<ul class="nav navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" href="#">Login</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Sign Up</a>
    </li>
  </ul>
</nav>

<?php


require "spellcheckutil.php"   ;

$port = 'localhost';
$username= 'root';
$pass = 'password';

$conn= mysqli_connect($port,$username,$pass);

if(!$conn)
 {
  echo "Error Connecting to the server";
  die();
}

mysqli_query($conn,"use project;");

if($_SERVER["REQUEST_METHOD"] == "POST") {

echo "<div class='insideres'>";  
echo "<h2>Search Results</h2>";

    $search = $_POST['searchfield'];
    $search= strtolower($search);
    
     
  
$guess= $spellcheckObject->Suggestions($search);
$guess = array_map('strtolower', $guess);


if($guess[0][0]=='*')
  $guess= array();

if(array_search($search, $guess)===false)
    array_unshift($guess , $search);

 $flag=true; 
 
 
 

 for($i=0;$i<count($guess);$i++)
  { 
    $search= $guess[$i];
    $q= "select * from book where title like '%$search%' or author like '%$search%' or bookID like '%$search%' or type like '%$search%' or category like '%$search%' or isbnNO like '%$search%' ";
   
    //see query if you wanna
    // echo $q."<br>"; 

    $res = mysqli_query($conn,$q);

    if (mysqli_num_rows($res) > 0 ) {
        
     
    if($flag)  
      {$flag=false;
        ?>
        <table class="table table-bordered table-hover "   >
  
        <thead class="thead-dark" >
        <tr>
    <th>BookID</th>
    <th>Title</th>
    <th>Author</th>
    <th>Category</th>
    <th>Type</th>
    <th>ISBN no.</th>
  </tr>
      </thead>
        <?php
      }
        // output data of each row
        while($row = mysqli_fetch_assoc($res)) {
            echo "<tr>";
            echo "<td>".$row["bookID"]."</td>";
            echo "<td>".ucwords($row["title"])."</td>";
            echo "<td>".ucwords($row["author"])."</td>";
            echo "<td>".ucwords($row["category"])."</td>";
            echo "<td>".ucwords($row["type"])."</td>";
            echo "<td>".$row["isbnNO"]."</td>"; 
            echo "</tr>";
           
        }
    } 
    
  }

 if($flag)
  echo "No Matches Found<br>"; 


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