<?php 

if(session_id() == '') { 
  session_start();
}

if(isset($_SESSION["logged_in"]))
{

header('Refresh: 2; URL = home.php');

}
else{
  include 'pages/header.php';
  include 'connection.php';
  $msg = '';

  if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {

  $name = $_POST["username"]; 

  $password = $_POST['password'];

  $hash =  password_hash($password, PASSWORD_DEFAULT);

  $sql = "SELECT id, username, password FROM user WHERE username = '".$name."'";

  if ($result=mysqli_query($conn, $sql))
  {

   $rowcount=mysqli_num_rows($result);

   if($rowcount > 0 ){
     while($row = mysqli_fetch_assoc($result)) {
      $pass = $row['password'];
      $id = $row['id'];

      if (password_verify($password, $pass)) {
       $_SESSION["logged_in"] = true; 
       $_SESSION["ses_name"] = $name; 
       $_SESSION["user_id"] = $id; 
       header("Location: home.php");
     } 
     else {
      $msg = 'Invalid Username or password.';
    }
  }
  }else{
   $msg = "No data was found.";
  }

    // Free result set
  mysqli_free_result($result);
  }
  else
  {
    $msg = 'The username or password are incorrect!';
  }
  mysqli_close($conn);
  }
  ?>

  <form class = "form-signin" role = "form"  action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
    <center><img src="logo.png" class="logo"></center>
  <h4>Login</h4>
  <p class = "error"><?php echo $msg; ?></p>
  <input type = "text" class = "form-control" name = "username" placeholder = "Enter Username"  required autofocus></br>
  <input type = "password" class = "form-control" name = "password" placeholder = "Enter Password" required><br/>


<input type='checkbox' id="standard" />
<span> Remember me</span> <br/><br/>


  <button type = "submit" name = "login" class="btn">Login</button>
  <a href="pass-reset.php" class="btn btn-yellow" >Forget Password</a>
  <a href="create_user.php" class="btn btn-green" >Register</a>
  </form>

  <?php

  include 'pages/footer.php';
}
  ?>