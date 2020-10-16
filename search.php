<?php
include 'pages/header.php';
include 'connection.php';


 $query = $_GET['search']; 
$sql = "SELECT * FROM product WHERE (`name` LIKE '%".$query."%') OR (`description` LIKE '%".$query."%')"
?>


<div class="container-fix">
    <h3>Search Results</h3>
<div class="row">
    <?php
if ($result=mysqli_query($conn, $sql))
{
 while($row = mysqli_fetch_assoc($result)) {
?>

  <div class="column3">
    <figure>
   
        <img src="images/img1.jpg">
        <h4><?php echo $row['name'];?></h4>
        <p>Available quantity: <?php echo $row['quantity'];?></p>
        <p>Description: <?php echo $row['description'];?></p>
        <p>Price: <?php echo $row['price'];?></p>
        <a href="cart.php" class="btn btn-green"> Add to cart</a>
        <?php 
                if($row['sale'] == 1)
                    echo "<figcaption>On sale</figcaption>";
               ?>
      
      
   </figure>
    </div>

<?php
}
}else{

    echo "No result found!";
}
?>

</div>
    </div>