<?php
session_start();
require_once('database.php');
//getting data from form
$user_name = filter_input(INPUT_POST, 'user_name');
$password = filter_input(INPUT_POST, 'password');


$queryContacts = 'SELECT * FROM registration'; //retrieve variable
$statement1 = $db-> prepare($queryContacts); //connecting data and webpage
$statement1-> execute(); //running the connection while requested
$registrations = $statement1-> fetchAll(); //retrieving All the data from the DB with creating the variable
$statement1-> closeCursor();//after data is fetched the dt connection closes

foreach($registrations as $registration){
    if($user_name == $registration['userName']){
        $_SESSION['add_error'] = 'User already exists. Please Check your field for any type mistakes';
        //redirecting to an error page
        $url = "error.php";
        header("Location: " . $url); //header is the method to redirect
        die();
    }
    else  if($user_name == NULL || $password == NULL){
      $_SESSION['add_error'] = 'Please Check your fields';
      //redirecting to an error page
      $url = "error.php";
      header("Location: " . $url); //header is the method to redirect
      die();
  }
}


  //adding data to the database
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  $query = "INSERT INTO registration (userName, password) 
  VALUES (:userName, :password)";
  $statement = $db->prepare($query);

  $statement->bindValue(':userName', $user_name);
  $statement->bindValue(':password', $hashed_password);
  
  $statement->execute();
  $statement->closeCursor();


$_SESSION['userName'] = $user_name;

// redirecting to confirmation page
$url = "registration_confirmation.php";
header("Location: " . $url); //header is the method to redirect
die();
?>


