 <?php include '../app/views/includes/header.php'; ?>

<div class="jumbotron">
  <h2>Create Your Profile</h2>
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
  <form role="form" action='' method="post" enctype="multipart/form-data" id="createProfile">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" name= "name" value = "Amandeep" placeholder="Enter your name">
    </div>
    <div class="form-group">
      <label for="paypalEmail">PayPal Account:</label>
      <input type="email" class="form-control" id="paypalAccount" value = "navi15486@yahoo.com" name= "paypalAccount" placeholder="Enter PayPal Account email">
    </div>
    <div class="form-group">
      <label for="age">Age: *Optional</label>
      <input type="text" class="form-control" id="age"  value = "35" name= "age" placeholder="Enter your age">
    </div>
    <div class="form-group">
      <label for="country">Country: *Optional</label>
      <input type="text" class="form-control" id="country" value = "canada" name= "country" placeholder="Enter your Country">
    </div>
    <div class="form-group">
      <label for="city">City: *Optional</label>
      <input type="text" class="form-control" id="city" name="city" value = "montreal" placeholder="Enter your city">
    </div>
    <div class="form-group">
      <label><input type="checkbox" value="1" name= "singer" id="singer">Singer</label>
    </div>
    <div class="form-group">
      <label><input type="checkbox" value="1" name= "producer" id="producer">Music Producer</label>
    </div>
    <div class="form-group">
      <label for="img">Image:</label>
      <input type="file" id="img" name="fileToUpload" placeholder="Upload Profile Image:">
    </div>
    <button type="submit" class="btn btn-default" name="submit">Submit</button>
  </form>
</div>

  <?php include '../app/views/includes/footer.php';?>


