<?php
include 'connect.php';
include 'nav.php';

$showAlert=false;
$showError=false;

if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    if($_FILES["image"]["error"] == 4){
        echo "<script> alert('image does not Exist'); </script>";
    }
    else{
        $filename = $_FILES["image"]["name"];
        $filesize = $_FILES["image"]["size"];
        $tmpname = $_FILES["image"]["tmp_name"];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $filename);
        $imageExtension = strtolower(end($imageExtension));
        if( !in_array($imageExtension, $validImageExtensions)){
            echo "<script> alert('Invalid Image Extension'); </script>";
        }
        else if($filesize > 1000000){
            echo "<script> alert('image size is too large'); </script>";
        }
        else{
            $newImageName = uniqid();
            $newImageName .= '.' .$imageExtension;

            move_uploaded_file($tmpname, 'img/' . $newImageName);
            $existSql="SELECT * FROM `crud` WHERE email='$email'";
            $result = mysqli_query($conn,$existSql);
            $numExistRows=mysqli_num_rows($result);
            if($numExistRows > 0){
                $showError= "User already exists";
            }
        
            else{
                if(($password == $cpassword)){
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `crud` (`name`, `email`, `mobile`, `password`, `image`) VALUES ('$name', '$email', '$mobile', '$hash', '$newImageName')";
                    $results = mysqli_query($conn,$sql);
                    if($results){
                        $showAlert=true;
                        header("location:login.php");
                    }
                }
                else{
                $showError="Passwords do not match";
                }
            }
            echo  "<script> alert('Successfully Added'); 
            document.location.href = ''</script>";
        }
    }

    
    


}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.rtl.min.css">

    <title>CRUD Application</title>
  </head>
  <body>
    <?php
    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible" fade show" role="alert">
            <strong>Success!</strong> Your account is now created. 
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"></span></button>
            </div>';
    }
    if($showError){
        echo '<div class="alert alert-danger alert-dismissible" fade show" role="alert">
            <strong>Error!</strong> '.$showError.' 
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"></span></button>
            </div>';
    }
    ?>
    <div class="container my-5">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Input your name" name="name" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Input your email" name="email" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Mobile</label>
                <input type="text" class="form-control" placeholder="Input your mobile" name="mobile" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Choose Image</label>
                <input type="file" class="form-control" name="image" accept=".jpg, .jpeg, .png" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Input your password" name="password" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" placeholder="Confirm your password" name="cpassword" autocomplete="off">
                <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
            </div>
  <button type="submit" class="btn btn-primary" name="submit">SignUp</button>
</form>
    </div>
  </body>
</html>