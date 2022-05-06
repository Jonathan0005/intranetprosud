<?php
$host="localhost";
$user="oficinaprosud";
$password="of.2102.cl";
$db = "oficinaprosud_appsprosud";

$con = mysqli_connect($host,$user,$password,$db);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }else{  //echo "Connect"; 
  
   
   }

?>