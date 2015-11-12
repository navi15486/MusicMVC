 <?php include '../app/views/includes/adminHeader.php'; ?>
<?php
$shopping_cart = $data['shopping_cart'] ;
 
 echo "
      <h2>List of the Users</h2>
       <div class='table-responsive'>      
      <table class='table'>
      <thead>
          <tr> 
          <th>ShoppingLineId</th> 
            <th>ProfileId</th>
            <th>AudioId</th>
            
             
          </tr>
        </thead>
        <tbody>";
foreach ($shopping_cart as $cart ) { 
	
echo 
  " <tr><form role='form' action ='' method='post' name= 'hh'>
            <td><input type = 'text' name = 'lineId' size='10' value = '" . $cart->getLineId() .  "'  /></td>
            <td><input type = 'text' size='10' value = '" . $cart->getProfileId() . " ' name = 'profileId'/> </td>
            <td><input type = 'text' size='10' value = '" . $cart->getAudioId() . " ' name = 'audioId' /></td>
            
            <td><input type = 'submit' class='btn btn-primary' value = 'Delete' name = 'delete'  id='update'/> </td>
            <td><input type = 'submit' class='btn btn-primary' value = 'Update' name = 'update' id='update'/></td>
          
          </form></tr>";
}
echo "      
        </tbody>
      </table>
        
    </div>";
?>
  
    
<?php include '../app/views/includes/adminFooter.php'; ?>
