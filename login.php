<?php
include 'conn.php';

if (!empty($_SESSION["id"])) {
    header("Location: index.php");
}

if(isset($_POST['btn'])){
    $unameEmail = $_POST['unameEmail'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE uname = '$unameEmail' OR email = '$unameEmail'";
    $result = mysqli_query($con, $sql);
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            session_start();
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header('location:index.php');
        } else {
            echo  "<script>alert('Wrong password')</script>";
        }
    } else {
        echo "<script>alert('User Not Registered')</script>";
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
        <h2>Login</h2>
        <div class="form-group">
            <input type="text" name="unameEmail" required>
            <span>Username or Email</span>
        </div>
        <div class="form-group">
            <input type="password" name="password" autocomplete="new-password" required>
            <span>Password</span>
        </div>
        <a href="404.php" class="frgt">Forgot password?</a>
        <input type="submit" value="Login" name="btn" class="btn">
        <p class="sign-up">Don't have an account? <a href="signup.php" >Signup</a></p>
    </form>
    </body>
</html>