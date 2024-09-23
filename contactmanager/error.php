<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact manager - Database Error</title>
  <link rel="stylesheet" type = "text/css" href="CSS.css">
</head>
<body>
  <?php include("header.php"); ?>
  <main>
    <h2>Error</h2>
   
    <p><?php echo $_SESSION["add_error"];?>
      </p>
    <p>
      <a href="index.php">Back to Home page</a>
      <a href="add_contact_form.php">Back to Contact From</a>
    </p>
  </main>
<?php include("footer.php")?>
</body>
</html>
