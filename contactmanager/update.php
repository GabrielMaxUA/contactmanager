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
$imageName = $_FILES['cImage']['name'];

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

   
// if (isset($_FILES['cImage'])) {
//     $filename = $_FILES['cImage']['name'];
    
//     if (!empty($filename)) {
//         $image_dir = 'uploads';
//         $image_dir_path = getcwd() . DIRECTORY_SEPARATOR . $image_dir;
        
//         if (!empty($contact['imageName'])) {
//             // Old image exists, move it to the "purchased" folder
//             $Pimage_dir = 'purchased';
//             $Pimage_dir_path = getcwd() . DIRECTORY_SEPARATOR . $Pimage_dir;

//             // Ensure the purchased folder exists
//             if (!is_dir($Pimage_dir_path)) {
//                 mkdir($Pimage_dir_path, 0777, true);
//             }
            
//             // Path of the old image to be moved
//             $old_image_path = $image_dir_path . DIRECTORY_SEPARATOR . $contact['imageName'];
            
//             // Target path in the "purchased" folder
//             $purchased_image_target = $Pimage_dir_path . DIRECTORY_SEPARATOR . $contact['imageName'];
           
//             if (file_exists($old_image_path)) {
//                 rename($old_image_path, $purchased_image_target);
//             }
//         }
        
//         // Process the new image upload
//         $source = $_FILES['cImage']['tmp_name'];
//         $target = $image_dir_path . DIRECTORY_SEPARATOR . $filename;
        
//         move_uploaded_file($source, $target);
//     }
// }
// Image processing
if ($imageName) { // Only if a new image was uploaded
    $image_dir = 'uploads';
    $image_dir_path = getcwd() . DIRECTORY_SEPARATOR . $image_dir;
    
    // Move existing image to "purchased" if it exists
    if (!empty($contact['imageName'])) {
        $Pimage_dir = 'purchased';
        $Pimage_dir_path = getcwd() . DIRECTORY_SEPARATOR . $Pimage_dir;

        if (!is_dir($Pimage_dir_path)) {
            mkdir($Pimage_dir_path, 0777, true);
        }
        
        $old_image_path = $image_dir_path . DIRECTORY_SEPARATOR . $contact['imageName'];
        $purchased_image_target = $Pimage_dir_path . DIRECTORY_SEPARATOR . time() . '_' . $currentContact['imageName'];
        
        if (file_exists($old_image_path)) {
            rename($old_image_path, $purchased_image_target);
        }
    }
    
    // Process the new image upload
    $source = $_FILES['cImage']['tmp_name'];
    $target = $image_dir_path . DIRECTORY_SEPARATOR . $imageName;
    move_uploaded_file($source, $target);
} else {
    // Keep the current image if no new image was uploaded
    $imageName = $contact['imageName'];
}
          


// Validate the inputs
if ($contact_id == null || $first_name == null || $last_name == null || $email == null || $phone == null || $DOB == null) {
    $_SESSION['add_error'] = 'Invalid contact data. Please make sure all fields are filled';
    header("Location: error.php");
    die();
}

// Update existing contact
$query = 'UPDATE contacts SET firstName = :firstName, lastName = :lastName, Email = :Email, phone = :phone, DOB = :DOB , imageName = :imageName 
WHERE contactID = :contact_id';
$statement = $db->prepare($query);
$statement->bindValue(':contact_id', $contact_id, PDO::PARAM_INT);
$statement->bindValue(':firstName', $first_name);
$statement->bindValue(':lastName', $last_name);
$statement->bindValue(':Email', $email);
$statement->bindValue(':phone', $phone);
$statement->bindValue(':DOB', $DOB);
$statement->bindValue(':imageName', $imageName);

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
