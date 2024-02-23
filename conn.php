<?php
    session_start();
    $con = mysqli_connect("localhost","root","","e-commerce");
    if(!$con){
        die(mysqli_error($con));
    }