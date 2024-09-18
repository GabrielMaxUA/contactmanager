<?php
require("database.php");// ' or " doesnt really matter in php.
$queryContacts = 'SELECT * FROM contacts';
$statement1 = $db-> prepare($queryContacts);
$statement1-> execute();
$contacts = $statement1-> fetchAll();
$statement1-> closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact manager - Home</title>
  <link rel="stylesheet" type = "text/css" href="CSS.css">
</head>
<body>
  <?php include("header.php"); ?>
  <main>
    <h2>Work in progress</h2>
    
  </main>
<?php include("footer.php")?>
</body>
</html>