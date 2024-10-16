
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact manager - LOGIN</title>
  <link rel="stylesheet" type = "text/css" href="CSS/CSS.css">
</head>
<body>
  <?php include("header.php"); ?>
  <main>
    <h2>LOGIN</h2>
    <form action = "login.php" method = "post">
      <div id ="data">
        <div class="labs">
          <label for="">User name:</label>
          <input type="text" name = "user_name"><br>
        </div>
        
        <div class="labs">
          <label for="">Password:</label>
          <input type="password" name = "password"><br>
        </div>
       
      <div id ="buttons">
      <input type="submit" value="Login"><br>
      </div>
    </form>
  </main>
<?php include("footer.php")?>
</body>
</html>