<?php include '../app/views/includes/header.php'; ?>
<div class="jumbotron">
<script type="text/javascript">
	
</script>
<div class= 'panel'>
<?php
	if (isset($data['message']))
		echo $data['message'];
?>
</div>
<h1>Upcoming Events</h1>
 <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Show Events</button>
  <div id="demo" class="collapse">
<?php 
	$events = $data['events'];
	foreach ($events as $event ) 
	{
		 echo "<h3>" . $event->getName() . "</h3>";
		 echo "<br>" . $event->getDescription() ;
	}
?>

</div> 

 </div>
 <div class = "panel">
<a href="http://facebook.com/navi15486" target="_blank"><img
src="http://static.viewbook.com/images/social_icons/facebook_32.png"/></a>
<a href = "https://plus.google.com/112463486445679042618/posts" target="_blank" > <img
src="http://static.viewbook.com/images/social_icons/google_32.png"/></a>
 
<a href="https://twitter.com/Aman15486" target="_blank" class="twitter-follow-button" data-show-count="false">Follow @twitter</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
</div> 
<?php include '../app/views/includes/footer.php';?>