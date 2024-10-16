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
    <h2>Login Confirmation</h2>
    <p>Welcome, <?php echo $_SESSION['userName'] ?>. </p>
    <p>Nice to see you again!</p>
    <p>We look foraward working with you</p>
    <p>your login status is <?php echo $_SESSION['isLoggedIn']?></p>
    
      <a href="index.php">Contact List</a>
      </p>
  </main>
<?php include("footer.php")?>
</body>
</html>
