 <?php include '../app/views/includes/header.php';  ?>

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
    $email = $image->getImage();
    $default = 'http://localhost/music/app/profileImages/' . $image->getImage();
    $size = 40;
    $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

  ?>

<style>
img {
  width:100px;
  height:100px;
   border-radius: 50%;
}
</style>
  <div class="media">
  <div class="media-left">
    <a href="#">
      <img class="media-object" id="img" src="<?php echo 'http://localhost/music/app/profileImages/' .$image->getImage()?>" alt="Profile Photo" title="click here to edit">
     <!-- <img class="media-object" src='<?php echo $grav_url;?>' alt="Profile Photo" >-->
    </a>
  </div>
  <div class="media-body">
    <a href="#"><h4 class="media-heading"><?php echo $user->getProfile()->getName();?></h4></a>
    
  </div>
</div>

  </div>
  <script>
  $("#img").hover(function(){
      $("#img").css("opacity","0.5");
      $("#img").html("change");
  });
  
  $("#img").mouseout(function(){
    $("#img").css("opacity","1.0");
  });


  </script>
  <?php include '../app/views/includes/footer.php';?>