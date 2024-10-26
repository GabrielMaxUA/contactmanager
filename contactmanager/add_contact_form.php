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
  <title>Contact manager - Add Contact</title>
  <link rel="stylesheet" type = "text/css" href="CSS/CSS.css">
</head>
<body>
  <?php include("header.php"); ?>
  <main>
    <h2>Add contact</h2>
    <form action = "add_contact.php" method = "post" enctype = "multipart/form-data
    ">
      <div id ="data">
        <div class="labs">
          <label for="">First name:</label>
          <input type="text" name = "first_name"><br>
        </div>
        
        <div class="labs">
          <label for="">Last name:</label>
          <input type="text" name = "last_name"><br>
        </div>
        
        <div class="labs">
          <label for="">Email:</label>
          <input type="text" name = "Email"><br>
        </div>
      
        <div class="labs">
          <label for="">Phone:</label>
          <input type="text" name = "phone"><br>
        </div>

        <div class="labs" id = "date">
          <label for="">DOB:</label>
          <input type="date" name = "DOB"><br>
        </div>


        <div class="labs" id = "image1">
          <label for="">Upload Image:</label>
          <input type="hidden" name="action" value="upload">
          <input type="file" name = "file1"><br>
        </div>
        
        <div class="labs" id = "Labs">
          <label for="">Status:</label>
              <div class="inputs">
                <input type="radio" name = "status" value = "member">Member<br>
                <input type="radio" name = "status" value = "nonmember" checked>Non-Member<br>
              </div>
        </div>

        <div id ="buttons">
          <input type="hidden" name="contact_id" value="<?php echo $contact_id; ?>">
          <input type="button" value="Cancel" onclick="window.location.href='index.php';"><br>
          <input type="submit" value="Save Contact"><br>
        </div>
      </div>

    </form>
    <p><a href="index.php">View contacts</a></p>
    
  </main>
<?php include("footer.php")?>
</body>
</html>