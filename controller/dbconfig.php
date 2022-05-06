<?php
$DBhost = "oficina.prosud.cl";
 $DBuser = "oficinaprosud";
 $DBpass = "of.2102.cl";
 $DBname = "oficinaprosud_appsprosud";
 
 try{
  
  $DBcon = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
  $DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
 }catch(PDOException $ex){
  
  die($ex->getMessage());
 }

 ?>