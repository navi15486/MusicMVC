 <?php include '../app/views/includes/adminHeader.php'; ?>
<?php
$users = $data['users'] ;
 
 echo "
      <h2>List of the Users</h2>
       <div class='table-responsive'>      
      <table class='table'>
      <thead>
          <tr> 
            <th>Firstname</th>
            <th>LastName</th>
            <th>Username</th>
            <th>Password</th>
            <th>GroupId</th>
            <th>Unregisterd</th>
          </tr>
        </thead>
        <tbody>";
foreach ($users as $user ) { 
	
echo 
  " <tr><form role='form' action ='index' method='post' name= 'hh'>
            <td><input type = 'text' name = 'fname' size='10' value = '" . $user->getFname() .  "'  /></td>
            <td><input type = 'text' size='10' value = '" . $user->getLname() . " ' name = 'lname'/> </td>
            <td><input type = 'text' size='10' value = '" . $user->getUsername() . " ' name = 'username' /></td>
            <td><input type = 'text' value = '" . $user->getPassword() . " ' name = 'password' /></td>
            <td><input type = 'text' size='1' value = '" . $user->getGroupId() . " ' name = 'groupId' /></td>
            <td><input type = 'text' size='1' value = '" . $user->getUnregistered() . " ' name = 'unregister'/></td>
            <td><input type = 'submit' class='btn btn-primary' value = 'Delete' name = 'delete'  id='update'/> </td>
            <td><input type = 'submit' class='btn btn-primary' value = 'Update' name = 'update' id='update'/></td>
          <td><input type = 'hidden' value = '" . $user->getId() . " ' name = 'userId' ></input></td>
          </form></tr>";
}
echo "      
        </tbody>
      </table>
        
    </div>";
?>
    
<?php include '../app/views/includes/adminFooter.php'; ?>
