<?php
  session_start()
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
    <h2>Database Error</h2>
    <p>Error conecting to the database... Please try gain later
      </p>
    <p>The database must be instaled
      </p>
    <p>MySQL must be running
      </p>
    <p> Error message: <?php echo $_SESSION["database_error"];
      ?>
      </p>
    <p>
      <a href="index.php">Back to Contact List</a>
      </p>
  </main>
<?php include("footer.php")?>
</body>
</html>
