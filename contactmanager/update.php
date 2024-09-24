<?php
session_start();
require_once("database.php"); // Connect to the database

// Get the data from the form
$contact_id = filter_input(INPUT_POST, 'contact_id', FILTER_VALIDATE_INT);
$first_name = filter_input(INPUT_POST, 'first_name');
$last_name = filter_input(INPUT_POST, 'last_name');
$email = filter_input(INPUT_POST, 'Email');
$phone = filter_input(INPUT_POST, 'phone');

// Validate the inputs
if ($contact_id == null || $first_name == null || $last_name == null || $email == null || $phone == null) {
    $_SESSION['update_error'] = 'Invalid contact data. Please make sure all fields are filled';
    header("Location: error.php");
    die();
}

// Update existing contact
$query = 'UPDATE contacts SET firstName = :firstName, lastName = :lastName, Email = :Email, phone = :phone WHERE contactID = :contact_id';
$statement = $db->prepare($query);
$statement->bindValue(':contact_id', $contact_id, PDO::PARAM_INT);
$statement->bindValue(':firstName', $first_name);
$statement->bindValue(':lastName', $last_name);
$statement->bindValue(':Email', $email);
$statement->bindValue(':phone', $phone);

// Execute the statement
try {
    $statement->execute();
    $statement->closeCursor();
} catch (Exception $e) {
    $_SESSION['update_error'] = 'Error updating contact: ' . $e->getMessage();
    header("Location: error.php");
    die();
}

// Redirect to confirmation page
$_SESSION['fullName'] = $first_name . ' ' . $last_name;
header("Location: confirmation.php");
die();
?>
