

<?php
include 'pages/header.php';
include 'connection.php';
$form_hide = false;
$msg = NULL;
$user_id =  $_GET['id'];
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

  if(strlen($name) < 1 || strlen($fname) < 1 || strlen($name) < 1 || strlen($email) < 1){
     $msg .= "Please enter values for all fields. <br/>"; 
  }

  if($_SESSION["ses_name"] != $name){
  $sql = "SELECT * FROM user WHERE username = '".$name."'";

  if ($result=mysqli_query($conn, $sql))
  {
  	$rowcount = mysqli_num_rows($result);

    if($rowcount > 0 ){
     $msg .= "Already Exist, Please enter different user name. <br/>"; 
   }
 }
}
  if($msg == NULL){

//echo "My name is Santosh".$name;

 $sql = "UPDATE user SET username = '".$name."', first_name='".$fname."', last_name='".$lname."', email='".$email."', phone_no='".$phone_no."', role_id='".$role."' WHERE id='".$user_id."'" ;

  if ($conn->query($sql) === TRUE) {
    echo "<p class='success'>Record updated successfully</p> <br/> <a href='users_list.php'>Click here to go back to users list</a>";
    $form_hide = TRUE;
  } else {
    echo "Error updating record: " . $conn->error;
  }
  $conn->close();
}


}
else{

  

$sql = "SELECT * FROM user where id=".$user_id;

if ($result=mysqli_query($conn, $sql))
{

 while($row = mysqli_fetch_assoc($result)) {
 
  $username = $row['username'];
  $fname = $row['first_name'];
  $lname = $row['last_name'];
  $email = $row['email'];
  $phone_no = $row['phone_no'];
  $role = $row['role_id'];
}
}
}
if($form_hide == false){
?>

<form method="post" action="" class="Registration">
  
  <center><img src="logo.png" class="logo"></center>
  
  <center><h3>User Registration</h3></center>
  <p class = "error"><?php echo $msg; ?></p>
  <label>Username:</label>
  <input name="username"  type="text" value="<?php echo $username; ?>"> <br/>
  <label>First Name:</label>
  <input name="first_name"  type="text" value="<?php echo $fname; ?>"> <br/>
  <label>Last Name:</label>
  <input name="last_name"  type="text" value="<?php echo $lname; ?>"> <br/>
  <label>Email Address:</label>
  <input type="text" name="email" value="<?php echo $email; ?>">  <br/>
  <label>Phone Number:</label>
  <input type="text" name="phone_no" value="<?php echo $phone_no; ?>"> <br/>
 <label>Category:</label>

<?php
 if ($result=mysqli_query($conn, $role))
{
 while($row = mysqli_fetch_assoc($result)) {

  if($row['id'] == $role){
    $value = "Selected";
  }
  echo $value;
  echo "<option value='" . $row['id'] . "'".$value.">" . $row['role'] . "</option>";
}
}
?>
  <select name='role'>
  <?php
  $role = "SELECT * FROM user_role where role != 'admin'";
if ($result=mysqli_query($conn, $role))
{
 while($row = mysqli_fetch_assoc($result)) {

  if($row['id'] == $role){
    $value = "Selected";
  }
  echo $value;
  echo "<option value='" . $row['id'] . "'".$value.">" . $row['role'] . "</option>";
}
}
?>
</select>

 <button type = "submit" name = "submit" class="btn">Update</button>

 <a href="users_list.php" class="btn btn-red" >Cancel</a>
 <br/>
 
</form>
<?php
}
include 'pages/footer.php';
?>