<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
	}
	if (isset($_SESSION['user']) && isset($_SESSION['profile']))
	{
?>
<hr>
<form method="post" >
<ul class="nav nav-pills">
<li  class="active"><a href="http://localhost/music/public/profile"><span class="glyphicon glyphicon-home"></span>Home</a></li>
<li  ><a href="http://localhost/music/public/event/"><span class="glyphicon glyphicon-glass"></span>Add an event</a></li> 
<li  ><a href="http://localhost/music/public/audio"><span class="glyphicon glyphicon-music"></span>Add Audio </a></li>
<li  ><a href="http://localhost/music/public/audio/manage"><span class="glyphicon glyphicon-music"></span>Manage Audio </a></li>
</ul>
 </form>
  <hr>
 <?php
} 
?>
<script>
 $(document).ready(function () {
			        var url = window.location;
			        $('ul.nav a[href="'+ url +'"]').parent().addClass('active');
			        $('ul.nav a').filter(function() {
			             return this.href == url;
			        }).parent().addClass('active');
    			});


</script>