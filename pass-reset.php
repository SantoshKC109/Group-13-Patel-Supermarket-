<?php
include 'pages/header.php';
include('connection.php');

require 'PHPMailer/PHPMailerAutoload.php';

if(isset($_POST["email"]) && (!empty($_POST["email"]))){
$email = $_POST["email"];
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);

$error = '';

if (!$email) {
   $error .="<p>Invalid email address please type a valid email address!</p>";
   }else{
   $sel_query = "SELECT * FROM `user` WHERE email='".$email."'";
   $results = mysqli_query($conn,$sel_query);
   $row = mysqli_num_rows($results);
   if ($row==""){
   $error .= "<p>No user is registered with this email address!</p>";
   }
  }
   if($error!=""){
   echo "<div class='error'>".$error."</div>
   <br /><a href='javascript:history.go(-1)'>Go Back</a>";
   }else{
   $expFormat = mktime(
   date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
   );
   $expDate = date("Y-m-d H:i:s", $expFormat);

   $prepare_key = 2418*2;
   $key = md5($prepare_key.$email);
   $addKey = substr(md5(uniqid(rand(),1)),3,10);
   $key = $key . $addKey;


  if (mysqli_query($conn,
"INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
VALUES ('".$email."', '".$key."', '".$expDate."');")) {

// Insert Temp Table
 
$output='<p>Dear user,</p>';
$output.='<p>Please click on the following link to reset your password.</p>';
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p><a href="http://localhost/patel/reset-password.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">
http://localhost/patel/reset-password.php?key='.$key.'&email='.$email.'&action=reset</a></p>'; 
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p>Please be sure to copy the entire link into your browser.
The link will expire after 1 day for security reason.</p>';
$output.='<p>If you did not request this forgotten password email, no action 
is needed, your password will not be reset. However, you may want to log into 
your account and change your security password as someone may have guessed it.</p>';   
$output.='<p>Thanks,</p>';
$output.='<p>Patel Supermarket Team</p>';
$body = $output; 

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'patelsupermarket09@gmail.com';                 // SMTP username
$mail->Password = 'LENOVOG50';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('patelsupermarket09@gmail.com', 'Patel Supermarket');
$mail->addAddress($email);               

$mail->Subject = 'Pasword reset link from Patel Supermarket';
$mail->Body    = $body;
$mail->AltBody = 'Password reset link';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo "<div class='success'>
<p>An email has been sent to you with instructions on how to reset your password.</p>
</div><center><a href='signin.php' class='btn btn-green'>Click here to go Login Page.</a></center>";
}
  //  header("Location: signin.php");

  } else {
    echo "Error: " . "<br>" . $conn->error;
  }
  $conn->close();

   }
}else{
?>
<form method="post" action="" name="reset"  class="Registration">
   <center><img src="logo.png" class="logo"></center>
  <center><h3>Forgotten your Password?</h3></center><br/>
<label><strong>Enter Your Email Address:</strong></label>
<input type="email" name="email" placeholder="username@email.com" />
<br /><br />
<input type="submit" value="Send Password Reset Link "/>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<?php
}
include 'pages/footer.php';
?>