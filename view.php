<?php

include 'connect.php';
include 'nav.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.rtl.min.css">

</head>
<body>
    <div class="container my-5">
        <table class="table" border = 1 cellspacing = 0 cellpadding = 10>
  <thead>   
    <tr>
      <th scope="col">S No.</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile</th>
      <th scope="col">Image</th>
   </tr>
  </thead>
  <tbody>

<?php
$i = 1;
$rows = mysqli_query($conn, "SELECT * FROM crud ORDER BY id DESC")
?>

<?php
foreach($rows as $row) : ?>
<tr>
  <td><?php echo $i++; ?></td>
  <td><?php echo $row["name"]; ?></td>
  <td><?php echo $row["email"]; ?></td>
  <td><?php echo $row["mobile"]; ?></td>
  <td><img src = "img/<?php echo $row["image"]; ?>" width = 200 title = "<?php echo $row['image']; ?>"> </td>
</tr>

<?php endforeach; ?>
    
  </tbody>
</table>
    </div>
    
</body>
</html>