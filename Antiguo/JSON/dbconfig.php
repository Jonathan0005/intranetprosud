<?php
$DBhost = "localhost";
 $DBuser = "prodea1";
 $DBpass = "desarrollo";
 $DBname = "prodea1_cpfr";
 
 try{
  
  $DBcon = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
  $DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
 }catch(PDOException $ex){
  
  die($ex->getMessage());
 }
?>