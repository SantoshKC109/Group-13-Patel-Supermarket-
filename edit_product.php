<?php
include 'pages/header.php';
include 'connection.php';

$form_hide = false;
$product_id =  $_GET['id'];

$product = "SELECT * FROM product_category";
$selected_product = "SELECT * FROM product where id=".$product_id;

if ($result=mysqli_query($conn, $selected_product))
{

 while($row = mysqli_fetch_assoc($result)) {
  $product_name = $row['name'];
  $quantity = $row['quantity'];
  $description = $row['description'];
  $price = $row['price'];
  $image = $row['image'];
  $sale = $row['sale'];
}
}

$msg = NULL;
//var_dump($_POST['submit']);
if (isset($_POST['submit'])){
	//$name = "ssss";
	//var_dump($_POST);
  $product_name = $_POST['product_name'];
  $quantity = $_POST['quantity'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $category = $_POST['category'];
//$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  If(isset($_POST['sale']))
  $sale = $_POST['sale'];
  else
  $sale = 0;


  if($product_name == NULL){

    $msg .= "Please enter Product name with length more than 2 letters <br/>"; 

  }

if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){

$image_name = "";
$uploadOk = 1;
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

 $check = getimagesize($_FILES["image"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $msg .=  "File is not an image.<br/>";
    $uploadOk = 0;
  }

// Check if file already exists
if (file_exists($target_file)) {
  $msg .=  "Sorry, file already exists.<br/>";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["image"]["size"] > 500000) {
  $msg .=  "Sorry, your file is too large.<br/>";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $msg .=  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br/>";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $msg .=  "Sorry, your file was not uploaded, fix the issues first.<br/>";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $image_name = htmlspecialchars(basename( $_FILES["image"]["name"]));
   
  } else {
    $msg .=  "Sorry, there was an error uploading your file.<br/>";
  }
}

 if($msg == NULL && $uploadOk == 1){

 $sql = "UPDATE product SET name = '".$product_name."', quantity='".$quantity."', description='".$description."', price='".$price."', category_id='".$category."', image='".$image_name."', sale='".$sale."' WHERE id='".$product_id."'";

  if ($conn->query($sql) === TRUE) {
    echo "<p class='success'>Record updated successfully</p> <br/> <a href='product_list.php'>Click here to go back to product list</a>";
    $form_hide = TRUE;
  } else {
    echo "Error updating record: " . $conn->error;
  }
  $conn->close();

}

}
else{


 if($msg == NULL){
//echo "image not selected";

 $sql = "UPDATE product SET name = '".$product_name."', quantity='".$quantity."', description='".$description."', price='".$price."', category_id='".$category."', image='".$image."', sale='".$sale."' WHERE id='".$product_id."'";

  if ($conn->query($sql) === TRUE) {
    echo "<p class='success'>Record updated successfully</p> <br/> <a href='product_list.php'>Click here to go back to product list</a>";
    $form_hide = TRUE;
  } else {
    echo "Error updating record: " . $conn->error;
  }
  $conn->close();
}
}
}

if($form_hide == FALSE){
  ?>
<form method="post" action="edit_product.php?id=<?php echo $product_id; ?>" class="Registration" enctype="multipart/form-data">

  <h4>Edit Product</h4>

  <p class = "error"><?php echo $msg; ?></p>

  <label>Product name:</label>

  <input name="product_name"  type="text" value="<?php echo $product_name; ?>"> <br/>

  <label>quantity:</label>

  <input name="quantity"  type="text" value="<?php echo $quantity; ?>"> <br/>

  <label>description:</label>

  <textarea name="description"><?php echo $description; ?></textarea>

  <label>price:</label>

  <input type="text" name="price" value="<?php echo $price; ?>">  <br/>

  <label>Category:</label>

  <select name='category'>
<?php 
if ($result=mysqli_query($conn, $product))
{
 while($row = mysqli_fetch_assoc($result)) {
  echo "<option value='" . $row['id'] . "'>" . $row['category'] . "</option>";
}
}
?>
</select>

<label>Browse Image </label>

  <input type="file" name="image"> <br/>

  <label>Is product on sale? 
  <input type="checkbox" id="sale" name="sale" value="1"></label>
  <br/>
  <br/>

 <button type = "submit" name = "submit" class="btn">Update</button>
</form>
<?php
}
include 'pages/footer.php';
?>