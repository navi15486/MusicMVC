 <?php include '../app/views/includes/header.php'; ?>

<?php 
  $user = $this->model('userModel');
  $user = unserialize($_SESSION['user']); 
  $image = unserialize($_SESSION['image']);
echo "<div class='jumbotron'>
  <h2>Update Your Profile</h2>
  <form role='form' action='' method='post' enctype='multipart/form-data' id='updateProfile'>
    <div class='form-group'>
      <label for='name'>Name:</label>
      <input type='text' class='form-control' id='name' name= 'name' value = '" . $user->getProfile()->getName() . " '  >
    </div>
    <div class='form-group'>
      <label for='paypalEmail'>PayPal Account:</label>
      <input type='email' class='form-control' name = 'paypalAccount' id='paypalAccount' value = '" . $user->getProfile()->getPaypal() . " '>
    </div>
    <div class='form-group'>
      <label for='age'>Age: *Optional</label>
      <input type='text' class='form-control' id='age'  name = 'age' value = '" . $user->getProfile()->getAge() . " '>
    </div>
    <div class='form-group'>
      <label for='country'>Country: *Optional</label>
      <input type='text' class='form-control' id='country'  name = 'country' value = '" . $user->getProfile()->getCountry() . " '>
    </div>
    <div class='form-group'>
      <label for='city'>City: *Optional</label>
      <input type='text' class='form-control' id='city' name='city' value = '" . $user->getProfile()->getCity() . " '>
    </div>
    <div class='form-group'>
      <label><input type='checkbox' value='1' name= 'singer' id='singer'>Singer</label>
    </div>
    <div class='form-group'>
      <label><input type='checkbox' value='1' name= 'producer' id='producer'>Music Producer</label>
    </div>
    <div class='form-group'>
      <label for='img'>Image:</label>
       <input type='file' id='img' name='fileToUpload' placeholder='Upload Profile Image:''>
    </div>
     <div class='media'>
  <div class='media-left'>
    <a href='#'>
      <img class='media-object' id='img' src="; echo "http://localhost/music/app/profileImages/" .$image->getImage(); echo " alt='Profile Photo' title='click here to edit'>
      
    </a>
  </div>
  <div class='media-body'> 
    
  </div>
</div>
    <button type='submit' class='btn btn-default' name='submit'>Submit</button>
  </form>
</div>";
   ?>
   <style>
img {
  width:100px;
  height:100px;
   border-radius: 50%;
}
</style>
  <?php include '../app/views/includes/footer.php';?>


