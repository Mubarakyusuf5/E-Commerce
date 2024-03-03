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
if(isset($_POST["chbtn"])){
    $chName = $_POST["chName"];
    $chNumber = $_POST["chNumber"];
    $chEmail = $_POST["chEmail"];
    $chPay = $_POST["chPay"];
    $chAd1 = $_POST["chAd1"];
    $chState = $_POST["chState"];
    $chCity = $_POST["chCity"];
    $chCountry = $_POST["chCountry"];
    $chCode = $_POST["chCode"];
    $ssql = "SELECT * FROM `cart`";
    $sresult = mysqli_query($con, $ssql);
    $tprice = 0;
    // $p_name = array(); // Initialize $p_name array
    $p_price = array();
    if(mysqli_num_rows($sresult) > 0){
        while($row = mysqli_fetch_assoc($sresult)){
            $p_name[] = $row["cname"].'('. $row["cquantity"] .')';
            $p_price[] = ($row["cprice"] * $row["cquantity"]);
            // $tprice += $p_price;
            $tprice = array_sum($p_price);
    }
}
    $tproducts = implode(', ', $p_name);
    $chsql = "INSERT INTO `checkout` (`chName`,`chNumber`,`chEmail`,`chPay`, `chAd1`,`chState`, `chCity`, `chCountry`, `chCode`, `tproducts`, `tprice`) VALUES ('$chName','$chNumber','$chEmail','$chPay', '$chAd1','$chState', '$chCity', '$chCountry', '$chCode', '$tproducts', '$tprice')";
    $iresult = mysqli_query($con, $chsql)or die("query failed");
    if($sresult && $iresult){
        echo "
        <div class='order-contain'>
        <div class='order-container'>
           <div class='message-container'>
              <h3>Thank you for Shopping!</h3> 
              <div class='con'>
               <span>".$tproducts."</span>
               <span class='money'> Total : &#x20A6;".number_format($tprice)."</span>
              </div>
              <div class='details'>
               <p>Your name : <span>".$chName."</span></p>
               <p>Your number : <span>".$chNumber."</span></p>
               <p>Your email : <span>".$chEmail."</span></p>
               <p>Your address : <span>".$chAd1.', '.$chCity.', '.$chState.' state'.', '.$chCountry.', '.$chCode."</span></p>
               <p>Your payment method : <span>".$chPay."</span></p>
              </div>
              <a href='cart.php?delete-all' class='btn3 btn4'>Continue Shopping</a>
           </div>
        </div>
        </div>
        
        ";
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
    <link rel="stylesheet" href="order.css">
</head>

<body>
    
    <?php
    include("header.php");
    ?>
    <?php
    if (isset($messages)) {
        foreach ($messages as $message) {
            echo '<div class="message"><span>' . $message . '</span> <svg onclick="this.parentElement.style.display = `none`" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 352 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg></div>';
        }
    }
    ?>
    <div class="container">
        <h1>Complete Your Order</h1>
        <form action="" method="post" class="ui form">
            <div class="con">
                <div class="con1">
                    <?php
                   $sql = "SELECT * FROM `cart`"; 
                   $result = mysqli_query($con, $sql);
                   $total = 0;
                   if(mysqli_num_rows($result)){
                    while($row = mysqli_fetch_assoc($result)){
                    
                        ($total_price = $row['cprice'] * $row['cquantity']);
                        $g_total = $total += $total_price;
                        ?>
                    <span><?=$row['cname']?>(<?= $row['cquantity']?>)</span>
                    <?php
                }
                
            }else{
                echo '<div class="con1-order"><span>Your cart is empty</span></div>';
            }
                    ?>
                </div>
                <p class="money"> Grand total: &#x20A6;<?php echo number_format($g_total);?></p>
                <!-- <p class="money">Grand Total: &dollar;460</p> -->
            </div>
            <div class="contain">
                <div class="">
                    <div class="form-group">
                        <input type="text" name="chName" id="pname" required>
                        <span>Your Name</span>
                    </div>
                    <div class="form-group">
                        <input type="email" name="chEmail" required>
                        <span>Your Email</span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="chAd1" required>
                        <span>Address Line 1</span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="chCity" required>
                        <span>City</span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="chCode" required>
                        <span>Postal Code</span>
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <input type="number" name="chNumber" required>
                        <span>Your Number</span>
                    </div>
                    <div class="form-group">
                        <select name="chPay" id="">
                            <option value="Payment Method">-- Payment Method --</option>
                            <option value="Opay">Opay</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Bank Card">Bank Card</option>
                            <option value="Cash on Delivery">Cash on Delivery</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="chState" required>
                        <span>State</span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="chCountry" required>
                        <span>Country</span>
                    </div>
                </div>
            </div>
            <button type="submit" name="chbtn" class="btn3">Order Now</button>

        </form>

    </div>
    <script src="main.js"></script>
</body>

</html>