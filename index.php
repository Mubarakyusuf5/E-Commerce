<?php
include "conn.php";
if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main page</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
   
<?php
    include("header.php");
    ?>
    <div class="container">
        <h1>Shopping Data</h1>
        <div class="category_con">
            <div class="sidebar">
                <div class="head">Categories</div>
                <ul class="side">
                    <li><a href="jlc.php">Jewelry & Accessories</a></li>
                    <li><a href="bkc.php">Books & Media</a></li>
                    <li><a href="Fc.php">Food & Beverage</a></li>
                    <li><a href="clth.php">Clothing & Apparel</a></li>
                    <li><a href="Elec.php">Electronics</a></li>
                </ul>
            </div>
            
            
        </div>
    </div>
    <script src="main.js"></script>
</body>

</html>
