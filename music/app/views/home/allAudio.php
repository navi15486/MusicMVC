<?php include '../app/views/includes/header.php';  
?>
<div class = "jumbotron">

<h1> All the songs</h1>

<table class="table table-hover">
    <thead>
      <tr>
        <th>Title</th>
        <th>Genre</th>
        <th>Type</th>
        <th>Size</th>
      </tr>
    </thead>
    <tbody>


<?php
$audio_array = $data['audioArray'];
foreach ($audio_array as $value)
{
	echo "<form action='' method='post' enctype='multipart/form-data'><tr>
            <input type='hidden' name='audioID' value='". $value->getAudioID() . "' />
        <td>". $value->getAudioName() ."</td>
        <td>". $value->getAudioGenre() ."</td>
        <td>". $value->getAudioType()  ."</td>
        <td>". $value->getAudioSize()  ."</td>
         <td><input   type='submit' name='like' value='Like' /></td>
         <td><input type='submit' name='dislike' value = 'Dislike'  > </input></td>
        <td><input type='submit' name='addtocart' value='Add to Cart' /></td>
      </tr></form>";
}
?>
</tbody>
</table>
</div>