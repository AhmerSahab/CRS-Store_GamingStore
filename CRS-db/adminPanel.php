<?php

session_start();

if(!isset($_SESSION['admin'])){
echo "You are not logged in as Admin \n Please login";
header('location: login.php');
}

require_once ("php/CreateDb.php");
require_once ("php/dp-component.php");

$db = new CreateDb("crs_db", "products_table");

if (isset($_POST['add'])){
     $product_name = $_POST['productName'];
    $product_price = $_POST['productPrice'];
    $product_image = $_POST['productPath'];
    // unset($_POST['add']);
    $sql = "INSERT INTO $db->tablename ( `productName`, `newPrice`, `imageAddress`) VALUES ('$product_name', '$product_price', '$product_image')" ;
        if (mysqli_query($db->con, $sql)) {
          echo "New record created successfully";
          unset($_POST);
          $_POST = array();
          } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db->con);
          }
    
    // $db->addData($product_name, $product_price, $product_image);
  }
elseif (isset($_POST['edit'])){
     $id = $_POST['id'];
     $product_name = $_POST['productName'];
    $product_price = $_POST['productPrice'];
    $product_image = $_POST['productPath'];
    $sql = "UPDATE $db->tablename SET `productName`='$product_name',`newPrice`='$product_price',`imageAddress`='$product_image' WHERE `id` = '$id'" ;
        if (mysqli_query($db->con, $sql)) {
            echo "Record updated successfully";
            unset($_POST['edit']);
          } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db->con);
          }
    
    // $db->addData($product_name, $product_price, $product_image);
  }
elseif (isset($_POST['delete'])){
     $id = $_POST['id'];
    $sql = "DELETE FROM $db->tablename  WHERE `id` = '$id'" ;
        if (mysqli_query($db->con, $sql)) {
            echo "Record deleted successfully";
            unset($_POST['delete']);
          } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db->con);
          }
    
    // $db->addData($product_name, $product_price, $product_image);
  }

else{
    // echo 'Error here in Admin Process ' ;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRS AdminPanel</title>
    
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="button.css"/>

<style>
    h2 , h1, p{
        text-align: center;
    }
    h2{
      margin-bottom: 1.5rem;
    }
    h1{
        font-family: 'Times New Roman', Times, serif;
        font-size: 4.5rem;
        padding-top: 5rem;
    }
    section{
        padding: 5rem 33rem;
    }
    .container{
        padding: 5rem ;
    }
    .tablerow{
      background-color:  #0fa69e9e;
    }
    a:hover{
      text-decoration: none;
    }
</style>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<body>
<nav class="navbar fixed-top navbar-dark bg-dark justify-content-between">
  <a class="navbar-brand">CRS Store</a>
  <form class="form-inline" >
    <button class="btn btn-outline-light my-2 my-sm-0" type="submit"><a href="logout.php">Logout <span><ion-icon name="log-out-outline"></ion-icon></span></a></button>
  </form>
</nav>
    <h1>Welcome to Admin Panel</h1>
    <section class="container">
        <h2>Products In Inventory</h2>
        <table class="table table-bordered">
  <thead>
    <tr class="tablerow">
      <th scope="col">#</th>
      <th scope="col">Product Name</th>
      <th scope="col">Price</th>
      <th scope="col">Image Path</th>
    </tr>
  </thead>
  <tbody>
    <?php
// $db_2 = new CreateDb("crs_db", "message_table");
// $sql_2 = "SELECT * FROM $db_2->tablename WHERE 1";
                $result = $db->getData(); 
                // $id = 1;
                while ($row = mysqli_fetch_assoc($result)){
                  showProducts($row['id'], $row['productName'], $row['newPrice'], $row['imageAddress']);
                  // $id++;
                }
    ?>
   
  </tbody>
</table>
    </section>
    <section>
        <h2>Add New Product</h2>
        <form action="adminPanel.php" method="POST">
            <!-- <label for="productName">Product Name</label> -->
            <div class="form-group">
            <input type="text" class="form-control" name="productName"  minlength="5" maxlength="20"  placeholder="Product Name" required>
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="productPrice"  minlength="2" maxlength="4"  placeholder="Product Price" required>
            </div>
            <div class="form-group">
            <input type="text" class="form-control"  minlength="10" maxlength="30"  name="productPath" placeholder="Relative Path" required>
            </div>
            <button type="submit" name="add"  class="btn-block">Add to Inventory</button>
          
        </form>
    </section>
    <section>
        <h2>Edit Product Details</h2>
        <form action="adminPanel.php" method="POST">
            <!-- <label for="productName">Product Name</label> -->
            <div class="form-group">
            <input type="text" class="form-control" name="id" maxlength="3" placeholder="id" required>
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="productName"   minlength="5" maxlength="20" placeholder="Product Name" required>
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="productPrice"   minlength="2" maxlength="4" placeholder="Product Price" required>
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="productPath" minlength="10" maxlength="30"   placeholder="Relative Path" required>
            </div>
            <button type="submit" name="edit"  class="btn-block">Edit Product</button>
          
        </form>
    </section>
    <section>
        <h2>Delete Product</h2>
        <form action="adminPanel.php" method="POST">
            <div class="form-group">
            <input type="text" class="form-control" name="id"  maxlength="3" placeholder="id" required>
            </div>
            <button type="submit" name="delete"  class="btn-block">Delete Product</button>
          
        </form>
    </section>
    <section class="container">
        <h2>Messages from Customers</h2>
        <table class="table table-bordered">
  <thead>
    <tr class="tablerow">
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Subject</th>
      <th scope="col">Message</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody>
    <?php
$db_2 = new CreateDb("crs_db", "message_table");
// $sql_2 = "SELECT * FROM $db_2->tablename WHERE 1";
                $result = $db_2->getData(); 
                $id = 1;
                while ($row = mysqli_fetch_assoc($result)){
                  showMessage($id, $row['name'], $row['email'], $row['subject'],$row['message'],$row['time']);
                  $id++;
                }
    ?>
   
  </tbody>
</table>
    </section>
    <section class="container">
        <h2>Sales Table</h2>
        <table class="table table-bordered">
  <thead>
    <tr class="tablerow">
      <th scope="col">#</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Email</th>
      <th scope="col">Total Amount</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody>
    <?php
$db_3 = new CreateDb("crs_db", "sales_table");
// $sql_2 = "SELECT * FROM $db_2->tablename WHERE 1";
                $result3 = $db_3->getData(); 
                $id = 1;
                while ($row = mysqli_fetch_assoc($result3)){
                  showSales($id, $row['username'], $row['email'], $row['amount'],$row['time']);
                  $id++;
                }
    ?>
   
  </tbody>
</table>
    </section>
    <section class="container">
        <h2>Login TimeStamp</h2>
        <table class="table table-bordered">
  <thead>
    <tr class="tablerow">
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody>
    <?php
$db_4 = new CreateDb("crs_db", "login_stamp");
// $sql_2 = "SELECT * FROM $db_2->tablename WHERE 1";
                $result4 = $db_4->getData(); 
                $id = 1;
                while ($row = mysqli_fetch_assoc($result4)){
                  showLoginStamp($id, $row['username'], $row['email'],$row['time']);
                  $id++;
                }
    ?>
   
  </tbody>
</table>
    </section>

    <!-- <section>
    <form name="user_verification" action="adminPanel.php" method="POST">
Name: <input type="text" name="name"><br>
E-mail: <input type="text" name="email"><br>
<input type="submit" name="submit" value="submit">
</form>
    </section> -->
</body>
</html>