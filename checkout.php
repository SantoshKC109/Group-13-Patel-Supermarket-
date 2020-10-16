<?php
include 'pages/header.php';
include 'connection.php';

$form_hide = false;

if (isset($_POST['submit'])){
  $error = '';

$user_id = $_SESSION["user_id"];

  foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
        $item_date = date('Y-m-d');
        $item_quantity = $item["quantity"];
        $item_id = $item["id"];

$sql = "INSERT INTO sales (product_id, date, quantity, price, user_id) VALUES ('".$item_id."', '".$item_date."','".$item_quantity."', '".$item_price."', '".$user_id."')";

$sql1 = "UPDATE product SET quantity = quantity - '".$item_quantity."' WHERE id='".$item_id."'";

if ($conn->query($sql) === TRUE)  {

if($conn->query($sql1) === TRUE){

}else{
$error = "yes";
}

  } else {
   $error = "yes";
  }
      }
  if($error == ''){
 if(!empty($_SESSION["cart_item"])) {

        foreach($_SESSION["cart_item"] as $k => $v) {

                    unset($_SESSION["cart_item"][$k]);     
        }
    }

    echo "<div class='success'>succesfully Ordered.Thanks for buying with us.</div><center><a href='home.php' class='btn btn-green'>click here to buy more</a></center>";
    $form_hide = true;
  }else{
    echo "<div class='error'>Error Occurred. Please try again later</div>";
  }
     
}
if($form_hide == false)
{
?>

<!-- main content starts here-->
    <section class="content">
 <div class="row">
  <div class="col-75">
    <div class="container container-fix">
        <center><h2 class='heading'">Checkout</h2></center>
      <form action="checkout.php" method="POST">
        <div class="row">
          <div class="col-25">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="Enter Full Name">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="Enter Email Address">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="Enter Address">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="Enter City">
            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="Enter state">
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="Enter Postcode">
              </div>
            </div>
          </div>
          <div class="col-25">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="Enter Card Name">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="Enter Credit Card Number">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="Enter Expiry Month">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="Enter Expirt Year ">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="Enter CVV">
              </div>
            </div>
          </div>
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
            <button type = "submit" name = "submit" class="btn btn-blue">Continue to checkout</button>
      </form>
    </div>
  </div>
  </div>

    </section>

<?php
}


include 'pages/footer.php';
?>