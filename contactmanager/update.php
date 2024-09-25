<?php
session_start();
require_once("database.php"); // Connect to the database

// Get the data from the form
$contact_id = filter_input(INPUT_POST, 'contact_id', FILTER_VALIDATE_INT);
$first_name = filter_input(INPUT_POST, 'first_name');
$last_name = filter_input(INPUT_POST, 'last_name');
$email = filter_input(INPUT_POST, 'Email');
$phone = filter_input(INPUT_POST, 'phone');
$DOB = filter_input(INPUT_POST, 'DOB');

$queryContacts = 'SELECT * FROM contacts'; //retrieve variable
$statement1 = $db-> prepare($queryContacts); //connecting data and webpage
$statement1-> execute(); //running the connection while requested
$contacts = $statement1-> fetchAll(); //retrieving All the data from the DB with creating the variable
$statement1-> closeCursor();//after data is fetched the dt connection closes

foreach($contacts as $contact){
    if($email == $contact['eMail'] && $contact_id != $contact['contactID']){
        $_SESSION['add_error'] = 'User already exists. Please Check your fields for any type mistakes';
        //redirecting to an error page
        $url = "error.php";
        header("Location: " . $url); //header is the method to redirect
        die();
    }
}



// Validate the inputs
if ($contact_id == null || $first_name == null || $last_name == null || $email == null || $phone == null || $DOB == null) {
    $_SESSION['add_error'] = 'Invalid contact data. Please make sure all fields are filled';
    header("Location: error.php");
    die();
}

// Update existing contact
$query = 'UPDATE contacts SET firstName = :firstName, lastName = :lastName, Email = :Email, phone = :phone, DOB = :DOB WHERE contactID = :contact_id';
$statement = $db->prepare($query);
$statement->bindValue(':contact_id', $contact_id, PDO::PARAM_INT);
$statement->bindValue(':firstName', $first_name);
$statement->bindValue(':lastName', $last_name);
$statement->bindValue(':Email', $email);
$statement->bindValue(':phone', $phone);
$statement->bindValue(':DOB', $DOB);

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
header("Location: update_confirmation.php");
die();
?>
