<?php

require_once '../app/core/database.php';
require_once '../app/models/imageModel.php';
require_once '../app/models/audioModel.php';

class profileModel
{
	private $audio;
	private $profileId;
	private $name;
	private $paypalAccount;
	private $age;
	private $country;
	private $city;
	private $singer;
	private $producer;
	private $userId;
	private $image;
	private $audios;

	//Add a profile to the Profile table
	public function add( $name, $paypalAccount, $userId, $age, $country, $city, $singer, $producer)
	{
		$connection = new pdoconn();
		$data = array( "$name", "$singer", "$producer", "$paypalAccount", "$userId", "$age", "$country", "$city");
		$STH = $connection->DBH->prepare("INSERT INTO profiles ( name, singer, music_producer, paypalAccount, user_id, age, country, city) values (?, ?, ?, ?, ?, ?, ?, ?)");
	 
		// if query is successfully executed
		if ($STH->execute($data))
		{ 
		$this->name = $name;
		$this->paypalAccount = $paypalAccount;
		$this->userId = $userId;
		$this->age = $age;
		$this->country = $country;
		$this->city = $city;
		$this->singer = $singer;
		$this->producer = $producer;
		$this->profileId = $connection->DBH->lastInsertId();
		$this->audios = new audioModel; 
		return $this->profileId;
		}
		 return false; 
	}

	//Set all the public fields
	public function setProfile($userId)
	{
		$connection = new pdoconn();
		$STH = $connection->DBH->prepare("SELECT * FROM  profiles WHERE user_id = ?");
	 	$STH->bindParam(1,$userId);
		$STH->execute();
		if($row = $STH->fetch())
		{ 
			$this->name = $row['name'];
			$this->paypalAccount = $row['paypalAccount'];
			$this->userId = $row['user_id'];
			$this->age = $row['age'];
			$this->country = $row['country'];
			$this->city = $row['city'];
			$this->singer = $row['singer'];
			$this->producer = $row['music_producer'];
			$this->profileId = $row['profile_id'];
			$this->audios = new audioModel;
			return true;
		}
		return false;
	}
	/*** All the Getters Method ***/

	//Get the Age
	public function getAge() 
	{
		return $this->age;
	}
	//Get the Country
	public function getName()
	{
		return $this->name;
	}
	 
	 public function getPaypal()
	 {
	 	return $this->paypalAccount;
	 }
	 public function getCountry()
	 {
	 	return $this->country;
	 }
	 public function getCity()
	 {
	 	return $this->city;
	 }

	 public function getAudios()
		{
			return $this->audios;
		}
	 public function getProfileId()
	 {
	 	return $this->profileId;
	 }
	public function setUserId($userId)
	{
		$this->userId = $userId;
	}

	 public function getImage()
	 {
	 	return $this->image;
	 }

	 //Remove a profile
	 public function removeProfile($userId)
	 {
	 	$connection = new pdoconn();
		$STH = $connection->DBH->prepare("DELETE  FROM profiles  where user_id =  ?");
		$STH->bindParam(1,$userId);
		return $STH->execute();	 
	 }

	 //Update a profile  $name, $paypalAccount, $userId, $age, $country, $city, $singer, $producer,$profileId
	 public function updateProfile($name, $paypalAccount, $age, $country, $city, $singer, $producer , $profile_id)
	 {	
		$data = array("$name", "$singer", "$producer", "$paypalAccount",   "$age", "$country", "$city", "$profile_id");
		$connection = new pdoconn();
		$STH = $connection->DBH->prepare("update profiles  set name = ? , singer = ? , music_producer = ? , paypalAccount = ? , age = ?, country = ? , city = ?  where profile_id =  ?");
		if ($STH->execute($data))
		{

		$this->name = $name;
		$this->paypalAccount =  $paypalAccount; 
		$this->age = $age;
		$this->country = $country;
		$this->city = $city;
		$this->singer = $singer;
		$this->producer = $producer;
		//$this->profileId = $profile_id;
		return $this->profileId;
		}		 
	 }

	 //search singer or producer by name
	 public function searchProfile($name)
	 {
	 	$connection = new pdoconn();
	 	$name = "%".$name."%";
	 	$data = array("$name");
		$STH = $connection->DBH->prepare("SELECT * FROM  profiles WHERE name like ?");
		$STH->execute($data);
		$rows = $STH->fetchAll(PDO::FETCH_ASSOC);
		$profiles = [];
		foreach ($rows as $row) 
		{
			$profile = new profileModel;
			$profile->name = $row['name'];
			$profile->singer = $row['singer'];
			$profile->age =  $row['age'];
			$profile->city =  $row['city'];
			$profile->country =  $row['country'];
			$profile->producer =  $row['music_producer'];
			$profile->profileId = $row['profile_id'];
		    $profiles[] = $profile; 
		}
		return $profiles;
	 }

 	//Find a Profile
 	public function getProfile($profileId)
 	{
 		$connection = new pdoconn();
 		$data = array("$profileId");
		$STH = $connection->DBH->prepare("SELECT * FROM  profiles WHERE profile_id = ?");
		$STH->execute($data);
		$profile = new profileModel;
		if($row = $STH->fetch())
		{
		$profile = new profileModel;
		$profile->name = $row['name'];
		$profile->singer = $row['singer'];
		$profile->age =  $row['age'];
		$profile->city =  $row['city'];
		$profile->country =  $row['country'];
		$profile->producer =  $row['music_producer'];
		$profile->profileId = $row['profile_id'];
		}
		return $profile;
 	}
}