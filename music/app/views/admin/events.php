<?php include '../app/views/includes/adminHeader.php'; ?>
<h1> All the Events </h1>
<style type="text/css">
	.table th, .table td { 
     border-top: none !important; 
 }

</style>
<div class="panel" >
<?php
  if (isset($data['errors']))
  {
    $errors  = $data['errors'];
    foreach($errors as $error => $data)
    {
    echo $data . "<br>";
    }
  }

  ?>
   </div>  
<?php
	 

	//get all the events
	$events = $data['events'];

	foreach ($events as $event )  
	{
	echo "
<div class='table-responsive'  >      
      <table class='table'>
      
        <tbody>";

echo 
  "  
  <form role='form' action ='' method='post' name= 'hh'>
            <h3><tr><td><input type = 'text' name = 'event_name' size='50'  value =' "  . $event->getName() .  " ' /></td></tr></h3>
             
             <tr><td>
             <textarea name='description' rows='5' cols='60'>" . $event->getDescription() . " </textarea></td></tr>
             <tr>
            <td><input type = 'submit' class='btn btn-primary' value = 'Update' name = 'update' id='update'/> 
            <input type = 'submit' class='btn btn-primary' value = 'Delete' name = 'delete'  id='delete'/> </td>
            </tr>
          <td><input type = 'hidden' value = '" . $event->getEventId() . " ' name = 'event_id' ></input></td>
          </form> ";
}
echo "      
        </tbody>
      </table>
        
    </div>";
	 include '../app/views/includes/adminFooter.php';
?>