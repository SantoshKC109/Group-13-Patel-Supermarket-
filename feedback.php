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


  if($email == ''){

    $msg .= "Please enter a valid email address <br/>"; 

  }


 if($msg == NULL){

//echo "My name is Santosh".$name;

  $sql = "INSERT INTO feedbacks (name, email, address, feedback) VALUES ('".$fname."', '".$email."','".$address."', '".$feedback."')";

  if ($conn->query($sql) === TRUE) {

   echo "<p class='success'>Feedback Recorded successfully. Thanks for your valuable suggestions.</p>";

    $form_hide = TRUE;
  //  header("Location: signin.php");


  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  $conn->close();
}
}

if($form_hide == false){
?>
<!-- main content starts here-->
<section class="content">
 <div class="row">
  <div class="col-75">
    <div class="container container-fix">
        <center><h2 class='heading'">Feedback </h2></center>
        <div class="row">
          <div class="col-25">
          <form method="post" action="feedback.php" class="">
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="fname" placeholder="Enter Full Name">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="Enter Email Address">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="Enter Address">
            <label for="city"><i class="fa fa-institution"></i> Feedback</label>
            <textarea  width="500" rows="15" name="feedback"></textarea>
           <button type = "submit" name = "submit" class="btn">Send Feedback</button>
          </form>
          </div>
        </div>

    </div>
  </div>
  </div>

    </section>

<?php
}
include 'pages/footer.php';
?>