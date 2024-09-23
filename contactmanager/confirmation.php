<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact manager - Confirmation</title>
  <link rel="stylesheet" type = "text/css" href="CSS.css">
</head>
<body>
  <?php include("header.php"); ?>
  <main>
    <h2>Contact Confirmation</h2>
    <p>Thank you, <?php echo $SESSION['fullName']; ?>. </p>
    <p>Saving your contact information</p>
    <p>We look foraward working with you</p>
      <a href="index.php">Back to Home page</a>
      </p>
  </main>
<?php include("footer.php")?>
</body>
</html>
