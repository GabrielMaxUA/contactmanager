<?php
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
        <th>&nbsp</th> <!-- for edit button -->
        <th>&nbsp</th> <!-- for delete button -->
      </tr>
        <?php foreach($contacts as $contact):?> <!--: instead of { } like in other languages -->
         <tr>
          <td><?php echo $contact['firstName'];?></td>
          <td><?php echo $contact['lastName'];?></td>
          <td><?php echo $contact['eMail'];?></td>
          <td><?php echo $contact['phone'];?></td>
          <td></td> <!-- for edit button -->
          <td></td> <!-- for delete button -->
         </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="add_contact_form.php">Add contact</a></p>
    
  </main>
<?php include("footer.php")?>
</body>
</html>