<?php
include 'pages/header.php';
include 'connection.php';
?>

<!-- main content starts here-->
    <section class="cart">
        <h2 class='heading'">Shopping Cart</h2>
        <div class="col-25">
    <div class="container">

<?php   
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>

<table>
  <tbody>
<tr>s
<th style="text-align:left;">Items</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr> 

<?php
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
    ?>

    <tr>
    <td><?php echo $item["name"]; ?></td>

    <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>

    <td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>

    <td  style="text-align:right;"><?php echo "$ ". number_format($item_price, 2); ?></td>

    <td style="text-align:center;"><a href="cart.php?action=remove&code=<?php echo $item["id"]; ?>" class="btnRemoveAction"><img src="images/icon-delete.png" alt="Remove Item" /></a></td>
    </tr>

    <?php
    $total_quantity += $item["quantity"];

    $total_price += ($item["price"]*$item["quantity"]);

    }

  
    ?>

    <tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>    
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>

<a href="signin.php" class="btn btn-red float-right" >Cancel</a>&nbsp; &nbsp; &nbsp;
<a href="checkout.php" class="btn btn-green float-right pad-right" >Proceed to Checkout</a> 
</p>
    </div>

  </div>
    </section>

<?php
include 'pages/footer.php';
?>

<?php

if(!empty($_GET["action"])) {

switch($_GET["action"]) {

case "remove":

    if(!empty($_SESSION["cart_item"])) {

        foreach($_SESSION["cart_item"] as $k => $v) {

                if($_GET["code"] == $k)

                    unset($_SESSION["cart_item"][$k]);     

                if(empty($_SESSION["cart_item"]))

                    unset($_SESSION["cart_item"]);
        }
    }
    break;

    case "empty":

        unset($_SESSION["cart_item"]);

    break; 

}
}

?>