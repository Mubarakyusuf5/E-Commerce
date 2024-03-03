<?php
include 'conn.php';

if (!empty($_SESSION["id"])) {
    header("Location: index.php");
}

if(isset($_POST['btn'])){
    $fname = $_POST['fname'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $cpassword = $_POST['cpassword'];
    
    $sql = "SELECT * FROM users WHERE uname='$uname' OR email='$email'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) > 0){
        echo "<script> alert('Username or Email has been taken') </script>";
    } else {
        if($password == $cpassword){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $query = "INSERT INTO `users` (fname, uname, email, password) 
                      VALUES('$fname', '$uname', '$email', '$hashed_password')";
            mysqli_query($con, $query);
            echo 
            header('location:login.php');
        } else {
            echo "<script>alert('Passwords do not match')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="form.css">

<body>
    <form method="post">
        <h2>Signup</h2>
        <div class="form-group">
            <input type="text" name="fname" required>
            <span>FullName</span>
        </div>
        <div class="form-group">
            <input type="text" name="uname" required>
            <span>Username</span>
        </div>
        <div class="form-group">
            <input type="email" name="email" required>
            <span>Email</span>
        </div>
        <div class="form-group">
            <input type="password" name="password" autocomplete="new-password" required>
            <span>Password</span>
        </div>
        <div class="form-group">
            <input type="password" name="cpassword" autocomplete="new-password" required>
            <span>Comfirm Password</span>
        </div>
        <input type="submit" value="Signup" name="btn" class="btn1">
        <p class="login">Already have an account? <a href="login.php" >login</a></p>
    </form>
    <script src="sweetalert/dist/sweetalert.min.js"></script>
    </body>
</html>