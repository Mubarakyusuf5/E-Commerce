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
        <h1>Latest Product</h1>
        <h3 id="toggle">Electronics</h3>
        <!-- <hr> -->
        <div class="category_con">
            <div class="products">
            <?php
            $sql = "SELECT * FROM `products` WHERE pcategory = 'Electronics'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
            ?>   
                <div class="product">
                    <img src="images/<?php echo $row['pimage'] ?>" alt="hamburger">
                    <div class="info">
                        <h3><?php echo $row['pname'] ?></h3>
                        <p>&#x20A6;<?php echo number_format($row['pprice']) ?></p>
                        <a href="Vproduct.php?view=<?php echo $row['id'] ?>" class="btn">View Product</a>
                    </div>
                </div>
            <?php
                }
            }
            ?>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
</body>

</html>
