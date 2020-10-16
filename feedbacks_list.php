
<?php
include 'pages/header.php';
include 'connection.php';

$sql = "SELECT * FROM feedbacks" ;
?>

    <div class="container-fix">
   <center><h3>Feedbacks List</h3></center>
      <table id="table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>email</th>
                <th>address</th>
                <th>feedback Message</th>
            </tr>
        </thead>
        <tbody>
<?php

if ($result=mysqli_query($conn, $sql))
{
 while($row = mysqli_fetch_assoc($result)) {
?>
 	     <tr>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['address'];?></td>
                <td><?php echo $row['feedback'];?></td>
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

</script>