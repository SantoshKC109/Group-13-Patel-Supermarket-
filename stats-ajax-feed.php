<?php 
include 'connection.php';


if(isset($_POST['category']) && isset($_POST['date_from']) && isset($_POST['date_to'])  ){

$category = $_POST['category'];
$date_from = $_POST['date_from'];
$date_to = $_POST['date_to'];

// $category = '0';
// $date_from = '2020-05-13';
// $date_to = '2020-10-13';
if($category != 0){
$product = "SELECT sales.*, product_category.category, product.name, user.username FROM sales INNER JOIN product ON sales.product_id = product.id INNER JOIN product_category ON product.category_id = product_category.id INNER JOIN user ON sales.user_id = user.id WHERE (sales.date between '".$date_from."' and '".$date_to."') AND product_category.id = '".$category."'";
}else{
$product = "SELECT sales.*, product_category.category, product.name, user.username FROM sales INNER JOIN product ON sales.product_id = product.id INNER JOIN product_category ON product.category_id = product_category.id INNER JOIN user ON sales.user_id = user.id WHERE (sales.date between '".$date_from."' and '".$date_to."')";
}

//echo $product;
if ($result=mysqli_query($conn, $product))
{
 while($row = mysqli_fetch_assoc($result)) {

    $results[] = $row;
  }
   echo json_encode($results);
 }
 else{
  echo 0;
 }

 


}


// $id = 0;
// if(isset($_POST['id'])){
//    $id = mysqli_real_escape_string($conn,$_POST['id']);
// }
// if($id > 0){

//   // Check record exists
//   $checkRecord = mysqli_query($conn,"SELECT * FROM user WHERE id=".$id);
//   $totalrows = mysqli_num_rows($checkRecord);

//   if($totalrows > 0){
//     // Delete record
//     $query = "DELETE FROM user WHERE id=".$id;
//     mysqli_query($conn,$query);
//     echo 1;
//     exit;
//   }else{
//     echo 0;
//     exit;
//   }
// }

exit;

?>