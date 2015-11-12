<?php include '../app/views/includes/header.php'; ?>
<div class="jumbotron">
<div class= 'panel'>
<?php
	if (isset($data['message'])) 
	{ 
		echo $data['message'];   
	}
?>
</div>
</div>
<?php include '../app/views/includes/footer.php'; ?>