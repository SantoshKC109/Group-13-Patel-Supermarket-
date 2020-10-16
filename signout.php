<?php
if(session_id() == '') {
    session_start();
}
   unset($_SESSION["logged_in"]);
   unset($_SESSION["username"]);
   unset($_SESSION["user_id"]);
   session_destroy();
  // echo 'You have cleaned session';
   header('Refresh: 2; URL = signin.php');
?>