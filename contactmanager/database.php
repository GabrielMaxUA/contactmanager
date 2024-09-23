<?php 
  session_start(); //allows to take info from one page to another (data share between pages)

  //to access data autorisation is requiered of the owner of the DB
  $dsn = 'mysql:host=localhost;dbname=contact_manager';// NO SPACES!!! data source name with location/name of the database 
  $username = 'root';
  $password = 'maxGabriel12';

  try{
    $db = new PDO($dsn, $username, $password);// creating the connection 
  }
  catch(PDOException $e){
    $_SESSION["database_error"] = $e-> getMessage();
    $url = "database_error.php";
    header("Location: " . $url);// func header ->directing from page to page where url is an address of the page
    exit();
  }

  ?>