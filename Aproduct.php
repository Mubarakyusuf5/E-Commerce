<?php
include "conn.php";

if (isset($_SESSION["id"])) { 
    $id = $_SESSION["id"];
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: login.php");
    exit(); 
}

if (isset($_POST['button'])) {
    $pname = mysqli_real_escape_string($con, $_POST['pname']);
    $pprice = mysqli_real_escape_string($con, $_POST['pprice']);
    $pdesc = mysqli_real_escape_string($con, $_POST['pdesc']);
    $pcategory = mysqli_real_escape_string($con, $_POST['pcategory']);
    $pimage = $_FILES['pimage']['name'];
    $pimage_tmp_name = $_FILES['pimage']['tmp_name'];
    $pimage_folder = 'images/' . $pimage;

    $sql_in = "INSERT INTO products (pname, pprice, pdesc, pcategory, pimage) VALUES('$pname','$pprice','$pdesc','$pcategory','$pimage')";
    $result_in = mysqli_query($con, $sql_in) or die("query failed");
    if ($result_in) {
        move_uploaded_file($pimage_tmp_name, $pimage_folder);
        $messages[] = 'Product added successfully';
    } else {
        $messages[] = 'Product could not be added';
    }
}

if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($con, $_GET['delete']);
    $sql_del = "DELETE FROM products WHERE id = $id ";
    $result_del = mysqli_query($con, $sql_del);
    if ($result_del) {
        $messages[] = "Product deleted successfully";
        header("Location: Aproduct.php");
        exit();
    } else {
        $messages[] = "Error deleting Product";
    }
}

if (isset($_POST["upbutton"])) {
    $upid = mysqli_real_escape_string($con, $_POST["upid"]);
    $upname = mysqli_real_escape_string($con, $_POST["upname"]);
    $upprice = mysqli_real_escape_string($con, $_POST["upprice"]);
    $updesc = mysqli_real_escape_string($con, $_POST["updesc"]);
    $upcategory = mysqli_real_escape_string($con, $_POST["upcategory"]);
    $upimage = $_FILES["upimage"]["name"];
    $upimage_tmp_name = $_FILES["upimage"]["tmp_name"];
    $upimage_folder = "images/" . $upimage;
    $sql_up = "UPDATE products SET pname ='$upname', pprice ='$upprice', pdesc ='$updesc', pcategory ='$upcategory', pimage ='$upimage' WHERE id = '$upid'";
    $result_up = mysqli_query($con, $sql_up);
    if ($result_up) {
        move_uploaded_file($upimage_tmp_name, $upimage_folder);
        $messages[] = "product updated successfully";
        header("Location: Aproduct.php");
        exit();
    } else {
        $messages[] = "Error updating product";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="Aproduct.css">
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
        <form action="" method="post" class="form" enctype="multipart/form-data">
            <h2>ADD A NEW PRODUCT</h2>
            <div class="form-group">
                <input type="text" name="pname" id="pname" required>
                <span>Product Name</span>
            </div>
            <div class="form-group">
                <input type="number" name="pprice" id="pprice" required>
                <span>Product Price</span>
            </div>
            <div class="form-group">
                <!-- <input type="text" name="pdesc" id="pdesc" required> -->
                <textarea name="pdesc" id="" cols="30" rows="10" required></textarea>
                <span>Description</span>
            </div>
            <div class="form-group">
                <select name="pcategory" id="">
                    <option value="Choose a Category">-- Choose a Category --</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Food & Beverage">Food & Beverage</option>
                    <option value="Jewelry & Accessories">Jewelry & Accessories</option>
                    <option value="Clothing & Apparel">Clothing & Apparel</option>
                    <option value="Books & Media">Books & Media</option>
                </select>
            </div>
            <div class="form-group">
                <input type="file" name="pimage" id="" required>
            </div>
            <button class="btn" name='button'>Add Product</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "Select * From `products`";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><img src='images/<?php echo $row['pimage'] ?>'></td>
                            <td>
                                <?php echo $row['pname'] ?>
                            </td>
                            <td>$<?php echo $row['pprice'] ?>
                            </td>
                            <td>
                                <?php echo $row['pdesc'] ?>
                            </td>
                            <td>
                                <?php echo $row['pcategory'] ?>
                            </td>
                            <td><a href="Aproduct.php?delete=<?php echo $row['id']; ?>" class='del'
                                    onclick="return confirm('Are you sure you want to delete this product?')"><svg width="64px"
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
                                    </svg></a><a href="Aproduct.php?edit=<?php echo $row['id']; ?>" class='edit'><svg
                                        width="64px" height="64px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z"
                                                fill="#212121"></path>
                                        </g>
                                    </svg></a></td>
                        </tr>
                        <?php
                    }
                    ;
                } else {
                    echo "<div class='empty'>No products added</div>";
                }
                ?>
            </tbody>
        </table>
        <div class="form-m">
            <?php
            if (isset($_GET['edit'])) {
                $edit = $_GET['edit'];
                $sql = "SELECT * FROM products WHERE id = $edit";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <form action="" method="post" class="form" enctype="multipart/form-data">
                            <h2>UPDATE A PRODUCT</h2>
                            <img src="images/<?php echo $row['pimage'] ?>" alt="Previous pic" />
                            <input type="hidden" name="upid" value="<?php echo $row['id'] ?>">
                            <div class="form-group">
                                <input type="text" name="upname" id="pname" value="<?php echo $row['pname'] ?>" required>
                                <span>Product Name</span>
                            </div>
                            <div class="form-group">
                                <input type="number" name="upprice" id="pprice" value="<?php echo $row['pprice'] ?>" min="0"
                                    required>
                                <span>Product Price</span>
                            </div>
                            <div class="form-group">
                                <textarea name="updesc" id="pdesc" cols="30" rows="10"
                                    required><?php echo $row['pdesc'] ?></textarea>
                                <span>Description</span>
                            </div>
                            <div class="form-group">
                                <select name="upcategory" id="" required>
                                    <option value="Choose a Category">-- Choose a Category --</option>
                                    <option value="Electronics" <?php if ($row['pcategory'] == "Electronics")
                                        echo " selected"; ?>>
                                        Electronics</option>
                                    <option value="Food & Beverage" <?php if ($row['pcategory'] == "Food & Beverage")
                                        echo " selected"; ?>>Food & Beverage</option>
                                    <option value="Jewelry & Accessories" <?php if ($row['pcategory'] == "Jewelry & Accessories")
                                        echo " selected"; ?>>Jewelry & Accessories</option>
                                    <option value="Clothing & Apparel" <?php if ($row['pcategory'] == "Clothing & Apparel")
                                        echo " selected"; ?>>Clothing & Apparel</option>
                                    <option value="Books & Media" <?php if ($row['pcategory'] == "Books & Media")
                                        echo " selected"; ?>>
                                        Books & Media</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="file" name="upimage" id="" accept="image/png, image/jpg, image/jpeg">
                            </div>
                            <button class="btn" name='upbutton'>Update the Product</button>
                            <input type="reset" class="btn" value="Close" name="upexit" id="Close-btn">
                        </form>

                        <?php
                    }
                    ;
                }
                ;
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.querySelector('#Close-btn').addEventListener('click', function (event) {
                        event.preventDefault();
                        document.querySelector('.form-m').style.display = 'none';
                        window.location.href = 'Aproduct.php';
                    });
                });
                </script>";
            }


            ?>
        </div>
    </div>
    <script src="main.js"></script>
</body>
</body>

</html>