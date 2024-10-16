<?php
session_start();
require_once('database.php');
//getting data from form
$user_name = filter_input(INPUT_POST, 'user_name');
$password = filter_input(INPUT_POST, 'password');

$query = 'SELECT password FROM registration
WHERE userName = :userName';
$statement = $db->prepare($query);
$statement->bindValue(':userName', $user_name);
$statement->execute();
$row = $statement->fetch();
$statement->closeCursor();

if ($row) { // Check if a row was returned
  $hash = $row['password'];
  $_SESSION['isLoggedIn'] = password_verify($password, $hash);
  $_SESSION['userName'] = $user_name;

  // Redirecting to confirmation page if login is successful
  if ($_SESSION['isLoggedIn']) {
      header("Location: login_confirmation.php");
      die();
  } else {
    $_SESSION["add_error"] =  "Invalid username or password";
    header("Location: error.php");
      die(); // Handle invalid login
  }
} else {
  $_SESSION["add_error"] = "Invalid username or password";
  header("Location: error.php");
  die(); // Handle invalid login // Handle case where user doesn't exist
}
?>


