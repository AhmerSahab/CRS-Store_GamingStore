<?php
session_start();

if(!isset($_SESSION['Username'])){
echo "You are not logged in \n Please login";
header('location: login.php');
}
elseif(!isset($_SESSION['cart'])){
    echo "No Item in Cart!";
    header('location: index.php');
}

require_once ("php/CreateDb.php");
require_once ("php/dp-component.php");

$db = new CreateDb("crs_db", "products_table");
$db_2 = new CreateDb("crs_db", "sales_table");

if (isset($_POST['remove'])){
  if ($_GET['action'] == 'remove'){
      foreach ($_SESSION['cart'] as $key => $value){
          if($value["product_id"] == $_GET['id']){
              unset($_SESSION['cart'][$key]);
            //   echo "<script>alert('Product has been Removed...!')</script>";
              echo "<script>window.location = 'cart.php'</script>";
          }
      }
  }
}

if(isset($_POST['checkout'])){
    $username = $_SESSION['Username'];
    $email = $_SESSION['Email'];
    $totalAmount = $_SESSION['totalAmount'] ;
$sql = "INSERT INTO `sales_table`( `username`, `email`, `amount`) VALUES ('$username','$email' ,'$totalAmount')";
if (mysqli_query($db_2->con, $sql)) {
    echo "<script>alert('You have successfully Checkout...!')</script>";
    unset($_POST['checkout']);
    unset($_SESSION['cart']);
    // echo "Successfully Checkout ";
    header('location: index.php');

  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db_2->con);
  }
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRS Store Cart</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="style_1.css">
    
</head>
<body class="bg-light">


<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
                <h1>Your Cart</h1>
                <hr>

                <?php

               $priceSum = 0;
                $delivery = 0;
                    if (isset($_SESSION['cart'])){
                        $product_id = array_column($_SESSION['cart'], 'product_id');

                        $result = $db->getData();
                        while ($row = mysqli_fetch_assoc($result)){
                            foreach ($product_id as $id){
                                if ($row['id'] == $id){
                                    cartElement($row['imageAddress'], $row['productName'],$row['newPrice'], $row['id']);
                                   $priceSum =$priceSum + (int)$row['newPrice'];
                                    $delivery = $delivery + 5;
                                }
                            }
                        }
                    }else{
                        echo "<h5>Cart is Empty</h5>";
                    }
                    $total = $priceSum + $delivery;
                    $_SESSION['totalAmount'] = $total;
                ?>

            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

            <div class="pt-4">
                <h6>PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                            if (isset($_SESSION['cart'])){
                                $count  = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            }else{
                                echo "<h6>Price (0 items)</h6>";
                            }
                        ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>$<?php echo $priceSum; ?></h6>
                        <h6>$<?php echo $delivery; ?></h6>
                        <!-- <h6 class="text-success">FREE</h6> -->
                        <hr>
                        <h6>$<?php
                            echo $total;
                            ?></h6>
                    </div>
                </div>
            </div>
            <hr>
            <p>Dear <h5><?php echo $_SESSION['Username']; ?></h5><h5><?php echo $_SESSION['Email']; ?></h5> Your total bill is $<?php echo $total; ?>. Tap to Proceed.
            </p>
            <hr>
            <form action="cart.php" method="post">
            <button type="submit" name="checkout" class="btn btn-success">Checkout</button>
            </form>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
