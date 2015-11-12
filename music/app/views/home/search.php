<?php include '../app/views/includes/header.php'; ?>
<div class = "jumbotron"> 
<?php
	if (isset ($data['profiles']))
	{
		$profiles = $data['profiles'] ;
		echo '<h1> Searched Profiles </h1>';
		foreach ($profiles as $profile )
		{
			$image = $this->model('imageModel');
			$imageSrc = $image->getImageByProfile($profile->getProfileId());

			echo "<img src = http://localhost/music/app/profileImages/" . $imageSrc . " width='30' height= '30'/> "; 
			echo "<a href= http://localhost/music/public/search?profile=". $profile->getProfileId() ."  >"
			 .'Name is ' . $profile->getName() . "</a><br>" ;
		}
	}
	if(isset ($data['profile']))
	{
		$profile = $data['profile'] ;
		$image = $this->model('imageModel');
		$imageSrc = $image->getImageByProfile($profile->getProfileId());

		echo '<h1>Name: ' . $profile->getName() . " Information</h1>";
		echo '<h1>Age: ' .$profile->getAge() . "</h1><br>";
		echo "<h1>City:" . $profile->getCity() . "</h1><br>";
		echo "<h1>Country:" . $profile->getCountry() . "</h1><br>";
		echo "<img src = http://localhost/music/app/profileImages/" . $imageSrc . " width='400' height= '300'/> "; 
			
	}
 ?>
 </div>
 <?php include '../app/views/includes/footer.php';?>