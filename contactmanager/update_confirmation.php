<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact manager - Update Confirmation</title>
  <link rel="stylesheet" type = "text/css" href="CSS/CSS.css">
</head>
<body>
  <?php include("header.php"); ?>
  <main id = "confirmation">
    <h2>Contact Update Confirmation</h2>
    <p><?php echo $_SESSION['fullName']; ?>. </p>
    <p>We updated your contact information</p>
    <p>We look foraward to continuing to work with you</p>
      <a href="index.php">Back to Home page</a>
      </p>
  </main>
<?php include("footer.php")?>
</body>
</html>
