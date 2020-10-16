<?php
include 'pages/header.php';
include 'connection.php';

$sql = "SELECT * FROM product";
?>

<div class="container-fix">
    <h3>Featured Items</h3>
<div class="row">
    <?php
if ($result=mysqli_query($conn, $sql))
{
 while($row = mysqli_fetch_assoc($result)) {
?>

  <div class="column3">


    <figure>
   <form method="post" action="home.php?action=add&code=<?php echo $row['id'];?>" class="no-margin-padding">
        <img src="images/<?php echo $row['image'];?>">
        <h4><?php echo $row['name'];?></h4>
        <p>Available quantity: <?php echo $row['quantity'];?></p>
        <p>Description: <?php echo $row['description'];?></p>
        <p>Price: <?php echo $row['price'];?></p>
        <?php 
                if($row['sale'] == 1)
                    echo "<figcaption>Sale</figcaption>";
        ?>
        <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
    </form>

   </figure>

    </div>

<?php
}
}
?>

</div>
    </div>

<?php
include 'pages/footer.php';
?>


<?php
if(isset($_GET["code"])){
$sql = "SELECT * FROM product WHERE id='" . $_GET["code"] . "'";

if ($result=mysqli_query($conn, $sql))
{
 while($row = mysqli_fetch_assoc($result)) {


if(!empty($_GET["action"])) {


switch($_GET["action"]) {

case "add":

if(!empty($_POST["quantity"])) {

$itemArray = array($row['id']=>array('name'=>$row['name'], 'id'=>$row['id'], 'quantity'=>$_POST['quantity'], 'price'=>$row['price'], 'image'=>$row['image']));

 if(!empty($_SESSION["cart_item"])) {
                if(in_array($row['id'],array_keys($_SESSION["cart_item"]))) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                            if($row["id"] == $k) {
                                if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                    }
                } else {
                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                }

            } else {
                $_SESSION["cart_item"] = $itemArray;
            }
        }
    break;

 }
}
}
}
}
//print_r($_SESSION);
?>

