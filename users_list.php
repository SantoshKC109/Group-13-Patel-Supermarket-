
<?php
include 'pages/header.php';
include 'connection.php';

$users = "SELECT user.*, user_role.role FROM user INNER JOIN user_role ON user.role_id = user_role.id where user_role.role != 'admin'";
?>

    <div class="container-fix">
    <a href="add_user.php" class="btn btn-green pull-right margin-btm"> Add a New user</a>
      <table id="table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone no.</th>
                <th>email</th>
                <th>role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
<?php

if ($result=mysqli_query($conn, $users))
{
 while($row = mysqli_fetch_assoc($result)) {
?>
 	     <tr>
                <td><?php echo $row['username'];?></td>
                <td><?php echo $row['first_name'];?></td>
                <td><?php echo $row['last_name'];?></td>
                <td><?php echo $row['phone_no'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['role'];?></td>
                <td><?php echo "<a href= edit_profile.php?id=".$row['id']." class='btn btn-green'>Edit </a>"; ?>
                <span class='delete btn btn-red' data-id='<?php echo $row['id']; ?>'>Delete</span>
                </td>
            </tr>
<?php
}
}
?>
</tbody>
</table>
</div>

<script>
$(document).ready(function() {
    $('#table').DataTable();
} );

$(document).ready(function(){

 // Delete 
 $('.delete').click(function(){
   var el = this;
  
   // Delete id
   var deleteid = $(this).data('id');

   //debugger;
 
   var confirmalert = confirm("Are you sure?");
   if (confirmalert == true) {
      // AJAX Request
      $.ajax({
        url: 'delete_user.php',
        type: 'POST',
        data: { id:deleteid },
        success: function(response){

          if(response == 1){
	    // Remove row from HTML Table
	    $(el).closest('tr').css('background','tomato');
	    $(el).closest('tr').fadeOut(800,function(){
	       $(this).remove();
	    });
          }else{
	    alert('Invalid ID.');
          }

        }
      });
   }

 });

});
</script>