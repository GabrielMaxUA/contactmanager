<?php
require_once("database.php"); // Connect to the database

// Get the contact_id from the form submission using POST
$contact_id = filter_input(INPUT_POST, 'contact_id', FILTER_VALIDATE_INT);

if ($contact_id) {
    // Query to retrieve the contact details based on contact_id
    $query = 'SELECT * FROM contacts WHERE contactID = :contact_id'; 
    $statement1 = $db->prepare($query);
    $statement1->bindValue(':contact_id', $contact_id);
    $statement1->execute();
    $contact = $statement1->fetch(); // Fetch the specific contact
    $statement1->closeCursor();

    // Check if the contact exists
    if ($contact) {
        // Extract the contact details and ensure the correct column names
        $first_name = $contact['firstName'];
        $last_name = $contact['lastName'];
        $email = $contact['eMail']; // Ensure column name matches exactly in the database
        $phone = $contact['phone'];
    } else {
        // If no contact found, redirect to an error page
        header("Location: error.php");
        die();
    }
} else {
    // If contact_id is not valid, redirect to an error page or handle the error
    header("Location: error.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Manager - Update Contact</title>
  <link rel="stylesheet" type="text/css" href="CSS/CSS.css">
</head>
<body>
  <?php include("header.php"); ?>
  <main>
    <h2>Update Contact</h2>
    <form action="update.php" method="post">
      <div id ="data">
        <div class="labs">
          <label for="first_name">First Name:</label>
          <input type="text" name="first_name" value="<?php echo $contact['firstName'];?>"><br>
        </div>
        
        <div class="labs">
          <label for="last_name">Last Name:</label>
          <input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>"><br>
        </div>
        
        <div class="labs">
          <label for="Email">Email:</label>
          <input type="text" name="Email" value="<?php echo htmlspecialchars($email); ?>"><br>
        </div>
      
        <div class="labs">
          <label for="phone">Phone:</label> 
          <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>"><br>
        </div>
        
        <div class="labs" id = "Labs">
          <label for="">Status:</label>
            <input type="radio" name = "status" value = "member" <?php echo ($contact['status'] == 'member') ? 'checked' : '' ?>>
            Member<br>
            <input type="radio" name = "status" value = "nonmember" <?php echo ($contact['status'] == 'member') ? 'checked' : '' ?>checked>Non-Member<br>
        </div>
        <div id ="buttons">
          <input type="hidden" name="contact_id" value="<?php echo $contact_id; ?>">
          <input type="button" value="Cancel" onclick="window.location.href='index.php';"><br>
          <input type="submit" value="Save Contact"><br>
        </div>
          
      </div>
    </form>
    <p><a href="confirmation.php">View contacts</a></p>
  </main>
  <?php include("footer.php"); ?>
</body>
</html>
