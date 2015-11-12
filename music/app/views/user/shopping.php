<?php include '../app/views/includes/header.php'; 
$audio_array = $data['audioArray'];
$shopping_cart = $data['shopping_cart'];
$profile_id = $data['profile_id'];
?>


<div class=" jumbotron  bs-example formLogin"  >

<h1>Shopping Cart</h1>

<table class="table table-hover">
    <thead>
      <tr>
        <th>Title</th>
        <th>Genre</th>
        <th>Type</th>
        <th>Size</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>

<?php
$total = 0;
$arr = [];
foreach ($audio_array as $value)
 {

    $audio = $value->getAudioFile();
	echo "<form action='' method='post' enctype='multipart/form-data'>

          <tr>
            <input type='hidden' name='audioID' value='". $value->getAudioID() . "'> 

            <input type='hidden' name='cartId' value='". $value->getCartId() . "'>
            
        <td>". $value->getAudioName() ."</td>
        <td>". $value->getAudioGenre() ."</td>
        <td>". $value->getAudioType()  ."</td>
        <td>". $value->getAudioSize()  ."</td>
        <td>". $value->getAudioPrice()  ."</td>
         <td><input type='submit' name='remove' value='Remove'/></td>
      </tr>

      </form>"

      ;

      $total += $value->getAudioPrice();
      $arr[] = $value->getAudioID();
}

echo "
<input type='hidden' name='total' value='". $total . "'>
	    <tr>
    	<td colspan='9'>Total: $". $total ."</td>
  		</tr>";

?>

</tbody>
</table>
 <form   method='post' enctype='multipart/form-data' action ="">
 
<input type='submit' name='checkout' value='Checkout'>
 </form>
</div>
</div>

<?php include '../app/views/includes/footer.php';?>