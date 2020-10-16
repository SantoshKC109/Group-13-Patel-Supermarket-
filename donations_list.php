
<?php
include 'pages/header.php';
include 'connection.php';

$sql = "SELECT * FROM donations" ;
?>

    <div class="container-fix">
   <center><h3>Donations List</h3></center>
      <table id="table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>email</th>
                <th>address</th>
                <th>feedback Message</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
<?php

if ($result=mysqli_query($conn, $sql))
{
    $total = 0;
 while($row = mysqli_fetch_assoc($result)) {
    $total = $row['amount'] + $total;
?>
 	     <tr>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['address'];?></td>
                <td><?php echo $row['feedback'];?></td>
                <td><?php echo $row['amount'];?></td>
                </td>
            </tr>
<?php
}
}
?>
</tbody>
</table>

<center><h3>Total Amount Donated: <?php echo $total ?></h3></center>
</div>

<script>
$(document).ready(function() {
    $('#table').DataTable();
} );

</script>