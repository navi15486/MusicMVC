<?php include '../app/views/includes/header.php'; ?>
<div class = "jumbotron">
 <?php include '../app/views/includes/profileMenu.php'; ?>
<?php

?>
<p>Upload your audio</p>
<div class="panel" >
<?php
if (isset($data['message']))
  echo $data['message'];
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

		<form action='' method="post" enctype="multipart/form-data">
		
		

		<label>Select type of audio to upload</label>
		<div class="radio">
      	<label><input type="radio" name="audioChoice" value = "song">Song</label>
   		</div>
   		<div class="radio">
   		<label><input type="radio" name="audioChoice" value = "instrumental">Instrumental</label>
   		</div>

   		<label>Select music genre</label>
   		<div class="radio">
      	<label><input type="radio" value="alternative" name= "genre">Alternative Music</label>
    	</div>

    	<div class="radio">
      	<label><input type="radio" value="blues" name= "genre" >Blues</label>
    	</div>

    	<div class="radio">
      	<label><input type="radio" value="country" name= "genre" >Country Music</label>
    	</div>

    	<div class="radio">
      	<label><input type="radio" value="dance" name= "genre" >Dance Music</label>
    	</div>

    	<div class="radio">
      	<label><input type="radio" value="electronic" name= "genre" >Electronic Music</label>
    	</div>

    	<div class="radio">
      	<label><input type="radio" value="rap" name= "genre" >Hip Hop / Rap</label>
    	</div>

    	<div class="radio">
      	<label><input type="radio" value="jazz" name= "genre" >Jazz</label>
    	</div>

    	<div class="radio">
      	<label><input type="radio" value="pop" name= "genre" >Pop</label>
    	</div>

    	<div class="radio">
      	<label><input type="radio" value="soul" name= "genre" >R&#38;B / Soul </label>
    	</div>

    	<div class="radio">
      	<label><input type="radio" value="reggae" name= "genre" >Reggae</label>
    	</div>

    	<div class="radio">
      	<label><input type="radio" value="rock" name= "genre" >Rock</label>
    	</div>

    	<div class="form-group">
		    <input type="file" name="audioFile">   
		 </div>  
		  
        <div class="form-group" id="firstnameError">
            $
            <div class="col-sm-3">
                <input type="text" id="price" class="form-control" placeholder="price" name="price" required>
                <span class="help-block" id = "firstname-help-block" style="visibility: hidden;">*Firstname Field is empty</span>
            </div>
        </div> 

		  <button type="submit" class="btn btn-default" name="submit">Submit</button>
		</form>
 </div>

<?php include '../app/views/includes/footer.php';?>