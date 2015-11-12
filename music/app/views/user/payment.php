 <?php include '../app/views/includes/header.php'; ?>

<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
 <div class="jumbotron">
<?php include '../app/views/includes/profileMenu.php'; ?>

  <?php 
  $user = $this->model('userModel');
  $user = unserialize($_SESSION['user']);

  $image = $this->model('imageModel');
  $image = unserialize($_SESSION['image']);

  $user->getProfile()->setProfile($user->getId());
  $_SESSION['user'] =  serialize($user); 
  echo 'Make the Payment'; 
?>
         </div>
  <?php include '../app/views/includes/footer.php';?>