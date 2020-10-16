<?php
include 'pages/header.php';
include 'connection.php';

$form_hide = false;
$msg = NULL;
//var_dump($_POST['submit']);
if (isset($_POST['submit'])){
  //$name = "ssss";
  //var_dump($_POST);
  $fname = $_POST['fname'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $feedback = $_POST['feedback'];
    $amount = $_POST['amount'];

  if($email == '' || $amount == ''){

    $msg .= "Please enter a valid email address and amount.<br/>"; 

  }
if(is_numeric($amount) && $amount > 0){


}else{
    $msg .= "Please enter a valid numeric and postive value for amount.<br/>"; 

}

 if($msg == NULL){

//echo "My name is Santosh".$name;

  $sql = "INSERT INTO donations (name, email, address, feedback, amount) VALUES ('".$fname."', '".$email."','".$address."', '".$feedback."', '".$amount."')";

  if ($conn->query($sql) === TRUE) {

   echo "<p class='success'>Donation received successfully. Thanks for your valuable donation.</p>";

    $form_hide = TRUE;
  //  header("Location: signin.php");


  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  $conn->close();
}else
{
  echo "<center><div class='error'>".$msg."</div></center>";
}
}

if($form_hide == false){
?>
<!-- main content starts here-->
<section class="content">
 <div class="row">
  <div class="col-75">
    <div class="container container-fix">
        <center><h2 class='heading'">Donation </h2></center>
        <div class="row">
            <form method="post" action="donate.php" class="">
          <div class="col-25">
        
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="fname" placeholder="Enter Full Name">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="Enter Email Address">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="Enter Address">
            <label for="city"><i class="fa fa-institution"></i> Feedback</label>
            <textarea  width="500" rows="18" name="feedback"></textarea>
           <button type = "submit" name = "submit" class="btn">Donate</button>
       
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
      
            <label for="cname">Amount</label>
            <input type="text" id="amount" name="amount" placeholder="Enter Amount">
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

</form>
        </div>

    </div>
  </div>


  </div>

    </section>

<?php
}
include 'pages/footer.php';
?>
