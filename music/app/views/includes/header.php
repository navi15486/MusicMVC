
<!DOCTYPE html>
<html>
<head>
<script src="//code.jquery.com/jquery-latest.min.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->

<script type="text/javascript">
	//javascript to make dynamic pages
	$(document).ready(function () {
	var url = window.location;
	$('ul.nav a[href="'+ url +'"]').parent().addClass('active');
	$('ul.nav a').filter(function() {
	return this.href == url;
	}).parent().addClass('active');
	});

	var index = 1

	function mouuseout(id) {
	document.getElementById(id).style.opacity = 1
	}
	function onHover(id) {
	document.getElementById(id).style.opacity = 0.5
	}
</script>

<title><?php echo $data['title'];?></title>
</head>
<body>
<style type="text/css">
	body {
		color:black;
		 background: grey !important;
	}
</style>
<nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top " role="navigation">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="container">
<div class="navbar-header ">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href = "index.php"><img style="width:200px;height:30px" id = "logo"  src = "http://localhost/music/app/images/music.png" /></a>

</div>
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse " id="navbarCollapse">
<div class="col-sm-3 col-md-3 pull-right">
<form class="navbar-form" role="search" action ="http://localhost/music/public/search">
<div class="input-group">
<input type="text" class="form-control" onkeyup="showResult(this.value)" placeholder="Search" name="search" id="srch-term">
<div class="input-group-btn">
<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>

</div>
</div>
</form>
</div>
<ul class="nav navbar-nav navbar-right"> 
<li  ><a href="http://localhost/music/public/home/">Home</a></li>
<li> <a href="http://localhost/music/public/home/contact">Contact</a></li>
<li> <a href="http://localhost/music/public/home/about" >About</a></li>

<?php 
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
if (isset($_SESSION['user']) && !isset($_SESSION['admin']))
{
?>

<li > 
<a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
<span class="">Profile</span>
</a>
<ul class="dropdown-menu">
<li><a href = "http://localhost/music/public/Profile/updateProfile">Change profile</a></li>
<li><a href = "http://localhost/music/public/Profile/removeProfile">Remove Profile</a></li>
<li><a href = "http://localhost/music/public/Profile/">Profile</a></li>
</ul> </li>
<li > 
<a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
<span class="glyphicon glyphicon-user"></span>
</a>
<ul class="dropdown-menu">
<li><a href = "http://localhost/music/public/login/logout">Logout</a></li>
<li><a href = "http://localhost/music/public/login/unregister">Unregisterd</a></li>
<li><a href = "http://localhost/music/public/login/resetPassword">ResetPassword</a></li>
</ul>
</li>

<li>
<a href="" class="dropdown-toggle" data-toggle="dropdown" > 
<span class="glyphicon glyphicon-music"> 
</span>
</a>
<ul class="dropdown-menu">
<li><a href = "http://localhost/music/public/audio/getAudios">All Audios</a></li>
<li><a href = "http://localhost/music/public/audio/getPopularSongs">Most Popular</a></li>
</ul>
</li>
<li>
<a href="http://localhost/music/public/shopping" > 
<span class="glyphicon glyphicon-shopping-cart"><?php
//session_start( );
if(isset($_SESSION['user']))
{
	$user = $this->model('userModel');
	$user = unserialize($_SESSION['user']); 
	$user_id = $user->getId();
	$profile_id = $user->getProfile()->getProfileId();
	$cart = $this->model('cartModel');
	echo $cart->countCart($profile_id);
}
?>
<?php 
}
else if (isset($_SESSION['user'] , $_SESSION['admin'] ))
{
?>
<li><a href = "http://localhost/music/public/admin/">Admin Area</a></li>
<?php
}
else
{
?>
<li><a href="http://localhost/music/public/registration">Create an Account</a></li>
<li ><a href="http://localhost/music/public/login">Login</a></li>
<?php } ?>



</span>
</a></li>


</ul>			 
</div>
</div>
</nav>

<div class = "container">

