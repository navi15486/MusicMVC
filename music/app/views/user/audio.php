<?php include '../app/views/includes/header.php'; 

$audio_array = $data['audioArray']; 

?>
<div class = "jumbotron">

 <?php include '../app/views/includes/profileMenu.php'; ?>

<h2>Manage Audio</h2>
<div class="panel">
<?php
if(isset($data['message']))
    echo $data['message'];
?>
</div>
 
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
foreach ($audio_array as $value)
 {
	echo "<form action='' method='post' enctype='multipart/form-data'><tr>
            <input type='hidden' name='audioID' value='". $value->getAudioID() . "' />
        <td>". $value->getAudioName() ."</td>
        <td>". $value->getAudioGenre() ."</td>
        <td>". $value->getAudioType()  ."</td>
        <td>". $value->getAudioSize()  ."</td>
        <td><input type='text' name='price' size='1' value=' ". $value->getAudioPrice()  ." '></td>
        <td><input type='submit' name='delete' value='Delete'></td>
        <td><input type='file' name='updateAudio' update value='Update'/></td>
        <td><input type='submit' name='update' value='update' /></td>
        <td>
        </td>
      </tr></form>";
}

?>

</tbody>
</table>

</div>


<?php include '../app/views/includes/footer.php';?>