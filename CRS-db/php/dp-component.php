<?php

function dpComponent($productName ,$productOldPrice, $productNewPrice, $productImg, $productRating, $productId){
    $element1 = "
    <div class=\"dp-image-card \">
    <form action=\"index.php\" method=\"post\">
            <div class=\"dp-img-div\">
              <img loading=\"lazy\" src=\"$productImg\" alt=\"Product Image\" />
            </div>
            <div class=\"dp-heading-div\">
              <h2>$productName</h2>
              <div class=\"dp-product-rating-div\">
              <ion-icon name=\"star\"></ion-icon>
              <ion-icon name=\"star\"></ion-icon>
              <ion-icon name=\"star\"></ion-icon>
              <ion-icon name=\"star\"></ion-icon>
              ";
              if($productRating == 1){
                $element2 = "<ion-icon name=\"star\"></ion-icon>";
              }elseif($productRating == 2){
                $element2 = "<ion-icon name=\"star-half\"></ion-icon>";
              }else{
                $element2 = "<ion-icon name=\"star-outline\"></ion-icon>";
              }
              $element3 =
              "</div>
              <p>This is one of most selling product of our store. Avail this exclusive discount NOW !</p>
              <h3>
                <small><s class=\"text-secondary\">$$productOldPrice</s></small>
                <strong>$$productNewPrice</strong>
              </h3>
              <button  name=\"add\" class=\"filled-btn dp-addToCart-btn\">Add to Cart
               <ion-icon name=\"cart\"></ion-icon></button>
              <input type=\"hidden\" name=\"product_id\" value=\"$productId\">

            </div>
            </form>
          </div>
    ";
    echo $element1.$element2.$element3;
}


function showMessage($id, $name, $email, $subject, $message, $time){
$element = "
<tr>
<th scope=\"row\">$id</th>
<td>$name</td>
<td>$email</td>
<td>$subject</td>
<td>$message</td>
<td>$time</td>
</tr>
";
echo $element;
}


function showProducts($id, $name, $price, $path,){
$element = "
<tr>
<th scope=\"row\">$id</th>
<td>$name</td>
<td>$price</td>
<td>$path</td>
</tr>
";
echo $element;
}

function showSales($id, $name, $email, $amount, $time){
$element = "
<tr>
<th scope=\"row\">$id</th>
<td>$name</td>
<td>$email</td>
<td>$amount</td>
<td>$time</td>
</tr>
";
echo $element;
}

function showLoginStamp($id, $name, $email, $time){
$element = "
<tr>
<th scope=\"row\">$id</th>
<td>$name</td>
<td>$email</td>
<td>$time</td>
</tr>
";
echo $element;
}


function NonDPComponent($productName , $productNewPrice, $productImg, $productRating, $productId){
    $element1 = "
    <div class=\"p-image-card \">
    <form action=\"index.php\" method=\"post\">
            <div class=\"p-img-div\">
              <img loading=\"lazy\" src=\"$productImg\" alt=\"Product Image\" />
            </div>
            <div class=\"dp-heading-div\">
              <h2>$productName</h2>
              <div class=\"dp-product-rating-div\">
              <ion-icon name=\"star\"></ion-icon>
              <ion-icon name=\"star\"></ion-icon>
              <ion-icon name=\"star\"></ion-icon>
              <ion-icon name=\"star\"></ion-icon>
              ";
              if($productRating == 1){
                $element2 = "<ion-icon name=\"star\"></ion-icon>";
              }elseif($productRating == 2){
                $element2 = "<ion-icon name=\"star-half\"></ion-icon>";
              }else{
                $element2 = "<ion-icon name=\"star-outline\"></ion-icon>";
              }
              $element3 =
              "</div>
              <h3>
                <strong>$$productNewPrice</strong>
              </h3>
              <button  name=\"add\" class=\"filled-btn dp-addToCart-btn\">Add to Cart
               <ion-icon name=\"cart\"></ion-icon></button>
              <input type=\"hidden\" name=\"product_id\" value=\"$productId\">

            </div>
            </form>
          </div>
    ";
    echo $element1.$element2.$element3;
}



function cartElement($productimg, $productname, $productprice, $productid){
  $element = "
  
  <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                  <div class=\"border rounded\">
                      <div class=\"row bg-white\">
                          <div class=\"col-md-3 pl-0\">
                              <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                          </div>
                          <div class=\"col-md-6\">
                              <h5 class=\"pt-2\">$productname</h5>
                              <small class=\"text-secondary\">Seller: CRS Store</small>
                              <h5 class=\"pt-2\">$$productprice</h5>
                              <button type=\"submit\" class=\"btn btn-warning\">Save for Later</button>
                              <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                          </div>
                          
                      </div>
                  </div>
              </form>
  
  ";
  echo  $element;
}


?>
<!-- 
<div class=\"col-md-3 py-5\">
                              <div>
                                  <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button>
                                  <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline\">
                                  <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-plus\"></i></button>
                              </div>
                          </div> -->