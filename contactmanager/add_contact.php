<?php
session_start();
//getting data from form
$first_name = filter_input(INPUT_POST, 'first_name');
$last_name = filter_input(INPUT_POST, 'last_name');
$email = filter_input(INPUT_POST, 'Email');
$phone = filter_input(INPUT_POST, 'phone');

// code to save data to SQL database
//validating the inputs from add_contact_form
if ($first_name == null || $last_name == null || $email == null || $phone == null) {
    $_SESSION['add_error'] = 'Invalid contact data. Please make sure all fields are filled';
    //redirecting to an error page
    $url = "error.php";
    header("Location: " . $url); //header is the method to redirect
    die(); // similar to return or break 
} else {
    require_once('database.php'); //connecting to the database once or per request

    //adding data to the database
    $query = "INSERT INTO contacts (firstName, lastName, Email, phone) VALUES (:firstName, :lastName, :Email, :phone)";
    $statement = $db->prepare($query);

    $statement->bindValue(':firstName', $first_name);
    $statement->bindValue(':lastName', $last_name);
    $statement->bindValue(':Email', $email);
    $statement->bindValue(':phone', $phone);

    $statement->execute();
    $statement->closeCursor();
}

$_SESSION['fullName'] = $first_name . ' ' . $last_name;

// redirecting to confirmation page
$url = "confirmation.php";
header("Location: " . $url); //header is the method to redirect
die();
?>
