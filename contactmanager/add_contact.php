

<?php

    session_start();
    require_once 'database.php';
    //require_once 'image_util.php'; // the process_image function
    
    // Getting data from the form
    $first_name = filter_input(INPUT_POST, 'first_name');
    $last_name = filter_input(INPUT_POST, 'last_name');
    $email = filter_input(INPUT_POST, 'Email');
    $phone = filter_input(INPUT_POST, 'phone');
    $status = filter_input(INPUT_POST, 'status');
    $DOB = filter_input(INPUT_POST, 'DOB');
    $imageName = $_FILES['cImage']['name'];

        
//validating the inputs from add_contact_form
if ($first_name == null || $last_name == null || $email == null || $phone == null || $DOB == null) {
    $_SESSION['add_error'] = 'Invalid contact data. Please make sure all fields are filled';
    //redirecting to an error page
    $url = "error.php";
    header("Location: " . $url); //header is the method to redirect
    die(); // similar to return or break 
} else {
   //connecting to the database once or per request
   
   $queryContacts = 'SELECT * FROM contacts';
   $statement1 = $db->prepare($queryContacts);
   $statement1->execute();
   $contacts = $statement1->fetchAll();
   $statement1->closeCursor();

   foreach ($contacts as $contact)
   {
       if ($email_address == $contact["emailAddress"])
       {
           $_SESSION["add_error"] = "Invalid data, Duplicate Email Address. Try again.";

           $url = "error.php";
           header("Location: " . $url);
           die();
       }
   }

   $image_dir = 'uploads';
   $image_dir_path = getcwd() . DIRECTORY_SEPARATOR . $image_dir;

   if (isset($_FILES['cImage'])) {
       $filename = $_FILES['cImage']['name'];
       
       if (!empty($filename)) {
           $source = $_FILES['cImage']['tmp_name'];
           
           $target = $image_dir_path . DIRECTORY_SEPARATOR . $filename;
           
           move_uploaded_file($source, $target);
           // create the '400' and '100' versions of the image
           //process_image($image_dir_path, $filename);
       }
   }

    //adding data to the database
    $query = "INSERT INTO contacts (firstName, lastName, Email, phone, status, DOB, imageName ) 
        VALUES (:firstName, :lastName, :Email, :phone, :status, :DOB, :imageName)";
    $statement = $db->prepare($query);
    $statement->bindValue(':firstName', $first_name);
    $statement->bindValue(':lastName', $last_name);
    $statement->bindValue(':Email', $email);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':status', $status);
    $statement->bindValue(':DOB', $DOB);
    $statement->bindValue(':imageName', $imageName);

    $statement->execute();
    $statement->closeCursor();
}

$_SESSION['fullName'] = $first_name . ' ' . $last_name;

// redirecting to confirmation page
$url = "confirmation.php";
header("Location: " . $url); //header is the method to redirect
die();
?>
