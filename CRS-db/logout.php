<?php
    session_start();
    unset($_SESSION["ID"]);
    unset($_SESSION["Username"]);
    unset($_SESSION["cart"]);
    unset($_SESSION["admin"]);
    session_destroy();
    echo "Seccessfully logged Out";
    header("Location:login.php");
?>