
<?php
include 'pages/header.php';
include 'connection.php';

?>
    <div class="container-fix">

<form>
  <label>Date From:</label>
<input type="text" id="date_from" class="datepicker">
  <label>Date To:</label>
<input type="text" id="date_to" class="datepicker">

  <label>Category:</label>
  <select name='category' id="category">
    <option value="0"> All Category </option>
<?php 
$product = "SELECT * FROM product_category";
if ($result=mysqli_query($conn, $product))
{
 while($row = mysqli_fetch_assoc($result)) {
  echo "<option value='" . $row['id'] . "'>" . $row['category'] . "</option>";
}
}
?>
</select>
<span  id = "submit" class="btn btn-green" >Find Records</span>

</form>

<span id = "totalsales"></span>

<table id="table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Sold on</th>
                <th>Product Name</th>
                <th>Product category</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Ordered By</th>
                <th>Deliver Status</th>
            </tr>
        </thead>
        <tbody id="tabledata">

</tbody>
</table>
</div>

<script>
$(document).ready(function() {
  
} );

  $( function() {
    $( ".datepicker" ).datepicker({  dateFormat: 'yy-mm-dd' });
  } );
$(document).ready(function(){

 // Delete 
 $('#submit').click(function(){
var str = null;

if(($('#date_from').val() == '') || ($('#date_to').val() == '' )){
alert("Please select the dates.");
}
  var formData = {
            'date_from' : $('#date_from').val(),
            'date_to'   : $('#date_to').val(),
            'category'  : $('#category').val()
        }

   totalsum = 0;

      $.ajax({
        url: 'stats-ajax-feed.php',
        type: 'POST',
        data: formData,
        success: function(response){
    var table=  $('#table').DataTable();
    table.clear();
    var jsonData = JSON.parse(response);
    for (var i = 0; i < jsonData.length; i++) {
  totalsum = totalsum + parseInt(jsonData[i].price);
  table.row.add( [jsonData[i].date, jsonData[i].name, jsonData[i].category, jsonData[i].quantity, jsonData[i].price, jsonData[i].username, jsonData[i].delivery_status] ).draw(false);
}
$('#totalsales').html("<h3><center>Total sales amount: " + totalsum +"</center></h3>");

        }
      });
  

 });

});

</script>