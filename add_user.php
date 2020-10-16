

<?php
include 'pages/header.php';
include 'connection.php';
$form_hide = false;
$msg = NULL;
//var_dump($_POST['submit']);
if (isset($_POST['submit'])){
	//$name = "ssss";
	//var_dump($_POST);
  $name = $_POST['username'];
  $fname = $_POST['first_name'];
  $lname = $_POST['last_name'];
  $email = $_POST['email'];
//$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $phone_no = $_POST['phone_no'];
  $role = $_POST['role'];
  $password = $_POST['password'];
  $pass2 = $_POST['confirm_password'];

if ($password!=$pass2){
$msg.= "Password do not match, both password should be same.<br />";
  }



  $pswdlength = strlen($password);

  if(strlen($name) < 1 || strlen($fname) < 1 || strlen($name) < 1 || strlen($email) < 1){
     $msg .= "Please enter values for all fields. <br/>"; 
  }

  if($pswdlength < 5){

    $msg .= "Please enter password with length less than 5 words <br/>"; 

  }


  $sql = "SELECT * FROM user WHERE username = '".$name."'";

  if ($result=mysqli_query($conn, $sql))
  {
  	$rowcount = mysqli_num_rows($result);

    if($rowcount > 0 ){
     $msg .= "Already Exist, Please enter different user name. <br/>"; 
   }
 }

 if($msg == NULL){
  $hash =  password_hash($password, PASSWORD_DEFAULT);

//echo "My name is Santosh".$name;

  $sql = "INSERT INTO user (username, first_name, last_name, email, password, phone_no,role_id) VALUES ('".$name."', '".$fname."','".$lname."', '".$email."', '".$hash."', '".$phone_no."', '".$role."')";

  if ($conn->query($sql) === TRUE) {

   echo "<p class='success'>Record Added successfully</p> <center> <a href='add_user.php'>Click here to add more products </a></center>";

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

<form method="post" action="add_user.php" class="Registration">
  
  <center><img src="logo.png" class="logo"></center>
  
  <center><h3>User Registration</h3></center>
  <p class = "error"><?php echo $msg; ?></p>
  <label>Username:</label>
  <input name="username"  type="text"> <br/>
  <label>First Name:</label>
  <input name="first_name"  type="text"> <br/>
  <label>Last Name:</label>
  <input name="last_name"  type="text"> <br/>
  <label>Email Address:</label>
  <input type="text" name="email">  <br/>
  <label>Phone Number:</label>
  <input type="text" name="phone_no"> <br/>
 <label>Category:</label>
  <select name='role'>
  <?php 

  $role = "SELECT * FROM user_role where role != 'admin'";
if ($result=mysqli_query($conn, $role))
{
 while($row = mysqli_fetch_assoc($result)) {
  echo "<option value='" . $row['id'] . "'>" . $row['role'] . "</option>";
}
}
?>
</select>
  <label>Password:</label>
  <input type="password" name="password"> <br/>

  <label>Confirm Password:</label>
  <input type="password" name="confirm_password"> <br/><br/>

 <button type = "submit" name = "submit" class="btn">Register</button>

 <a href="users_list.php" class="btn btn-red" >Cancel</a>
 <br/>
 
</form>
<?php
}
include 'pages/footer.php';
?>