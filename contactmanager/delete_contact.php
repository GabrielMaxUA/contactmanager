<?php
require_once('database.php');
//getting data from form
$contactID = filter_input(INPUT_POST, 'contact_id', FILTER_VALIDATE_INT);

// code to save data to SQL database
//validating the inputs from add_contact_form
if ($contactID != false) {
      //adding data to the database
      $query = "DELETE FROM contacts WHERE contactID = :contact_id";
      $statement = $db->prepare($query);
      $statement->bindValue(':contact_id', $contactID);
     
      $statement->execute();
      $statement->closeCursor();
}

// redirecting to confirmation page
$url = "index.php";
header("Location: " . $url); //header is the method to redirect
die();
?>
