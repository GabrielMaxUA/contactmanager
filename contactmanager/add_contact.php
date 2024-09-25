<?php
session_start();
require_once('database.php');
//getting data from form
$first_name = filter_input(INPUT_POST, 'first_name');
$last_name = filter_input(INPUT_POST, 'last_name');
$email = filter_input(INPUT_POST, 'Email');
$phone = filter_input(INPUT_POST, 'phone');
$status = filter_input(INPUT_POST, 'status');


$queryContacts = 'SELECT * FROM contacts'; //retrieve variable
$statement1 = $db-> prepare($queryContacts); //connecting data and webpage
$statement1-> execute(); //running the connection while requested
$contacts = $statement1-> fetchAll(); //retrieving All the data from the DB with creating the variable
$statement1-> closeCursor();//after data is fetched the dt connection closes

foreach($contacts as $contact){
    if($email == $contact['eMail']){
        $_SESSION['add_error'] = 'User already exists. PLease Check your field for any type mistakes';
        //redirecting to an error page
        $url = "error.php";
        header("Location: " . $url); //header is the method to redirect
        die();
    }
}

// code to save data to SQL database
//validating the inputs from add_contact_form
if ($first_name == null || $last_name == null || $email == null || $phone == null) {
    $_SESSION['add_error'] = 'Invalid contact data. Please make sure all fields are filled';
    //redirecting to an error page
    $url = "error.php";
    header("Location: " . $url); //header is the method to redirect
    die(); // similar to return or break 
} else {
   //connecting to the database once or per request

    //adding data to the database
    $query = "INSERT INTO contacts (firstName, lastName, Email, phone, status) VALUES (:firstName, :lastName, :Email, :phone, :status)";
    $statement = $db->prepare($query);

    $statement->bindValue(':firstName', $first_name);
    $statement->bindValue(':lastName', $last_name);
    $statement->bindValue(':Email', $email);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':status', $status);

    $statement->execute();
    $statement->closeCursor();
}

$_SESSION['fullName'] = $first_name . ' ' . $last_name;

// redirecting to confirmation page
$url = "confirmation.php";
header("Location: " . $url); //header is the method to redirect
die();
?>
