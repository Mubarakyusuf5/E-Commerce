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
if (isset($_POST["upq-btn"])) {
    $upquantity = $_POST["upquantity"];
    $upquantity_id = $_POST["upquantity_id"];
    $up_sql = "UPDATE `cart` SET cquantity = '$upquantity' WHERE id = '$upquantity_id'";
    $result = mysqli_query($con, $up_sql);
    if ($result) {
        header("location: cart.php");
    }
}

if (isset($_GET["remove"])) {
    $remid = $_GET["remove"];
    $remsql = "DELETE FROM `cart` WHERE id = '$remid'";
    $result = mysqli_query($con, $remsql);
    if ($result) {
        header("location: cart.php");
    }
}

if (isset($_GET["delete-all"])) {
    $delid = $_GET["delete-all"];
    $delsql = "DELETE FROM `cart` ";
    $result = mysqli_query($con, $delsql);
    if ($result) {
        header("location:cart.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="Aproduct.css">
</head>
<style>
    body {
        background: #eee;
    }

    .container1 {
        background: #eee;
        padding: 30px 5%;
    }

    h1 {
        text-align: center;
        font-size: 2.1em;
        margin-bottom: 30px;
    }

    table {
        margin: 0 auto;
        width: 80%;
        margin-bottom: 20px;
    }

    .container1 th,
    td {
        border: 1px solid #eee;
    }

    .container1 .mk {
        background: #dddada;
    }

    .container1 table td {
        border-bottom: 1px solid #000;
    }

    table tr {
        background: #eee;
    }

    input {
        width: 60px;
        padding: 8px;
    }

    .del:last-child {
        min-width: 90px;
    }

    .upd {
        padding: 10px 6px;
        margin-left: 3px;
        font-size: .8em;
        font-weight: 600;
        color: #fff;
        background: #E2B522;
        border: none;
        outline: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .upd:hover {
        background: #CBA21A;
    }

    .check {
        display: block;
        text-align: center;
        width: 190px;
        margin: 0 auto;
        background: #5aaa67;
        padding: 10px;
        color: #fff;
        border-radius: 7px;
    }
    .check:hover{
        background: #478a52;
    }

    .check.disabled {
        pointer-events: none;
        opacity: .5;
    }
</style>

<body>
    <?php
    include("header.php");
    ?>
    <div class="container1">
        <h1>Shopping Cart</h1>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "Select * From `cart`";

                $g_total = 0; // Initialize $g_total here
                
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><img src='images/<?php echo $row['cimage'] ?>'></td>
                            <td>
                                <?php echo $row['cname'] ?>
                            </td>
                            <td>&#x20A6;
                                <?php echo number_format($row['cprice']) ?>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="upquantity_id" value="<?php echo $row['id'] ?>">
                                    <input type='number' name="upquantity" min="1"
                                        value="<?php echo $row['cquantity'] ?>"><button type="submit" name="upq-btn"
                                        class="upd">Update</button>
                                </form>
                            </td>
                            <td>&#x20A6;
                                <?php echo number_format($s_total = $row['cprice'] * $row['cquantity']) ?>
                            </td> <!-- Removed number_format() here -->
                            <td><a href="cart.php?remove=<?php echo $row['id'] ?>"
                                    onclick="return confirm('Remove item from cart?')" class='del'><svg width="64px"
                                        height="64px" viewBox="-3 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <title>trash</title>
                                            <desc>Created with Sketch Beta.</desc>
                                            <defs> </defs>
                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                                sketch:type="MSPage">
                                                <g id="Icon-Set" sketch:type="MSLayerGroup"
                                                    transform="translate(-259.000000, -203.000000)" fill="#eee">
                                                    <path
                                                        d="M282,211 L262,211 C261.448,211 261,210.553 261,210 C261,209.448 261.448,209 262,209 L282,209 C282.552,209 283,209.448 283,210 C283,210.553 282.552,211 282,211 L282,211 Z M281,231 C281,232.104 280.104,233 279,233 L265,233 C263.896,233 263,232.104 263,231 L263,213 L281,213 L281,231 L281,231 Z M269,206 C269,205.447 269.448,205 270,205 L274,205 C274.552,205 275,205.447 275,206 L275,207 L269,207 L269,206 L269,206 Z M283,207 L277,207 L277,205 C277,203.896 276.104,203 275,203 L269,203 C267.896,203 267,203.896 267,205 L267,207 L261,207 C259.896,207 259,207.896 259,209 L259,211 C259,212.104 259.896,213 261,213 L261,231 C261,233.209 262.791,235 265,235 L279,235 C281.209,235 283,233.209 283,231 L283,213 C284.104,213 285,212.104 285,211 L285,209 C285,207.896 284.104,207 283,207 L283,207 Z M272,231 C272.552,231 273,230.553 273,230 L273,218 C273,217.448 272.552,217 272,217 C271.448,217 271,217.448 271,218 L271,230 C271,230.553 271.448,231 272,231 L272,231 Z M267,231 C267.552,231 268,230.553 268,230 L268,218 C268,217.448 267.552,217 267,217 C266.448,217 266,217.448 266,218 L266,230 C266,230.553 266.448,231 267,231 L267,231 Z M277,231 C277.552,231 278,230.553 278,230 L278,218 C278,217.448 277.552,217 277,217 C276.448,217 276,217.448 276,218 L276,230 C276,230.553 276.448,231 277,231 L277,231 Z"
                                                        id="trash" sketch:type="MSShapeGroup"> </path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg></a></td>
                        </tr>
                        <?php
                        $g_total += $s_total; // Add to $g_total here
                    }
                }
                ?>

                <tr class="mk">
                    <td><a href='index.php' class="btn">Continue Shopping</a></td>
                    <td colspan='3'>Grand total</td>
                    <td>&dollar;
                        <?php echo number_format($g_total); ?>
                    </td>
                    <td><a href="cart.php?delete-all" onclick="return confirm('Are sure you want to delete all?')"
                            class='del'><svg width="64px"
                                        height="64px" viewBox="-3 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <title>trash</title>
                                            <desc>Created with Sketch Beta.</desc>
                                            <defs> </defs>
                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                                sketch:type="MSPage">
                                                <g id="Icon-Set" sketch:type="MSLayerGroup"
                                                    transform="translate(-259.000000, -203.000000)" fill="#eee">
                                                    <path
                                                        d="M282,211 L262,211 C261.448,211 261,210.553 261,210 C261,209.448 261.448,209 262,209 L282,209 C282.552,209 283,209.448 283,210 C283,210.553 282.552,211 282,211 L282,211 Z M281,231 C281,232.104 280.104,233 279,233 L265,233 C263.896,233 263,232.104 263,231 L263,213 L281,213 L281,231 L281,231 Z M269,206 C269,205.447 269.448,205 270,205 L274,205 C274.552,205 275,205.447 275,206 L275,207 L269,207 L269,206 L269,206 Z M283,207 L277,207 L277,205 C277,203.896 276.104,203 275,203 L269,203 C267.896,203 267,203.896 267,205 L267,207 L261,207 C259.896,207 259,207.896 259,209 L259,211 C259,212.104 259.896,213 261,213 L261,231 C261,233.209 262.791,235 265,235 L279,235 C281.209,235 283,233.209 283,231 L283,213 C284.104,213 285,212.104 285,211 L285,209 C285,207.896 284.104,207 283,207 L283,207 Z M272,231 C272.552,231 273,230.553 273,230 L273,218 C273,217.448 272.552,217 272,217 C271.448,217 271,217.448 271,218 L271,230 C271,230.553 271.448,231 272,231 L272,231 Z M267,231 C267.552,231 268,230.553 268,230 L268,218 C268,217.448 267.552,217 267,217 C266.448,217 266,217.448 266,218 L266,230 C266,230.553 266.448,231 267,231 L267,231 Z M277,231 C277.552,231 278,230.553 278,230 L278,218 C278,217.448 277.552,217 277,217 C276.448,217 276,217.448 276,218 L276,230 C276,230.553 276.448,231 277,231 L277,231 Z"
                                                        id="trash" sketch:type="MSShapeGroup"> </path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>all</a></td>
                </tr>
            </tbody>
        </table>

        <a href="Checkout.php" class="check <?= ($g_total > 1) ? '' : 'disabled' ?>">Proceed To Checkout</a>
    </div>
    <script src="main.js"></script>
</body>

</html>