<?php
session_start();

if(!isset($_SESSION['isLoggedIn'])){
  $_SESSION = [];
  session_destroy();
  header("Location: login_form.php");
  die();
}

require("database.php");// ' or " doesnt really matter in php.
$queryContacts = 'SELECT * FROM contacts'; //retrieve variable
$statement1 = $db-> prepare($queryContacts); //connecting data and webpage
$statement1-> execute(); //running the connection while requested
$contacts = $statement1-> fetchAll(); //retrieving All the data from the DB with creating the variable
$statement1-> closeCursor();//after data is fetched the dt connection closes
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact manager - Home</title>
  <link rel="stylesheet" type = "text/css" href="CSS/CSS.css">
</head>
<body>
  <?php include("header.php"); ?>
  <main>
    <h2>Contacts</h2>
    <table>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Status</th>
        <th>DOB</th> 
        <th>&nbsp</th> <!-- for edit button -->
        <th>&nbsp</th> <!-- for delete button -->
      </tr>
        <?php foreach($contacts as $contact):?> <!--: instead of { } like in other languages -->
         <tr>
          <td><?php echo $contact['firstName'];?></td>
          <td><?php echo $contact['lastName'];?></td>
          <td><?php echo $contact['eMail'];?></td>
          <td><?php echo $contact['phone'];?></td>
          <td><?php echo $contact['status'];?></td>
          <td><?php echo $contact['DOB'];?></td>
          <td>
          <form action="update_contact_form.php" method="post">
              <input type="hidden" name="contact_id" value="<?php echo $contact['contactID']; ?>">  
              <input type="submit" value="Update">
          </form>

          </td> <!-- for edit button -->
          <td>
            <form action = "delete_contact.php" method = "post">
            <input type="hidden" name = "contact_id" value = "<?php echo $contact['contactID'];?>"/>  
            <input type="submit" value = "Delete"/>
            </form>
          </td> <!-- for delete button -->
         </tr>
        <?php endforeach; ?> <!-- end of forearch loop -->
    </table>
    <p><a href="add_contact_form.php">Add contact</a></p>
    <p><a href="logout.php">Logout</a></p>
    
  </main>
<?php include("footer.php")?>
</body>
</html>