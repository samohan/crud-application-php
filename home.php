<?php
include 'user_auth.php';
include 'connect.php';
include 'nav.php';


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.rtl.min.css" integrity="sha384-T5m5WERuXcjgzF8DAb7tRkByEZQGcpraRTinjpywg37AO96WoYN9+hrhDVoM6CaT" crossorigin="anonymous">
    <title>crudapplication</title>
  </head>
  <body>
    <div class="conatiner my-3">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Welcome - <?php echo $_SESSION['email']; ?> </h4>
            <p>Hey, how are you doing? Welcome to our website. You are logged in as <?php echo $_SESSION['email']; ?> </p>
            <p class="mb-0">Go to the admin page by clicking <a href="display.php">here</a></p>
  </body>
</html>