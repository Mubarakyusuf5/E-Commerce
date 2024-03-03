<?php
include "conn.php";

if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION["id"];
$sql = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($con, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: login.php");
    exit;
}

// $row = mysqli_fetch_assoc($result);

$product = null;

if (isset($_GET['view'])) {
    $productId = $_GET['view'];
    $sql = "SELECT * FROM products WHERE id = '$productId'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    }
}

if (isset($_POST['cbtn'])) {
    $cname = $_POST['cname'];
    $cprice = $_POST['cprice'];
    $cimage = $_POST['cimage'];
    $cquantity = 1;

    $cselect = "SELECT * FROM `cart` WHERE cname = '$cname'";
    $cresult = mysqli_query($con, $cselect);
    if (mysqli_num_rows($cresult) > 0) {
        $messages[] = 'Product already added';
    } else {
        $cinsert = "INSERT INTO `cart` (cname, cprice, cimage, cquantity) VALUES ('$cname', '$cprice', '$cimage', '$cquantity')";
        mysqli_query($con, $cinsert);
        $messages[] = 'Product added to cart successfully!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main page</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .container {
            font-family: Arial, sans-serif;
        }

        .message {
            background: #383636;
            position: sticky;
            top: 0;
            left: 0;
            z-index: 1000;
            /* border-radius: .5rem; */
            padding: 1.5rem 5%;
            max-width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
        }

        .message span {
            font-size: 1.1em;
            color: #f5f5f5;
        }

        .message svg {
            cursor: pointer;
            color: #f5f5f5;
        }

        form {
            display: flex;
            gap: 40px;
            width: 800px;
        }

        .cont {
            padding: 40px 0;
            margin-top: 19px;
        }

        .cont h2 {
            font-size: 1.8em;
        }

        .cont p {
            font-size: 1.1em;
        }

        .cont .pr {
            margin: 20px 0;
        }

        .cont .de {
            line-height: 1.5;
            margin-bottom: 20px;
        }

        img {
            width: 350px;
            height: 350px;
            object-fit: contain;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            border: none;
            outline: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body>
    <?php
    if (isset($messages)) {
        foreach ($messages as $message) {
            echo '<div class="message"><span>' . $message . '</span> <svg onclick="this.parentElement.style.display = `none`" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 352 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg></div>';
        }
    }
    ?>
    <?php
    include("header.php");
    ?>

    <div class="container">
        <?php if (isset($product)) { ?>
            <form action="" method="post">
                <img src="images/<?php echo $product['pimage']; ?>" alt="<?php echo $product['pname']; ?>">
                <div class="cont">
                    <h2>
                        <?php echo $product['pname']; ?>
                    </h2>
                    <p class="pr">
                        Price: &#x20A6;<?php echo number_format($product['pprice']); ?>
                    </p>
                    <p class="de">
                        Description:
                        <?php echo $product['pdesc'] ?>
                    </p>
                    <input type="hidden" name="cname" value="<?php echo $product['pname']; ?>">
                    <input type="hidden" name="cprice" value="<?php echo $product['pprice']; ?>">
                    <input type="hidden" name="cimage" value="<?php echo $product['pimage']; ?>">
                    <button href="#" type="submit" name="cbtn" class="btn">Add to Cart</button>
                    <a href="checkout.php?checkout=<?= $product['id']?>" type="submit" class="btn btn-secondary">Order Now</a>
                <?php } else { ?>
                    <p>No product selected.</p>
                <?php } ?>
            </div>
        </form>
    </div>

    <script src="main.js"></script>
</body>

</html>