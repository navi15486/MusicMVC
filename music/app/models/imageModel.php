<?php

require_once '../app/core/database.php';

/*** imageModel class handles queries related to image table in the database ***/
class imageModel
{
	private $image_type;
	private $image;
	private $image_size;
	private $image_name;
	private $profileId;

	/*** Adds an image to image table ***/
	public function add($profileId, $image_type, $image, $image_size, $image_name)
	{
		$this->image_type = $image_type;
		$this->image = $image;
		$this->image_size = $image_size;
		$this->image_name = $image_name;
		$this->profileId = $profileId;
		$connection = new pdoconn();
		$data = array("$this->profileId" , "$this->image_type", "$this->image", "$this->image_size" , "$this->image_name");
		$STH = $connection->DBH->prepare("INSERT INTO images (profile_id , image_type, image, image_size, image_name) VALUES (?,?, ?, ? ,?)");
		$STH->execute($data);		
	}

	/*** Update the Image in the Database ***/
	public function updateImage($image_type, $image, $image_size, $image_name,$profileId)
	{
		$this->image_type = $image_type;
		$this->image = $image;
		$this->image_size = $image_size;
		$this->image_name = $image_name;
		$this->profileId = $profileId;
		$data = array("$this->image_type", "$this->image", "$this->image_size" , "$this->image_name", "$this->profileId");
		$connection = new pdoconn();
		$STH = $connection->DBH->prepare("update images  set image_type = ? , image = ? , image_size = ? , image_name = ?   where profile_id =  ?");
		return $STH->execute($data);	
	}
	public function getImage()
	{
		return $this->image_name;
	}

	public function getImageByProfile($profile_id)
	{
		$connection = new pdoconn();
		$STH = $connection->DBH->prepare("SELECT * FROM images  where profile_Id =  ?");
		$STH->bindParam(1,$profile_id);
		$STH->execute();
		if($row = $STH->fetch())
		{
			$this->image = $row['image']; 
			$this->image_name = $row['image_name']; 
		}
		return $this->image_name;
	}

	public function getImageId()
	{
		return $this->imageId;
	}
	public function setImageId($imageId) 
	{
		$this->imageId = $imageId;
	}

	public function setProfileId($profile_id)
	{
		$this->profileId = $profile_id;
	}
}