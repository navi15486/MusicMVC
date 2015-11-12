<?php include '../app/views/includes/adminHeader.php'; ?>

<div class="container">
  <h2>Registration</h2>
  <form role="form"  method="post" enctype="multipart/form-data" id="createProfile">
    <div class="form-group">
      <label for="first_name">First Name:</label>
      <input type="text" class="form-control" id="fname" name= "fname" value = "Amandeep" placeholder="Enter your first name">
    </div>
    <div class="form-group">
      <label for="last_name">Last Name:</label>
      <input type="text" class="form-control" id="lname" name= "lname" value = "multani" placeholder="Enter your last name">
    </div>
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="email" class="form-control" id="username" name= "username" value = "tt@bb.com" placeholder="Enter your email">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password" value = "aman" placeholder="Enter password">
    </div>
    <div class="form-group">
      <label for="confirmPassword">Confirm Password:</label>
      <input type="password" class="form-control" id="confirmPassword" value = "aman" name="confirmPassword" placeholder="Confirm Password">
    </div>
    <button type="submit" class="btn btn-default" name="addUser">Submit</button>
  </form>
</div>

<?php include '../app/views/includes/adminFooter.php'; ?>
