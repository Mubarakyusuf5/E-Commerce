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
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="Aproduct.css">
</head>
<body>
    <nav>
        <div class="logo"><a href="index.php">E-commerce</a></div>
        <ul>
            <li class="prod">Product
                <ul id="pmenu">
                    <li><a href="index.php">View Product</a></li>
                    <li><a href="Aproduct.php">Add Product</a></li>
                </ul>
            </li>
            <li><a href="cart.php"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                        height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path fill="none" stroke="#000" stroke-width="2"
                            d="M5,5 L22,5 L20,14 L7,14 L4,2 L0,2 M7,14 L8,18 L21,18 M19,23 C18.4475,23 18,22.5525 18,22 C18,21.4475 18.4475,21 19,21 C19.5525,21 20,21.4475 20,22 C20,22.5525 19.5525,23 19,23 Z M9,23 C8.4475,23 8,22.5525 8,22 C8,21.4475 8.4475,21 9,21 C9.5525,21 10,21.4475 10,22 C10,22.5525 9.5525,23 9,23 Z">
                        </path>
                    </svg></a></li>
                </ul>
                <img src="user.png" alt="" class="user">
        <div class="submenu-main">
            <div class="submenu">
                <div class="user-profile">
                    <img src="user.png" alt="">
                    <div class="tet">
                        <h4>Welcome Back</h4>
                        <p>
                            <?php echo $row['uname'] ?>
                        </p>
                    </div>
                </div>
                <hr>
                <a href="logout.php" class="submenu-link">
                    <div class="k">
                        <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                            stroke-linecap="round" stroke-linejoin="round" height="1em" width="1em"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        <p>Logout</p>
                    </div>
                    <span><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                            height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M294.1 256L167 129c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.3 34 0L345 239c9.1 9.1 9.3 23.7.7 33.1L201.1 417c-4.7 4.7-10.9 7-17 7s-12.3-2.3-17-7c-9.4-9.4-9.4-24.6 0-33.9l127-127.1z">
                            </path>
                        </svg></span>
                </a>
            </div>
        </div>
    </nav>
    <div class="container">
            <form action="" method="post">
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
                    <input type="file" name="pimage" id="" required>
                </div>
                <button class="btn">Add Product</button>
            </form>
            <?php
            echo "<table>
                <tr><th>Product Image</th><th>Product Name</th><th>Product Price</th><th>Action</th></tr>
                <tr><td><img src='user.png'></td><td>name</td><td>$8000</td><td><button class='del'>del</button><button class='edit'>edit</button></td></tr>
                <tr><td><img src='hh.jpg'></td><td>khkh</td><td>$090000</td><td><button class='del'>del</button><button class='edit'>edit</button></td></tr>
                <tr><td><img src='hj.jpg'></td><td>mlmoo</td><td>$80000</td><td><button class='del'>del</button><button class='edit'>edit</button></td></tr>
                <tr><td><img src='hj.jpg'></td><td>mlmoo</td><td>$80000</td><td><button class='del'>del</button><button class='edit'>edit</button></td></tr>
            </table>";
            ?>
    </div>
        <script>
            const menu = document.querySelector('.submenu-main')
            document.querySelector('.user').addEventListener('click', function () {
                menu.classList.toggle('active');
            })
        </script>
</body>
</body>
</html>