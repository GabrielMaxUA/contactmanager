<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact manager - Confirmation</title>
  <link rel="stylesheet" type = "text/css" href="CSS/CSS.css">
</head>
<body>
  <?php include("header.php"); ?>
  <main id = "confirmation">
    <h2>registration Confirmation</h2>
    <p>Thank you, <?php echo $_SESSION['userName']; ?>. </p>
    <p>Saving your contact information</p>
    <p>We look foraward working with you</p>
      <a href="index.php">Contact List</a>
      </p>
  </main>
<?php include("footer.php")?>
</body>
</html>
