
<?php
include 'pages/header.php';
include 'connection.php';

$product = "SELECT product.*, product_category.category FROM product INNER JOIN product_category ON product.category_id = product_category.id";

?>
    <div class="container-fix">
    <a href="add_product.php" class="btn btn-green pull-right margin-btm"> Add a New Product</a>
<table id="table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Added Date</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Sale</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
<?php

if ($result=mysqli_query($conn, $product))
{
 while($row = mysqli_fetch_assoc($result)) {
?>
 	     <tr>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['created_date'];?></td>
                <td><?php echo $row['quantity'];?></td>
                <td><?php echo $row['description'];?></td>
                <td><?php echo $row['price'];?></td>
                <td><?php echo $row['category'];?></td>
                <td><?php 
                if($row['sale'] == 1)
                	echo "On sale";
                else
                	echo "Not on sale";

                ?></td>
                <td><?php echo "<a href= edit_product.php?id=".$row['id']." class='btn btn-green'>Edit </a>"; ?>
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
        url: 'delete_product.php',
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